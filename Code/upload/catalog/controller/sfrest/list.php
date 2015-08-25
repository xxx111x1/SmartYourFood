<?php
class ControllerSfrestList extends Controller{
    public function index(){
        $this->load->model('sfrest/list');
        $data = array();
        $this->load->model('sfrest/information');
		$data['types'] = $this->model_sfrest_information->getTypes();
        $data['header'] = $this->load->controller('common/header');
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
        }
        else{
        	$data['address'] = "添加送餐地址";
        }
        
        $this->response->setOutput($this->load->view('default/template/sfrest/list.tpl', $data));
    }
}