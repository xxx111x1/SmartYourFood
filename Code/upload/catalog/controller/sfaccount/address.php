<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/10/6
 * Time: 13:59
 */
class ControllerSfaccountAddress extends Controller {
    public function index()
    {	
    	$returnUrl = explode("&", $_SERVER['REQUEST_URI'])[0];    	    	
    	$data['returnUrl'] = $returnUrl;
    	
        $this->load->model('sfcheckout/shippingaddress');
        $addresses = $this->model_sfcheckout_shippingaddress->getAddresses();
        $data['addresslist']=$addresses;
        
        $this->load->language('account/account');
        $this->load->language('sfcheckout/checkout');
        $data['Edit'] = $this->language->get('Edit');
        $data['Delete'] = $this->language->get('Delete');
        $data['New_Address'] = $this->language->get('New_Address');
        
        return $this->load->view('default/template/sfaccount/address.tpl', $data);
    }
}