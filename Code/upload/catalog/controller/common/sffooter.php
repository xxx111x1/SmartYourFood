<?php
class ControllerCommonSffooter extends Controller {
	public function index() {
		$this->load->language('common/footer');
		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));
		
		$this->load->language('sfcheckout/checkout');
		$data['Contact_Us'] =                                $this->language->get('Contact_Us');
		$data['Scan_here'] =                                 $this->language->get('Scan_here');
		$data['Help_Center'] =                               $this->language->get('Help_Center');
		$data['Follow_Us'] =                                 $this->language->get('Follow_Us');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/sffooter.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/sffooter.tpl', $data);
		} else {
			return $this->load->view('default/template/common/sffooter.tpl', $data);
		}
	}
}