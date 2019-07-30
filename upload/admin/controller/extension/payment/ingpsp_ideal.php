<?php

/**
 * Class ControllerPaymentIngIdeal
 */
class ControllerExtensionPaymentIngpspIdeal extends Controller
{
    /**
     * Prefix for fields in admin settings page
     */
    const POST_FIELD_PREFIX = 'ing_';

    /**
     * @var array
     */
    static $update_fields = [
        'api_key',
        'psp_product',
        'status',
        'sort_order',
        'order_status_id_new',
        'order_status_id_processing',
        'order_status_id_completed',
        'order_status_id_expired',
        'order_status_id_cancelled',
        'order_status_id_error',
        'order_status_id_captured',
        'total',
        'bundle_cacert',
        'send_webhook',
        'klarna_ip_filter',
        'klarna_test_api_key',
        'afterpay_ip_filter',
        'afterpay_test_api_key'
    ];

    /**
     * @var array ING PSP list of available products
     */
    static $psp_products = [
        'kassacompleet' => 'Kassa Compleet',
        'ingcheckout' => 'ING Checkout',
        'epay' => 'ING ePay'
    ];

    /**
     * @var string
     */
    private $ingModuleName;

    /**
     * @var array
     */
    private $error = array();

    /**
     * @param string $ingModuleName
     */
    public function index($ingModuleName = 'ingpsp_ideal')
    {
        $this->setModuleName($ingModuleName);

        $this->language->load('extension/payment/'.$ingModuleName);
        $this->load->model('setting/setting');
        $this->load->model('localisation/order_status');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->updateSettings();
        }

        $data = $this->getTemplateData();
        $data = $this->prepareSettingsData($data);

        $data['breadcrumbs'] = $this->getBreadcrumbs();
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['ingpsp_module'] = $this->getModuleName();

        $this->response->setOutput($this->load->view('extension/payment/ingpsp', $data));
    }

    /**
     * @return bool
     */
    protected function validate()
    {
        if (!$this->request->post[$this->getPostFieldName('api_key')]) {
            $this->error['missing_api'] = $this->language->get('error_missing_api_key');
        }

        if (!$this->user->hasPermission('modify', 'extension/payment/'.$this->getModuleName())) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    /**
     * Method updates Payment Settings and redirects back to payment plugin page
     */
    protected function updateSettings()
    {
        $this->model_setting_setting->editSetting($this->getModuleName(), $this->mapPostData());

        $this->session->data['success'] = $this->language->get('text_settings_saved');

        $this->response->redirect(
            $this->url->link('extension/extension', 'token='.$this->session->data['token'] . '&type=payment', true)
        );
    }

    /**
     * @return array
     */
    protected function getTemplateData()
    {
        return [
            'heading_title' => $this->language->get('heading_title'),
            'text_edit_ing' => $this->language->get('text_edit_ing'),
            'info_help_api_key' => $this->language->get('info_help_api_key'),
            'info_help_klarna_ip_filter' => $this->language->get('info_help_klarna_ip_filter'),
            'info_help_klarna_test_api_key' => $this->language->get('info_help_klarna_test_api_key'),
            'info_help_afterpay_ip_filter' => $this->language->get('info_help_afterpay_ip_filter'),
            'info_help_afterpay_test_api_key' => $this->language->get('info_help_afterpay_test_api_key'),
            'info_help_total' => $this->language->get('info_help_total'),
            'entry_ing_api_key' => $this->language->get('entry_ing_api_key'),
            'entry_order_completed' => $this->language->get('entry_order_completed'),
            'entry_order_new' => $this->language->get('entry_order_new'),
            'entry_order_error' => $this->language->get('entry_order_error'),
            'entry_order_expired' => $this->language->get('entry_order_expired'),
            'entry_order_cancelled' => $this->language->get('entry_order_cancelled'),
            'entry_order_processing' => $this->language->get('entry_order_processing'),
            'entry_order_captured' => $this->language->get('entry_order_captured'),
            'entry_sort_order' => $this->language->get('entry_sort_order'),
            'entry_status' => $this->language->get('entry_status'),
            'entry_ing_total' => $this->language->get('entry_ing_total'),
            'entry_ing_product' =>  $this->language->get('entry_ing_product'),
            'entry_cacert' =>  $this->language->get('entry_cacert'),
            'entry_send_webhook' =>  $this->language->get('entry_send_webhook'),
            'entry_klarna_ip_filter' => $this->language->get('entry_klarna_ip_filter'),
            'entry_afterpay_ip_filter' => $this->language->get('entry_afterpay_ip_filter'),
            'entry_klarna_test_api_key' => $this->language->get('entry_klarna_test_api_key'),
            'entry_afterpay_test_api_key' => $this->language->get('entry_afterpay_test_api_key'),
            'text_enabled' => $this->language->get('text_enabled'),
            'text_disabled' => $this->language->get('text_disabled'),
            'button_save' => $this->language->get('text_button_save'),
            'button_cancel' => $this->language->get('text_button_cancel'),
            'text_yes' => $this->language->get('text_yes'),
            'text_no' => $this->language->get('text_no'),
            'action' => $this->url->link(
                'extension/payment/'.$this->getModuleName(), 'token='.$this->session->data['token'],
                true
            ),
            'cancel' => $this->url->link(
                'extension/extension', 'token='.$this->session->data['token'] . '&type=payment',
                true
            ),
            'psp_products' => self::$psp_products
        ];
    }

    /**
     * Process and prepare data for configuration page
     *
     * @param array $data
     * @return array
     */
    protected function prepareSettingsData(array $data)
    {
        foreach (static::$update_fields AS $fieldToUpdate) {
            $formPostFiled = $this->getPostFieldName($fieldToUpdate);
            if (isset($this->request->post[$formPostFiled])) {
                $data[$formPostFiled] = $this->request->post[$formPostFiled];
            } else {
                $data[$formPostFiled] = $this->config->get($this->getModuleFieldName($fieldToUpdate));
            }
        }

        if (empty($this->config->get($this->getModuleFieldName('api_key')))) {
            $data['info_message'] = $this->language->get('info_plugin_not_configured');
        }

        if (isset($this->error['missing_api'])) {
            $data['error_missing_api_key'] = $this->error['missing_api'];
        } else {
            $data['error_missing_api_key'] = '';
        }

        return $data;
    }

    /**
     * Generate configuration page breadcrumbs
     *
     * @return array
     */
    protected function getBreadcrumbs()
    {
        return [
            [
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token='.$this->session->data['token'], true)
            ],
            [
                'text' => $this->language->get('text_extension'),
                'href' => $this->url->link('extension/extension', 'token='.$this->session->data['token'].'&type=payment', true)
            ],
            [
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/payment/'.$this->getModuleName(),
                    'token='.$this->session->data['token'], true)
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getUpdateFields()
    {
        $fields = [];
        foreach (static::$update_fields AS $field) {
            $fields[] = $this->getModuleName().'_'.$field;
        }
        return $fields;
    }

    /**
     * @return array
     */
    protected function mapPostData()
    {
        $postFields = [];
        foreach (static::$update_fields AS $field) {
            $postFields[$this->getModuleFieldName($field)] = $this->request->post[$this->getPostFieldName($field)];
        }

        return $postFields;
    }


    /**
     * @param string $ingModuleName
     */
    protected function setModuleName($ingModuleName)
    {
        $this->ingModuleName = $ingModuleName;
    }

    /**
     * @return string
     */
    protected function getModuleName()
    {
        return $this->ingModuleName;
    }

    /**
     * @param  string $fieldName
     * @return string
     */
    protected function getModuleFieldName($fieldName)
    {
        return $this->getModuleName().'_'.$fieldName;
    }

    /**
     * @param $postFieldName
     * @return string
     */
    protected function getPostFieldName($postFieldName)
    {
        return static::POST_FIELD_PREFIX.$postFieldName;
    }
}
