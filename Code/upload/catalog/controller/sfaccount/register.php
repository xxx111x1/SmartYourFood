<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/16
 * Time: 17:25
 */
class ControllerSfaccountRegister extends Controller{
    public function index()
    {
        $data=array();
        $this->response->setOutput($this->load->view('default/template/sfaccount/register.tpl', $data));
    }
}