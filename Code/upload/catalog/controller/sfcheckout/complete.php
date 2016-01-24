<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2016/1/24
 * Time: 12:23
 */

class ControllerSfcheckoutComplete extends Controller{
    private $tax_rate = 0.05;
    private $deliver_fee_rate = 1;
    public function index()
    {
        $data=array();
        // Get price
        $food_list = $this->cart->getFoods();
        $data['food_list']= $food_list;
        $data['beforetax'] = $this->session->data['order_beforetax'];
        unset($this->session->data['order_beforetax']);
        $data['tax'] = $this->session->data['order_tax'];
        unset($this->session->data['order_tax']);
        $data['deliverfee'] = $this->session->data['order_deliverfee'];
        unset($this->session->data['order_deliverfee']);
        $data['fast_deliverfee'] = $this->session->data['order_fastdeliverfee'];
        unset($this->session->data['order_fastdeliverfee']);
        $data['totalcost'] = $this->session->data['total'];
        unset($this->session->data['total']);

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
        $data['order_id']=$this->session->data['order_id'];
        unset($this->session->data['order_id']);
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        $this->cart->clear();

        $this->load->language('sfcheckout/complete');
        $data['Logo'] =                                      $this->language->get('Logo');
        $data['Home'] =                                      $this->language->get('Home');
        $data['Food'] =                                      $this->language->get('Food');
        $data['Order'] =                                     $this->language->get('Order');
        $data['Order_Succeed'] =                        $this->language->get('Order_Succeed');
        $data['Order_More'] =                         $this->language->get('Order_More');
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


        $this->response->setOutput($this->load->view('default/template/sfcheckout/complete.tpl', $data));
    }
}