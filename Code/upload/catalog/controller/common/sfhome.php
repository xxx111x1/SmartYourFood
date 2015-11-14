<?php
class ControllerCommonSfhome extends Controller {
	public function index() {
		$data = array();
		if(isset($this->request->get['logout'])){
			$this->customer->logout();
		}
		$this->load->model('sffood/food');
		//$data["foods"] = $this->model_sffood_food->getSpecialFoods();
		$data["foods"] = $this->model_sffood_food->getTempSpecialFoods();
		$data['first_name'] = "";
		$data['history_address'] = "";
		if(isset($this->request->get['lat'])){
			$this->session->data['lat'] = $this->request->get['lat'];
			$this->session->data['lng'] = $this->request->get['lng'];
			$this->session->data['address'] = $this->request->get['address'];
			$data['address'] =$this->request->get['address'];
			if($this->customer->isLogged()){
				$this->load->model('account/customer');
				$data['first_name'] = $this->customer->getFirstName();
				$this->model_account_customer->editAddress($this->session->data);
				$this->load->model('account/address');
				$data['history_address'] = $this->model_account_address->getAddressesHistory();
			}
		}
		elseif($this->customer->isLogged() || isset($this->session->data['address']))
		{
			$data['address'] =$this->session->data['address'];
			$data['first_name'] = $this->customer->getFirstName();
			$this->load->model('account/address');
			$data['history_address'] = $this->model_account_address->getAddressesHistory();
		}
		else{
			$data['address'] = "请输入送餐地址";
		}
		
		if(isset($this->session->data['cart_rest_id'])){
			$data['cart_rest_id'] = $this->session->data['cart_rest_id'];
		}
		else{
			$data['cart_rest_id'] = 0;
		}
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/sfhome.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/sfhome.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/sfhome.tpl', $data));
		}
	}
}