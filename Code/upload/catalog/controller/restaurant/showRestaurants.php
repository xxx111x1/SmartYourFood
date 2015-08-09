<?php
header("Content-Type: text/html; charset=gb2312");

class ControllerRestaurantShowRestaurants extends Controller{
	public function index() {
		/*if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
		
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}*/
		$filters = $this->request->post['product_id'];
		$this->load->model('restaurant/information');
		$data['restaurants'] = $this->model_restaurant_information->getRestaurants($filters);
		$data['types'] = $this->model_restaurant_information->getTypes();
		$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/restaurant/showRestaurant.tpl', $data));
	}
}