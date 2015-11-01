<?php
class ModelSfRestInformation extends Model{
	public function addRestaurant($data){
		$this->event->trigger('pre.restaurant.add', $data);
	    $query =  'INSERT INTO ' . DB_PREFIX . 'restaurant_info	SET name             = "'. $data['name'] . '"';
			if(array_key_exists('description'     , $data)){ $query .= ', description      = "' . $data['description']      .'"'; }
			if(array_key_exists('lat'             , $data)){ $query .= ", lat              =  " . $data['lat']              . ""; } else {$query .= ", lat              = 0";}
			if(array_key_exists('lng'             , $data)){ $query .= ", lng              =  " . $data['lng']              . ""; } else {$query .= ", lng              = 0";}
			if(array_key_exists('address'         , $data)){ $query .= ', address          = "' . $data['address']          . '"'; }
			if(array_key_exists('phone'           , $data)){ $query .= ", phone            = '" . $data['phone']            . "'"; }
			if(array_key_exists('contacts'        , $data)){ $query .= ', contacts         = "' . $data['contacts']         . '"'; }
			if(array_key_exists('review_score'    , $data)){ $query .= ", review_score     = '" . $data['review_score']     . "'"; }
			if(array_key_exists('tags'            , $data)){ $query .= ", tags             = '" . $data['tags']             . "'"; }
			if(array_key_exists('img_url'         , $data))
		    	{ 
		    		
		    		$img_url = $data['img_url'];
		    		if(strpos($img_url,'http') == false){
		    			$img_url = "./catalog/view/theme/default/image/foodImages/" . $img_url;
		    		}
		    		$query .= ", img_url          = '" . $img_url . "'"; 
		    	}
			if(array_key_exists('avg_cost'        , $data)){ $query .= ", avg_cost         = '" . $data['avg_cost']         . "'"; } else {$query .= ", avg_cost      = 0";}
			if(array_key_exists('available'       , $data)){ $query .= ", available        = '" . $data['available']        . "'"; }
			if(array_key_exists('taste_score'     , $data)){ $query .= ", taste_score      = '" . $data['taste_score']      . "'"; }
			if(array_key_exists('atmosphere_score', $data)){ $query .= ", atmosphere_score = '" . $data['atmosphere_score'] . "'"; }
			if(array_key_exists('service_score'   , $data)){ $query .= ", service_score    = '" . $data['service_score']    . "'"; }
			if(array_key_exists('review_number'   , $data)){ $query .= ", review_number    = '" . $data['review_number']    . "'"; }
		$this->db->query($query);		
		$this->event->trigger('post.restaurant.add', $data);
	}
	
	public function getAddRestaurantSql($data){
		$query =  'INSERT INTO ' . DB_PREFIX . 'restaurant_info	SET name             = "'. $data['name'] . '"';
		if(array_key_exists('description'     , $data)){ $query .= ', description      = "' . $data['description']      .'"'; }
		if(array_key_exists('lat'             , $data)){ $query .= ", lat              =  " . $data['lat']              . ""; } else {$query .= ", lat              = 0";}
		if(array_key_exists('lng'             , $data)){ $query .= ", lng              =  " . $data['lng']              . ""; } else {$query .= ", lng              = 0";}
		if(array_key_exists('address'         , $data)){ $query .= ', address          = "' . $data['address']          . '"'; }
		if(array_key_exists('phone'           , $data)){ $query .= ", phone            = '" . $data['phone']            . "'"; }
		if(array_key_exists('contacts'        , $data)){ $query .= ', contacts         = "' . $data['contacts']         . '"'; }
		if(array_key_exists('review_score'    , $data)){ $query .= ", review_score     = '" . $data['review_score']     . "'"; }
		if(array_key_exists('tags'            , $data)){ $query .= ", tags             = '" . $data['tags']             . "'"; }
		if(array_key_exists('img_url'         , $data))
		{
	
			$img_url = $data['img_url'];
			if(strpos($img_url,'http') == false){
				$img_url = "./catalog/view/theme/default/image/foodImages/" . $img_url;
			}
			$query .= ", img_url          = '" . $img_url . "'";
		}
		if(array_key_exists('avg_cost'        , $data)){ $query .= ", avg_cost         = '" . $data['avg_cost']         . "'"; } else {$query .= ", avg_cost      = 0";}
		if(array_key_exists('available'       , $data)){ $query .= ", available        = '" . $data['available']        . "'"; }
		if(array_key_exists('taste_score'     , $data)){ $query .= ", taste_score      = '" . $data['taste_score']      . "'"; }
		if(array_key_exists('atmosphere_score', $data)){ $query .= ", atmosphere_score = '" . $data['atmosphere_score'] . "'"; }
		if(array_key_exists('service_score'   , $data)){ $query .= ", service_score    = '" . $data['service_score']    . "'"; }
		if(array_key_exists('review_number'   , $data)){ $query .= ", review_number    = '" . $data['review_number']    . "'"; }
		return $query.';';
		
	}
	
	public function addRestReview($data){
		$this->event->trigger('pre.RestReview.add', $data);
		$query =  "INSERT INTO " . DB_PREFIX . "restaurant_reviews	SET restaurant_id             = '" . $data['restaurant_id'] . "' ";
		if(array_key_exists('overall_score' , $data)){ $query .= ", overall_score      = '" . $data['overall_score']      ."'"; }
		if(array_key_exists('taste_score'   , $data)){ $query .= ", taste_score              =  " . $data['taste_score']              . ""; } 
		if(array_key_exists('service_score' , $data)){ $query .= ", service_score              =  " . $data['service_score']              . ""; } 
		if(array_key_exists('comment'         , $data)){ $query .= ", comment          = '" . $data['comment']          . "'"; }
		if(array_key_exists('customer_id'           , $data)){ $query .= ", customer_id            = '" . $data['customer_id']            . "', date_added = NOW() "; }		
		$this->db->query($query);
		$this->event->trigger('post.RestReview.add', $data);
	}
	public function editRestaurant($data){
		$this->event->trigger('pre.restaurant.edit', $data);
		$restaurant_id = $data['restaurant_id'];
		$this->db->query("UPDATE " . DB_PREFIX . "restaurant_info
				SET  name             = '" . $this->db->escape($data['name'])
				. "',description      = '" . $this->db->escape($data['description'])
				. "',lat              = '" . $this->db->escape($data['lat'])
				. "',lng              = '" . $this->db->escape($data['lng'])
				. "',address          = '" . $this->db->escape($data['address'])
				. "',phone            = '" . $this->db->escape($data['phone'])
				. "',contacts         = '" . $this->db->escape($data['contacts'])
				. "',review_score     = '" . $this->db->escape($data['review_score'])
				. "',tags             = '" . $this->db->escape($data['tags'])
				. "',img_url          = '" . $this->db->escape($data['img_url'])
				. "',avg_cost         = '" . $this->db->escape($data['avg_cost'])
				. "',available        = '" . $this->db->escape($data['available'])
				. "',taste_score      = '" . $this->db->escape($data['taste_score'])
				. "',atmosphere_score = '" . $this->db->escape($data['atmosphere_score'])
				. "',service_score    = '" . $this->db->escape($data['service_score'])
				. "',review_number    = '" . $this->db->escape($data['review_number'])
				. "' WHERE restaurant_id = '" . (int)$restaurant_id . "'");
		$this->event->trigger('post.restaurant.edit', $data);
	}
	
	public function deleteRestaurant($restaurant_id){
		$this->db->query("DELETE " . DB_PREFIX . "restaurant_info WHERE restaurant_id = '" . (int)$restaurant_id . "'");		
	}
	
	public function getRestaurant($restaurant_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "restaurant_info WHERE available = 1 and restaurant_id = '" . $restaurant_id . "'";
		$query = $this->db->query($sql);
		return $query->row;
	}
	
	public function getRestaurants($filters = "0", $sort = " sell_number desc, review_score desc", $start = 0, $number = 16) {	
		$sql = "SELECT * FROM " . DB_PREFIX . "restaurant_info where available =1 ";
		if($filters != "0"){
			$filters = str_replace(',','|',$filters);
			$sql .= "and tags REGEXP '" . $filters ."' ";
		}
		$sql .= " order by " . $sort . " limit " . $start . "," . $number;
		$query = $this->db->query($sql);
		return $query->rows;
	}
		
	public function getRestaurantsByFilters($filters,$start = 0, $number = 16) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "restaurant_info where available =1 and restaurant_type in (" . $filters .") limit " . $start . "," . $number);
		return $query->rows;
	}

    public function getRestaurantsByName($name) {
        $sql = "SELECT * FROM " . DB_PREFIX."restaurant_info where available = 1 and name like '%".$name."%'";
        $this->log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;
    }

	public function getTypes() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "restaurant_type ");
		return $query->rows;
	}
}