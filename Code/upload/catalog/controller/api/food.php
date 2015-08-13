<?php
class ControllerApiFood extends Controller {
	public function getData() {
		$filters = $this->request->post['filters'];
		$orders = $this->request->post['orders'];
		$page_number = $this->request->post['page_number'];
		$page_content_number = 12;
		$start_position = $page_number * $page_content_number;
		$this->load->model('sffood/food');
		$foods = $this->model_sffood_food->getFoods($filters,$orders,$start_position,$page_content_number);			
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