<?php

class ModelExtensionPaymentIngpspKlarna extends Model
{
    public function getMethod($address, $total)
    {
        $this->load->language('extension/payment/ingpsp_klarna');

        $query = $this->db->query("SELECT * 
            FROM ".DB_PREFIX."zone_to_geo_zone 
            WHERE geo_zone_id = '".(int) $this->config->get('ingpsp_klarna_geo_zone_id')."' 
            AND country_id = '".(int) $address['country_id']."' 
            AND (zone_id = '".(int) $address['zone_id']."' 
            OR zone_id = '0');"
        );

        if ($this->config->get('ingpsp_klarna_total') > $total) {
            $status = false;
        } elseif (!$this->config->get('ingpsp_klarna_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }

        if (!IngHelper::ipIsEnabled($this->config->get('ingpsp_klarna_klarna_ip_filter'))) {
            $status = false;
        }

        $method_data = [];

        if ($status) {
            $method_data = [
                'code' => 'ingpsp_klarna',
                'title' => $this->language->get('text_title'),
                'terms' => $this->language->get('text_payment_terms'),
                'sort_order' => $this->config->get('ingpsp_klarna_sort_order')
            ];
        }

        return $method_data;
    }
}
