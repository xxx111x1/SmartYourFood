<?php
class ControllerAddressAddress extends Controller{
    public function index(){
        $data = array();  
        $data['lang'] = $this->language->get('code');
        if(isset($this->request->get['isFromHome'])){
        	$data["is_from_home"] = 1;
        }
        else{
        	$data["is_from_home"] = 0;
        }
        
        if(isset($this->request->get['returnUrl'])){
        	$data["return_url"] = $this->request->get['returnUrl'];        	
        }
        
        if(isset($this->request->get['addressId'])){
        	$data["address_id"] = $this->request->get['addressId'];
        }
        else{
        	$data["address_id"] = "";
        }
        
        if(isset($this->request->get['phone'])){
        	$data["phone"] = $this->request->get['phone'];
        }
        else{
        	$data["phone"] = "";
        }
        
        if(isset($this->request->get['contact'])){
        	$data["contact"] = $this->request->get['contact'];
        }
        else{
        	$data["contact"] = "";
        }
        $data['random'] = rand(0,1000);
        $this->response->setOutput($this->load->view('default/template/address/address.tpl', $data));
    }   
}