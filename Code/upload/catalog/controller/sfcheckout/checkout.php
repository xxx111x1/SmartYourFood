<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/16
 * Time: 16:45
 */
class ControllerSfcheckoutCheckout extends Controller{
    private $tax_rate = 0.05;
    private $deliver_fee_rate = 1.00;
    public function index()
    {
        /*
    	if(!$this->customer->isLogged()){
    		$redirect = $this->url->link('common/sfhome');
    		$this->response->redirect($this->url->link('sfaccount/login','redirect=' . $redirect));
    	}*/

        $data=array();
        
        $data['lang'] = $this->language->get('code');
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        
        $this->load->language('sfcheckout/checkout');
        $data['Logo'] =                                      $this->language->get('Logo');
        $data['Home'] =                                      $this->language->get('Home');
        $data['Food'] =                                      $this->language->get('Food');
        $data['Order'] =                                     $this->language->get('Order');
        $data['Selected_Restaurants'] =                      $this->language->get('Selected_Restaurants');
        $data['Selected_Food'] =                             $this->language->get('Selected_Food');
        $data['My_Cart'] =                                   $this->language->get('My_Cart');
        $data['Order_Detail'] =                              $this->language->get('Order_Detail');
        $data['Order'] =                                     $this->language->get('Order');
        $data['Price'] =                                     $this->language->get('Price');
        $data['Count'] =                                     $this->language->get('Count');
        $data['Total_Price'] =                               $this->language->get('Total_Price');
        $data['Sub_Total'] =                                 $this->language->get('Sub_Total');
        $data['Delivery'] =                                  $this->language->get('Delivery');
        $data['Tax'] =                                       $this->language->get('Tax');
        $data['Priority_Delivery'] =                         $this->language->get('Priority_Delivery');
        $data['Total'] =                                     $this->language->get('Total');
        $data['Delivery_Information'] =                      $this->language->get('Delivery_Information');
        $data['Payment_Cash'] =                             $this->language->get('Payment_Cash');
        $data['Pay_Bill'] =                                  $this->language->get('Pay_Bill');
        $data['Help_Center'] =                               $this->language->get('Help_Center');
        $data['Follow_Us'] =                                 $this->language->get('Follow_Us');
        $data['Contact_Us'] =                                $this->language->get('Contact_Us');
        $data['Scan_here'] =                                 $this->language->get('Scan_here');
        $data['Delete'] = $this->language->get('Delete');
		$data['Edit'] = $this->language->get('Edit');
		$data['New_Address'] = $this->language->get('New_Address');
		$data['No_Any_Order'] = $this->language->get('No_Any_Order');
        //Get Address
        $this->load->model('sfcheckout/shippingaddress');
        $has_address = false;


        //check if current page is returned from address pickup page        
        if(isset($this->request->get['lat'])
        		&&isset($this->request->get['lng'])
        		&&isset($this->request->get['address'])
        		&&isset($this->request->get['phone'])
        		&&isset($this->request->get['contact'])
        )
        {
        	$address_data=array();
        	$this->session->data['lat'] = $this->request->get['lat'];
        	$this->session->data['lng'] = $this->request->get['lng'];
        	$this->session->data['address'] = $this->request->get['address'];
        	$this->session->data['shipping_address_phone'] = $this->request->get['phone'];
        	$this->session->data['shipping_address_contact'] = $this->request->get['contact'];
        	$address_data['lat']=$this->request->get['lat'];
        	$address_data['lng']=$this->request->get['lng'];
        	$address_data['address']=$this->request->get['address'];
        	$address_data['phone']=$this->request->get['phone'];
        	$address_data['contact']=$this->request->get['contact'];
        	if(isset($this->request->get['addressId'])){
				$this->model_sfcheckout_shippingaddress->editAddress($this->request->get['addressId'],$address_data);
			}
			else{
				$this->model_sfcheckout_shippingaddress->addAddress($address_data);
			}	
        }
        //session stores the address information
        else if(isset($this->session->data['lat'])&&
                 isset($this->session->data['lng'])&&
                 isset($this->session->data['address'])){
        	
        	$address_data['lat']=$this->session->data['lat'];
        	$address_data['lng']=$this->session->data['lng'];
        	$address_data['address']=$this->session->data['address'];
        	
        	if(isset($this->session->data['shipping_address_phone'])&&
            isset($this->session->data['shipping_address_contact'])){
        		$address_data['phone']=$this->session->data['shipping_address_phone'];
        		$address_data['contact']=$this->session->data['shipping_address_contact'];        		
        	}
        	else{
        		$address_data['phone']=$this->customer->getTelephone();
        		$address_data['contact']=$this->customer->getFirstName();
        	}
        	
        	$this->model_sfcheckout_shippingaddress->addAddress($address_data);
        	
        }

        /*
        if($this->customer->isLogged())
        {
            $addresses = $this->model_sfcheckout_shippingaddress->getAddresses();
            if(count($addresses)>0 && isset($addresses->rows[0]['address_id']))
            {
                $this->set_shipping_address($addresses->rows[0]['address_id']);
            }
        }
        else{
            //TODO: get guest's address
            $addresses = array();
            $addresses[0] = $address_data;
            //$addresses = $this->customer->getAddresses();
        }*/

        $addresses = $this->model_sfcheckout_shippingaddress->getAddresses();
        if(count($addresses)>0 )
        {
            $first_addr = reset($addresses);
            $this->set_shipping_address($first_addr['address_id']);
            $this->customer->setShippingAddress($first_addr);
            $data['addr']=$first_addr;
        }
        

        //TODO: test if has address cookie
        $data['addresslist']=$addresses;  
        
        $food_list = $this->cart->getFoods();
        $restIds = array();
        foreach($food_list as $food){
        	$restIds[$food["rest_id"]] = 1;
        }
        if(count($restIds)>1){
        	$data["more_rests"] = 1;
        }
        else{
        	$data["more_rests"] = 0;
        }
        
        $data['food_list']= $food_list;  
        $data['food_view'] = $this->load->view('default/mobile/sfcheckout/foodList.tpl', $data);
        
        $total_before_tax = $this->cart->getFoodSubTotal();
        
        //Distance and price
        $deliverfee = 5;
        $lat_lng = $this->cart->getRestAddress();
        $distance = -1;
        if(isset($lat_lng['0']) &&
            isset($address_data['lat']) &&
            isset($address_data['lng'])){
        	$this->load->model('account/address');
        	$distance = $this->model_account_address->getDistance($address_data['lat'],$address_data['lng'],explode(',',$lat_lng['0'])['0'],explode(',',$lat_lng['0'])['1']);
        	$deliverfee = 4 + max(0,round($distance-4,0,PHP_ROUND_HALF_UP)) + (max(0,round($distance-8,0,PHP_ROUND_HALF_UP)))*0.5;
        	$data['rest_lat'] = explode(',',$lat_lng['0'])['0'];
        	$data['rest_lng'] = explode(',',$lat_lng['0'])['1'];
        }
        
        //GetTime Canada/Pacific
        date_default_timezone_set('Canada/Pacific');
	    if (date('H') >= 22.5 || date('H')<9) {
	    	$deliverfee += 2;
	    	$data['is_night'] = 1;
	    }        
        $deliverfee = $deliverfee*$this->deliver_fee_rate;

        $total_before_tax = round($total_before_tax,2);
        $tax=round($this->tax_rate*$total_before_tax,2);
        //$tips = round(0.1*$total_before_tax,2);
        $data['beforetax'] =  $total_before_tax;
        $data['tax'] = $tax;
        //$data['tips'] = $tips;
        $fast_deliverfee = round($total_before_tax*0.05,2);
        if($distance<0)
        {
            $data['deliverfee'] = '--';
            $data['totalcost'] = '--';
            $data['fast_deliverfee'] = '--';
            $data['validaddress'] = false;
            $data['Delivery_Information'] =                      $this->language->get('Require_Address');
        }
        else{
            $data['deliverfee'] = $deliverfee;
            $data['fast_deliverfee'] = $fast_deliverfee;
            $data['totalcost'] = round($total_before_tax + $tax + $deliverfee +$fast_deliverfee,2);
            $data['validaddress'] = true;
        }
        $this->session->data['order_beforetax'] = $total_before_tax;
        $this->session->data['order_tax'] = $tax;
        $this->session->data['order_deliverfee'] = $deliverfee;
        $this->session->data['order_fastdeliverfee'] = $fast_deliverfee;
        $this->session->data['order_totalcost'] = $data['totalcost'];
        if(count($food_list)==0)
        {
            $data['nofood']="display: none";
            $data['hasfood']="";
        }
        else{
            $data['nofood']="";
            $data['hasfood']="display: none;";
        }
        
        $returnUrl = explode("&", $_SERVER['REQUEST_URI'])[0];
        $data['multiple_rest'] = 0;
        if($this->cart->getRestNumber()>1){
        	$data['multiple_rest'] = 1;
        }
        $data['returnUrl'] = $returnUrl;
        
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if($this->detector->isMobile($useragent)){
        	$data['Confirm_Order'] =         $this->language->get('Confirm_Order');
        	$data['Order_Number'] =          $this->language->get('Order_Number');
        	$data['Memo'] =                  $this->language->get('Memo');
        	$data['Deliveried_Pay'] =        $this->language->get('Deliveried_Pay');
        	$data['By_Cash'] =               $this->language->get('By_Cash');
        	$data['Summary'] =               $this->language->get('Summary');
        	$data['Fee_Info'] =              $this->language->get('Fee_Info');
        	$data['Confirm'] =               $this->language->get('Confirm');
        	$data['Note'] =               $this->language->get('Note');
        	$this->response->setOutput($this->load->view('default/mobile/sfcheckout/cart.tpl', $data));
        }
        else{
        	$this->response->setOutput($this->load->view('default/template/sfcheckout/cart.tpl', $data));
        }
        
    }
    
    public function info(){
    	$data['lang'] = $this->language->get('code');
    	$food_list = $this->cart->getFoods();
    	$data['food_list']= $food_list;
    	
    	$this->response->setOutput($this->load->view('default/mobile/sfcheckout/foodList.tpl', $data));
    }

    public function set_shipping_address($addr_id)
    {
        $this->load->model('sfcheckout/shippingaddress');
        $addr = $this->model_sfcheckout_shippingaddress->getAddress($addr_id);
        $this->session->data['shipping_address_id'] = $addr_id;
        $this->session->data['lat'] = $addr['lat'];
        $this->session->data['lng'] = $addr['lng'];
        $this->session->data['address'] = $addr['address'];
        $this->session->data['shipping_address_addr'] =  $addr['address'];
        $this->session->data['shipping_address_contact'] = $addr['contact'];
        $this->session->data['shipping_address_phone'] = $addr['phone'];
        $this->model_sfcheckout_shippingaddress->updateAddressDate($addr_id);
        
        
        //update deliverfee
        $this->session->data['order_totalcost'] = $this->session->data['order_totalcost'] - $this->session->data['order_deliverfee'];
        $deliverfee = 5;
        $lat_lng = $this->cart->getRestAddress();
        $distance = -1;
        if(isset($lat_lng['0']) &&
        		isset($addr['lat']) &&
        		isset($addr['lng'])){
        	$this->load->model('account/address');
        	$distance = $this->model_account_address->getDistance($addr['lat'],$addr['lng'],explode(',',$lat_lng['0'])['0'],explode(',',$lat_lng['0'])['1']);
        	$deliverfee = 4 + max(0,round($distance-4,0,PHP_ROUND_HALF_UP)) + (max(0,round($distance-8,0,PHP_ROUND_HALF_UP)))*0.5;
        }
        
        //GetTime Canada/Pacific
        date_default_timezone_set('Canada/Pacific');
        if (date('H') >= 22.5 || date('H')<9) {
        	$deliverfee += 2;
        }
        $deliverfee = $deliverfee*$this->deliver_fee_rate;
        $this->session->data['order_deliverfee'] = $deliverfee;
        $this->session->data['order_totalcost'] = $this->session->data['order_totalcost'] + $this->session->data['order_deliverfee'];
        
    }

    public function set_address()
    {
        if(isset($this->request->post['addr_id']))
        {
            $addr_id =$this->request->post['addr_id'];
            $this->set_shipping_address($addr_id);
        }
    }

}