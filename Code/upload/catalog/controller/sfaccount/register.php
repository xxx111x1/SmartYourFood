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
        if ($this->customer->isLogged()) {
            $this->response->redirect($this->url->link('account/account', '', 'SSL'));
        }

        $this->load->model('account/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $customer_data = array();
            $customer_data['password'] = $this->request->post['pwd_1st'];
            $customer_data['telephone'] = $this->request->post['phonenumber'];
            //$customer_data['telephone'] = 1234567;
            $customer_data['firstname'] =  $this->request->post['accountname'];
            $customer_data['lastname'] = 'null';
            $customer_data['lastname'] = 'null';
            $customer_data['address_1'] = 'null';
            $customer_data['address_2'] = 'null';
            $customer_data['email'] = 'null';
            $customer_data['store_id']=1;
            $customer_data['fax']='null';
            $customer_id = $this->model_account_customer->addSFCustomer($customer_data);
            $this->customer->loginbytelephone($customer_data['telephone'], $customer_data['password']);
            $this->response->redirect($this->url->link('common/sfhome'));
        }

        $data=array();
        //$this->response->setOutput($this->load->view('default/template/sfaccount/register.tpl', $data));
        if(isset($this->error['error']))
        {
            $data['error']=$this->error['error'];
        }
        
        $this->load->language('sfaccount/register');
        $data['Register'] =                                  $this->language->get('Register');
        $data['Your_Name'] =                                 $this->language->get('Your_Name');
        $data['Cell_Phone_Number'] =                         $this->language->get('Cell_Phone_Number');
        $data['Enter_a_Password'] =                          $this->language->get('Enter_a_Password');
        $data['Enter_Password_Again'] =                      $this->language->get('Enter_Password_Again');
        $data['Jion_Us'] =                                   $this->language->get('Jion_Us');
        $data['By_clicking_Join_Now'] =                      $this->language->get('By_clicking_Join_Now');
        $data['Already_on_Usays'] =                          $this->language->get('Already_on_Usays');
        $data['Agree_Register'] =                            $this->language->get('Agree_Register');
        
        $this->response->setOutput($this->load->view('default/template/sfaccount/register.tpl', $data));
    }

    public function validate() {

        if ((utf8_strlen(trim($this->request->post['accountname'])) < 1) || (utf8_strlen(trim($this->request->post['accountname'])) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
            $this->error['error'] = '用户名长度不符合要求';
            return false;
        }

        if ((utf8_strlen($this->request->post['phonenumber']) < 3) || (utf8_strlen($this->request->post['phonenumber']) > 32)) {
            $this->error['phonenumber'] = $this->language->get('error_telephone');
            $this->error['error']='电话号码长度不符合要求';
            return false;
        }

        $this->load->model('account/customer');
        $customer = $this->model_account_customer->getCustomerByPhone($this->request->post['phonenumber']);

        if(!empty($customer))
        {
            $this->error['error'] = '电话号码已经存在';
            return false;
        }

        if ((utf8_strlen($this->request->post['pwd_1st']) < 4) || (utf8_strlen($this->request->post['pwd_1st']) > 20)) {
            $this->error['password'] = $this->language->get('error_password');
            $this->error['error'] = '密码长度不符合要求';
            return false;
        }

        if ($this->request->post['pwd_2nd'] != $this->request->post['pwd_2nd']) {
            $this->error['confirm'] = $this->language->get('error_confirm');
            $this->error['error'] ='两次密码输入不一致';
        }
        return !$this->error;
    }
/*
    public function validate() {

        if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }

        if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }

        if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }

        if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
            $this->error['warning'] = $this->language->get('error_exists');
        }

        if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }

        if ((utf8_strlen(trim($this->request->post['address_1'])) < 3) || (utf8_strlen(trim($this->request->post['address_1'])) > 128)) {
            $this->error['address_1'] = $this->language->get('error_address_1');
        }

        if ((utf8_strlen(trim($this->request->post['city'])) < 2) || (utf8_strlen(trim($this->request->post['city'])) > 128)) {
            $this->error['city'] = $this->language->get('error_city');
        }

        $this->load->model('localisation/country');

        $country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

        if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($this->request->post['postcode'])) < 2 || utf8_strlen(trim($this->request->post['postcode'])) > 10)) {
            $this->error['postcode'] = $this->language->get('error_postcode');
        }

        if ($this->request->post['country_id'] == '') {
            $this->error['country'] = $this->language->get('error_country');
        }

        if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
            $this->error['zone'] = $this->language->get('error_zone');
        }

        // Customer Group
        if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
            $customer_group_id = $this->request->post['customer_group_id'];
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        // Custom field validation
        $this->load->model('account/custom_field');

        $custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

        foreach ($custom_fields as $custom_field) {
            if ($custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
                $this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
            }
        }

        if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
            $this->error['password'] = $this->language->get('error_password');
        }

        if ($this->request->post['confirm'] != $this->request->post['password']) {
            $this->error['confirm'] = $this->language->get('error_confirm');
        }

        // Agree to terms
        if ($this->config->get('config_account_id')) {
            $this->load->model('catalog/information');

            $information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

            if ($information_info && !isset($this->request->post['agree'])) {
                $this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
            }
        }

        return !$this->error;
    }*/

    public function customfield() {
        $json = array();

        $this->load->model('account/custom_field');

        // Customer Group
        if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
            $customer_group_id = $this->request->get['customer_group_id'];
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

        foreach ($custom_fields as $custom_field) {
            $json[] = array(
                'custom_field_id' => $custom_field['custom_field_id'],
                'required'        => $custom_field['required']
            );
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}