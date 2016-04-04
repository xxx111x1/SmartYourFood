<?php
class Customer {
	protected $customer_id;
    protected $firstname;
    protected $lastname;
    protected $customer_group_id;
    protected $email;
    protected $telephone;
    protected $fax;
    protected $newsletter;
    protected $address_id;
    protected $cart;
    protected $wishlist;
    protected $guest_mode;
    protected $cookie;
    protected $shipping_address;
	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');
		$this->guest_mode = false; // guest mode by default.

		if (isset($this->session->data['customer_id'])) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND status = '1'");

			if ($customer_query->num_rows) {
				$this->customer_id = $customer_query->row['customer_id'];
				$this->firstname = $customer_query->row['firstname'];
				$this->lastname = $customer_query->row['lastname'];
				$this->customer_group_id = $customer_query->row['customer_group_id'];
				$this->email = $customer_query->row['email'];
				$this->telephone = $customer_query->row['telephone'];
				$this->fax = $customer_query->row['fax'];
				$this->newsletter = $customer_query->row['newsletter'];
				$this->address_id = $customer_query->row['address_id'];
				$this->cart = unserialize($customer_query->row['cart']);
				$this->wishlist = unserialize($customer_query->row['cart']);
				$this->guest_mode = false;
                //$this->address = $customer_query->row['address'];
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

				if (!$query->num_rows) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "customer_ip SET customer_id = '" . (int)$this->session->data['customer_id'] . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', date_added = NOW()");
				}
			} else {
				$this->logout();
			}
		}
	}

	public function is_guest(){
		return $this->guest_mode;
	}

	public function login($email, $password, $override = false) {
		if ($override) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
		} else {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
		}
		if ($customer_query->num_rows) {
			$this->session->data['customer_id'] = $customer_query->row['customer_id'];

			$this->customer_id = $customer_query->row['customer_id'];
			$this->firstname = $customer_query->row['firstname'];
			$this->lastname = $customer_query->row['lastname'];
			$this->customer_group_id = $customer_query->row['customer_group_id'];
			$this->email = $customer_query->row['email'];
			$this->telephone = $customer_query->row['telephone'];
			$this->fax = $customer_query->row['fax'];
			$this->newsletter = $customer_query->row['newsletter'];
			$this->address_id = $customer_query->row['address_id'];
			$this->cart = unserialize($customer_query->row['cart']);
			$this->wishlist = unserialize($customer_query->row['wishlist']);			
			$this->session->data['lat'] = $customer_query->row['lat'];
        	$this->session->data['lng'] = $customer_query->row['lng'];
        	$this->session->data['address'] = $customer_query->row['address'];
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
			$this->guest_mode = false;
			return true;
		} else {
			$this->guest_mode = true;
			return false;
		}
	}

    public function loginbytelephone($phonenumber, $password, $override = false) {
        if ($override) {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(telephone) = '" . $this->db->escape(utf8_strtolower($phonenumber)) . "' AND status = '1'");
        } else {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(telephone) = '" . $this->db->escape(utf8_strtolower($phonenumber)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
        }

        if ($customer_query->num_rows) {
            $this->session->data['customer_id'] = $customer_query->row['customer_id'];

            $this->customer_id = $customer_query->row['customer_id'];
            $this->firstname = $customer_query->row['firstname'];
            $this->lastname = $customer_query->row['lastname'];
            $this->customer_group_id = $customer_query->row['customer_group_id'];
            $this->email = $customer_query->row['email'];
            $this->telephone = $customer_query->row['telephone'];
            $this->fax = $customer_query->row['fax'];
            $this->newsletter = $customer_query->row['newsletter'];
            $this->address_id = $customer_query->row['address_id'];
            $this->cart = unserialize($customer_query->row['cart']);
            $this->wishlist = unserialize($customer_query->row['wishlist']);
            $this->session->data['lat'] = $customer_query->row['lat'];
            $this->session->data['lng'] = $customer_query->row['lng'];
            $this->session->data['address'] = $customer_query->row['address'];
            $this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
			$this->guest_mode = false;
            return true;
        } else {
			$this->guest_mode = true;
            return false;
        }
    }

	public function logout() {
		unset($this->session->data['customer_id']);

		$this->customer_id = '';
		$this->firstname = '';
		$this->lastname = '';
		$this->customer_group_id = '';
		$this->email = '';
		$this->telephone = '';
		$this->fax = '';
		$this->newsletter = '';
		$this->address_id = '';
		$this->cart = array();
		$this->wishlist = array();
		$this->guest_mode = true;
	}

	public function isLogged() {
		return $this->customer_id;
	}

	public function getId() {
        return $this->customer_id;
	}

	public function getFirstName() {
        return $this->firstname;
	}

	public function getLastName() {
		return $this->lastname;
	}

	public function getGroupId() {
		return $this->customer_group_id;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getTelephone() {
		return $this->telephone;
	}

	public function getFax() {
		return $this->fax;
	}

	public function getNewsletter() {
		return $this->newsletter;
	}

	public function getAddressId() {
		return $this->address_id;
	}

    public function setShippingAddress($addr){
        $this->shipping_address = array();
        $this->shipping_address['address_id'] = $addr['address_id'];
        $this->shipping_address['contact'] = $addr['contact'];
        $this->shipping_address['phone'] = $addr['phone'];
    }

    public function getShippingAddress(){
        return $this->shipping_address;
    }
	public function getCart() {
        return $this->cart;	
	}
	
	public function getWishlist() {
		return $this->wishlist;
	}	
	
	public function getBalance() {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$this->customer_id . "'");

		return $query->row['total'];
	}

	public function getRewardPoints() {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$this->customer_id . "'");

		return $query->row['total'];
	}
}