<?php
class ControllerSfcheckoutSuccess extends Controller {
	public function index() {
		$this->load->language('sfcheckout/success');
		$this->load->model('checkout/order');
		$order_id = $this->session->data['order_id'];
		// update state, 2 is processing.
		$this->model_checkout_order->updateOrderStatus($order_id, 2);
		
		if (isset($this->session->data['order_id'])) {
			$order_id = $this->session->data['order_id'];
			$this->log->write('start to notify admin, order id: '.$order_id);
			//$this->model_checkout_order->notifyAdmin($order_id);
			$this->msg->notifydeliveryman($order_id);
			$this->msg->sendOperatorDetail($order_id);
			$this->log->write('end of notifying admin');

			$this->cart->clear();

			// Add to activity log
			$this->load->model('account/activity');

			if ($this->customer->isLogged()) {
				$activity_data = array(
					'customer_id' => $this->customer->getId(),
					'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
					'order_id'    => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_account', $activity_data);
			} else {
				$activity_data = array(
					'name'     => $this->session->data['guest']['firstname'] . ' ' . $this->session->data['guest']['lastname'],
					'order_id' => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_guest', $activity_data);
			}

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
			unset($this->session->data['totals']);
			
			
		}
		$this->response->redirect($this->url->link('account/account','success=1'));
	}
	
	public function getOrderString($order_id){
		$order = $this->model_checkout_order->getOrder($order_id);
		$foods = $this->model_checkout_order->getOrderProducts($order_id);
		$content = "订单号：  " .$order_id.  " 总金额（不含小费）：　" . $order['total'] . " 送餐地址： " . $order['shipping_address_1']. " 联系人： ". $order['firstname'] . " 联系电话：" . $order['shipping_address_2'] . "\n" ;
		foreach ($foods as $key => $v) {
			$content .= "餐馆： " . $foods[$key]['model'] . " 菜品： " . $foods[$key]['name'] . " 数量： " . $foods[$key]['quantity'] . " 单份价格：" . $foods[$key]['price'] .  " 菜品总价： " . $foods[$key]['total'] . "\n";
		
		}
		$content .= "-------------------------------------------------------------------------------------------------------";
		return $content;
	}
}