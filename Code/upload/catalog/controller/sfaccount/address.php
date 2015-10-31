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
        return $this->load->view('default/template/sfaccount/address.tpl', $data);
    }
}