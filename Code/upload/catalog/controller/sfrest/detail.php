<?php
class ControllerSfrestDetail extends Controller{
    public function index(){
        $data = array();
        $restaurant_id = $this->request->get['restaurant_id'];
        $food_id = "-1";
        if (isset($this->request->get['food_id'])) {
        	$food_id = $this->request->get['food_id'];
        }        
        $this->load->model('sfrest/information');
		$data['restaurant'] = $this->model_sfrest_information->getRestaurant($restaurant_id);
		$this->load->model('sffood/food');
		$data['foods'] = $this->model_sffood_food->getFoodsByRestID($restaurant_id);
		$cart_foods = $this->cart->getFoods();
		if(count($cart_foods)){
			foreach ($data['foods'] as $key => $food) {
				foreach($cart_foods as $product){
					if((int)$food['food_id'] == (int)$product['product_id']){
						$data['foods'][$key]['cart_number'] = $product['quantity'];
					}
				}
			}
		}
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
        $this->response->setOutput($this->load->view('default/template/sfrest/detail.tpl', $data));
    }
}