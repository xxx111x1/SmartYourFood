<?php
class ModelRestaurantInformation extends Model{
	public function initialRestaurants(){
	
	}
	public function addRestaurants($data){
		$this->event->trigger('pre.restaurant.add', $data);
		$restaurant_id = $this->db->getLastId();
		$this->db->query("INSERT INTO " . DB_PREFIX . "restaurant_info
				SET restaurant_id = '" . $restaurant_id 
				. "',name             = '" . $this->db->escape($data['name'])
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
				. "',review_number    = '" . $this->db->escape($data['review_number']));
		$this->event->trigger('post.restaurant.add', $data);
		return $restaurant_id;
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
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "restaurant_info WHERE restaurant_id = '" . (int)restaurant_id . "'");
		return $query->row;
	}
	
	public function getRestaurants() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "restaurant_info ");	
		return $query->rows;
	}
}