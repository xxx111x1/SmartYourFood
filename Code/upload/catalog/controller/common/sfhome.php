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
		
		$this->load->language('common/sfhome');
		$data['Logo'] =                                      $this->language->get('Logo');
		$data['Search'] =                                    $this->language->get('Search');
		$data['Login_Register'] =                            $this->language->get('Login_Register');
		$data['Please_enter_your_address'] =                 $this->language->get('Please_enter_your_address');
		$data['Search_Restaurant_name_Food_Keywords'] =      $this->language->get('Search_Restaurant_name_Food_Keywords');
		$data['History'] =                                   $this->language->get('History');
		$data['More_Dishes'] =                               $this->language->get('More_Dishes');
		$data['Selected_Restaurants'] =                      $this->language->get('Selected_Restaurants');
		$data['Language'] =                                  $this->language->get('Language');
		$data['Welcome'] =                                  $this->language->get('Welcome');
		if(isset($this->request->get['lat'])){
			$this->load->model('account/address');
			$this->session->data['lat'] = $this->request->get['lat'];
			$this->session->data['lng'] = $this->request->get['lng'];
			$this->session->data['address'] = $this->request->get['address'];
			$data['address'] =$this->request->get['address'];
			
			//set delivery fee
// 			if(isset($this->request->get['geoResult'])){
// 				$region_string = $this->request->get['geoResult'];
// 				$this->session->data['delivery_fee'] = $this->model_account_address->getRegionFee($region_string);
// 			}			
			if($this->customer->isLogged()){
				$this->load->model('account/customer');
				$data['first_name'] = $this->customer->getFirstName();
				$this->model_account_customer->editAddress($this->session->data);				
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
			$data['address'] = $data['Please_enter_your_address'];
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