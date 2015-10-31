<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/10/30
 * Time: 20:40
 */
class UsaysMessager{
    //只发送订单消息， 不发送订单详情
    private $deliveryid = 'omiagw6HuwXD95DmvmpY27rs1y1c';//zoumin
    //private $operatorid = 'omiagwzBMqBnpGLL5o6qAhUNOZlg';//yinghui
    private $operatorid = 'omiagw6HuwXD95DmvmpY27rs1y1c';//yinghui

    public function __construct($registry) {
        $this->config = $registry->get('config');
        $this->session = $registry->get('session');
        $this->db = $registry->get('db');
        $this->log= $registry->get('log');
    }

    public function sendmsg($openid, $msg)
    {
        $request_str =  'http://128.199.199.160/wechat/message.php?msg='.urlencode($msg).'&openid='.urlencode($openid);
        return file_get_contents($request_str);
    }

    //发送订单提醒
    public function notifydeliveryman($orderid)
    {
        $msg = $this->getShippingInfo($orderid);
        $this->sendmsg($this->deliveryid,$msg);
    }

    public function getOrderDetail($orderid)
    {
        $query_str = "select name,model,quantity,price,total,tax from ".DB_PREFIX."order_product where order_id=".$orderid;
        $this->log->write($query_str);
        $query_res = $this->db->query($query_str);
        $order_detail=' OrderDetail: ';
        foreach($query_res->rows as $query_res)
        {
            $order_detail = $order_detail.'\n FoodName: '.$query_res['name'].' Qty: '.$query_res['quantity'].' SubTotal: '.round($query_res['total'],2).' Tax: '.round($query_res['tax'],2);
        }
        $query_str = "select deliverfee,total, extra_cost from ".DB_PREFIX."order where order_id=".$orderid;
        $query_res = $this->db->query($query_str);
        $order_detail = $order_detail.'  DeliverFee: '.round($query_res->row['deliverfee'],2).'  FastDeliverFee: '.round($query_res->row['extra_cost'],2).'   Total Cost: '.round($query_res->row['total'],2);
        return $order_detail;
    }

    public function getShippingInfo($orderid)
    {
        $query_res = $this->db->query("SELECT order_id,
		                        store_name,
		                        store_address,
		                        store_telephone,
		                        shipping_firstname,
		                        shipping_address_1,
		                        shipping_address_2,
		                        telephone,
		                        date_modified from ".DB_PREFIX."order where order_id=".$orderid);
        $order_detail = $query_res->row;
       /* $msg = '订单编号: '.$order_detail['order_id'].
            '发货地址: '.$order_detail['store_address'].
            '发货餐馆: '.$order_detail['store_name'].
            '餐馆联系电话: '.$order_detail['store_telephone'].
            '收货地址: '.$order_detail['shipping_address_1'].' '.$order_detail['shipping_address_2'].
            '收货联系人: '.$order_detail['shipping_firstname'].
            '收货联系电话: '.$order_detail['telephone'].
            ' 订单时间: '.$order_detail['date_modified'];*/
        $msg = 'OrderID: '.$order_detail['order_id'].
            'RestAddr: '.$order_detail['store_address'].
            'RestName: '.$order_detail['store_name'].
            'RestPhone: '.$order_detail['store_telephone'].
            'CustomerAddr: '.$order_detail['shipping_address_1'].' '.$order_detail['shipping_address_2'].
            'CustomerName: '.$order_detail['shipping_firstname'].
            'Contact: '.$order_detail['telephone'].
            ' OrderTime: '.$order_detail['date_modified'];
        return $msg;
    }
    //发送订单详情
    public function sendDeliverymanDetail($orderid)
    {
        $msg = $this->getShippingInfo($orderid);
        $detail = $this->getOrderDetail($orderid);
        $this->log->write($detail);
        return $this->sendmsg($this->operatorid,$msg.'\n'.$detail);
    }


    //确认配送人员收到消息，司机已经出发
    public function receive_logistic_confirmmsg($orderid)
    {
        //update
    }



//发送给客服的消息， 订单详情
    public function sendOperatorDetail($orderid)
    {
        $msg = $this->getShippingInfo($orderid);
        $detail = $this->getOrderDetail($orderid);
        return $this->sendmsg($this->deliveryid,$msg.'\n'.$detail);
    }
//接收客服部分的消息
    //接收来自客服的下单成功消息

    public function recieve_order_succeed($orderid)
    {
        $post_url='';
        //1. first update database

        //2.send detail information to deliver man
        $this->sendDeliverymanDetail($orderid);
    }


    //取消订单
    public function recieve_order_cancelletion($orderid)
    {

    }

    //订单需要修改
    public function  recieve_order_update($orderid)
    {

    }



}