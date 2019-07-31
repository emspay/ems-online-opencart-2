<?php

/**
 * Class ControllerPaymentEmspaySepa
 */
class ControllerExtensionPaymentEmspaySepa extends Controller
{
    /**
     * Default currency for Order
     */
    const DEFAULT_CURRENCY = 'EUR';

    /**
     * Payments module name
     */
    const MODULE_NAME = 'emspay_sepa';

    /**
     *  EMS PAY bank transfer details
     */
    const EMS_BIC = 'INGBNL2A';
    const EMS_IBAN = 'NL13INGB0005300060';
    const EMS_HOLDER = 'ING Bank N.V. PSP';
    const EMS_RESIDENCE = 'Amsterdam';

    /**
     * @var \GingerPayments\Payment\Client
     */
    public $ems;

    /**
     * @var IngHelper
     */
    public $emsHelper;

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->emsHelper = new IngHelper(static::MODULE_NAME);
        $this->ems = $this->emsHelper->getClient($this->config);
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
                $emsOrderData = $this->emsHelper->getOrderData($orderInfo, $this);
                $emsOrder = $this->createOrder($emsOrderData);

                if ($emsOrder->status()->isError()) {
                    $this->language->load('extension/payment/'.static::MODULE_NAME);
                    $this->session->data['error'] = $emsOrder->transactions()->current()->reason()->toString();
                    $this->session->data['error'] .= $this->language->get('error_another_payment_method');
                    $this->response->redirect($this->url->link('checkout/checkout'));
                }

                $paymentReference = $this->getBankPaymentReference($emsOrder);

                $this->model_checkout_order->addOrderHistory(
                    $emsOrder->getMerchantOrderId(),
                    $this->emsHelper->getOrderStatus($emsOrder->getStatus(), $this->config),
                    'EMS PAY Bank Transfer order: '.$emsOrder->id()->toString(),
                    true
                );

                $this->model_checkout_order->addOrderHistory(
                    $emsOrder->getMerchantOrderId(),
                    $this->emsHelper->getOrderStatus($emsOrder->getStatus(), $this->config),
                    'EMS PAY Bank Transfer Reference ID: '.$paymentReference,
                    true
                );

                $data = [];
                $data['button_confirm'] = $this->language->get('button_confirm');
                $data['ems_bank_details'] = $this->language->get('ems_bank_details');
                $data['ems_payment_reference'] = $this->language->get('ems_payment_reference').$paymentReference;
                $data['ems_iban'] = $this->language->get('ems_iban').static::EMS_IBAN;
                $data['ems_bic'] = $this->language->get('ems_bic').static::EMS_BIC;
                $data['ems_account_holder'] = $this->language->get('ems_account_holder').static::EMS_HOLDER;
                $data['ems_residence'] = $this->language->get('ems_residence').static::EMS_RESIDENCE;
                $data['text_description'] = $this->language->get('text_description');
                $data['action'] = $this->emsHelper->getSucceedUrl($this, $this->session->data['order_id']);
                
                return $this->load->view('extension/payment/'.static::MODULE_NAME, $data);
            }
        } catch (\Exception $e) {
            $this->session->data['error'] = $e->getMessage();
            $this->response->redirect($this->url->link('checkout/checkout'));
        }
    }

    /**
     * Generate EMS PAY Payments order.
     *
     * @param array
     * @return \GingerPayments\Payment\Order
     */
    protected function createOrder(array $orderData)
    {
        return $this->ems->createSepaOrder(
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
     * @param \GingerPayments\Payment\Order $emsOrder
     * @return mixed
     */
    protected function getBankPaymentReference(\GingerPayments\Payment\Order $emsOrder)
    {
        return $emsOrder->transactions()->current()->paymentMethodDetails()->reference()->toString();
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
        $this->emsHelper->processWebhook($this, $webhookData);
    }
}
