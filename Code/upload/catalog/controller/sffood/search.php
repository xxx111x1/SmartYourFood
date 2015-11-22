<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/28
 * Time: 22:11
 */
class ControllerSffoodSearch extends Controller{
    public function index()
    {    	
        $food_name="";
        $lat = "";
        $lng = "";
        $address = "";
        $data=array();
        $this->load->model('sffood/food');
        $this->load->model('sfrest/information');
        $this->load->model('account/address');
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        $data['backtop'] = $this->load->controller('common/backtop');
        if (isset($this->request->get['search'])) {
            $food_name = $this->request->get['search'];
        }
        
        if(isset($this->request->get['address'])){
        	$lat = $this->request->get['lat'];
        	$lng = $this->request->get['lng'];
        	$address = $this->request->get['address'];
        }
        
        if(!$this->customer->isLogged()){
        	$redirect = $this->url->link('sffood/search','search='.$food_name . '&lat='.$lat.'&lng='.$lng.'address='.$address);
        	$this->response->redirect($this->url->link('sfaccount/login','redirect=' . $redirect));
        }
        
        $data['query']=$food_name;

        $this->log->write('food name '.$food_name);
        $food_list = $this->model_sffood_food->getFoodByName($food_name);

        foreach($food_list as $key => $value)
        {
            if(isset($this->session->data['lat'])&&isset($this->session->data['lng']))
            {
                $dist = $this->model_account_address->getDistance($this->session->data['lat'],
                $this->session->data['lng'],
                $food_list[$key]['lat'],
                $food_list[$key]['lng']);
                $food_list[$key]['dist'] = $dist;
            }
            $food_list[$key]['is_open'] = $this->openhours->is_open($food_list[$key]['restaurant_id']);
         }

        $data['foods'] =$food_list;
        $rest_list = $this->model_sfrest_information->getRestaurantsByName($food_name);

        foreach ($rest_list as $key => $value){
        	if(isset($this->session->data['address'])){
        		$rest_list[$key]['distance'] = $this->model_account_address->getDistance($this->session->data['lat'], $this->session->data['lng'], $rest_list[$key]['lat'], $rest_list[$key]['lng']);
        	}
        	else{
        		$rest_list[$key]['distance'] = "未知";
        	}
            $rest_list[$key]['is_open'] = $this->openhours->is_open($rest_list[$key]['restaurant_id']);
           // $this->log->write('rest id: '.$rest_list[$key]['restaurant_id'].' is_open '.$rest_list[$key]['is_open']);
        }        
        $data['rests'] = $rest_list;
        $food_result_num =count($food_list);
        $data['food_result_num'] = $food_result_num;
        if($food_result_num==0)
        {
            $data['nofood']="style=\"display: none\"";
            $data['hasfood']="";
        }
        else{
            $data['nofood']="";
            $data['hasfood']="style=\"display: none\"";
        }

        $rest_num=count($rest_list);
        $data['rest_num']=$rest_num;
        if($rest_num==0)
        {
            $data['norest']="style=\"display: none\"";
            $data['hasrest']="";
        }
        else{
            $data['hasrest']="style=\"display: none\"";
            $data['norest']="";
        }

        //set search history
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
            $data['first_name'] = $this->customer->getFirstName();
            $this->load->model('account/address');
            $data['history_address'] = $this->model_account_address->getAddressesHistory();
        }
        else{
            $data['address'] = "请输入送餐地址";
            $data['first_name'] = "";
            $data['history_address'] = "";
        }
		if(isset($this->request->get['type'])){
			if($this->request->get['type'] == "rest"){
				$this->response->setOutput($this->load->view('default/template/sfrest/search.2.tpl', $data));
			}
			else{
				$this->response->setOutput($this->load->view('default/template/sffood/search.2.tpl', $data));
			}			
		}
		else{
			$this->response->setOutput($this->load->view('default/template/sffood/search.2.tpl', $data));
		}
        
    }
}