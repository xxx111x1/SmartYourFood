<?php
class ControllerSfrestShowRestaurants extends Controller{
	public function index() {
		/*if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
		
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}*/
		//$filters = $this->request->post['product_id'];
		$this->load->model('sfrest/information');
		$data['restaurants'] = $this->model_sfrest_information->getRestaurants();
		$data['types'] = $this->model_sfrest_information->getTypes();
		$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/sfrest/showRestaurant.tpl', $data));
	}
}