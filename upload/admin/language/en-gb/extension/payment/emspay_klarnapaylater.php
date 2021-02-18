<?php

/**
 * General Admin Settings Page
 */
$_['heading_title'] = 'EMS Online: Klarna Pay Later';
$_['text_emspay_klarnapaylater'] = '<img src="view/image/payment/emspay_klarnapaylater.png" alt="EMS Online" title="EMS Online" />';
$_['text_extension'] = 'Extensions';

/**
 * Entry points
 */
$_['entry_status'] = 'Status:';
$_['entry_order_completed'] = 'Order Completed:';
$_['entry_order_new'] = 'Order New:';
$_['entry_order_expired'] = 'Order Expired:';
$_['entry_order_cancelled'] = 'Order Cancelled:';
$_['entry_order_processing'] = 'Order Processing:';
$_['entry_order_error'] = 'Order Error:';
$_['entry_sort_order'] = 'Sort Order:';
$_['entry_ems_api_key'] = 'EMS Online API Key:';
$_['entry_ems_total'] = 'Minimum order amount:';
$_['entry_cacert'] = 'Bundle cURL ca.cert:';
$_['entry_order_captured'] = 'Order Captured:';

/**
 * Text strings
 */
$_['text_button_save'] = 'Save';
$_['text_button_cancel'] = 'Cancel';
$_['text_enabled'] = 'Enabled';
$_['text_disabled'] = 'Disabled';
$_['text_payments'] = 'Payments';
$_['text_issuer_id'] = 'SWIFT/BIC';
$_['text_settings_saved'] = 'EMS Online: Klarna Pay Later settings updated!';
$_['text_edit_ems'] = 'Edit EMS Online: Klarna Pay Later Settings';
$_['text_yes'] = 'Yes';
$_['text_no'] = 'No';

/**
 * Error messages
 */
$_['error_missing_api_key'] = 'EMS Online API Key is required!';

/**
 * Information text
 */
$_['info_help_api_key'] = 'Get your EMS Online API key from Payments merchant portal.';
$_['info_help_total'] = 'The payment method will only be presented if the total checkout amount of an order is higher than this threshold.';
$_['info_plugin_not_configured'] = 'EMS Online: Klarna Pay Later plugin is not configured.';
$_['info_help_klarnapaylater_ip_filter'] = 'If entered, only for those IPs payment method will be displayed. (Example: 128.0.0.1, 255.255.255.255)';
$_['entry_klarnapaylater_ip_filter'] = 'IP Filtering:';
$_['entry_klarnapaylater_test_api_key'] = 'Test API Key:';
$_['info_help_klarnapaylater_test_api_key'] = 'If entered this API key will be used for testing purposes.';

/**
 * Refund text
 */
$_['empty_price'] = 'The price is empty in the refund product information.';
$_['wrong_order_status'] = 'Only completed orders can be refunded.';
$_['order_not_captured'] = 'Refunds only possible when captured.';
$_['refund_not_completed'] = 'Refund order is not completed.';
