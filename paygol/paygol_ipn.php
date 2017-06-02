<?php
/**
* Paygol.com
*
* @author    Paygol 
* @copyright 2017 Paygol
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/
include_once(dirname(__FILE__).'/../../config/config.inc.php');
include_once(dirname(__FILE__).'/../../init.php');
include_once(_PS_MODULE_DIR_.'paygol/paygol.php');
$pg = new PayGol();
$pg->validationPaygol();
