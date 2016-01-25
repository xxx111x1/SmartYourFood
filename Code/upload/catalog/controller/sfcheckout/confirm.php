<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/16
 * Time: 16:45
 */
class ControllerSfcheckoutConfirm extends Controller{
    private $tax_rate = 0.05;
    private $deliver_fee_rate = 1;
    public function index()
    {
        $data=array();
        if($this->cart->getRestNumber()>1){
    		$this->response->redirect($this->url->link('sfcheckout/checkout'));
        }
        $food_list = $this->cart->getFoods();
        //start to make order data here
        $order_data = array();
        $order_data['store_id'] = $this->config->get('config_store_id');
        $order_data['store_name'] = $this->config->get('config_name');
        $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
        $order_data['store_url'] = 'smartyourfood';
        
        // Get price
        $food_list = $this->cart->getFoods();
        $data['food_list']= $food_list;
        $total_before_tax = $this->cart->getFoodSubTotal();
        $total_before_tax = round($total_before_tax,2);
        $tax=round($this->tax_rate*$total_before_tax,2);
        $data['beforetax'] = $total_before_tax;
        $this->session->data['order_beforetax'] = $total_before_tax;
        $data['tax'] = $tax;
        $this->session->data['order_tax'] = $tax;

        //Distance and price
        $deliverfee = 5;
        $rest_addr = '';
        $rest_id=-1;
        $rest_phone = '';
        $rest_name='';
        foreach($food_list as $food)
        {
            $rest_addr = $food['rest_address'];
            $rest_id = $food['rest_id'];
            $rest_name = $food['rest_name'];
            $rest_phone = $food['phone'];
        }
        $order_data['store_id'] = $rest_id;
        $order_data['store_name'] = $rest_name;
        $order_data['store_telephone'] = $rest_phone;
        $order_data['store_address'] = $rest_addr;
        $lat_lng = $this->cart->getRestAddress();
        if(isset($lat_lng['0'])){
        	$this->load->model('account/address');
        	$distance = $this->model_account_address->getDistance($this->session->data['lat'],$this->session->data['lng'],explode(',',$lat_lng['0'])['0'],explode(',',$lat_lng['0'])['1']);        	
        	$deliverfee = 4 + max(0,round($distance-4,0,PHP_ROUND_HALF_UP)) + (max(0,round($distance-8,0,PHP_ROUND_HALF_UP)))*0.5;
        }
        
        //GetTime Canada/Pacific
        date_default_timezone_set('Canada/Pacific');
        if (date('H') >= 22.5 || date('H')<9) {
        	$deliverfee += 2;
        }
        
        if(isset($this->request->get['isFast'])){
        	$fast_deliverfee = round($total_before_tax*0.05,2);
        }
        else{
        	$fast_deliverfee = 0;
        }
        $deliverfee = $this->deliver_fee_rate*$deliverfee;
        $data['deliverfee'] = $deliverfee;
        $data['fast_deliverfee'] = $fast_deliverfee;
        $data['totalcost'] = round($total_before_tax + $tax + $deliverfee + $fast_deliverfee,2);
        $this->session->data['order_deliverfee'] = $deliverfee;
        $this->session->data['order_fastdeliverfee'] = $fast_deliverfee;
        $this->session->data['order_totalcost'] = $data['totalcost'];
        $order_data['deliverfee'] = $deliverfee;
        $order_data['extra_cost'] = $fast_deliverfee;

        if(count($food_list)==0)
        {
        	$data['nofood']="display: none";
        	$data['hasfood']="";
        }
        else{
        	$data['nofood']="";
        	$data['hasfood']="display: none";
        }

        // Create Order
        if ($this->customer->isLogged()) {
            $this->load->model('account/customer');

            $customer_info = $this->model_account_customer->getCustomer($this->customer->getId());

            $order_data['customer_id'] = $this->customer->getId();
            $order_data['customer_group_id'] = $customer_info['customer_group_id'];
            $order_data['firstname'] = $customer_info['firstname'];
            $order_data['lastname'] = $customer_info['lastname'];
            $order_data['email'] = $customer_info['email'];
            $order_data['telephone'] = $customer_info['telephone'];
            $order_data['fax'] = $customer_info['fax'];
            $order_data['custom_field'] = unserialize($customer_info['custom_field']);
        } else{
            //get customer infor from guest data
            $shippingAddress = $this->customer->getShippingAddress();
            $order_data['customer_id'] = $this->customer->getId();
            $order_data['customer_group_id'] = $this->customer->getGroupId();
            $order_data['firstname'] = $shippingAddress['contact'];
            $order_data['lastname'] = '';
            $order_data['email'] = '';
            $order_data['telephone'] = $shippingAddress['phone'];
            $order_data['fax'] = '';
            $order_data['custom_field'] = '';
        }
        if(isset($this->session->data['payment_address']['firstname']))
            $order_data['payment_firstname'] = $this->session->data['payment_address']['firstname'];
        else
            $order_data['payment_firstname'] = '';

        if(isset($this->session->data['payment_address']['lastname']))
            $order_data['payment_lastname'] = $this->session->data['payment_address']['lastname'];
        else
            $order_data['payment_lastname'] = '';

        if(isset($this->session->data['payment_address']['company']))
        $order_data['payment_company'] = $this->session->data['payment_address']['company'];
        else
            $order_data['payment_company'] = '';

        if(isset($this->session->data['payment_address']['address_1']))
        $order_data['payment_address_1'] = $this->session->data['payment_address']['address_1'];
        else
            $order_data['payment_address_1'] = '';

        if(isset($this->session->data['payment_address']['address_2']))
        $order_data['payment_address_2'] = $this->session->data['payment_address']['address_2'];
        else
            $order_data['payment_address_2'] = '';


        if(isset($this->session->data['payment_address']['city']))
        $order_data['payment_city'] = $this->session->data['payment_address']['city'];
        else
            $order_data['payment_city'] = '';


        if(isset($this->session->data['payment_address']['postcode']))
        $order_data['payment_postcode'] = $this->session->data['payment_address']['postcode'];
        else
            $order_data['payment_postcode'] = '';


        if(isset($this->session->data['payment_address']['zone']))
        $order_data['payment_zone'] = $this->session->data['payment_address']['zone'];
        else
            $order_data['payment_zone'] = '';

        if(isset($this->session->data['payment_address']['zone_id']))
        $order_data['payment_zone_id'] = $this->session->data['payment_address']['zone_id'];
        else
            $order_data['payment_zone_id'] = '';

        if(isset($this->session->data['payment_address']['country']))
        $order_data['payment_country'] = $this->session->data['payment_address']['country'];
        else
            $order_data['payment_country'] = '';

        if(isset($this->session->data['payment_address']['country_id']))
        $order_data['payment_country_id'] = $this->session->data['payment_address']['country_id'];
        else
            $order_data['payment_country_id'] = '';

        if(isset($this->session->data['payment_address']['address_format']))
        $order_data['payment_address_format'] = $this->session->data['payment_address']['address_format'];
        else
            $order_data['payment_address_format'] = '';

        $order_data['payment_custom_field'] = (isset($this->session->data['payment_address']['custom_field']) ? $this->session->data['payment_address']['custom_field'] : array());

        if (isset($this->session->data['payment_method']['title'])) {
            $order_data['payment_method'] = $this->session->data['payment_method']['title'];
        } else {
            $order_data['payment_method'] = '';
        }



        if (isset($this->session->data['payment_method']['code'])) {
            $order_data['payment_code'] = $this->session->data['payment_method']['code'];
        } else {
            $order_data['payment_code'] = '';
        }


        if ($this->cart->hasShipping()) {
            $order_data['shipping_firstname'] = $this->session->data['shipping_address']['firstname'];
            $order_data['shipping_lastname'] = '';//$this->session->data['shipping_address']['lastname'];
            $order_data['shipping_company'] = 'u-says.com';//$this->session->data['shipping_address']['company'];
            $order_data['shipping_address_1'] = $this->session->data['shipping_address']['address_1'];
            $order_data['shipping_address_2'] = $this->session->data['shipping_address']['address_2'];
            $order_data['shipping_city'] = 'Vancouvor';//$this->session->data['shipping_address']['city'];
            $order_data['shipping_postcode'] = '';//$this->session->data['shipping_address']['postcode'];
            $order_data['shipping_zone'] = '';//$this->session->data['shipping_address']['zone'];
            $order_data['shipping_zone_id'] = '';//$this->session->data['shipping_address']['zone_id'];
            $order_data['shipping_country'] = 'CA';//$this->session->data['shipping_address']['country'];
            $order_data['shipping_country_id'] = 'CA';//$this->session->data['shipping_address']['country_id'];
            $order_data['shipping_address_format'] = '';//$this->session->data['shipping_address']['address_format'];
            $order_data['shipping_custom_field'] = (isset($this->session->data['shipping_address']['custom_field']) ? $this->session->data['shipping_address']['custom_field'] : array());

            if (isset($this->session->data['shipping_method']['title'])) {
                $order_data['shipping_method'] = $this->session->data['shipping_method']['title'];
            } else {
                $order_data['shipping_method'] = '';
            }

            if (isset($this->session->data['shipping_method']['code'])) {
                $order_data['shipping_code'] = $this->session->data['shipping_method']['code'];
            } else {
                $order_data['shipping_code'] = '';
            }
        } else {
            $order_data['shipping_firstname'] = '';
            $order_data['shipping_lastname'] = '';
            $order_data['shipping_company'] = '';
            $order_data['shipping_address_1'] = '';
            $order_data['shipping_address_2'] = '';
            $order_data['shipping_city'] = '';
            $order_data['shipping_postcode'] = '';
            $order_data['shipping_zone'] = '';
            $order_data['shipping_zone_id'] = '';
            $order_data['shipping_country'] = '';
            $order_data['shipping_country_id'] = '';
            $order_data['shipping_address_format'] = '';
            $order_data['shipping_custom_field'] = array();
            $order_data['shipping_method'] = '';
            $order_data['shipping_code'] = '';
        }
        if(isset($this->session->data['comment']))
        {
            $order_data['comment'] = $this->session->data['comment'];
        }
        else{
            $order_data['comment']='';
        }

        if (isset($this->request->cookie['tracking'])) {
            $order_data['tracking'] = $this->request->cookie['tracking'];

            $subtotal = $this->cart->getSubTotal();

            // Affiliate
            $this->load->model('affiliate/affiliate');

            $affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);

            if ($affiliate_info) {
                $order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
                $order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
            } else {
                $order_data['affiliate_id'] = 0;
                $order_data['commission'] = 0;
            }

            // Marketing
            $this->load->model('checkout/marketing');

            $marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

            if ($marketing_info) {
                $order_data['marketing_id'] = $marketing_info['marketing_id'];
            } else {
                $order_data['marketing_id'] = 0;
            }
        } else {
            $order_data['affiliate_id'] = 0;
            $order_data['commission'] = 0;
            $order_data['marketing_id'] = 0;
            $order_data['tracking'] = '';
        }

        $order_data['language_id'] = $this->config->get('config_language_id');
        $order_data['currency_id'] = $this->currency->getId();
        $order_data['currency_code'] = $this->currency->getCode();
        $order_data['currency_value'] = $this->currency->getValue($this->currency->getCode());
        $order_data['ip'] = $this->request->server['REMOTE_ADDR'];
        
        

        if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
            $order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
            $order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
        } else {
            $order_data['forwarded_ip'] = '';
        }

        if (isset($this->request->server['HTTP_USER_AGENT'])) {
            $order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
        } else {
            $order_data['user_agent'] = '';
        }

        if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
            $order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
        } else {
            $order_data['accept_language'] = '';
        }

        $order_data['products'] = array();
        $total=0;
        foreach ($this->cart->getFoods() as $product) {
// 				$option_data = array();

// 				foreach ($product['option'] as $option) {
// 					$option_data[] = array(
// 						'product_option_id'       => $option['product_option_id'],
// 						'product_option_value_id' => $option['product_option_value_id'],
// 						'option_id'               => $option['option_id'],
// 						'option_value_id'         => $option['option_value_id'],
// 						'name'                    => $option['name'],
// 						'value'                   => $option['value'],
// 						'type'                    => $option['type']
// 					);
// 				}

            $order_data['products'][] = array(
                'product_id' => $product['product_id'],
                'name'=>$product['food_name'],
                'model'=>$product['rest_name'],
                'rest_address'=>$product['rest_address'],
                'rest_phone'=>$product['phone'],
// 					'name'       => $product['name'],
// 					'model'      => $product['model'],
// 					'option'     => $option_data,
// 					'download'   => $product['download'],
                'quantity'   => $product['quantity'],
// 					'subtract'   => $product['subtract'],
                'price'      => $product['price'],
                'total'      => $product['total'],
                'tax'        => $product['total']*$this->tax_rate,//$this->tax->getTax($product['price'], $product['tax_class_id']),
 					'reward'     => 0,
                'option' =>array()
            );
            $total+=$product['total'];
        }
        $order_data['total'] = $data['totalcost'];
        $this->session->data['total'] = $data['totalcost'];
        $this->load->model('checkout/order');
        $this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);
        $data['order_id']=$this->session->data['order_id'];
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        
        $this->load->language('sfcheckout/confirm');
        $data['Logo'] =                                      $this->language->get('Logo');
        $data['Home'] =                                      $this->language->get('Home');
        $data['Food'] =                                      $this->language->get('Food');
        $data['Order'] =                                     $this->language->get('Order');
        $data['Confirm_Your_Order'] =                        $this->language->get('Confirm_Your_Order');
        $data['Back_to_your_cart'] =                         $this->language->get('Back_to_your_cart');
        $data['Order_Number'] =                              $this->language->get('Order_Number');
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
        $data['Confirm'] =                                   $this->language->get('Confirm');
        $data['Print'] =                                     $this->language->get('Print');
        $data['Delivery_Information_Not_Complete'] =                                     $this->language->get('Delivery_Information_Not_Complete');
        $data['Yes'] =                                     $this->language->get('Yes');
        $data['No'] =                                     $this->language->get('No');

        if(isset($this->session->data['shipping_address_addr'])
            &&isset($this->session->data['shipping_address_contact'])
            &&isset($this->session->data['shipping_address_phone'])
            )
        {
            $data['address'] = $this->session->data['shipping_address_addr'];
            $data['contact'] = $this->session->data['shipping_address_contact'];
            $data['phone'] =  $this->session->data['shipping_address_phone'];
            $data['validaddress']=true;
        }
        else{
            $data['validaddress'] = false;
        }


        $this->response->setOutput($this->load->view('default/template/sfcheckout/confirm.tpl', $data));
    }
}