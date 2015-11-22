<?php
class ControllerApiRest extends Controller {
	public function getData() {
		$filters = $this->request->post['filters'];
		$sort = $this->request->post['sort'];
		$page_number = $this->request->post['page_number'];
		$page_content_number = 12;
		$start_position = $page_number * $page_content_number;
		$this->load->model('sfrest/information');	
		$restaurants = $this->model_sfrest_information->getRestaurants($filters,$sort,$start_position,$page_content_number);
        foreach ($restaurants as $key => $rest) {
            $restaurants[$key]['is_open']=$this->openhours->is_open($restaurants[$key]['restaurant_id']);
        }

		if ($restaurants) {			
			$json['success'] = $this->language->get('text_success');
			$json['results'] = $restaurants;
			if(isset($this->session->data['lat'])){
				$json['lat'] = $this->session->data['lat'];
				$json['lng'] = $this->session->data['lng'];
			}
			else{
				$json['lat'] = 0;
				$json['lng'] = 0;
			}
		} else {
			$json['error'] = $this->language->get('error');
		}						
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getType() {
		$this->load->model('sfrest/information');
		$types = $this->model_sfrest_information->getTypes();
		if ($types) {
			$json['success'] = $this->language->get('text_success');
			$json['types'] = $types;
		} else {
			$json['error'] = $this->language->get('error');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function addreview()
	{
		$data = array();
		if($this->customer->isLogged()){
			$data['restaurant_id'] = $this->request->post['restid'];
			$data['overall_score'] = $this->request->post['overallScore'];
			$data['taste_score'] = $this->request->post['tasteScore'];
			$data['service_score'] = $this->request->post['serviceScore'];
			$data['comment'] = $this->request->post['comment'];
			$data['review_id'] = $this->customer->getId();
			$this->load->model('sfrest/information');
			$this->model_sfrest_information->addRestReview($data);
			$json['success'] = $this->language->get('text_success');
		}
		else{
			$json['error'] = $this->language->get('error');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}