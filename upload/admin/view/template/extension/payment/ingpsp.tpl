<?php echo $header; ?>
<?php echo $column_left; ?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-ing" data-toggle="tooltip" title="<?php echo $button_save; ?>"
                        class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
                   class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <?php if (isset($error_warning)) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <?php if (isset($info_message)) { ?>
        <div class="alert alert-info"><i class="fa fa-exclamation-circle"></i> <?php echo $info_message; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit_ing; ?></h3>
            </div>

            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ing"
                      class="form-horizontal">

                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-ing-api-key">
                            <span data-toggle="tooltip" title="<?php echo $info_help_api_key; ?>">
                                <?php echo $entry_ing_api_key; ?>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="ing_api_key" id="input-ing-api-key"
                                   value="<?php echo $ing_api_key; ?>" size="50" class="form-control"
                                   placeholder="<?php echo $info_help_api_key; ?>"/>
                            <?php if ($error_missing_api_key) { ?>
                            <div class="text-danger"><?php echo $error_missing_api_key; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php if ($ingpsp_module == 'ingpsp_klarna'): ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-ing-klarna-test-api-key">
                            <span data-toggle="tooltip" title="<?php echo $info_help_klarna_test_api_key; ?>">
                                <?php echo $entry_klarna_test_api_key; ?>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="ing_klarna_test_api_key" id="input-ing-klarna-test-api-key"
                                   value="<?php echo $ing_klarna_test_api_key; ?>" size="50" class="form-control"
                                   placeholder="<?php echo $info_help_klarna_test_api_key; ?>"/>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-klarna-ip-filter">
                            <span data-toggle="tooltip" title="<?php echo $info_help_klarna_ip_filter; ?>">
                                <?php echo $entry_klarna_ip_filter; ?>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="ing_klarna_ip_filter"
                                   value="<?php echo $ing_klarna_ip_filter; ?>"
                                   placeholder="<?php echo $ing_klarna_ip_filter; ?>"
                                   id="input-klarna-ip-filter" class="form-control" />
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($ingpsp_module == 'ingpsp_afterpay'): ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-ing-afterpay-test-api-key">
                            <span data-toggle="tooltip" title="<?php echo $info_help_afterpay_test_api_key; ?>">
                                <?php echo $entry_afterpay_test_api_key; ?>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="ing_afterpay_test_api_key" id="input-ing-afterpay-test-api-key"
                                   value="<?php echo $ing_afterpay_test_api_key; ?>" size="50" class="form-control"
                                   placeholder="<?php echo $info_help_afterpay_test_api_key; ?>"/>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-afterpay-ip-filter">
                            <span data-toggle="tooltip" title="<?php echo $info_help_afterpay_ip_filter; ?>">
                                <?php echo $entry_afterpay_ip_filter; ?>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="ing_afterpay_ip_filter"
                                   value="<?php echo $ing_afterpay_ip_filter; ?>"
                                   placeholder="<?php echo $ing_afterpay_ip_filter; ?>"
                                   id="input-afterpay-ip-filter" class="form-control" />
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-ing-product">
                            <?php echo $entry_ing_product; ?>
                        </label>
                        <div class="col-sm-10">
                            <select name="ing_psp_product" class="form-control"
                                    id="input-ing_psp_product">
                                <?php foreach ($psp_products as $value => $title) { ?>
                                <?php if ($value == $ing_psp_product) { ?>
                                <option value="<?php echo $value; ?>"
                                        selected="selected"><?php echo $title; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $value ?>"><?php echo $title; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing_order_status_id_new"><?php echo $entry_order_new; ?></label>
                        <div class="col-sm-10">
                            <select name="ing_order_status_id_new" class="form-control"
                                    id="input-ing_order_status_id_new">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $ing_order_status_id_new) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"
                                        selected="selected"><?php echo $order_status['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing_order_status_id_processing"><?php echo $entry_order_processing; ?></label>
                        <div class="col-sm-10">
                            <select name="ing_order_status_id_processing" class="form-control"
                                    id="input-ing_order_status_id_processing">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $ing_order_status_id_processing) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"
                                        selected="selected"><?php echo $order_status['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing_order_status_id_completed"><?php echo $entry_order_completed; ?></label>
                        <div class="col-sm-10">
                            <select name="ing_order_status_id_completed" class="form-control"
                                    id="input-ing_order_status_id_completed">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $ing_order_status_id_completed) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"
                                        selected="selected"><?php echo $order_status['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing_order_status_id_expired"><?php echo $entry_order_expired; ?></label>
                        <div class="col-sm-10">
                            <select name="ing_order_status_id_expired" class="form-control"
                                    id="input-ing_order_status_id_expired">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $ing_order_status_id_expired) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"
                                        selected="selected"><?php echo $order_status['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing_order_status_id_cancelled"><?php echo $entry_order_cancelled; ?></label>
                        <div class="col-sm-10">
                            <select name="ing_order_status_id_cancelled" class="form-control"
                                    id="input-ing_order_status_id_cancelled">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $ing_order_status_id_cancelled) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"
                                        selected="selected"><?php echo $order_status['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing_order_status_id_error"><?php echo $entry_order_error; ?></label>
                        <div class="col-sm-10">
                            <select name="ing_order_status_id_error" class="form-control"
                                    id="input-ing_order_status_id_error">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $ing_order_status_id_error) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"
                                        selected="selected"><?php echo $order_status['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing_order_status_id_captured"><?php echo $entry_order_captured; ?></label>
                        <div class="col-sm-10">
                            <select name="ing_order_status_id_captured" class="form-control"
                                    id="input-ing_order_status_id_captured">
                                <?php foreach ($order_statuses as $order_status) { ?>
                                <?php if ($order_status['order_status_id'] == $ing_order_status_id_captured) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"
                                        selected="selected"><?php echo $order_status['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="ing_sort_order"
                                   value="<?php echo $ing_sort_order; ?>"
                                   placeholder="<?php echo $ing_sort_order; ?>"
                                   id="input-sort-order" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing-total">
                             <span data-toggle="tooltip" title="<?php echo $info_help_total; ?>">
                                   <?php echo $entry_ing_total; ?>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="ing_total"
                                   value="<?php echo $ing_total; ?>"
                                   placeholder="<?php echo $info_help_total; ?>"
                                   id="input-ing-total" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="input-ing-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="ing_status" id="input-ing-status" class="form-control">
                                <?php if ($ing_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_cacert; ?></label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="ing_bundle_cacert" value="1"
                                <?php if ($ing_bundle_cacert) { ?> checked="checked" <?php } ?> />
                                <?php echo $text_yes; ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ing_bundle_cacert" value="0"
                                <?php if (!$ing_bundle_cacert) { ?> checked="checked" <?php } ?> />
                                <?php echo $text_no; ?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_send_webhook; ?></label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="ing_send_webhook" value="1"
                                <?php if ($ing_send_webhook) { ?> checked="checked" <?php } ?> />
                                <?php echo $text_yes; ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ing_send_webhook" value="0"
                                <?php if (!$ing_send_webhook) { ?> checked="checked" <?php } ?> />
                                <?php echo $text_no; ?>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>
