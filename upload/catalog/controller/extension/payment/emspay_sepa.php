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
     *  EMS Online bank transfer details
     */
    const EMS_BIC = 'ABNANL2A';
    const EMS_IBAN = 'NL79ABNA0842577610';
    const EMS_HOLDER = 'THIRD PARTY FUNDS EMS';
    const EMS_RESIDENCE = 'Amsterdam';

    /**
     * @var Ginger\ApiClient\
     */
    public $ems;

    /**
     * @var EmsHelper
     */
    public $emsHelper;

    /**
     * @param $registry
     */
    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->emsHelper = new EmsHelper(static::MODULE_NAME);
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

                if ($emsOrder['status'] == 'error') {
                    $this->language->load('extension/payment/'.static::MODULE_NAME);
                    $this->session->data['error'] = $emsOrder['transactions'][0]['reason'];
                    $this->session->data['error'] .= $this->language->get('error_another_payment_method');
                    $this->response->redirect($this->url->link('checkout/checkout'));
                }

                $paymentReference = $this->getBankPaymentReference($emsOrder);

                $this->model_checkout_order->addOrderHistory(
                    $emsOrder['transactions'][0]['merchant_order_id'],
                    $this->emsHelper->getOrderStatus($emsOrder['status'], $this->config),
                    'EMS Online Bank Transfer order: '.$emsOrder['id'],
                    true
                );

                $this->model_checkout_order->addOrderHistory(
                    $emsOrder['transactions'][0]['merchant_order_id'],
                    $this->emsHelper->getOrderStatus($emsOrder['status'], $this->config),
                    'EMS Online Bank Transfer Reference ID: '.$paymentReference,
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
     * Generate EMS Online Payments order.
     *
     * @param array
     * @return array
     */
    protected function createOrder(array $orderData)
    {
        return $this->ems->createOrder([
            'amount' => $orderData['amount'],                                // Amount in cents
            'currency' => (string) $orderData['currency'],                   // Currency
            'description' => $orderData['description'],                      // Description
            'merchant_order_id' => (string) $orderData['merchant_order_id'], // Merchant Order Id
            'return_url' => $orderData['return_url'],                        // Return URL
            'customer' => $orderData['customer'],                            // Customer information
            'extra' => $orderData['plugin_version'],                         // Extra information
            'webhook_url' => $orderData['webhook_url'],                      // Webhook URL
            'transactions' => [
                [
                    'payment_method' => "bank-transfer"
                ]
            ]
        ]);
    }

    /**
     * Method gets payment reference from order.
     *
     * @return mixed
     */
    protected function getBankPaymentReference($emsOrder)
    {
        return $emsOrder['transactions'][0]['payment_method_details']['reference'];
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
