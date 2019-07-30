<?php

class ControllerExtensionPaymentIngpspSepa extends Controller
{
    const ING_MODULE = 'ingpsp_sepa';

    public function index()
    {
        $this->load->controller('extension/payment/ingpsp_ideal', static::getModuleName());
    }

    static function getModuleName()
    {
        return static::ING_MODULE;
    }
}
