<?php
class ControllerSffoodList extends Controller{
    public function index(){
        $data = array();
        $this->load->model('sffood/food');
		$data['types'] = $this->model_sffood_food->getTypes();
        $data['header'] = $this->load->controller('common/header');
        $data['backtop'] = $this->load->controller('common/backtop');
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
        
        $this->response->setOutput($this->load->view('default/template/sffood/list.tpl', $data));
    }
}