<?php
class ControllerApiRest extends Controller {
	public function getData() {
		$filters = $this->request->post['filters'];
		$sort = $this->request->post['sort'];
		$page_number = $this->request->post['page_number'];
		$page_content_number = 12;
		$start_position = $page_number * $page_content_number;
		$this->load->model('sfrest/information');	
		$restaurants = $this->model_sfrest_information->getRestaurants($filters,$sort,$start_position,$page_content_number);			
		if ($restaurants) {			
			$json['success'] = $this->language->get('text_success');
			$json['restaurants'] = $restaurants;
		} else {
			$json['error'] = $this->language->get('error');
		}						
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($restaurants));
	}
}