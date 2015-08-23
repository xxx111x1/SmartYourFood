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

        $this->log->write('food number: '.count($food_list));
        $data['food_list']=$this->cart->getFoods();
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
}