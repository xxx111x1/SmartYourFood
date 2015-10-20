<?php
class ControllerCommonSfhome extends Controller {
	public function index() {
		$data = array();
		if(isset($this->request->get['logout'])){
			$this->customer->logout();
		}
		$this->load->model('sffood/food');
		$data["foods"] = $this->model_sffood_food->getSpecialFoods();
		if(isset($this->request->get['lat'])){
			$this->session->data['lat'] = $this->request->get['lat'];
			$this->session->data['lng'] = $this->request->get['lng'];
			$this->session->data['address'] = $this->request->get['address'];
			$data['address'] =$this->request->get['address'];
			if($this->customer->isLogged()){
				$this->load->model('account/customer');
				$this->model_account_customer->editAddress($this->session->data);
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
			$data['first_name'] = "";
			$data['history_address'] = "";
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/sfhome.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/sfhome.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/sfhome.tpl', $data));
		}
	}
}