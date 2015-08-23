<?php
class ControllerSffoodList extends Controller{
    public function index(){
        $data = array();
        $this->load->model('sffood/food');
		$data['types'] = $this->model_sffood_food->getTypes();
        $data['header'] = $this->load->controller('common/header');
        if(isset($this->request->get['lat'])){
        	$this->session->data['lat'] = $this->request->get['lat'];
        	$this->session->data['lng'] = $this->request->get['lng'];
        	$this->session->data['address'] = $this->request->get['address'];
        	$data['address'] =$this->request->get['address'];
        }
        elseif(isset($this->session->data['address'])){
        	$data['address'] =$this->session->data['address'];
        }elseif($this->customer->isLogged())
        {
        	$addressID = $this->customer->getAddressId();
        	$this->load->model('account/address');
        	$address = $this->model_account_address->getAddress($addressID);
        	$data['address'] = $address['city'].",".$address['address_1'];
        }
        else{
        	$data['address'] = "添加送餐地址";
        }
        
        $this->response->setOutput($this->load->view('default/template/sffood/list.tpl', $data));
    }
}