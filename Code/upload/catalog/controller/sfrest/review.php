<?php
class ControllerSfrestReview extends Controller{
	public function index() {
		if(isset($this->request->get['restaurant_id'])){
			$data['rest_id'] = $this->request->get['restaurant_id'];
		}
		else{
			$data['rest_id'] = -1;
		}
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/sfrest/review.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/sfrest/review.tpl', $data);
		} else {
			return $this->load->view('default/template/sfrest/review.tpl', $data);
		}		
	}
}