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

        foreach ($food_list as $food) {
            $data['food_list'] = array(
                'img_url' => $food['image'],
                'name' => $food['name'],
                'price' => $food['price'],
                'rest_address'=>$food['rest_address'],
                'phone' => $food['phone'],
                'qty' => 2
            );
        }
        $this->response->setOutput($this->load->view('default/template/sfcheckout/cart.tpl', $data));
    }
}