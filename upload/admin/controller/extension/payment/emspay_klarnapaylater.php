<?php

class ControllerExtensionPaymentEmspayKlarnaPayLater extends Controller
{
    const EMS_MODULE = 'emspay_klarnapaylater';

    public function index()
    {
        $this->load->controller('extension/payment/emspay_ideal', static::getModuleName());
    }

    static function getModuleName()
    {
        return static::EMS_MODULE;
    }

    public function install()
    {
        $this->load->model('extension/event');

        $this->model_extension_event->addEvent(
            'emspay_klarnapaylater_edit_order',
            'catalog/controller/api/order/edit/after',
            'extension/payment/emspay_klarnapaylater/capture'
        );

        $this->model_extension_event->addEvent(
            'emspay_klarnapaylater_add_history',
            'catalog/controller/api/order/history/after',
            'extension/payment/emspay_klarnapaylater/capture'
        );
    }

    public function uninstall()
    {
        $this->load->model('extension/event');
        $this->model_extension_event->deleteEvent('emspay_klarnapaylater_edit_order');
        $this->model_extension_event->deleteEvent('emspay_klarnapaylater_add_history');
    }
}
