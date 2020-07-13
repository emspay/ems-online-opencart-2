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
$_['entry_order_completed'] = 'Bestellung abgeschlossen:';
$_['entry_order_new'] = 'Neu Bestellung:';
$_['entry_order_expired'] = 'Bestellung abgelaufen:';
$_['entry_order_cancelled'] = 'Bestellung annulliert:';
$_['entry_order_processing'] = 'Bestellung wird bearbeitet:';
$_['entry_order_error'] = 'Bestellfehler:';
$_['entry_sort_order'] = 'Sortierreihenfolge:';
$_['entry_ems_api_key'] = 'EMS Online API Schüssel:';
$_['entry_ems_total'] = 'Gesamt:';
$_['entry_country_access'] = 'Für AfterPay verfügbare Länder';
$_['entry_cacert'] = 'Bundle cURL ca.cert:';
$_['entry_send_webhook'] = 'Webhook-URL automatisch generieren:';
$_['entry_order_captured'] = 'Bestellung gefangen:';

/**
 * Text strings
 */
$_['text_button_save'] = 'Speichern';
$_['text_button_cancel'] = 'Abbrechen';
$_['text_enabled'] = 'Aktiviert';
$_['text_disabled'] = 'Deaktiviert';
$_['text_payments'] = 'Zahlungen';
$_['text_issuer_id'] = 'SWIFT/BIC';
$_['text_settings_saved'] = 'EMS Online: AfterPay Einstellungen aktualisiert!';
$_['text_edit_ems'] = 'Bearbeiten EMS Online: AfterPay Einstellungen';
$_['text_yes'] = 'Ja';
$_['text_no'] = 'Nein';

/**
 * Error messages
 */
$_['error_missing_api_key'] = 'EMS Online API schlüssel ist erforderlich!';

/**
 * Information text
 */
$_['info_help_api_key'] = 'Duplizieren Sie Ihre EMS Online API Schlüssel von Merchant Portal.';
$_['info_help_total'] = 'Die Zahlungsmethode wird nur angezeigt, wenn der Gesamtbestellbetrag einer Bestellung diesen Schwellenwert überschreitet.';
$_['info_plugin_not_configured'] = 'EMS Online: AfterPay plugin ist nicht konfiguriert.';
$_['info_help_afterpay_ip_filter'] = 'Wenn eingegeben, wird nur für diese IPs die Zahlungsmethode angezeigt. (Beispiel: 128.0.0.1, 255.255.255.255)';
$_['entry_afterpay_ip_filter'] = 'IP-Filterung:';
$_['entry_afterpay_test_api_key'] = 'Test API schlüssel:';
$_['info_help_afterpay_test_api_key'] = 'Wenn eingegeben, wird dieser API-Schlüssel nur zu Testzwecken verwendet werden.';
$_['info_help_country_access'] = 'Damit AfterPay für jedes andere Land verwendet werden kann, fügen Sie einfach seinen Ländercode (in ISO 2-Norm) in das Feld &#34;Für AfterPay verfügbare Länder&#34; ein. Beispiel: BE, NL, FR';
$_['info_example_country_access'] = 'BE, NL, FR';
