<?php
class ControllerCommonSffooter extends Controller {
	public function index() {
		$this->load->language('common/footer');
		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/sffooter.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/sffooter.tpl', $data);
		} else {
			return $this->load->view('default/template/common/sffooter.tpl', $data);
		}
	}
}