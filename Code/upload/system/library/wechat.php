<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/10/25
 * Time: 15:35
 */
class Wechat{
    //Í¨ÖªÅÜÍÈ°ï
    private $carrior_openid = 'omiagw6HuwXD95DmvmpY27rs1y1c';
    private $addmin_openid = 'omiagwzBMqBnpGLL5o6qAhUNOZlg';
    private $tech_openid = '';
    private $ACC_TOKEN='';
    public function __construct($registry)
    {
        $this->db = $registry->get('db');
        $this->log = $registry->get('log');
    }

    public function notifycarrior($msg)
    {
        $this->refresh_access_token();
        $this->sendmsg($this->carrior_openid,$msg);
        $this->sendmsg($this->addmin_openid,$msg);
        //return $this->sendmsg($this->carrior_openid,$msg);
        return 'ok';
    }

    public function refresh_access_token()
    {
        $APPID="wx47180ba69fa68387";
        $APPSECRET="978a3e249a1980827fed107003227cdd";
        $TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;
        //$json=file_get_contents($TOKEN_URL);
        $json=$this->http_get($TOKEN_URL);
        $result=json_decode($json);
        $this->ACC_TOKEN=$result->access_token;
    }

    public function sendmsg($touser,$content){
        $data = '{
            "touser":"'.$touser.'",
            "msgtype":"text",
            "text":
            {
                 "content":"'.$content.'"
            }
        }';

        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->ACC_TOKEN;

        $result = $this->https_post($url,$data);

        $final = json_decode($result);
        return $final;
    }

    function http_get($url)
    {
        $this->log->write('start to get access token '.$url);
        $ch = curl_init();
        $timeout = 10; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

        //curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36');
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $html = curl_exec($ch);

        curl_close($ch);

        $this->log->write($html);
        $this->log->write('response length: '.count($html));
        $this->log->write('finish get access token');
        return $html;
    }

    function https_post($url,$data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            return 'Errno'.curl_error($curl);
        }
        curl_close($curl);
        return $result;
    }
}