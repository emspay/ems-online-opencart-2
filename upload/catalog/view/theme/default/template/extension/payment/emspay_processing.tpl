<?php echo $header; ?>

<div class="container">
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>
    <div class="row">
        <?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?>">
            <?php echo $content_top; ?>
            <h1><?php echo $order_description_text; ?></h1>
            <h3><?php echo $text_processing; ?></h3>
            <p>
                <?php echo $processing_message; ?>
            </p>
            <img src="catalog/view/theme/default/image/ingpsp_ajax-loader.gif" />
        </div>
        <?php echo $column_right; ?>
    </div>
</div>

<script language="JavaScript">
    var fallback_url = "<?php echo $fallback_url; ?>";
    var callback_url = "<?php echo $callback_url; ?>";
</script>

<script language="JavaScript" src="catalog/view/javascript/ingpsp.js" ></script>

<?php echo $footer; ?>
