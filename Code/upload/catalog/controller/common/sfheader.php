<?php
class ControllerCommonSfheader extends Controller {
	public function index() {
		$data['lang'] = $this->language->get('code');
		$data['title'] = $this->document->getTitle();
		$this->load->language('common/sfhome');
		if($this->customer->isLogged() || isset($this->session->data['address']))
		{
			$data['address'] =$this->session->data['address'];
			$data['first_name'] = $this->customer->getFirstName();
		}
		else{
			$data['address'] = $this->language->get('Please_enter_your_address');;
			$data['first_name'] = "";
		}
		
		$this->load->language('common/list');
		$data['Login_Register'] =                            $this->language->get('Login_Register');
		$data['Logo'] =                                      $this->language->get('Logo');
		$data['Home'] =                                      $this->language->get('Home');
		$data['Food'] =                                      $this->language->get('Food');
		$data['Order_Amount'] =                                     $this->language->get('Order_Amount');
		$data['Language'] =                                  $this->language->get('Language');
		$data['Welcome'] =                                  $this->language->get('Welcome');
		$data['Search_Restaurant_name_Food_Keywords'] =      $this->language->get('Search_Restaurant_name_Food_Keywords');
		$data['Go'] =                                        $this->language->get('Go');
		$data['Category'] = $this->language->get('Category');
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if($this->detector->isMobile($useragent)){
			return $this->load->view('default/mobile/common/sfheader.tpl', $data);
		}
		else{
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/sfheader.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/common/sfheader.tpl', $data);
			} else {
				return $this->load->view('default/template/common/sfheader.tpl', $data);
			}	
		}
		
	}
}