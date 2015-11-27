<?php
class ControllerSfrestDetail extends Controller{

    public function index(){
        $data = array();        
        
        if(isset($this->request->get['restaurant_id'])){
        	$restaurant_id = $this->request->get['restaurant_id'];
        }
        else{
        	$restaurant_id = 1;
        }
        if(isset($this->request->get['returnUrl'])){
        	$returnUrl = $this->request->get['returnUrl'];
        }
        else{
        	$returnUrl = '/index.php?route=common/list';
        }        
        
        $data["return_url"] =$returnUrl; 
        $data["rest_id"] = $restaurant_id;
        if (isset($this->request->get['food_id'])) {
        	$food_id = $this->request->get['food_id'];
        	$data['food_id'] = $food_id;
        }  
        
        if(!$this->customer->isLogged()){
        	if (isset($this->request->get['food_id'])) {
        		$food_id = $this->request->get['food_id'];
        	}
        	$redirect = urlencode($this->url->link('sfrest/detail').'&restaurant_id='.$restaurant_id.'&food_id='.$food_id);
        	$this->response->redirect($this->url->link('sfaccount/login','redirect=' . $redirect));
        }
        $this->load->model('sfrest/information');
		$data['restaurant'] = $this->model_sfrest_information->getRestaurant($restaurant_id);
		$data['tags'] = $this->model_sfrest_information->getRestaurantTags($restaurant_id);
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
        
        if(isset($this->session->data['address'])){
        	$this->load->model('account/address');
        	$data['distance'] = $this->model_account_address->getDistance($this->session->data['lat'], $this->session->data['lng'], $data['restaurant']['lat'], $data['restaurant']['lng']);
        }
        else{
        	$data['distance'] = "未知";
        }
        
        $data['header'] = $this->load->controller('common/sfheader');
        $data['review'] = $this->load->controller('sfrest/review');
        $data['footer'] = $this->load->controller('common/sffooter');
        $data['backtop'] = $this->load->controller('common/backtop');
        
        $this->response->setOutput($this->load->view('default/template/sfrest/detail.tpl', $data));
    }
}