<?php
class ControllerCommonList extends Controller{
    public function index(){
    	$data = array();      
        $this->load->model('sfrest/information');
		$data['types'] = $this->model_sfrest_information->getTypes();
		$data['header'] = $this->load->controller('common/sfheader');
		$data['footer'] = $this->load->controller('common/sffooter');
        $data['backtop'] = $this->load->controller('common/backtop');
        
        if(!$this->customer->isLogged()){
        	$redirect = $this->url->link('common/list'); 
        	$this->response->redirect($this->url->link('sfaccount/login','redirect=' . $redirect));
        }        
        
    	if(isset($this->request->get['lat'])){
        	$this->session->data['lat'] = $this->request->get['lat'];
        	$this->session->data['lng'] = $this->request->get['lng'];
        	$this->session->data['address'] = $this->request->get['address'];
        	$data['address'] =$this->request->get['address'];
        	if($this->customer->isLogged()){
        		$this->load->model('account/customer');
        		$this->model_account_customer->editAddress($this->session->data);
        	}        	
        }
        elseif($this->customer->isLogged() || isset($this->session->data['address']))
        {
        	$data['address'] =$this->session->data['address'];
        	$data['first_name'] = $this->customer->getFirstName();
        	$this->load->model('account/address');
        	$data['history_address'] = $this->model_account_address->getAddressesHistory();
        }
        else{
        	$data['address'] = "请输入送餐地址按回车确认";
        	$data['first_name'] = "";
        	$data['history_address'] = "";
        }        
        $this->response->setOutput($this->load->view('default/template/common/list.tpl', $data));
    }
}