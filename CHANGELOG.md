# Changelog OpenCart

** 1.0.0 **

* Initial Version

** 1.0.2 **

* Add Apple Pay
* Fix in the beberlei/assert library
* Fixed bug with field ip address

** 1.0.3 **

* Changed library from ems-php to ginger-php
* Renamed Sofort to Klarna Pay Now
* Renamed Klarna to Klarna Pay Later
* Add American Express, Tikkie Payment Request, WeChat 

** 1.0.4 **

* Enable Klarna Pay Now 
* Enable Klarna Pay Later

** 1.0.5 **

* Fix Captured and shipped functionality

** 1.5.0 **

* Fixed payment URL for Klarna Pay Later

** 1.6.0 **

* Added the ability for AfterPay to be available in the selected countries.
* Added the AfterPay localization for Netherlands, German and French language.
* Klarna Pay Later : Remove fields gender and birthday from checkout form and customer object.
* Replaced locally stored ginger-php library on composer library installer.
* Added order lines for Klarna Pay Later payment method
* Added order lines for AfterPay payment method

** 1.6.1 **

* Removed WebHook option in all payments
* Update plugin descriptions

** 1.6.2 **

* optimized translations
* fixed IP filtering and 'Test API key' functionality for Afterpay and Klarna Pay Later