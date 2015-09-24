<?php
class ControllerCommonSfheader extends Controller {
	public function index() {
		$data['lang'] = $this->language->get('code');
		$data['title'] = $this->document->getTitle();
		if($this->customer->isLogged() || isset($this->session->data['address']))
		{
			$data['address'] =$this->session->data['address'];
			$data['first_name'] = $this->customer->getFirstName();
		}
		else{
			$data['address'] = "请输入送餐地址";
			$data['first_name'] = "";
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/sfheader.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/sfheader.tpl', $data);
		} else {
			return $this->load->view('default/template/common/sfheader.tpl', $data);
		}
	}
}