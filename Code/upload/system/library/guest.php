<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2016/1/17
 * Time: 12:44
 */
class Guest extends Customer{
    public function __construct($registry) {
        $this->config = $registry->get('config');
        $this->db = $registry->get('db');
        $this->request = $registry->get('request');
        $this->session = $registry->get('session');
        $this->guest_mode = true; // guest mode by default.

        if(isset($_COOKIE['_GUEST_FIRST_NAME']))
        {
            $this->firstname = $_COOKIE['_GUEST_FIRST_NAME'];
        }

        if(isset($_COOKIE['_GUEST_LAST_NAME']))
        {
            $this->lastname = $_COOKIE['_GUEST_LAST_NAME'];
        }
        if(isset($_COOKIE['_GUEST_EMAIL']))
        {
            $this->email = $_COOKIE['_GUEST_EMAIL'];
        }
        if(isset($_COOKIE['_GUEST_TELEPHONE']))
        {
            $this->telephone = $_COOKIE['_GUEST_TELEPHONE'];
        }

        if(isset($_COOKIE['_GUEST_GUEST_ID']))
        {
            $this->customer_id = $_COOKIE['_GUEST_GUEST_ID'];
        }
        else{
            $this->customer_id = -1*rand(100000,2000000);
        }
    }

    public function isLogged()
    {
        return $this->customer_id>=0;
    }

    public function getAddresses() {
        $address_data = array();
        if(isset($_COOKIE['_GUEST_ADDRESS'])
        && isset($_COOKIE['_GUSET_ADDR_CONTACT'])
        && isset($_COOKIE['_GUEST_ADDR_LAT'])
        && isset($_COOKIE['_GUEST_ADDR_LNG'])
        && isset($_COOKIE['_GUEST_ADDR_ADDR'])
        && isset($_COOKIE['_GUEST_ADDR_PHONE']))
        {
            $address_data[1] = array(
                'address_id'     => -1,
                'contact'      => $_COOKIE['_GUSET_ADDR_CONTACT'],
                'lat'       => $_COOKIE['_GUEST_ADDR_LAT'],
                'lng'        => $_COOKIE['_GUEST_ADDR_LNG'],
                'address'      => $_COOKIE['_GUEST_ADDR_ADDR'],
                'phone'      => $_COOKIE['_GUEST_ADDR_PHONE'],

            );
        }

        return $address_data;
    }
}