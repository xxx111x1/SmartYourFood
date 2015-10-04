<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/28
 * Time: 22:11
 */
class ControllerSffoodSearch extends Controller{
    public function index()
    {
        $food_name="";
        $data=array();
        $this->load->model('sffood/food');
        $this->load->model('sfrest/information');
        $data['header'] = $this->load->controller('common/sfheader');
        $data['footer'] = $this->load->controller('common/sffooter');
        $data['backtop'] = $this->load->controller('common/backtop');
        if (isset($this->request->get['search'])) {
            $food_name = $this->request->get['search'];
        }
        $data['query']=$food_name;

        $this->log->write('food name '.$food_name);
        $food_list = $this->model_sffood_food->getFoodByName($food_name);
        $data['foods'] =$food_list;
        $rest_list = $this->model_sfrest_information->getRestaurantsByName($food_name);
        $data['rests'] = $rest_list;
        $food_result_num =count($food_list);
        $data['food_result_num'] = $food_result_num;
        if($food_result_num==0)
        {
            $data['nofood']="style=\"display: none\"";
            $data['hasfood']="";
        }
        else{
            $data['nofood']="";
            $data['hasfood']="style=\"display: none\"";
        }

        $rest_num=count($rest_list);
        $data['rest_num']=$rest_num;
        if($rest_num==0)
        {
            $data['norest']="style=\"display: none\"";
            $data['hasrest']="";
        }
        else{
            $data['hasrest']="style=\"display: none\"";
            $data['norest']="";
        }

        //set search history
        if(isset($this->request->get['lat'])){
            $this->session->data['lat'] = $this->request->get['lat'];
            $this->session->data['lng'] = $this->request->get['lng'];
            $this->session->data['address'] = $this->request->get['address'];
            $data['address'] =$this->request->get['address'];
            if($this->customer->isLogged()){
                $this->load->model('account/customer');
                $this->model_account_customer->editAddress($this->session->data);
            }
        }
        elseif($this->customer->isLogged() || isset($this->session->data['address']))
        {
            $data['address'] =$this->session->data['address'];
            $data['first_name'] = $this->customer->getFirstName();
            $this->load->model('account/address');
            $data['history_address'] = $this->model_account_address->getAddressesHistory();
        }
        else{
            $data['address'] = "请输入送餐地址";
            $data['first_name'] = "";
            $data['history_address'] = "";
        }

        $this->response->setOutput($this->load->view('default/template/sffood/search.2.tpl', $data));
    }
}