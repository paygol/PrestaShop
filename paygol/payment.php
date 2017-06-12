<?php
/**
* Paygol.com
*
* @author    Paygol <info@paygol.com>
* @copyright 2017 Paygol
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

    $useSSL = true;
    include(dirname(__FILE__).'/../../config/config.inc.php');
    include(dirname(__FILE__).'/../../init.php');
    include_once(_PS_MODULE_DIR_.'/paygol/paygol.php');
class PayGolController extends FrontController
{
    public $ssl = true;
    public function setMedia()
    {
        parent::setMedia();
    }
    public function process()
    {
        parent::process();
        $language               = new Language(self::$cart->id_lang);
        $customer               = new Customer(self::$cart->id_customer);
        $paygol                 = new PayGol();
        $cart_id                = (int)self::$cart->id;
        $total                  = (float)self::$cart->getOrderTotal();
        $serviceid              = Tools::safeOutput(Configuration::get('PAYGOL_SERVICEID'));
        $skey                   = self::$cart->secure_key;
        $name_site="Order # ";
        self::$smarty->assign(array(
            'name'              => $name_site,
            'serviceid'         => $serviceid,
            'total'             => $total,
            'customerid'        => $customer->id,
            'skey'              => $skey,
            'cart_id'           => $cart_id
            ));
    }
    public function displayContent()
    {
        parent::displayContent();
        self::$smarty->display(_PS_MODULE_DIR_.'paygol/views/templates/front/payment.tpl');
    }
       //update cart to Pending to Pay.
    public function createPendingOrder()
        {
            $paygol = new PayGol();
            $paygol->validateOrder(
                (int)self::$cart->id,
                (int)Configuration::get('PAYGOL_WAITING_PAYMENT'),
                (float)self::$cart->getOrderTotal(),
                $paygol->displayName,
                null,
                array(),
                null,
                false,
                self::$cart->secure_key
            );
    }
}
    $pgController = new PayGolController();
    echo Tools::getValue('create-pending-order');
    $cpo= Tools::getValue('create-pending-order');
if (Tools::getIsset('create-pending-order')) {
    $pgController->createPendingOrder();
}
$pgController->run();
