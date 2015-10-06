<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/10/5
 * Time: 11:30
 */
class ControllerSfaccountProfile extends Controller{
    public function index()
    {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('sfaccount/account', '', 'SSL');

            $this->response->redirect($this->url->link('sfaccount/login', '', 'SSL'));
        }
        $this->load->model('account/customer');
        $customerID = $this->customer->getId();
        $customerInfor=$this->model_account_customer->getCustomer($customerID);
        return $this->load->view('default/template/sfaccount/profile.tpl', $customerInfor);
    }
}