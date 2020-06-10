# EMS Online plugin for OpenCart
This is the offical EMS Online plugin.

## About

By integrating your webshop with EMS Online you can accept payments from your customers in an easy and trusted manner with all relevant payment methods supported.

## Version number
Version 1.0.6

## Pre-requisites to install the plug-ins: 
- PHP v5.4 and above
- MySQL v5.4 and above

## Installation
Manual installation using (s)FTP

1. Copy the contents of the ‘upload’ folder in the ZIP file to your OpenCart public installation path (no files are overwritten). You can use, for example, an sFTP or SCP program to upload the files. There are various sFTP clients that you can download free of charge from the internet, such as WinSCP or Filezilla.
2. Go to your OpenCart admin environment and select ‘Extensions’ > ‘Extensions’. Choose the extension type ‘Payments’ from the filter menu and scroll to the EMS PAY payment methods (starting with ‘EMS PAY’). 	
3. Select which EMS PAY payment methods you would like to install and click the ‘Install’ icon.
4. After successfully installing the payment method, click the ‘Edit’ icon to configure the selected payment method.
5. Configure the EMS PAY payment method.
- Copy the API key (test api key: 8ca6aefd46154303b0684a90c69136af).
- Configure the order statuses.
- Configure the order statuses in your OpenCart admin environment as follows:

Order status field	Select status
Order New	Pending
Order Processing	Processing
Order Completed	Complete
Order Expired	Expired
Order Cancelled	Canceled
Order Error	Failed
Order Captured	Shipped

- Change field 'Status' to 'Enabled'.
- Enable the CA bundle
Enable this option to fix a cURL SSL Certificate issue that appears in some web-hosting environments where you do not have access to the PHP.ini file and therefore are not able to update server certificates.
- Enable generate webhook URL
The plugin can automatically generate a webhook URL when a message is sent to the EMS PAY new orders. To enable this option set ‘Generate webhook URL’ to yes.
- After configuring the selected payment method in your OpenCart admin environment click ´Save´.

6. Perform step 5 and 6 for every payment method you want to add to your paypage.
7. Compatibility: OpenCart 2.3.0.2
