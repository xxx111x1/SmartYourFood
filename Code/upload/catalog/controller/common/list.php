<?php
class ControllerCommonList extends Controller{
    public function index(){
    	$data = array();      
        $this->load->model('sfrest/information');
		$data['types'] = $this->model_sfrest_information->getTypes();
		$data['header'] = $this->load->controller('common/sfheader');
		$data['footer'] = $this->load->controller('common/sffooter');
        $data['backtop'] = $this->load->controller('common/backtop');
        
        if(!$this->customer->isLogged()){
        	$redirect = $this->url->link('common/list'); 
        	$this->response->redirect($this->url->link('sfaccount/login','redirect=' . $redirect));
        }        
        $this->load->language('common/list');
		$data['Logo'] =                                      $this->language->get('Logo');
		$data['Home'] =                                      $this->language->get('Home');
		$data['Food'] =                                      $this->language->get('Food');
		$data['Order_Amount'] =                                     $this->language->get('Order_Amount');
		$data['Selected_Restaurants'] =                      $this->language->get('Selected_Restaurants');
		$data['Selected_Food'] =                             $this->language->get('Selected_Food');
		$data['Search_Restaurant_name_Food_Keywords'] =      $this->language->get('Search_Restaurant_name_Food_Keywords');
		$data['Go'] =                                        $this->language->get('Go');
		$data['Selected_Dishes'] =                           $this->language->get('Selected_Dishes');
		$data['Selected_Restaurants'] =                      $this->language->get('Selected_Restaurants');
		$data['Categories'] =                                $this->language->get('Categories');
		$data['All'] =                                       $this->language->get('All');
		$data['Chinese'] =                                   $this->language->get('Chinese');
		$data['Spicy'] =                                     $this->language->get('Spicy');
		$data['Noodle_Congee'] =                             $this->language->get('Noodle_Congee');
		$data['Chinese_Traditional'] =                       $this->language->get('Chinese_Traditional');
		$data['Snack_Fast_Food'] =                           $this->language->get('Snack_Fast_Food');
		$data['Dessert_Drink'] =                             $this->language->get('Dessert_Drink');
		$data['Cantonese'] =                                 $this->language->get('Cantonese');
		$data['Beef_Lamb'] =                                 $this->language->get('Beef_Lamb');
		$data['Vegetarian'] =                                $this->language->get('Vegetarian');
		$data['Dim_Sum'] =                                   $this->language->get('Dim_Sum');
		$data['Soup'] =                                      $this->language->get('Soup');
		$data['BBQ'] =                                       $this->language->get('BBQ');
		$data['Sushi'] =                                     $this->language->get('Sushi');
		$data['Hot_Pot'] =                                   $this->language->get('Hot_Pot');
		$data['Southeast_Asia'] =                            $this->language->get('Southeast_Asia');
		$data['Deep_Fries'] =                                $this->language->get('Deep_Fries');
		$data['Bakeries'] =                                  $this->language->get('Bakeries');
		$data['North_China'] =                               $this->language->get('North_China');
		$data['Korean'] =                                    $this->language->get('Korean');
		$data['Filter'] =                                    $this->language->get('Filter');
		$data['Default'] =                                   $this->language->get('Default');
		$data['Popular'] =                                   $this->language->get('Popular');
		$data['Comments'] =                                  $this->language->get('Comments');
		$data['Delivery_Time'] =                                  $this->language->get('Delivery_Time');
		$data['History_Record'] =                                       $this->language->get('History_Record');
		$data['random'] = rand(0,1000);
		$rest_id=0;
		if(isset($this->session->data['cart_rest_id'])){
			$rest_id= $this->session->data['cart_rest_id'];
		}
		
		$data['rest_id'] = $rest_id;
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
        	$data['address'] = $data['Selected_Restaurants'];
        	$data['first_name'] = "";
        	$data['history_address'] = "";
        }
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if($this->detector->isMobile($useragent)){
        	$this->response->setOutput($this->load->view('default/mobile/common/list.tpl', $data));
        }
        else{
        	$this->response->setOutput($this->load->view('default/template/common/list.tpl', $data));
        }
        
    }
}