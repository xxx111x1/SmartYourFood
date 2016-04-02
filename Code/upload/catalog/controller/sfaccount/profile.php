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
        
        $this->load->language('account/account');
        $customerInfor['User_Name'] = $this->language->get('User_Name');
        $customerInfor['Phone_Number'] = $this->language->get('Phone_Number');
        $customerInfor['Email'] = $this->language->get('Email');
        $customerInfor['Enter_Old_Password'] = $this->language->get('Enter_Old_Password');
        $customerInfor['Enter_New_Password'] = $this->language->get('Enter_New_Password');
        $customerInfor['Reenter_New_Password'] = $this->language->get('Reenter_New_Password');
        $customerInfor['Change_Password'] = $this->language->get('Change_Password');
        $customerInfor['Edit'] = $this->language->get('Edit');
        $customerInfor['Edit_Name'] = $this->language->get('Edit_Name');
        $customerInfor['Please_Enter_Name_Here'] = $this->language->get('Please_Enter_Name_Here');
        $customerInfor['Confirm'] = $this->language->get('Confirm');
        $customerInfor['Edit_Phone_Number'] = $this->language->get('Edit_Phone_Number');
        $customerInfor['Enter_New_Phone_Number'] = $this->language->get('Enter_New_Phone_Number');
        $customerInfor['Reenter_New_Phone_Number'] = $this->language->get('Reenter_New_Phone_Number');
        $customerInfor['Edit_Your_Email'] = $this->language->get('Edit_Your_Email');
        $customerInfor['Enter_Your_New_Email'] = $this->language->get('Enter_Your_New_Email');
        $customerInfor['Profile'] = $this->language->get('Profile');
        $customerInfor['New_Password'] = $this->language->get('New_Password');
        $customerInfor['Old_Password'] = $this->language->get('Old_Password');
        $customerInfor['Password_Confirm'] = $this->language->get('Password_Confirm');
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if($this->detector->isMobile($useragent)){
        	return $this->load->view('default/mobile/sfaccount/profile.tpl', $customerInfor);
        }else{
	        return $this->load->view('default/template/sfaccount/profile.tpl', $customerInfor);
        }
    }
}