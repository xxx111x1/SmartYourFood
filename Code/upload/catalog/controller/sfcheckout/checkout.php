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
        $data=array();
        $food_list = $this->cart->getFoods();
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        $food_list = $this->cart->getFoods();
        $data['food_list']= $food_list;
        $total_before_tax = $this->cart->getFoodSubTotal();
        $total_before_tax = round($total_before_tax,2);
        $tax=round(0.12*$total_before_tax,2);
        $tips = round(0.1*$total_before_tax,2);
        $data['beforetax'] =  $total_before_tax;
        $data['tax'] = $tax;
        $data['tips'] = $tips;
        $deliverfee = 5;
        $data['deliverfee'] = $deliverfee;
        $data['totalcost'] = $total_before_tax + $tax + $tips + $deliverfee;
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
        if(isset($this->session->data['address']))
        {
            $data['address'] =$this->session->data['address'];
        }
        else{
            $data['address'] = "选择收货地址";
        }

        $this->load->model('sfcheckout/shippingaddress');
        //check if current page is returned from address pickup page

        if(isset($this->request->get['lat'])
            &&isset($this->request->get['lng'])
            &&isset($this->request->get['address'])
            &&isset($this->request->get['phone'])
            &&isset($this->request->get['contact'])
        )
        {
            $this->log->write('returned url, start to insert new address');
            $address_data=array();
            $address_data['lat']=$this->request->get['lat'];
            $address_data['lng']=$this->request->get['lng'];
            $address_data['address']=$this->request->get['address'];
            $address_data['phone']=$this->request->get['phone'];
            $address_data['contact']=$this->request->get['contact'];
            $this->model_sfcheckout_shippingaddress->addAddress($address_data);
        }
        else{
            $this->log->write('not returned url');
        }

        $addresses = $this->model_sfcheckout_shippingaddress->getAddresses();
        if(count($addresses)>0)
        {
            $addresses[0]['address_id'];
        }
        $data['addresslist']=$addresses;
        $this->response->setOutput($this->load->view('default/template/sfcheckout/updatecart.html', $data));
    }

    public function set_shipping_address($addr_id)
    {
        $this->log->write('set shipping address id: '.$addr_id);
        $this->load->model('sfcheckout/shippingaddress');
        $this->session->data['shipping_address_id'] = $addr_id;
        $addr = $this->model_sfcheckout_shippingaddress->getAddress($addr_id);
        $this->session->data['shipping_address'] = $addr['address'];
        $this->session->data['shipping_contact'] = $addr['contact'];
        $this->session->data['shipping_phone'] = $addr['phone'];
    }

    public function set_address()
    {
        $addr_id =$this->request->post['addr_id'];
        $this->set_shipping_address($addr_id);
    }

}