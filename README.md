<img src="paygol_logo.png" alt="Paygol - PrestaShop" />


# PrestaShop

## Paygol module for Prestashop, version 1.0 <br>
[About Paygol](#about-paygol) <br>
[Requirements](#requirements) <br>
[Installation](#installation) <br>
[Testing](#testing) <br>
[Important Notes](#important-notes) <br>

---

### About Paygol:

- Paygol is an online payment service provider that offers a wide variety of both worldwide and local payment methods.
- Website: https://www.paygol.com 
- Payment methods: https://www.paygol.com/pricing
    
### Requirements:

- Working Prestashop installation (tested with prestashop v1.6.1.6, prestashop v1.6.1.0).
- Paygol account, you can register for free at https://secure.paygol.com/register.
- "`Standard`" type PayGol service (make sure to select "`Integrated`" in the service settings), which can be created at 
  https://www.paygol.com/en/webapps (you must be logged in).  

   
### Installation:

- Option 1 : upload the file  via FTP, decompress the content of the "`paygol_prestashop_v1.0.zip`" file, directly in the file “`modules`” in your prestashop site.
- Option 2 : upload the file to the server via Prestashop.  Please go to “`modules and services`”, add a new module, press “`select a file`”,  look for  the file in your computer  ("`paygol_prestashop_v1.0.zip`"), press the botón “`upload this module`”, wait until the module is installed and then configurate
- Activate the module “`Paygol`” in your administration panel of Prestashop (modules and services,  module list, look for the module  “`paygol`”).  Select install and configure.  Then go to the configuration of Paygol module.
- In the configuration of  the Paygol module you must enter:  ID of your Paygol service (you can find this number in “`my services`” in you Paygol account)
- On the other hand, Paygol needs an URL  address to do IPN.  The URL that is in the box correspond to the address that you must enter in Paygol (My services, inside of the service, edit or change and enter the URL address in any box “`URL background (IPN)`”)
  the URL address of IPN has the following things: "`http://www.your-domain.com/prestashop/modules/paygol/paygol_ipn.php`". (please, replace  the URL `www.your-domain.com` for the name of your domain.  “`Prestashop`” is the instalation file of Prestashop and use the http/https as corespond )

  
### Testing:

- To test the newly installed module you can enable your service's "`Test`" mode at the "`My Services`" section of your panel, 
  at Paygol's website. Be sure to change it back before going live.

  
### Important Notes:

- While in test mode, an IPN request (payment notification) will be issued immediately after each test.
- Payments are usually notified immediately; however, certain payment methods may take longer to confirm the payment 
  (e.g. methods that take a few minutes to notify the transaction, or voucher-based transactions that require the payer 
  to print it in order to pay by cash at a given place). In these cases the product is shown as not paid, and only 
  once it's confirmed by the provider will it show as paid. We strongly recommend that you inform your customers about this 
  beforehand in order to avoid confusions.

---
