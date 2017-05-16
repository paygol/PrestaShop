# PrestaShop
******* English *******

PayGol module for Prestashop, version 1.0

About PayGol:

- PayGol is an online payment service provider that offers a wide variety of both worldwide and local payment methods.
- Additional information can be found at:
  https://www.paygol.com/en  
  https://www.paygol.com/en/pricing
    
Requirements:

- Working Prestashop installation (tested with prestashop v1.6.1.6, prestashop v1.6.1.0).
- PayGol account, you can register for free at https://secure.paygol.com/register.
- "Standard" type PayGol service (make sure to select "Integrated" in the service settings), which can be created at 
  https://www.paygol.com/en/webapps (you must be logged in).  

   
Installation:

- Option 1 : upload the file  via FTP, decompress the content of the "paygol_prestashop_v1.0.zip" file, directly in the file “modules” in your prestashop site.
- Option 2 : upload the file to the server via Prestashop.  Please go to “modules and services”, add a new module, press “select a file”,  look for  the file in your computer  ("paygol_prestashop_v1.0.zip"), press the botón “upload this module”, wait until the module is installed and then configurate
- Activate the module “Paygol” in your administration panel of Prestashop (modules and services,  module list, look for the module  “paygol”).  Select install and configure.  Then go to the configuration of Paygol module.
- In the configuration of  the Paygol module you must enter:  ID of your Paygol service (you can find this number in “my services” in you Paygol account)
- On the other hand, Paygol needs an URL  address to do IPN.  The URL that is in the box correspond to the address that you must enter in Paygol (My services, inside of the service, edit or change and enter the URL address in any box “URL background (IPN)”)
  the URL address of IPN has the following things: "http://www.your-domain.com/prestashop/modules/paygol/paygol_ipn.php". (please, replace  the URL www.your-domain.com for the name of your domain.  “Prestashop” is the instalation file of Prestashop and use the http/https as corespond )

  
Testing:

- To test the newly installed module you can enable your service's "Test" mode at the "My Services" section of your panel, 
  at PayGol's website. Be sure to change it back before going live.

  
Important Notes:

- While in test mode, an IPN request (payment notification) will be issued immediately after each test.
- Payments are usually notified immediately; however, certain payment methods may take longer to confirm the payment 
  (e.g. methods that take a few minutes to notify the transaction, or voucher-based transactions that require the payer 
  to print it in order to pay by cash at a given place). In these cases the product is shown as not paid, and only 
  once it's confirmed by the provider will it show as paid. We strongly recommend that you inform your customers about this 
  beforehand in order to avoid confusions.


******* Español ********

Módulo de PayGol para Prestashop, versión 1.0


Acerca de PayGol:

- PayGol es un proveedor de servicios de pago en línea que ofrece una amplia variedad de formas de pago tanto a nivel mundial como local.
- Información adicional se encuentra disponible en:
  https://www.paygol.com/es  
  https://www.paygol.com/es/pricing  

  
Requerimientos:

- Instalación funcional de Prestashop (este modulo fue probado en prestashop v1.6.1.6, prestashop v1.6.1.0).
- Cuenta en PayGol, puedes registrarte de forma gratuita en https://secure.paygol.com/register 
- Servicio tipo "Estándar", el cual puede ser creado en https://www.paygol.com/es/webapps (debes haber ingresado a tu cuenta).
  

Instalación:

- Opcion 1: subir el archivo via FTP, descomprimir el contenido del archivo "paygol_prestashop_v1.0.zip" directamente en la carpeta "modules/" de tu sitio prestashop.
- Opcion 2: subir el archivos al servidor vía Prestashop, favor ir a Módulos y Servicios-> Agregar nuevo modulo-> presionar elegir un fichero, buscar el fichero en tu
  computador ("paygol_prestashop_v1.0.zip"), presionar botón subir este modulo, esperar que el modulo se instale y luego configurar.
- Activar el modulo "PayGol" en tu panel de administración de PrestaShop. (Módulos y Servicios->lista de módulos-> Buscar modulo "PayGol"), selecciona instalar y configurar.
  luego ingresar a la configuración del modulo PayGol.
- En la configuración del modulo PayGol se debe ingresar:
- ID de tu servicio de Paygol. (este numero lo encuentras en "Mis Servicios" en tu cuenta de Paygol)
- Por otra parte Paygol necesita una dirección URL para realizar IPN, la URL que se encuentra en la casilla corresponde a la dirección que se debe ingresa en PayGol
  (Mi Servicios, dentro de servicio,  editar o cambiar e ingresar la dirección URL en la siguiente casilla, "Url Background (IPN)")
  La direccion URL de IPN contiene los siguiente: "http://www.tudominio.com/prestashop/modules/paygol/paygol_ipn.php".
  (favor reemplazar  la URL "www.tudominio.com" con el nombre de tu dominio, "prestashop" es la carpeta de instalación de PrestaShop y utilizar http/https según corresponda).

  
Pruebas:

- Para probar el módulo tras su instalación puedes activar el modo de pruebas de tu servicio en la sección "Mis Servicios" 
  de tu panel, en el sitio web de PayGol. Recuerda cambiarlo de vuelta una vez concluídas tus pruebas.


Notas Importantes:

- En modo de pruebas se realizará un llamado a tu archivo IPN inmediatamente después de cada prueba.
- Los pagos usualmente son notificados inmediatamente; ahora bien, algunos métodos de pago podrían tomar más tiempo en notificar 
  la transacción (ej: métodos que toman algunos minutos en realizar la notificación, o métodos basados en boletos que deben ser 
  impresos y pagados en efectivo). En esos casos el producto se mostrará como no pagado, y sólo una vez sea confirmado por el 
  proveedor se mostrará como pagado. Recomendamos que informes a tu clientela sobre esto a modo de evitar confusiones.   

