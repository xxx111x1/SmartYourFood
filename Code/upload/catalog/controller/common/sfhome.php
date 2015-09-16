<?php
class ControllerCommonSfhome extends Controller {
	public function index() {
		$data = array();
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
		}
		else{
			$data['address'] = "添加送餐地址";
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/sfhome.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/sfhome.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/sfhome.tpl', $data));
		}
	}
}