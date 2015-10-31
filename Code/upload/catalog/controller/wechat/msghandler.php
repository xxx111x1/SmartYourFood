<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/10/31
 * Time: 14:19
 */
class ControllerWechatMsghandler extends Controller{
    private $operatorid='omiagw6HuwXD95DmvmpY27rs1y1c';
    private $deliveryid='omiagwzBMqBnpGLL5o6qAhUNOZlg';

    public function index()
    {
        if(!isset($_GET['from']) || !isset($_GET['msg']))
        {
            return;
        }
        $from = urldecode($_GET['from']);
        $msg = urldecode($_GET['msg']);
        $this->log->write('debug msger, from '.$from.' msg:'.$msg);
        echo $this->process($from,$msg);
    }

    public function process($from, $msg)
    {
        $msg=trim($msg);
        $parts = explode(' ',$msg);
        $parts = array_filter($msg, 'strlen');
        if(count($parts)!=2)
        {
            return $this->invalid_msg_reply($from,$msg);
        }
        $parts[0] = trim($parts[0]);
        $parts[1] = trim($parts[1]);
        $orderid = $parts[1];
        $op_type = $parts[0];
        //鍚庡彴瀹㈡湇纭涓嬪崟鎴愬姛
        if($this->fromOperator($from))
        {
            $this->log->write('from operator');
            if($op_type=='下单成功')
            {
                $this->log->write('start to send order succeed message');
                return $this->order_succeed($orderid);
            }
        }
        else if($this->fromDeliveryService($from))
        {
            if($op_type=='已配送')
            {
                return $this->start_to_deliver($orderid);
            }
        }
        else{
            //handle message from unknown user.
        }
        return "unprocessed";
    }

    public function fromOperator($openid)
    {
        return $openid==$this->operatorid;
    }

    public function fromDeliveryService($openid)
    {
        return $openid==$this->deliveryid;
    }

    //鍜岀綉绔欏悗鍙版墦浜ら亾锟�? 鍛婅瘔缃戠珯鍚庡彴涓嬪崟鎴愬姛
    public function order_succeed($orderid)
    {
        return $this->msg->recieve_order_succeed($orderid);
    }

    //鎺ユ敹鍒拌窇鑵垮府鐨勭‘璁ら厤閫佹秷锟�?
    public function start_to_deliver($orderid)
    {
        return $this->msg->receive_logistic_confirmmsg($orderid);
    }

    public function invalid_msg_reply($to,$msg)
    {
        $msg = '无效信息'.$msg;
        return $msg;
       // return $this->sendmsg($to,$msg);
    }

    public function sendmsg($openid, $msg)
    {
        $request_str =  'http://128.199.199.160/wechat/message.php?msg='.urlencode($msg).'&openid='.urlencode($openid);
        return file_get_contents($request_str);
    }
}