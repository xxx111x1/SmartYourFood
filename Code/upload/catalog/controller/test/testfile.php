<?php
class Controllertesttestfile extends Controller{
	public function index() {
		$this->load->model('restaurant/information');
		$string = file_get_contents(DIR_APPLICATION . '/shops.json');
		$json = json_decode($string, true);
		$queryArray = array();
		foreach ($json as $restaurant) {		
			$this->model_restaurant_information->addRestaurant($restaurant);
		}
		$data['query'] = $queryArray;
		
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/test/test.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/test/test.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/test/test.tpl', $data));
		}
	}
}
?>