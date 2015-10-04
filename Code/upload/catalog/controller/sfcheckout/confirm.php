<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/16
 * Time: 16:45
 */
class ControllerSfcheckoutConfirm extends Controller{
    public function index()
    {
        $data=array();
        $food_list = $this->cart->getFoods();
        //start to make order data here
        $order_data = array();
        $order_data['store_id'] = $this->config->get('config_store_id');
        $order_data['store_name'] = $this->config->get('config_name');
        $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
        $order_data['store_url'] = 'smartyourfood';

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
        } elseif (isset($this->session->data['guest'])) {
            $order_data['customer_id'] = 0;
            $order_data['customer_group_id'] = $this->session->data['guest']['customer_group_id'];
            $order_data['firstname'] = $this->session->data['guest']['firstname'];
            $order_data['lastname'] = $this->session->data['guest']['lastname'];
            $order_data['email'] = $this->session->data['guest']['email'];
            $order_data['telephone'] = $this->session->data['guest']['telephone'];
            $order_data['fax'] = $this->session->data['guest']['fax'];
            $order_data['custom_field'] = $this->session->data['guest']['custom_field'];
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
// 					'name'       => $product['name'],
// 					'model'      => $product['model'],
// 					'option'     => $option_data,
// 					'download'   => $product['download'],
                'quantity'   => $product['quantity'],
// 					'subtract'   => $product['subtract'],
                'price'      => $product['price'],
                'total'      => $product['total'],
                'tax'        => $product['price']*0.1,//$this->tax->getTax($product['price'], $product['tax_class_id']),
 					'reward'     => 0,
                'option' =>array()
            );
            $total+=$product['total'];
        }
        $order_data['total'] = $total;
        $this->load->model('checkout/order');
        $this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);

        $this->log->write('food number: '.count($food_list));
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        $data['order_id']=$this->session->data['order_id'];
        $food_list = $this->cart->getFoods();
        $data['food_list']= $food_list;
        $total_before_tax = $this->cart->getFoodSubTotal();
        $total_before_tax = round($total_before_tax,2);
        $tax=round(0.12*$total_before_tax,2);
        $tips = round(0.1*$total_before_tax,2);
        $data['beforetax'] = $total_before_tax;
        $data['tax'] = $tax;
        $data['tips'] = $tips;
        $deliverfee = 5;
        $data['deliverfee'] = $deliverfee;
        $data['totalcost'] = round($total_before_tax + $tax + $tips + $deliverfee,2);
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
        if(isset($this->session->data['shipping_address'])
            &&isset($this->session->data['shipping_address']['address_1'])
            &&isset($this->session->data['shipping_address']['firstname'])
            &&isset($this->session->data['shipping_address']['address_2']))
        {
            $data['address'] =$this->session->data['shipping_address']['address_1'];
            $data['contact'] =$this->session->data['shipping_address']['firstname'];
            $data['phone'] = $this->session->data['shipping_address']['address_2'];
            $data['validaddress']=true;
          //  $data['telephone']=$this->telephone;
        }
        else{
            $data['validaddress'] = false;
        }


        $this->response->setOutput($this->load->view('default/template/sfcheckout/confirm.tpl', $data));
    }
}