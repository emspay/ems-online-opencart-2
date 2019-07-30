# Changelog OpenCart

** 1.4.8 **

* Fixed validation of IBAN and URL for certain PHP versions

** 1.4.7 **

* Consistency fix; use the same values to calculate totals preventing a rounding error

** 1.4.6 **

* Bugfix, also send in miscellaneous orderlines

** 1.4.5 **

* Bugfix, send in shipping address and not only billing address

** 1.4.4 **

* Add additional address field

** 1.4.3 **

* Make link clickable

** 1.4.2 **

* Fix displaying of AfterPay inputs

** 1.4.1 **

* Updates for DOB parsing

** 1.4.0 **

* Added AfterPay 

* Klarna helper class refactored


** 1.3.2 **

* Updated ing-php library to version 1.4.0 *

** 1.3.1 **

* Added dynamic order descriptions *


** 1.3.0 **

* Added Payconiq Payment Method

* Updated License content to reflect ING Bank N.V

* Updated deployment method


** 1.2.7 **

* Added new translation string to all languages

* Added helper method to obtain ING order ID from order history

* Added Klarna Order capturing

* Updated ing-php to latest version

* Updated README.md


** 1.2.6 **

* Added Pre-requisites to install text in Readme.md

* Updated translations for OpenCart

* Updated the readme to reflect correct ing resources instead of ginger

* Added Plugin version 


** 1.2.5 **

* Improved error handling for OpenCart payment methods

* Added multilingual error message text to the payment methods

* Updated translations


** 1.2.4 ** 

* Improved & added more translations

* Added Flags for the languages


** 1.2.3 ** 

* Improved & added more translations

* Added Flags for the languages


** 1.2.2 **

* Added missing iDeal Strings to translations


** 1.2.1 **

* Added French language pack

* Added updated German Translations


** 1.2 **

* Added test_api_key and IP filtering functionality & related translations for Klarna

* Fixed typos 


** 1.1 **

* Fixed Formatting

* Added Sofort, PayPal, Klarna, HomePay

* Implemented new functionality in the Helper class

* Updated ingpsp/ing-php library to 1.2.8

* Resolved issue with undefined variables on checkout page

* Added German translations to Bancontact, Credit Card, iDEAL, COD and Bank Transfer


** 1.0.1 ** 

* Fixed typo in payment pending message


** 1.0 **

* Initial Version

* Renamed files, and changed structure according to new Opencart

* Removed code duplication

* Added ca.cert bundle and webhook url options

* Updated payment method names

* Updated frontend translations

* Implemented pending page, re-used code for data collection

* Updated Translation strings for admi view

* Resolved path issue