# EMS Online plugin for OpenCart
This is the offical EMS Online plugin.

## About


EMS helps entrepreneurs with the best, smartest and most efficient payment systems. Both 
in your physical store and online in your webshop. With a wide range of payment methods 
you can serve every customer.

Why EMS?

Via the EMS website you can create a free test account online 24/7 and try out the online 
payment solution. EMS's online solution also offers the option of sending payment links and 
accepting QR payments.

The ideal online payment page for your webshop:
- Free test account - available online 24/7
- Wide range of payment methods
- Easy integration via a plug-in or API
- Free shopping cart plug-ins
- Payment page in the look & feel of your webshop
- Reports in the formats CAMT.053, MT940S, MT940 & CODA
- One clear dashboard for all your payment, turnover data and administration functions

Promotion promotion extended!

Choose the EMS Online Payment Solution now
and pay no subscription costs at € 9.95 throughout 2020!

Start immediately with your test account
Request it https://portal.emspay.eu/create-test-account?language=NL_NL 

Satisfied after testing?
Click on the yellow button [Begin→]
 in the test portal and
simply request your live account.
## Version number
Version 1.6.2

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

Only for AfterPay payment: To allow AfterPay to be used for any other country just add its country code (in ISO 2 standard) to the "Countries available for AfterPay" field. Example: BE, NL, FR

- Change field 'Status' to 'Enabled'.
- Enable the CA bundle
Enable this option to fix a cURL SSL Certificate issue that appears in some web-hosting environments where you do not have access to the PHP.ini file and therefore are not able to update server certificates.
- After configuring the selected payment method in your OpenCart admin environment click ´Save´.

6. Perform step 5 and 6 for every payment method you want to add to your paypage.
7. Compatibility: OpenCart 2.3.0.2
