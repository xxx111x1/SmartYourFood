<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/16
 * Time: 16:45
 */
class ControllerSfcheckoutCheckout extends Controller{
    public function index()
    {
    	if(!$this->customer->isLogged()){
    		$redirect = $this->url->link('common/sfhome');
    		$this->response->redirect($this->url->link('sfaccount/login','redirect=' . $redirect));
    	}
        $data=array();
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        
        //Get Address
        $this->load->model('sfcheckout/shippingaddress');
        if(isset($this->session->data['address'])
        		&& isset($this->session->data['lat'])
        		&& isset($this->session->data['lng'])
        		&& $this->customer->isLogged())
        {
        	$address_data=array();
        	$address_data['lat']=$this->session->data['lat'];
        	$address_data['lng']=$this->session->data['lng'];
        	$address_data['address']=$this->session->data['address'];
        	$address_data['phone']=$this->customer->getTelephone();
        	$address_data['contact']=$this->customer->getFirstName();
        	$this->model_sfcheckout_shippingaddress->addAddress($address_data);
        }
        
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
        else{
        	$this->log->write('no returned url');
        }
        $addresses = $this->model_sfcheckout_shippingaddress->getAddresses();
        if(count($addresses)>0 && isset($addresses->rows[0]['address_id']))
        {
        	$this->set_shipping_address($addresses->rows[0]['address_id']);
        }
        $data['addresslist']=$addresses;  
        
        $food_list = $this->cart->getFoods();
        //foreach($food in $food_list)
        $data['food_list']= $food_list;              
        $total_before_tax = $this->cart->getFoodSubTotal();
        
        //Distance and price
        $deliverfee = 5;
        $lat_lng = $this->cart->getRestAddress();
        if(isset($lat_lng['0'])){
        	$this->load->model('account/address');
        	$distance = $this->model_account_address->getDistance($address_data['lat'],$address_data['lng'],explode(',',$lat_lng['0'])['0'],explode(',',$lat_lng['0'])['1']);
        	$deliverfee = 4 + max(0,round($distance-4,0,PHP_ROUND_HALF_UP)) + (max(0,round($distance-8,0,PHP_ROUND_HALF_UP)))*0.5;
        }
        
        //GetTime Canada/Pacific
        date_default_timezone_set('Canada/Pacific');
	    if (date('H') >= 22.5 || date('H')<9) {
	    	$deliverfee += 2;
	    }        
        
        $total_before_tax = round($total_before_tax,2);
        $tax=round(0.12*$total_before_tax,2);
        //$tips = round(0.1*$total_before_tax,2);
        $data['beforetax'] =  $total_before_tax;
        $data['tax'] = $tax;
        //$data['tips'] = $tips;
        $fast_deliverfee = 5;
        $data['deliverfee'] = $deliverfee;
        $data['fast_deliverfee'] = $fast_deliverfee;
        $data['totalcost'] = round($total_before_tax + $tax + $deliverfee +$fast_deliverfee,2);
        if(count($food_list)==0)
        {
            $data['nofood']="display: none";
            $data['hasfood']="";
        }
        else{
            $data['nofood']="";
            $data['hasfood']="display: none";
        }
        /*
        foreach ($food_list as $food) {
            $this->log->write('img: '.$food['image'].' name:'.$food['name'].' price: '.$food['price']);
            $data['food_list'] = array(
                'img_url' => $food['image'],
                'name' => $food['name'],
                'price' => $food['price'],
                'rest_address'=>$food['rest_address'],
                'phone' => $food['phone'],
                'qty' => 2
            );
        }
        $data['msg']='Hello World!';*/

       
        $this->response->setOutput($this->load->view('default/template/sfcheckout/cart.tpl', $data));
    }

    public function set_shipping_address($addr_id)
    {
        $this->log->write('set shipping address id: '.$addr_id);
        $this->load->model('sfcheckout/shippingaddress');
        $this->session->data['shipping_address_id'] = $addr_id;
        $addr = $this->model_sfcheckout_shippingaddress->getAddress($addr_id);
        $shippingaddress = array();
        $shippingaddress['firstname'] = $addr['contact'];
        $shippingaddress['address_1'] = $addr['address'];
        $shippingaddress['address_2'] = $addr['phone'];
        $this->session->data['shipping_address'] = $shippingaddress;
    }

    public function set_address()
    {
        $addr_id =$this->request->post['addr_id'];
        $this->set_shipping_address($addr_id);
    }

}