<?php

class ControllerExtensionPaymentIngpspAfterPay extends Controller
{
    /**
     * Default currency for Order
     */
    const DEFAULT_CURRENCY = 'EUR';
    
    /**
     * T&C url for Dutch loclae
     */
    const TERMS_CONDITION_URL_NL = 'https://www.afterpay.nl/nl/algemeen/betalen-met-afterpay/betalingsvoorwaarden';
    
    /**
     * T&C url for Belgium loclae
     */
    const TERMS_CONDITION_URL_BE = 'https://www.afterpay.be/be/footer/betalen-met-afterpay/betalingsvoorwaarden';
    
    /**
     * Belgium iso 2 code
     */
    const BE_ISO_CODE = 'BE';

    /**
     * Payments module name
     */
    const MODULE_NAME = 'ingpsp_afterpay';

    /**
     * @var \GingerPayments\Payment\Client
     */
    public $ing;

    /**
     * @var IngHelper
     */
    public $ingHelper;
    
    /**
     * @var array
     */
    protected static $allowedLocales = ['NL', 'BE'];

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->ingHelper = new IngHelper(static::MODULE_NAME);
        $this->ing = $this->ingHelper->getClientForAfterPay($this->config);
    }
    
    /**
     * Method is an event trigger for capturing Klarna shipped status.
     *
     * @param $route
     * @param $data
     */
    
    public function capture($route, $data)
    {
        $this->load->model('account/order');
        $this->load->model('checkout/order');

        try {
            $ingOrderId = IngHelper::searchHistoryForOrderKey(
                $this->model_account_order->getOrderHistories(
                    $this->request->get['order_id']
                )
            );

            if ($ingOrderId) {
                $order = $this->model_checkout_order->getOrder(
                    $this->request->get['order_id']
                );

                $capturedStatus = $this->ingHelper->getOrderStatus(
                    IngHelper::ING_STATUS_CAPTURED,
                    $this->config
                );

                if ($order['order_status_id'] == $capturedStatus) {
                    $this->ing->setOrderCapturedStatus(
                        $this->ing->getOrder($ingOrderId)
                    );
                };
            }
        } catch (\Exception $e) {
            $this->session->data['error'] = $e->getMessage();
        }
    }

    /**
     * Index Action
     * @return mixed
     */
    public function index()
    {
        $this->language->load('extension/payment/'.static::MODULE_NAME);

        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['text_select_bank'] = $this->language->get('text_select_bank');
        $data['action'] = $this->url->link('extension/payment/'.static::MODULE_NAME.'/confirm');
        $data['text_error_please_accept_tc'] = $this->language->get('error_please_accept_tc');
        $data['text_error_invalid_dob'] = $this->language->get('error_invalid_dob');
        $data['text_terms_and_conditions'] = $this->language->get('text_terms_and_conditions');
        $data['text_i_accept'] = $this->language->get('text_i_accept');
        $data['text_please_enter_dob'] = $this->language->get('text_please_enter_dob');
        $data['text_please_select_gender'] = $this->language->get('text_please_select_gender');
        $data['text_please_select_gender_male'] = $this->language->get('text_please_select_gender_male');
        $data['text_please_select_gender_female'] = $this->language->get('text_please_select_gender_female');
        $data['terms_conditions_url'] = $this->getTermsAndConditionUrlByCountryIsoLocale($this->session->data['payment_address']['iso_code_2']);
        $data['is_ap_allowed'] = $this->isPaymentAllowed($this->session->data['payment_address']['iso_code_2']);
        return $this->load->view('extension/payment/'.static::MODULE_NAME, $data);
    }

    /**
     * Order Confirm Action
     */
    public function confirm()
    {
        try {
            $this->load->model('checkout/order');
            $orderInfo = $this->model_checkout_order->getOrder($this->session->data['order_id']);
            if ($orderInfo) {
                $ingOrderData = $this->ingHelper->getOrderData($orderInfo, $this);
                $ingOrder = $this->createOrder($ingOrderData);

                if ($ingOrder->status()->isError()) {
                    $this->language->load('extension/payment/'.static::MODULE_NAME);
                    $this->session->data['error'] = $ingOrder->transactions()->current()->reason()->toString();
                    $this->session->data['error'] .= $this->language->get('error_another_payment_method');
                    $this->response->redirect($this->url->link('checkout/checkout'));
                } elseif ($ingOrder->status()->isCancelled()) { 
                    $this->response->redirect($this->getCancelledStatusUrl($this->session->data['order_id']));
                }

                $this->model_checkout_order->addOrderHistory(
                    $ingOrder->getMerchantOrderId(),
                    $this->ingHelper->getOrderStatus($ingOrder->getStatus(), $this->config),
                    'ING PSP AfterPay order: '.$ingOrder->id()->toString(),
                    true
                );
                $this->response->redirect($this->ingHelper->getSucceedUrl($this, $this->session->data['order_id']));
            }
        } catch (\Exception $e) {
            $this->session->data['error'] = $e->getMessage();
            $this->response->redirect($this->url->link('checkout/checkout'));
        }
    }

    /**
     * @param $paymentMethod
     * @param int $orderId
     * @return string
     */
    public function getCancelledStatusUrl($orderId)
    {
        return htmlspecialchars_decode(
            $this->url->link(
                'extension/payment/ingpsp_afterpay_cancelled',
                ['order_id' => $orderId]
            )
        );
    }
    
    /**
     * Callback Action
     */
    public function callback()
    {
        $this->ingHelper->loadCallbackFunction($this);
    }

    /**
     * Pending order processing page
     *
     * @return mixed
     */
    public function processing()
    {
        return $this->ingHelper->loadProcessingPage($this);
    }

    /**
     * Pending order processing page
     *
     * @return mixed
     */
    public function pending()
    {
        $this->cart->clear();

        return $this->ingHelper->loadPendingPage($this);
    }

    /**
     * Webhook action is called by API when transaction status is updated
     *
     * @return void
     */
    public function webhook()
    {
        $this->load->model('checkout/order');
        $webhookData = json_decode(file_get_contents('php://input'), true);
        $this->ingHelper->processWebhook($this, $webhookData);
    }

    /**
     * Generate ING PSP iDEAL order.
     *
     * @param array
     * @return \GingerPayments\Payment\Order
     */
    protected function createOrder(array $orderData)
    {
        return $this->ing->createAfterPayOrder(
            $orderData['amount'],            // Amount in cents
            $orderData['currency'],          // Currency
            $orderData['description'],       // Description
            $orderData['merchant_order_id'], // Merchant Order Id
            null,                            // Return URL
            null,                            // Expiration Period
            $orderData['customer'],          // Customer information
            $orderData['plugin_version'],    // Extra information
            $orderData['webhook_url'],       // Webhook URL
            $orderData['order_lines']        // Order lines
        );
    }
    
    /**
     * get t&c url based on user locale
     *
     * @param string $iso2code
     * @return string
     */
    protected function getTermsAndConditionUrlByCountryIsoLocale($iso2code)
    {
        if (strtoupper($iso2code) === self::BE_ISO_CODE) {
            return self::TERMS_CONDITION_URL_BE;
        }
        return self::TERMS_CONDITION_URL_NL;
    }
    
    /**
     * check is payment allowed for the locale
     *
     * @param type $iso2code
     * @return bool
     */
    protected function isPaymentAllowed($iso2code)
    {
        return in_array(strtoupper($iso2code), self::$allowedLocales);
    }
}
