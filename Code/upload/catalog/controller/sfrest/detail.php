<?php
class ControllerSfrestDetail extends Controller{
    public function index(){
        //$this->load->model('common/header');
        //$data = $this->model_shop_list->getInfo();
        //echo "ControllerShopList";
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
        if($this->customer->isLogged())
        {
            $addressID = $this->customer->getAddressId();
            $this->load->model('account/address');
            $address = $this->model_account_address->getAddress($addressID);
            $data['address'] = $address['city'].",".$address['address_1'];
        }
        else{
            $data['address'] = "添加送餐地址";
        }
        //$data['product_overview'] = $this->load->controller('product/overview');
        $this->response->setOutput($this->load->view('default/template/sfrest/detail.tpl', $data));
        //$this->response->setOutput($data['category']);
    }
}