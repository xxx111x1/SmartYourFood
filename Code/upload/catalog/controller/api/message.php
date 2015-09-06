<?php
class ControllerApiMessage extends Controller {
	public function get() {
		//$this->load->language('api/cart');
		$json = array();
		if(isset($this->request->post['message_ids'])){
			$message_ids = $this->request->post['message_ids'];
			$this->load->model('catalog/message');
			echo $message_ids;
			$this->model_catalog_message->readMessage($message_ids);
			$json['success'] = $this->language->get('text_success');
		}
	
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Credentials: true');
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function read() {
		//$this->load->language('api/cart');
		$json = array();
			if(isset($this->request->post['message_ids'])){
				$message_ids = $this->request->post['message_ids'];
				$this->load->model('catalog/message');		
				echo $message_ids;
				$this->model_catalog_message->readMessage($message_ids);
				$json['success'] = $this->language->get('text_success');
			}				
		
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Credentials: true');
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}