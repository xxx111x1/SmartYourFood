<?php
class ControllerApiFood extends Controller {
	public function getData() {
		$filters = $this->request->post['filters'];
		$sort = $this->request->post['sort'];
		$page_number = $this->request->post['page_number'];
		$page_content_number = 12;
		$start_position = $page_number * $page_content_number;
		$this->load->model('sffood/food');
		$foods = $this->model_sffood_food->getFoodsWithRestaurantInfo($filters,$sort,$start_position,$page_content_number);
		
		//check if restaurant still open
		foreach($foods as $key =>$food)
		{
			$foods[$key]['is_open']=$this->openhours->is_open($foods[$key]['restaurant_id']);
		}

		$cart_foods = $this->cart->getFoods();
		if(count($cart_foods)){
			foreach ($foods as $key => $food) {
				foreach($cart_foods as $product){
					if((int)$food['food_id'] == (int)$product['product_id']){
						$foods[$key]['cart_number'] = $product['quantity'];
					}
				}	
			}
		}
		
		//sort foods
		if(isset($this->request->post['isDistance'])){
			$user_lat = $this->session->data['lat'];
			$user_lng = $this->session->data['lng'];
			$this->load->model('account/address');
			foreach($foods as $key =>$food)
			{
				$foods[$key]['distance']=$this->model_account_address->getDistance($user_lat, $user_lng, $foods[$key]['lat'], $foods[$key]['lng']);
			}
			function distanceSort( $a, $b ) {
				return $a['distance'] == $b['distance'] ? 0 : ( $a['distance'] > $b['distance'] ) ? 1 : -1;
			}
			usort($foods, 'distanceSort' );
		}
		
		if ($foods) {			
			$json['success'] = $this->language->get('text_success');
			$json['results'] = $foods;
			if(isset($this->session->data['lat'])){
				$json['lat'] = $this->session->data['lat'];
				$json['lng'] = $this->session->data['lng'];
			}
			else{
				$json['lat'] = 0;
				$json['lng'] = 0;
			}
		} else {
			$json['error'] = $this->language->get('error');
		}						
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getType() {
		$this->load->model('sffood/food');
		$types = $this->model_sffood_food->getTypes();
		if ($types) {
			$json['success'] = $this->language->get('text_success');
			$json['types'] = $types;
		} else {
			$json['error'] = $this->language->get('error');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getFoodByRestaurantId(){
		$restaurant_id = $this->request->post['restid'];
		$sort = $this->request->post['sort'];
		$this->load->model('sffood/food');
		$foods = $this->model_sffood_food->getFoodsByRestID($restaurant_id,$sort);

		$cart_foods = $this->cart->getFoods();

		foreach ($foods as $key => $food) {
			if(count($cart_foods)){
				foreach($cart_foods as $product){
					if((int)$food['food_id'] == (int)$product['product_id']){
						$foods[$key]['cart_number'] = $product['quantity'];
					}
				}
			}
			$foods[$key]['is_open']= $this->openhours->is_open($foods[$key]['restaurant_id']);
		}
		if ($foods) {
			$json['success'] = $this->language->get('text_success');
			$json['results'] = $foods;
			if(isset($this->session->data['lat'])){
				$json['lat'] = $this->session->data['lat'];
				$json['lng'] = $this->session->data['lng'];
			}
			else{
				$json['lat'] = 0;
				$json['lng'] = 0;
			}
		} else {
			$json['error'] = $this->language->get('error');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getFoodByRestaurantAndTagId(){
		$this->load->model('sffood/food');
		$restaurant_id = $this->request->post['restid'];	
		$sort = $this->request->post['sort'];		
		if(isset($this->request->post['tagid']) && $this->request->post['tagid'] != 0){
			$tag_id = $this->request->post['tagid'];
			$foods = $this->model_sffood_food->getFoodsByRestIDAndTags($restaurant_id,$tag_id,$sort);
		}
		else{
			$foods = $this->model_sffood_food->getFoodsByRestID($restaurant_id,$sort);
		}		
		$cart_foods = $this->cart->getFoods();

		foreach ($foods as $key => $food) {
			if(count($cart_foods)){
				foreach($cart_foods as $product){
					if((int)$food['food_id'] == (int)$product['product_id']){
						$foods[$key]['cart_number'] = $product['quantity'];
					}
				}
			}
			$foods[$key]['is_open']= $this->openhours->is_open($foods[$key]['restaurant_id']);
		}

		if ($foods) {
			$json['success'] = $this->language->get('text_success');
			$json['results'] = $foods;
			if(isset($this->session->data['lat'])){
				$json['lat'] = $this->session->data['lat'];
				$json['lng'] = $this->session->data['lng'];
			}
			else{
				$json['lat'] = 0;
				$json['lng'] = 0;
			}
		} else {
			$json['error'] = $this->language->get('error');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getFoodByRestaurantAndTagIdWithPage(){
		$this->load->model('sffood/food');
		$restaurant_id = $this->request->post['restid'];
		$sort = $this->request->post['sort'];
		$page_number = $this->request->post['page_number'];
		$page_content_number = 12;
		$start_position = $page_number * $page_content_number;
		if(isset($this->request->post['tagid']) && $this->request->post['tagid'] != 0){
			$tag_id = $this->request->post['tagid'];
			$foods = $this->model_sffood_food->getFoodsByRestIDAndTagsWithPage($restaurant_id,$tag_id,$sort,$start_position,$page_content_number);
		}
		else{
			$foods = $this->model_sffood_food->getFoodsByRestIDWithPage($restaurant_id,$sort,$start_position,$page_content_number);
		}
		$cart_foods = $this->cart->getFoods();
	
		foreach ($foods as $key => $food) {
			if(count($cart_foods)){
				foreach($cart_foods as $product){
					if((int)$food['food_id'] == (int)$product['product_id']){
						$foods[$key]['cart_number'] = $product['quantity'];
					}
				}
			}
			$foods[$key]['is_open']= $this->openhours->is_open($foods[$key]['restaurant_id']);
		}
	
		if ($foods) {
			$json['success'] = $this->language->get('text_success');
			$json['results'] = $foods;
			if(isset($this->session->data['lat'])){
				$json['lat'] = $this->session->data['lat'];
				$json['lng'] = $this->session->data['lng'];
			}
			else{
				$json['lat'] = 0;
				$json['lng'] = 0;
			}
		} else {
			$json['error'] = $this->language->get('error');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function searchFood(){
		$food_name="";
		$lat = "";
		$lng = "";
		$address = "";
		$data=array();
		$this->load->model('sffood/food');
		$this->load->model('sfrest/information');
		$this->load->model('account/address');
		
		if (isset($this->request->post['search'])) {
			$food_name = $this->request->post['search'];
		}
				
		$data['query']=$food_name;
		$this->log->write('food name '.$food_name);
		if(strlen($food_name)>0)
		{
			$food_list = $this->model_sffood_food->getFoodByName($food_name);
			$rest_list = $this->model_sfrest_information->getRestaurantsByName($food_name);
		}
		else{
			$food_list = array();
			$rest_list = array();
		}
		
		$cart_foods = $this->cart->getFoods();
		if(count($cart_foods)){
			foreach ($food_list as $key => $food) {
				foreach($cart_foods as $product){
					if((int)$food['food_id'] == (int)$product['product_id']){
						$food_list[$key]['cart_number'] = $product['quantity'];
					}
				}
			}
		}
		$lang = $this->session->data['language'];	
		
		foreach($food_list as $key => $value)
		{
			if(isset($this->session->data['lat'])&&isset($this->session->data['lng']))
			{
				$dist = $this->model_account_address->getDistance($this->session->data['lat'],
						$this->session->data['lng'],
						$food_list[$key]['lat'],
						$food_list[$key]['lng']);
				$food_list[$key]['dist'] = $dist;
			}
			$food_list[$key]['is_open'] = $this->openhours->is_open($food_list[$key]['restaurant_id']);
			if($lang=='en')
			{
				$food_list[$key]['food_name'] = $food_list[$key]['food_name_en'];
				$food_list[$key]['rest_name'] = $food_list[$key]['rest_name_en'];
			}
		}
		
		$data['foods'] =$food_list;
		foreach ($rest_list as $key => $value){
			if(isset($this->session->data['address'])){
				$rest_list[$key]['distance'] = $this->model_account_address->getDistance($this->session->data['lat'], $this->session->data['lng'], $rest_list[$key]['lat'], $rest_list[$key]['lng']);
			}
			else{
				$rest_list[$key]['distance'] = "未知";
			}
			$rest_list[$key]['is_open'] = $this->openhours->is_open($rest_list[$key]['restaurant_id']);
			if($lang=='en')
			{
				$rest_list[$key]['name'] = $rest_list[$key]['name_en'];
			}
		}
		$data['rests'] = $rest_list;
				
		//set search history
		
		//return result
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
	
}