<?php
class ControllerApiAddress extends Controller {
	public function setAddress() {
		$this->session->data['lat'] = $this->request->get['lat'];
        $this->session->data['lng'] = $this->request->get['lng'];
        $this->session->data['address'] = $this->request->get['address'];
        $insert = $this->request->get['isInsert'];
        $data['address'] =$this->request->get['address'];
        if($this->customer->isLogged()){
        	$this->load->model('account/customer');
        	$this->load->model('account/address');
        	$this->model_account_customer->editAddress($this->session->data);
        	if($insert>0)
        	$this->model_account_address->addAddressHistory($this->session->data);
        }        				
		$json['success'] = $this->language->get('text_success');					
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getRecentAddresses() {
		if($this->customer->isLogged()){
			$this->load->model('account/address');
			$json['addresses'] = $this->model_account_address->getAddressesHistory();
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}	

	public function deleteShippingAddress()
	{
		if(isset($this->request->post['addressId'])){
			$address_id = $this->request->post['addressId'];
			$this->load->model('sfcheckout/shippingaddress');
			$this->model_sfcheckout_shippingaddress->deleteAddress($address_id);
			$json['status'] = 'ok';
		}
		else{
			$json['status'] = 'failed';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}