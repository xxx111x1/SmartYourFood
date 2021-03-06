<?php
class ControllerAccountAccount extends Controller {
	public function index_bkp() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/account');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_my_account'] = $this->language->get('text_my_account');
		$data['text_my_orders'] = $this->language->get('text_my_orders');
		$data['text_my_newsletter'] = $this->language->get('text_my_newsletter');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_password'] = $this->language->get('text_password');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_reward'] = $this->language->get('text_reward');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_recurring'] = $this->language->get('text_recurring');

		$data['edit'] = $this->url->link('account/edit', '', 'SSL');
		$data['password'] = $this->url->link('account/password', '', 'SSL');
		$data['address'] = $this->url->link('account/address', '', 'SSL');
		$data['wishlist'] = $this->url->link('account/wishlist');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['return'] = $this->url->link('account/return', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');
		$data['recurring'] = $this->url->link('account/recurring', '', 'SSL');

		if ($this->config->get('reward_status')) {
			$data['reward'] = $this->url->link('account/reward', '', 'SSL');
		} else {
			$data['reward'] = '';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		/*$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');*/
		$data['header'] = $this->load->controller('common/sfheader');
		$data['footer'] = $this->load->controller('common/sffooter');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/account_full.html')) {
			#$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/account.tpl', $data));
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/account_full.html', $data));
		} else {
			#$this->response->setOutput($this->load->view('default/template/account/account.tpl', $data));
			$this->response->setOutput($this->load->view('default/template/account/account_full.html', $data));
		}
	}
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');

			$this->response->redirect($this->url->link('sfaccount/login', '', 'SSL'));
		}
		
		$data['lang'] = $this->language->get('code');
		
		if(isset($this->request->get['lat'])
				&&isset($this->request->get['lng'])
				&&isset($this->request->get['address'])
		)
		{
			$this->load->model('sfcheckout/shippingaddress');
			$address_data=array();
			$this->session->data['lat'] = $this->request->get['lat'];
			$this->session->data['lng'] = $this->request->get['lng'];
			$this->session->data['address'] = $this->request->get['address'];

			$address_data['lat']=$this->request->get['lat'];
			$address_data['lng']=$this->request->get['lng'];
			$address_data['address']=$this->request->get['address'];
			
			if(isset($this->request->get['phone'])
				&&isset($this->request->get['contact'])){
				
				$this->session->data['shipping_address_phone'] = $this->request->get['phone'];
				$this->session->data['shipping_address_contact'] = $this->request->get['contact'];
				$address_data['phone']=$this->request->get['phone'];
				$address_data['contact']=$this->request->get['contact'];
			}
			else{
				$this->session->data['shipping_address_phone'] = $this->customer->getTelephone();
				$this->session->data['shipping_address_contact'] =$this->customer->getFirstName();
        		$address_data['phone']=$this->customer->getTelephone();
        		$address_data['contact']=$this->customer->getFirstName();
        	}
        	
			
			
			
			//set delivery fee
// 			if(isset($this->request->get['geoResult'])){
// 				$region_string = $this->request->get['geoResult'];
// 				$this->session->data['delivery_fee'] = $this->model_account_address->getRegionFee($region_string);
// 			}
			
			if(isset($this->request->get['addressId'])){
				$this->model_sfcheckout_shippingaddress->editAddress($this->request->get['addressId'],$address_data);
			}
			else{
				$this->model_sfcheckout_shippingaddress->addAddress($address_data);
			}
			
			$useragent=$_SERVER['HTTP_USER_AGENT'];
			if($this->detector->isMobile($useragent)){
				$this->response->redirect($this->url->link('account/account', '#updateaddress_', 'SSL'));
			}
			
			
		}
		$data['first_name'] = $this->customer->getFirstName();
		$this->load->language('account/account');
		$data['My_Account'] = $this->language->get('My_Account');
		$data['Change_Account_Information'] = $this->language->get('Change_Account_Information');
		
		$data['Profile'] = $this->language->get('Profile');
		$data['HistoryOrders'] = $this->language->get('HistoryOrders');
		$data['All'] = $this->language->get('All');
		$data['Order_Detail'] = $this->language->get('Order_Detail');
		$data['Receiver'] = $this->language->get('Receiver');
		$data['Total'] = $this->language->get('Total');
		$data['Status'] = $this->language->get('Status');
		$data['Address_Management'] = $this->language->get('Address_Management');
		$data['Edit'] = $this->language->get('Edit');
		$data['Delete'] = $this->language->get('Delete');
		$data['Wecome_Here'] = $this->language->get('Wecome_Here');
		$data['Log_Out'] = $this->language->get('Log_Out');
		$data['Primary_Fooder'] = $this->language->get('Primary_Fooder');
		$data['About'] = $this->language->get('About');
		
		$this->document->setTitle($this->language->get('heading_title'));
		$data['header'] = $this->load->controller('common/sfheader');
		$data['footer'] = $this->load->controller('common/sffooter');
		$data['profile'] = $this->load->controller('sfaccount/profile');
		$data['orderhistory'] = $this->load->controller('sfaccount/order');
		$data['addresses'] = $this->load->controller('sfaccount/address');
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if($this->detector->isMobile($useragent)){
			$this->response->setOutput($this->load->view('default/mobile/account/account.tpl', $data));
		}elseif (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/account.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/account.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/account.tpl', $data));
		}
	}
	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function editaccount(){
		$user_name =$this->request->post['username'];
		$phone =$this->request->post['phone'];
		$oldpassword = $this->request->post['oldpassword'];
		$newpassword = $this->request->post['newpassword'];
		$this->load->model('account/customer');
		$this->log->write(__LINE__.'  modify user by phone: '.$user_name);
		$json = array();
		$this->response->addHeader('Content-Type: application/json');
		if($user_name != ""){
			$this->model_account_customer->editUsername($user_name);
		}
		if($phone !=""){
			if(!is_numeric($phone) || !$this->model_account_customer->editPhone($phone)){
				$json['status']='modify phone failed, this phone number have been already registered or in wrong format.';
				$this->response->setOutput(json_encode($json));
				return ;
			}
		}
		if($oldpassword !="" && $newpassword !=""){
			if(!$this->model_account_customer->editPasswordByCustomerID($oldpassword,$newpassword)){
				$json['status']='modify password failed';
				$this->response->setOutput(json_encode($json));
				return ;
			}
		}
		
		$json['status']='ok';		
		return $this->response->setOutput(json_encode($json));
	}
	public function editusername()
	{
        $user_name =$this->request->post['username'];
        $this->log->write(__LINE__.'  new user name: '.$user_name);
        $this->load->model('account/customer');
        $this->model_account_customer->editUsername($user_name);
        $json = array();
        $json['status']='ok';
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
	}

	public function editphone()
	{
		$phone =$this->request->post['phone'];
		$this->load->model('account/customer');
		$json = array();
		if($this->model_account_customer->editPhone($phone))
		{
			$json['status']='ok';
		}
		else{
			$json['status']='error';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function editemail()
	{
		$email =$this->request->post['email'];
		$this->load->model('account/customer');
		$json = array();
		if($this->model_account_customer->editEmail($email))
		{
			$json['status']='ok';
		}
		else{
			$json['status']='error';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


	public function  editPassword()
	{
		$oldpassword = $this->request->post['oldpassword'];
		$newpassword = $this->request->post['newpassword'];
		$this->load->model('account/customer');
		$status = $this->model_account_customer->editPasswordByCustomerID($oldpassword,$newpassword);
		$json = array();
		if($status)
		{
			$json['status']='ok';
		}
		else{
			$json['status']='error';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}