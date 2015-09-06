<?php
class ControllerCommonBacktop extends Controller {
	public function index() {
		$data['cartthumbnail'] = $this->load->controller('common/cartthumbnail');
		$this->load->model('catalog/message');		
		$data['my_message'] = $this->model_catalog_message->getMessage();
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/backtop.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/backtop.tpl', $data);
		} else {
			return $this->load->view('default/template/common/backtop.tpl', $data);
		}
	}
}