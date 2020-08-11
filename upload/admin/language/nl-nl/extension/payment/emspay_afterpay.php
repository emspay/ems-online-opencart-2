<?php

/**
 * General Admin Settings Page
 */
$_['heading_title'] = 'EMS Online: AfterPay';
$_['text_emspay_afterpay'] = '<img src="view/image/payment/emspay_afterpay.png" alt="EMS Online" title="EMS Online" />';
$_['text_extension'] = 'Extensions';

/**
 * Entry points
 */
$_['entry_status'] = 'Status:';
$_['entry_order_completed'] = 'Bestelling afgerond:';
$_['entry_order_new'] = 'Nieuwe Bestelling :';
$_['entry_order_expired'] = 'Bestelling Verlopen:';
$_['entry_order_cancelled'] = 'Bestelling is geannuleerd:';
$_['entry_order_processing'] = 'Bestelling in verwerking:';
$_['entry_order_error'] = 'Bestellingsfout:';
$_['entry_sort_order'] = 'Sorteervolgorde:';
$_['entry_ems_api_key'] = 'EMS Online API Key:';
$_['entry_ems_total'] = 'Minimum bestelbedrag:';
$_['entry_country_access'] = 'Landen beschikbaar voor AfterPay';
$_['entry_cacert'] = 'Bundle cURL ca.cert:';
$_['entry_send_webhook'] = 'Genereer webhook URL:';
$_['entry_order_captured'] = 'Bestelling gevangen:';

/**
 * Text strings
 */
$_['text_button_save'] = 'Opslaan';
$_['text_button_cancel'] = 'Annuleren';
$_['text_enabled'] = 'Ingeschakeld';
$_['text_disabled'] = 'Uitgeschakeld';
$_['text_payments'] = 'Betalingen';
$_['text_issuer_id'] = 'SWIFT/BIC';
$_['text_settings_saved'] = 'EMS Online: AfterPay Instellingen bijgewerkt!';
$_['text_edit_ems'] = 'Bewerken EMS Online: AfterPay Instellingen';
$_['text_yes'] = 'Ja';
$_['text_no'] = 'Nee';

/**
 * Error messages
 */
$_['error_missing_api_key'] = 'EMS Online API Key is verplicht!';

/**
 * Information text
 */
$_['info_help_api_key'] = 'Kopieer uw EMS Online API key van uw merchant portal.';
$_['info_help_total'] = 'De betaalmethode wordt alleen getoond als het totaalbedrag van een bestelling hoger is dan dit bedrag.';
$_['info_plugin_not_configured'] = 'EMS Online: AfterPay plugin is niet ingesteld.';
$_['info_help_afterpay_ip_filter'] = 'U kunt specifieke IP adressen opgeven waarvoor de betaalmethode zichtbaar is, bv als u wilt testen  (bijvoorbeeld: 128.0.0.1, 255.255.255.255)';
$_['entry_afterpay_ip_filter'] = 'IP-Filteren:';
$_['entry_afterpay_test_api_key'] = 'Test API Key:';
$_['info_help_afterpay_test_api_key'] = 'Vul hier de API Key in van uw test webshop.';
$_['info_help_country_access'] = 'Om AfterPay voor elk ander land te kunnen gebruiken, voegt u de landcode (in ISO 2-norm) toe aan het veld &#34;Beschikbare landen voor AfterPay&#34;.<br> Voorbeeld: BE, NL, FR <br> Als het veld leeg is, is AfterPay beschikbaar voor alle landen.';
$_['info_example_country_access'] = 'BE, NL, FR';