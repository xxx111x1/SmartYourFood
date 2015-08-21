<?php
class ControllerApiFood extends Controller {
	public function getData() {
		$filters = $this->request->post['filters'];
		$sort = $this->request->post['sort'];
		$page_number = $this->request->post['page_number'];
		$page_content_number = 12;
		$start_position = $page_number * $page_content_number;
		$this->load->model('sffood/food');
		$foods = $this->model_sffood_food->getFoods($filters,$sort,$start_position,$page_content_number);	
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
		
		if ($foods) {			
			$json['success'] = $this->language->get('text_success');
			$json['foods'] = $foods;
		} else {
			$json['error'] = $this->language->get('error');
		}						
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($foods));
	}
}