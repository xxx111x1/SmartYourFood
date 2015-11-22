<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/11/22
 * Time: 14:56
 */
class OpenHours{
    private  $schedule=array();
    private $last_access_time=0;
    public function __construct($registry) {
        //$this->config = $registry->get('config');
        //$this->session = $registry->get('session');
        $this->db = $registry->get('db');
    }

    public function is_opening($datetime, $open_info)
    {
        $day = $open_info['week_day'];
        $start_hour = $open_info['open_hour'];
        $close_hour = $open_info['close_hour'];
        $cur_weekday = $datetime->format('N');
        $cur_hour = $datetime->format('H');
        return $cur_weekday==$day && $cur_hour>=$start_hour && $cur_hour<$close_hour;
    }

    public function opening_info()
    {
        $cur_time = new DateTime();
        $cur_time->setTimezone(new DateTimeZone('America/Vancouver'));
        $timestamp = $cur_time->getTimestamp();
        if($timestamp-$this->last_access_time>60)
        {
            //check the opening info
            $sql = "SELECT DISTINCT rest_id FROM ".DB_PREFIX."rest_opening_times";
            $query = $this->db->query($sql);
            foreach($query->rows as $rest_id)
            {
                $this->schedule[$rest_id]=0;
            }

            $sql = "SELECT * FROM ".DB_PREFIX."rest_opening_times";
            $query = $this->db->query($sql);
            foreach($query->rows as $open_info)
            {
                if($this->is_opening($cur_time,$open_info)==1)
                {
                    $this->schedule[$open_info['rest_id']]=1;
                }
            }
            $this->last_access_time = $timestamp;
        }
        return $this->schedule;
    }

    public function is_open($restid)
    {
        $open_info = $this->opening_info();
        if(array_key_exists($restid,$open_info))
        {
            return $open_info[$restid];
        }
        return 0;
    }
}