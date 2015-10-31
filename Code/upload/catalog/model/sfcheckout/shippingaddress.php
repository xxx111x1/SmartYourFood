<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/10/3
 * Time: 10:44
 */
class ModelSfcheckoutShippingaddress extends Model
{
    public function addAddress($data) {
        $this->event->trigger('pre.shipping_address.add.address', $data);
        //test if address already existed.
        $query_str = "select address_id from " . DB_PREFIX . "shipping_address where customer_id = '" .
            (int)$this->customer->getId() . "' and
            contact = '" . $this->db->escape($data['contact']) . "' and
            address = '" . $this->db->escape($data['address']) . "' and
            phone = '" . $this->db->escape($data['phone'])."'";
        $this->log->write($query_str);
        $address_res = $this->db->query($query_str);
        $row_num = count($address_res->rows);
        $this->log->write('row num: '.$row_num);
        if(count($address_res->rows)>0)
        {
            //already exist, exit;
            $address_id = $address_res->rows[0]['address_id'];
            $query_str="update ". DB_PREFIX . "shipping_address set date_updated=NOW() where address_id=".$address_id;
            $this->log->write($query_str);
            $this->db->query($query_str);
            $this->event->trigger('post.shipping_address.add.address', $address_id);
            return $address_id;
        }
        $query_str = "INSERT INTO " . DB_PREFIX . "shipping_address SET customer_id = '" .
            (int)$this->customer->getId() . "',
            contact = '" . $this->db->escape($data['contact']) . "',
            lat = '" . $this->db->escape($data['lat']) . "',
            lng = '" . $this->db->escape($data['lng']) . "',
            address = '" . $this->db->escape($data['address']) . "',
            phone = '" . $this->db->escape($data['phone']) . "',date_updated=NOW()";
        $this->log->write($query_str);
        $this->db->query($query_str);

        $address_id = $this->db->getLastId();
        $this->event->trigger('post.shipping_address.add.address', $address_id);
        return $address_id;
    }
/*
    public function addAddressHistory($data) {
        $this->event->trigger('pre.customer.add.addressHistory', $data);
        $this->db->query("INSERT INTO " . DB_PREFIX . "address_search_history SET customer_id = '" . (int)$this->customer->getId() . "', lat = '" . $this->db->escape($data['lat']) . "', lng = '" . $this->db->escape($data['lng']) . "', address = '" . $this->db->escape($data['address']) . "', date_added = NOW()");
        $this->event->trigger('post.customer.add.addressHistory', $data);
    }
*/

    public function editAddress($address_id, $data) {
        $this->event->trigger('pre.shipping_address.edit.address', $data);

        $this->db->query("UPDATE " . DB_PREFIX . "shipping_address SET customer_id = '" .
            (int)$this->customer->getId() . "',
            contact = '" . $this->db->escape($data['contact']) . "',
            lat = '" . $this->db->escape($data['lat']) . "',
            lng = '" . $this->db->escape($data['lng']) . "',
            address = '" . $this->db->escape($data['address']) . "',
            phone = '" . $this->db->escape($data['phone']) . "',
            date_updated=now()
        	where address_id = '" . $address_id . "'");

        $this->event->trigger('post.shipping_address.edit.address', $address_id);
    }

    public function deleteAddress($address_id) {
        $this->event->trigger('pre.shipping_address.delete.address', $address_id);

        $this->db->query("DELETE FROM " . DB_PREFIX . "shipping_address WHERE address_id = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");

        $this->event->trigger('post.shipping_address.delete.address', $address_id);
    }

    public function getAddress($address_id) {
        $address_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "shipping_address WHERE address_id = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->customer->getId() . "' order by date_updated desc");

        if ($address_query->num_rows) {
            $address_data = array(
                'address_id'     => $address_query->row['address_id'],
                'contact'      => $address_query->row['contact'],
                'lat'       => $address_query->row['lat'],
                'lng'        => $address_query->row['lng'],
                'address'      => $address_query->row['address'],
                'phone'      => $address_query->row['phone'],
            );

            return $address_data;
        } else {
            return false;
        }
    }

    public function getAddresses() {
        $address_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_address WHERE customer_id = '" . (int)$this->customer->getId() . "' order by address_id desc");

        foreach ($query->rows as $result) {
            $address_data[$result['address_id']] = array(
                'address_id'     => $result['address_id'],
                'contact'      => $result['contact'],
                'lat'       => $result['lat'],
                'lng'        => $result['lng'],
                'address'      => $result['address'],
                'phone'      => $result['phone'],

            );
        }

        return $address_data;
    }

    public function getTotalAddresses() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "shipping_address WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        return $query->row['total'];
    }

    public function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6367000; //approximate radius of earth in meters

        /*
         Convert these degrees to radians
         to work with the formula
         */

        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;

        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;

        /*
         Using the
         Haversine formula

         http://en.wikipedia.org/wiki/Haversine_formula

         calculate the distance
         */

        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;

        return round($calculatedDistance);
    }
}