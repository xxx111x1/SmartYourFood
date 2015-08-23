<?php
class ControllerAddressAddress extends Controller{
    public function index(){;
        $data = array();        
        if(isset($this->request->get['returnUrl'])){
        	$data["return_url"] = $this->request->get['returnUrl']; 
        }
        $this->response->setOutput($this->load->view('default/template/address/address.tpl', $data));
    }
}