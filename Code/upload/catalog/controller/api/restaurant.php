<?php
class ControllerApiRestaurant extends Controller {
	public function getRestaurants() {
		$filters = $this->request->post['filters'];
		$orders = $this->request->post['orders'];
		$this->load->model('restaurant/information');	
		echo "filters: " . $filters . "orders: " . $orders;
		$restaurants = $this->model_restaurant_information->getRestaurants($filters,$orders,0,16);			
		if ($restaurants) {			
			$json['success'] = $this->language->get('text_success');
			$json['restaurants'] = $restaurants;
		} else {
			$json['error'] = $this->language->get('error');
		}						
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}