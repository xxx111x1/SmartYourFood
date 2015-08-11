<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/2
 * Time: 16:01
 */
//http://localhost/?route=shop/list/
class ControllerSfrestList extends Controller{
    public function index(){
        $this->load->model('sfrest/list');
        //$this->load->model('common/header');
        //$data = $this->model_shop_list->getInfo();
        //echo "ControllerShopList";
        $data = array();
        $data['category'] = $this->load->controller('shop/category');
        $data['header'] = $this->load->controller('common/header');
        if($this->customer->isLogged())
        {
            $addressID = $this->customer->getAddressId();
            $this->load->model('account/address');
            $address = $this->model_account_address->getAddress($addressID);
            $data['address'] = $address['city'].",".$address['address_1'];
        }
        else{
            $data['address'] = "添加送餐地址";
        }
        //$data['product_overview'] = $this->load->controller('product/overview');
        $this->response->setOutput($this->load->view('default/template/sfrest/list.tpl', $data));
        //$this->response->setOutput($data['category']);
    }
}