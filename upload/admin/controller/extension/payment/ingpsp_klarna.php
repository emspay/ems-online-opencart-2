<?php

class ControllerExtensionPaymentIngpspKlarna extends Controller
{
    const ING_MODULE = 'ingpsp_klarna';

    public function index()
    {
        $this->load->controller('extension/payment/ingpsp_ideal', static::getModuleName());
    }

    static function getModuleName()
    {
        return static::ING_MODULE;
    }

    public function install()
    {
        $this->load->model('extension/event');

        $this->model_extension_event->addEvent(
            'ingpsp_klarna_edit_order',
            'catalog/controller/api/order/edit/after',
            'extension/payment/ingpsp_klarna/capture'
        );

        $this->model_extension_event->addEvent(
            'ingpsp_klarna_add_history',
            'catalog/controller/api/order/history/after',
            'extension/payment/ingpsp_klarna/capture'
        );
    }

    public function uninstall()
    {
        $this->load->model('extension/event');
        $this->model_extension_event->deleteEvent('ingpsp_klarna_edit_order');
        $this->model_extension_event->deleteEvent('ingpsp_klarna_add_history');
    }
}
