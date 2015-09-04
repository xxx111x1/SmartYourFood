<?php
class ControllerApiFeedback extends Controller {
	public function submit() {
		//$this->load->language('api/cart');
		$json = array();
			if(isset($this->request->post['sender'])){
				$data = array();
				$sender = $this->request->post['sender'];
				if(strpos($sender,'@') !== false && !filter_var($sender, FILTER_VALIDATE_EMAIL)){					
						$json['error'] = "Invalid Email Address.";					
				}
				else{
					$data['email'] = $this->request->post['sender'];
				}
				if (strpos($sender,'@') !== false && !filter_var($sender, FILTER_VALIDATE_INT)) {
						$json['error'] = "Invalid Phone Number.";
				}
				else{
					$data['phone'] = $this->request->post['sender'];
				}	
				
				if(!isset($json['error'])){
					$data['message'] = $this->request->post['message'];
					//insert suggestion
					$this->load->model('catalog/feedback');
						
					$this->model_catalog_feedback->addFeedback($data);
					$json['success'] = $this->language->get('text_success');
				}
				
			}
			else{
				$json['error'] = "Please input contactor.";
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