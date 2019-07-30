<?php

/**
 * Class ControllerPaymentIngpspSepa
 */
class ControllerExtensionPaymentIngpspSepa extends Controller
{
    /**
     * Default currency for Order
     */
    const DEFAULT_CURRENCY = 'EUR';

    /**
     * Payments module name
     */
    const MODULE_NAME = 'ingpsp_sepa';

    /**
     *  ING PSP bank transfer details
     */
    const ING_BIC = 'INGBNL2A';
    const ING_IBAN = 'NL13INGB0005300060';
    const ING_HOLDER = 'ING Bank N.V. PSP';
    const ING_RESIDENCE = 'Amsterdam';

    /**
     * @var \GingerPayments\Payment\Client
     */
    public $ing;

    /**
     * @var IngHelper
     */
    public $ingHelper;

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->ingHelper = new IngHelper(static::MODULE_NAME);
        $this->ing = $this->ingHelper->getClient($this->config);
        $this->language->load('extension/payment/'.static::MODULE_NAME);
        $this->load->model('checkout/order');
    }

    /**
     * Index Action
     * @return mixed
     */
    public function index()
    {
        try {
            $orderInfo = $this->model_checkout_order->getOrder($this->session->data['order_id']);

            if ($orderInfo) {
                $ingOrderData = $this->ingHelper->getOrderData($orderInfo, $this);
                $ingOrder = $this->createOrder($ingOrderData);

                if ($ingOrder->status()->isError()) {
                    $this->language->load('extension/payment/'.static::MODULE_NAME);
                    $this->session->data['error'] = $ingOrder->transactions()->current()->reason()->toString();
                    $this->session->data['error'] .= $this->language->get('error_another_payment_method');
                    $this->response->redirect($this->url->link('checkout/checkout'));
                }

                $paymentReference = $this->getBankPaymentReference($ingOrder);

                $this->model_checkout_order->addOrderHistory(
                    $ingOrder->getMerchantOrderId(),
                    $this->ingHelper->getOrderStatus($ingOrder->getStatus(), $this->config),
                    'ING PSP Bank Transfer order: '.$ingOrder->id()->toString(),
                    true
                );

                $this->model_checkout_order->addOrderHistory(
                    $ingOrder->getMerchantOrderId(),
                    $this->ingHelper->getOrderStatus($ingOrder->getStatus(), $this->config),
                    'ING PSP Bank Transfer Reference ID: '.$paymentReference,
                    true
                );

                $data = [];
                $data['button_confirm'] = $this->language->get('button_confirm');
                $data['ing_bank_details'] = $this->language->get('ing_bank_details');
                $data['ing_payment_reference'] = $this->language->get('ing_payment_reference').$paymentReference;
                $data['ing_iban'] = $this->language->get('ing_iban').static::ING_IBAN;
                $data['ing_bic'] = $this->language->get('ing_bic').static::ING_BIC;
                $data['ing_account_holder'] = $this->language->get('ing_account_holder').static::ING_HOLDER;
                $data['ing_residence'] = $this->language->get('ing_residence').static::ING_RESIDENCE;
                $data['text_description'] = $this->language->get('text_description');
                $data['action'] = $this->ingHelper->getSucceedUrl($this, $this->session->data['order_id']);
                
                return $this->load->view('extension/payment/'.static::MODULE_NAME, $data);
            }
        } catch (\Exception $e) {
            $this->session->data['error'] = $e->getMessage();
            $this->response->redirect($this->url->link('checkout/checkout'));
        }
    }

    /**
     * Generate ING PSP Payments order.
     *
     * @param array
     * @return \GingerPayments\Payment\Order
     */
    protected function createOrder(array $orderData)
    {
        return $this->ing->createSepaOrder(
            $orderData['amount'],            // Amount in cents
            $orderData['currency'],          // Currency
            $orderData['payment_info'],      // Payment information
            $orderData['description'],       // Description
            $orderData['merchant_order_id'], // Merchant Order Id
            $orderData['return_url'],        // Return URL
            null,                            // Expiration Period
            $orderData['customer'],          // Customer information
            $orderData['plugin_version'],    // Extra information
            $orderData['webhook_url']        // Webhook URL
        );
    }

    /**
     * Method gets payment reference from order.
     *
     * @param \GingerPayments\Payment\Order $ingOrder
     * @return mixed
     */
    protected function getBankPaymentReference(\GingerPayments\Payment\Order $ingOrder)
    {
        return $ingOrder->transactions()->current()->paymentMethodDetails()->reference()->toString();
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
}
