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
        $tax=0.12*$total_before_tax;
        $tips = 0.1*$total_before_tax;
        $data['beforetax'] = $total_before_tax;
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
        $this->response->setOutput($this->load->view('default/template/sfcheckout/updatecart.html', $data));
    }
}