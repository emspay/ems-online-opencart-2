<?php

/**
 * General Admin Settings Page
 */
$_['heading_title'] = 'ING PSP: Carte de Credit ';
$_['text_ingpsp_cc'] = '<img src="view/image/payment/ingpsp.png" alt="ING PSP" title="ING PSP" />';
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
$_['entry_ing_api_key'] = 'ING PSP clé API:';
$_['entry_ing_total'] = 'Total:';
$_['entry_ing_product'] = 'Produit ING PSP:';
$_['entry_cacert'] = 'Bundle cURL ca.cert:';
$_['entry_send_webhook'] = 'Générer URL Webhook:';
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
$_['text_settings_saved'] = 'ING PSP: Paramètres Carte de Credit mis à jour!';
$_['text_edit_ing'] = 'Modifier ING PSP: Paramètres Carte de Credit';
$_['text_yes'] = 'Oui';
$_['text_no'] = 'Non';

/**
 * Error messages
 */
$_['error_missing_api_key'] = 'ING PSP clé API est obligatoire!';

/**
 * Information text
 */
$_['info_help_api_key'] = 'Obtenez votre ING PSP clé API du portail marchand.';
$_['info_help_total'] = 'Le total de la caisse que la commande doit atteindre avant que ce mode de paiement devient actif.';
$_['info_plugin_not_configured'] = 'ING PSP: Plugin Carte de Credit est pas configuré.';
$_['info_help_klarna_ip_filter'] = 'Si cette champs est rempli, uniquement pour ces adresses IP le mode de paiement sera affiché. (Par Ex: 128.0.0.1, 255.255.255.255)';
$_['entry_klarna_ip_filter'] = 'le filtrage IP:';
$_['entry_klarna_test_api_key'] = 'clé API de Test:';
$_['info_help_klarna_test_api_key'] = 'Si entré, cette clé API sera utilisée uniquement à des test.';