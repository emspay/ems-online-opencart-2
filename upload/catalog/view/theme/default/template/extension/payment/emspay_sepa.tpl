<h2><?php echo $ems_bank_details; ?></h2>
<p><b><?php echo $text_description; ?></b></p>

<form action=<?php echo $action; ?> method="post">
    <div class="well well-sm">
        <p><?php echo $ems_payment_reference; ?></p>
        <p><?php echo $ems_iban; ?></p>
        <p><?php echo $ems_bic; ?></p>
        <p><?php echo $ems_account_holder; ?></p>
        <p><?php echo $ems_residence; ?></p>
    </div>

    <div class="buttons pull-right">
        <div class="right">
            <input type="submit" value="<?php echo $button_confirm; ?>" class="button btn btn-primary"/>
        </div>
    </div>
</form>