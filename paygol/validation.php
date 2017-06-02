<?php
/**
* Paygol.com
*
* @author    Paygol <info@paygol.com>
* @copyright 2017 Paygol
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/paygol.php');
$context = Context::getContext();
$cart = $context->cart;
$paygol = new PayGol();
$customer = new Customer((int)$cart->id_customer);
$order = new Order($paygol->currentOrder);
Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$paygol->id.'&id_order='.$paygol->currentOrder.'&key='.$customer->secure_key);
