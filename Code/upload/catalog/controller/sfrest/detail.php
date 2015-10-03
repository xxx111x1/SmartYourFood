<?php
class ControllerSfrestDetail extends Controller{

    public function index(){
        $data = array();        
        $restaurant_id = $this->request->get['restaurant_id'];
        $data["rest_id"] = $restaurant_id;
        if (isset($this->request->get['food_id'])) {
        	$food_id = $this->request->get['food_id'];
        	$data['food_id'] = $food_id;
        }        
        $this->load->model('sfrest/information');
		$data['restaurant'] = $this->model_sfrest_information->getRestaurant($restaurant_id);
		
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
        	$data['address'] = "请输入送餐地址";
        	$data['first_name'] = "";
        	$data['history_address'] = "";
        }        
        
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        $data['backtop'] = $this->load->controller('common/backtop');
        
        $this->response->setOutput($this->load->view('default/template/sfrest/detail.tpl', $data));
    }
}