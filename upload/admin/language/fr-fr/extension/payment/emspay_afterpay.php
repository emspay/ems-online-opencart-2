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
$_['entry_status'] = 'Statut:';
$_['entry_order_completed'] = 'Commande réalisé:';
$_['entry_order_new'] = 'Nouvelle commande:';
$_['entry_order_expired'] = 'Commande expirée:';
$_['entry_order_cancelled'] = 'Commande Annulé:';
$_['entry_order_processing'] = 'Commande en traitement:';
$_['entry_order_error'] = 'Erreur de commande:';
$_['entry_sort_order'] = 'Order de tri:';
$_['entry_ems_api_key'] = 'EMS Online clé API:';
$_['entry_ems_total'] = 'Total:';
$_['entry_country_access'] = 'Pays disponibles pour AfterPay';
$_['entry_cacert'] = 'Bundle cURL ca.cert:';
$_['entry_order_captured'] = 'Commande capturé:';

/**
 * Text strings
 */
$_['text_button_save'] = 'Enregister';
$_['text_button_cancel'] = 'Annuler';
$_['text_enabled'] = 'Activé';
$_['text_disabled'] = 'Désactivé';
$_['text_payments'] = 'Paiements';
$_['text_issuer_id'] = 'SWIFT/BIC';
$_['text_settings_saved'] = 'EMS Online: Paramètres AfterPay mis à jour!';
$_['text_edit_ems'] = 'Modifier EMS Online Paiments: Paramètres AfterPay';
$_['text_yes'] = 'Oui';
$_['text_no'] = 'Non';

/**
 * Error messages
 */
$_['error_missing_api_key'] = 'EMS Online clé API est obligatoire!';

/**
 * Information text
 */
$_['info_help_api_key'] = 'Obtenez votre EMS Online clé API du portail marchand.';
$_['info_help_total'] = 'Le total de la caisse que la commande doit atteindre avant que ce mode de paiement devient actif.';
$_['info_plugin_not_configured'] = 'EMS Online: Plugin AfterPay est pas configuré.';
$_['info_help_afterpay_ip_filter'] = 'Si cette champs est rempli, uniquement pour ces adresses IP le mode de paiement sera affiché. (Par Ex: 128.0.0.1, 255.255.255.255)';
$_['entry_afterpay_ip_filter'] = 'le filtrage IP:';
$_['entry_afterpay_test_api_key'] = 'clé API de Test:';
$_['info_help_afterpay_test_api_key'] = 'Si entré, cette clé API sera utilisée uniquement à des test.';
$_['info_help_country_access'] = 'Pour autoriser AfterPay à être utilisé pour tout autre pays, ajoutez simplement son code de pays (dans la norme ISO 2) au champ &#34;Pays disponibles pour AfterPay&#34;. <br> Exemple: BE, NL, FR <br> Si le champ est vide, AfterPay sera disponible pour tous les pays.';
$_['info_example_country_access'] = 'BE, NL, FR';

/**
 * Refund text
 */
$_['empty_price'] = 'Le prix est vide dans les informations sur le produit de remboursement.';
$_['wrong_order_status'] = 'Seules les commandes terminées peuvent être remboursées.';
$_['order_not_captured'] = 'Les remboursements ne sont possibles qu\'une fois capturés.';
$_['refund_not_completed'] = 'La commande de remboursement n\'est pas terminée.';