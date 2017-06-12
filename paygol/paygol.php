<?php
if (!defined('_PS_VERSION_')) {
    exit;
}
class PayGol extends PaymentModule
{
    private $_html = '';
    private $_postErrors = array();
    public $serviceid;
	public $secretkey;
    public $gateway='https://www.paygol.com/pay';
    public function __construct()
    {
        $this->name = 'paygol';
        $this->tab = 'payments_gateways';
        $this->version = '1.1';
        $this->author = 'Paygol';
        $this->currencies = true;
        $this->currencies_mode = 'checkbox';
       	$config = Configuration::getMultiple(array('PAYGOL_SERVICEID','PAYGOL_SECRETKEY'));
		/////
		if (isset($config['PAYGOL_SERVICEID'])) {
            $this->serviceid  = $config['PAYGOL_SERVICEID'];
		}
		if (isset($config['PAYGOL_SECRETKEY'])) {
            $this->secretkey = $config['PAYGOL_SECRETKEY'];
        }
		/////
		parent::__construct();
		
        $this->displayName = $this->l('Paygol');
        $this->description = $this->l('Allow payments with Paygol');
        $this->confirmUninstall = $this->l('Are you sure you want to remove the Paygol module?');
        /*
        if (!isset($this->serviceid)) {
            $this->warning = $this->l('Account Service ID');
        }
        if (!sizeof(Currency::checkPaymentCurrencies($this->id))) {
            $this->warning = $this->l('No currency set for this module');
        }
        */
    }
    public function install()
    {
        if (!Configuration::get('PAYGOL_PAYMENT_PREORDER')) {
            Configuration::updateValue('PAYGOL_PAYMENT_PREORDER', $this->addState('Successful (Paygol)', '#DDEEFF'));
        }
        if (!Configuration::get('PAYGOL_WAITING_PAYMENT')) {
            Configuration::updateValue('PAYGOL_WAITING_PAYMENT', $this->addState('Pending (Paygol)', '#DDEEFF'));
        }
        if (!Configuration::get('PAYGOL_PAYMENT_SUCCESS')) {
            Configuration::updateValue('PAYGOL_PAYMENT_SUCCESS', $this->addState('Successful (Paygol)', '#32D600'));
        }
        if (!parent::install() || !$this->registerHook('payment') || !$this->registerHook('paymentReturn')) {
            return false;
        }
        return true;
    }
    private function addState($en, $color)
    {
        $orderState = new OrderState();
        $orderState->name = array();
        foreach (Language::getLanguages() as $language) {
            $orderState->name[$language['id_lang']] = $en;
        }
        $orderState->send_email = false;
        $orderState->color = $color;
        $orderState->hidden = false;
        $orderState->delivery = false;
        $orderState->logable = false;
        
		if ($orderState->add()) {
            copy(dirname(__FILE__).'/views/img/os_paygol.gif', dirname(__FILE__).'/../../img/os/'.(int)$orderState->id.'.gif');
            return $orderState->id;
        }
		
    }
    public function uninstall()
    {
        if (!Configuration::deleteByName('PAYGOL_SERVICEID') || !parent::uninstall()) {
            return false;
        }
		if (!Configuration::deleteByName('PAYGOL_SECRETKEY') || !parent::uninstall()) {
            return false;
        }
        return true;
    }
    private function _postValidation()
    {
        if (Tools::isSubmit('btnSubmit')) {
            
			if (!Tools::getValue('serviceid')) {
                $this->_postErrors[] = $this->l('You must enter your service ID');
            }
			if (!Tools::getValue('secretkey')) {
                $this->_postErrors[] = $this->l('You must enter your secret key');
            }
        }
    }
    private function _postProcess()
    {
        if (Tools::isSubmit('btnSubmit')) {
            Configuration::updateValue('PAYGOL_SERVICEID', Tools::getValue('serviceid'));
			Configuration::updateValue('PAYGOL_SECRETKEY', Tools::getValue('secretkey'));
        }
            $this->_html .= '<div class="conf confirm"> '.$this->l('Settings updated').'</div>';
    }
    public function getConfigFieldsValues()
    {
        return array(
		'PAYGOL_SERVICEID' => Tools::getValue('PAYGOL_SERVICEID', Configuration::get('PAYGOL_SERVICEID')),
		'PAYGOL_SECRETKEY' => Tools::getValue('PAYGOL_SECRETKEY', Configuration::get('PAYGOL_SECRETKEY')),
        );
    }
    private function _displayPayGol()
    {
        $this->_html .= '<img src="../modules/paygol/views/img/index_logo_main.png" style="float:left; margin-right:15px;"><b><br><br><br><br><br>'.$this->l('This module lets your customers pay using Paygol.').'</b><br /><br />
        '.$this->l('Paygol is an online payment platform that offers a wide variety of both worldwide and local payment methods.').'<br /><br /><br />';
    }
    private function _displayForm()
    {
        $cookie_lang = $this->context->language->id;
        $order_query = "SELECT os.id_order_state, osl.name FROM "._DB_PREFIX_."order_state os, "._DB_PREFIX_."order_state_lang osl WHERE os.id_order_state=osl.id_order_state AND osl.id_lang='".$cookie_lang."';";
        $host = _DB_SERVER_;
        $dbName = _DB_NAME_;
        $dbPass = _DB_PASSWD_;
        $dbUser = _DB_USER_;
        $conexion = mysql_connect($host, $dbUser, $dbPass);
        if (!$conexion) {
            die('Error de conexión DB: ');
        } else {
            mysql_select_db($dbName, $conexion);
        }
                $result = mysql_query($order_query);
        if (!$result) {
                    die(' Invalid query: ' . mysql_error());
        }
                $url_ipn=_PS_BASE_URL_.__PS_BASE_URI__."modules/paygol/paygol_ipn.php";
                $this->_html .=
                '<form action="'.Tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']).'" method="post">
                    <fieldset style="width:80%;">
                      <legend><img src="../img/admin/contact.gif" />'.$this->l('Account details').'</legend>
                          <table border="0" width="100%" cellpadding="0" cellspacing="0" id="form">
                            <tr><td colspan="2">'.$this->l('Enter the ID and secret key of your service and then click \"Save\".').'<br /><br /></td></tr> 
                            <tr><td width="130" style="height: 30px;">'.$this->l('Service ID').':</td><td><input type="text" name="serviceid" value="'.Tools::htmlentitiesUTF8(Tools::getValue('serviceid', $this->serviceid)).'" size="40" /></td></tr>
							<tr><td width="130" style="height: 30px;">'.$this->l('Secret Key').':</td><td><input type="text" name="secretkey" value="'.Tools::htmlentitiesUTF8(Tools::getValue('secretkey', $this->secretkey)).'" size="40" /></td></tr>
                            <tr><td width="130" style="height: 30px;">'.$this->l('URL IPN').':</td><td><br><strong>'.$url_ipn.'</strong><br>'.$this->l('Paste this URL on the \"Background URL (IPN)\" field, at the \"My Services\" section of your panel at Paygol\'s website.').'</td></tr>
                            <tr><td width="130" style="height: 30px;"></td><td align="left"><br /><input style="width:100px;" class="button" name="btnSubmit" value="'.$this->l('Save').'" type="submit" /></td></tr>
                          </table>
                    </fieldset>
                </form>';
    }
    public function getContent()
    {
        $this->_html = '<h2>'.$this->displayName.'</h2>';
            if (Tools::isSubmit('btnSubmit')) {
                $this->_postValidation();
                if (!count($this->_postErrors))
                    $this->_postProcess();
                else
                    foreach ($this->_postErrors as $err)
                        $this->_html .= '<div class="alert error">'.$err.'</div>';
            } else
            $this->_html .= '<br />';
            $this->_displayPayGol();
            $this->_displayForm();
            return $this->_html;
    }
    public function hookPayment($params)
    {
        if (!$this->active) {
            return ;
        }
                $smarty= $this->context->smarty->assign($smarty);
        foreach ($params['cart']->getProducts() as $product) {
            $pd = ProductDownload::getIdFromIdProduct((int)($product['id_product']));
            if ($pd and Validate::isUnsignedInt($pd)) {
                return false;
            }
        }
                $smarty->assign(array(
                        'this_path' => $this->_path,
                        'this_path_ssl' => Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/'
                ));
                return $this->display(__FILE__, 'payment.tpl');
    }
        /*
        public function hookPaymentReturn($params)
        {
            if (!$this->active)
                return ;
            return $this->display(__FILE__, 'paygol_validate.tpl');
        }
        */
    public function validationPaygol()
    {
            $service_id        =    Tools::getValue('service_id');
			$country           =    Tools::getValue('country');
            $price             =    Tools::getValue('price');
            $custom            =    Tools::getValue('custom');
            $currency          =    Tools::getValue('currency');
            $frmprice          =    Tools::getValue('frmprice');
            $frmcurrency       =    Tools::getValue('frmcurrency');
            $arrayCustom       =    explode("-", $custom);
            $cart_id           =    $arrayCustom[0];
            $customer_id       =    $arrayCustom[1];
            $skey              =    $arrayCustom[2];
			///
			$key               =    Tools::getValue('key');
			$sk			       =    Tools::safeOutput(Configuration::get('PAYGOL_SECRETKEY'));
			$sk                =    trim($sk);
			$sid         	   =    Tools::safeOutput(Configuration::get('PAYGOL_SERVICEID'));
			$sid			   =    trim($sid);
			if ( $sk  != $key)        { echo "Error: Wrong secret key"; exit; 	}
			if ( $sid != $service_id) { echo "Error: Wrong service ID"; exit; 	}
			
        if ((!empty($frmprice) && !empty($frmcurrency)) && (!empty($custom) && !empty($price))) {
                $this->context->cart = new Cart((int)$cart_id);
                $this->context->cart->id;
                $this->context->cart->id_customer;
                $valide_var = 'SELECT `id_order`,`id_customer`,`id_cart`,`secure_key` FROM `'._DB_PREFIX_.'orders` WHERE `id_cart` = '.(int)$this->context->cart->id.'';
            if ($results = Db::getInstance()->ExecuteS($valide_var)) {
                foreach ($results as $row) {
                    if (($skey == $row['secure_key']) && ($row['id_cart'] == $cart_id && $row['id_customer']== $customer_id )) {
                        if (!$this->context->cart->OrderExists()) {
                                return false;
                        }
                        if (Validate::isLoadedObject($this->context->cart)) {
                                    $id_orders = Db::getInstance()->ExecuteS('SELECT `id_order` FROM `'._DB_PREFIX_.'orders` WHERE `id_cart` = '.(int)$this->context->cart->id.'');
                            foreach ($id_orders as $val) {
                                    $order = new Order((int)$val['id_order']);
                                    $order->setCurrentState((int)Configuration::get('PAYGOL_PAYMENT_SUCCESS'));
                            }
                        }
                    }// 
                }
            }
        }//not null
            
    }//validationPaygol()
}
