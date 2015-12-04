<?php
class ControllerCommonCartthumbnail extends Controller {
	public function index() {
		

		// Totals
		$this->load->model('extension/extension');

		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();
		
		//Display prices
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$sort_order = array();
		
			$results = $this->model_extension_extension->getExtensions('total');
		
			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}
		
			array_multisort($sort_order, SORT_ASC, $results);
			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);
					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}
		
			$sort_order = array();
		
			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}
		
			array_multisort($sort_order, SORT_ASC, $total_data);
		}
		


		$this->load->model('tool/image');
		$this->load->model('tool/upload');

		$data['products'] = array();
		$total_price = 0;
		$rest_id=0;
		if(isset($this->session->data['cart_rest_id'])){
			$rest_id= $this->session->data['cart_rest_id'];
		}		
		foreach ($this->cart->getFoods() as $product) {
			if ($product['image']) {
				$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			} else {
				$image = '';
			}
			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				//$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
				$price = $this->currency->format($product['price']);
			} else {
				$price = false;
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
//				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
				$total = $this->currency->format($product['price']* $product['quantity']);
			} else {
				$total = false;
			}			
			$total_price = $total_price + $product['price']* $product['quantity'];
			$data['products'][] = array(
				'key'       => $product['key'],
				'thumb'     => $image,
				'name'      => $product['food_name'],
				'product_id'    => $product['product_id'],
				//'model'     => $product['model'],
				//'option'    => $option_data,
				//'recurring' => ($product['recurring'] ? $product['recurring']['name'] : ''),
				'quantity'  => $product['quantity'],
				'price'     => $price,
				'total'     => $total,
				'href'      => $this->url->link('sfrest/detail', 'restaurant_id=' . $product['rest_id']. '&food_id='.$product['product_id'])
			);
		}

		// Gift Voucher
		$data['vouchers'] = array();

		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $key => $voucher) {
				$data['vouchers'][] = array(
					'key'         => $key,
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'])
				);
			}
		}

		$data['totals'] = array();

		foreach ($total_data as $result) {
			$data['totals'][] = array(
				'title' => $result['title'],
				'text'  => $this->currency->format($result['value']),
			);
		}
		
		$this->load->language('common/backtop');
		$data['Cart'] = $this->language->get('Cart');
		$data['Clear_Cart'] = $this->language->get('Clear_Cart');
		$data['Food'] = $this->language->get('Food');
		$data['Select_Number'] = $this->language->get('Select_Number');
		$data['Price'] = $this->language->get('Price');
		$data['Sum_Food'] = $this->language->get('Sum_Food');
		$data['Pay_Food'] = $this->language->get('Pay_Food');
		$data['Empty_Cart'] = $this->language->get('Empty_Cart');
		
		$data['cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('sfcheckout/checkout', '', 'SSL');
		
		
		//Distance and price
		$sf_deliverfee = 5;
		$lat_lng = $this->cart->getRestAddress();
		if(isset($lat_lng['0'])){
			$this->load->model('account/address');
			$distance = $this->model_account_address->getDistance($this->session->data['lat'],$this->session->data['lng'],explode(',',$lat_lng['0'])['0'],explode(',',$lat_lng['0'])['1']);
			$sf_deliverfee = 4 + max(0,round($distance-4,0,PHP_ROUND_HALF_UP)) + (max(0,round($distance-8,0,PHP_ROUND_HALF_UP)))*0.5;
		}
		else{
			$sf_deliverfee= 0;
		}
		
		//GetTime Canada/Pacific
		date_default_timezone_set('Canada/Pacific');
		if (date('H') >= 22.5 || date('H')<9) {
			$sf_deliverfee += 2;
		}
		$data['total_transffer'] = $sf_deliverfee;
		$data['total_price'] = $total_price;
		$data['total_taxes'] = round($total_price*0.12,2);
		$data['total_fees'] = round($total_price*0.1,2);
		$data['total_sum'] = $data['total_transffer'] +$data['total_price']+$data['total_taxes']+$data['total_fees'];
		$data['rest_id'] = $rest_id;
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/cart_thumbnail.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/cart_thumbnail.tpl', $data);
		} else {
			return $this->load->view('default/template/common/cart_thumbnail.tpl', $data);
		}
	}

	public function info() {
		$this->response->setOutput($this->index());
	}
}