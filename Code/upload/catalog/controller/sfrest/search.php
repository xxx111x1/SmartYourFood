<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/28
 * Time: 22:11
 */
class ControllerSfrestSearch extends Controller{
    public function index()
    {
        $food_name="";
        $data=array();
        $this->load->model('sffood/food');
        $this->load->model('sfrest/information');
        $data['header'] = $this->load->controller('common/header');
        if (isset($this->request->get['search'])) {
            $food_name = $this->request->get['search'];
        }
        if(isset($this->session->data['address'])){
            $data['address'] = $this->session->data['address'];
        }
        else{
            $data['address'] = '选择送餐地址';
        }
       // $this->log->write('food name '.$food_name);
        $food_list = $this->model_sffood_food->getFoodByName($food_name);
        foreach($food_list as $key => $value)
        {
            if(isset($this->session->data['lat'])&&isset($this->session->data['lng']))
            {
                $dist = $this->model_account_address->getDistance($this->session->data['lat'],
                    $this->session->data['lng'],
                    $food_list[$key]['lat'],
                    $food_list[$key]['lng']);
                $food_list[$key]['dist'] = $dist;
            }
            $food_list[$key]['is_open'] = $this->openhours->is_open($food_list[$key]['restaurant_id']);
        }

        $data['foods'] =$food_list;
        $rest_list = $this->model_sfrest_information->getRestaurantsByName($food_name);
        foreach ($rest_list as $key => $value){
            if(isset($this->session->data['address'])){
                $rest_list[$key]['distance'] = $this->model_account_address->getDistance($this->session->data['lat'], $this->session->data['lng'], $rest_list[$key]['lat'], $rest_list[$key]['lng']);
            }
            else{
                $rest_list[$key]['distance'] = "未知";
            }
            $rest_list[$key]['is_open'] = $this->openhours->is_open($rest_list[$key]['restaurant_id']);
            // $this->log->write('rest id: '.$rest_list[$key]['restaurant_id'].' is_open '.$rest_list[$key]['is_open']);
        }

        $data['rests'] = $rest_list;
        if(count($food_list)==0)
        {
            $data['nofood']="style=\"display: none\"";
            $data['hasfood']="";
        }
        else{
            $data['nofood']="";
            $data['hasfood']="style=\"display: none\"";
        }

        if(count($rest_list)==0)
        {
            $data['norest']="style=\"display: none\"";
            $data['hasrest']="";
        }
        else{
            $data['hasrest']="style=\"display: none\"";
            $data['norest']="";
        }

/*
        //$data['foods'] = array();
        $this->log->write('food number: '.count($food_list));
        foreach( $food_list as $food)
        {
            $this->log->write('img: '.$food['img_url'].' name:'.$food['name'].' price: '.$food['price']);
            //$this->log->write('img: '.$food['img_url']);
        }
*/
        $this->response->setOutput($this->load->view('default/template/sfrest/search.tpl', $data));
    }
}