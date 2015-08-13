<?php
class ControllerApiFood extends Controller {
	public function getData() {
		$filters = $this->request->post['filters'];
		$orders = $this->request->post['orders'];
		$this->load->model('sffood/food');
		$foods = $this->model_sffood_food->getFoods($filters,$orders,0,12);			
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