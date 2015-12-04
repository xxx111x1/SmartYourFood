<?php
class ControllerCommonBacktop extends Controller {
	public function index() {
		$data['cartthumbnail'] = $this->load->controller('common/cartthumbnail');
		$this->load->model('catalog/message');		
		$data['my_message'] = $this->model_catalog_message->getMessage();
		
		$this->load->language('common/list');
		$data['Function_Feedback'] =         $this->language->get('Feedback');
		$data['Contact_Info'] =     $this->language->get('Contact_Info');
		$data['Leave_Your_Connection'] =             $this->language->get('Leave_Your_Connection');
		$data['Submit'] =             $this->language->get('Submit');
		$data['Cancel'] =             $this->language->get('Cancel');
		$data['History'] =             $this->language->get('History');
		$data['My_Order'] =             $this->language->get('My_Order');
		
		$data['Customer_Service'] =             $this->language->get('Customer_Service');
		$data['Feedback'] =             $this->language->get('Feedback');
		$data['Cart'] =             $this->language->get('Cart');
		
		$data['Back_Top'] =             $this->language->get('Back_Top');
		$data['Back'] =             $this->language->get('Back');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/backtop.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/backtop.tpl', $data);
		} else {
			return $this->load->view('default/template/common/backtop.tpl', $data);
		}
	}
}