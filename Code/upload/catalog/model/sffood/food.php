<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/9
 * Time: 15:38
 * force push  force push force push
 */
class ModelSffoodFood extends Model{

    public function add(){
    	$this->event->trigger('pre.food.add', $data);
    	$query =  "INSERT INTO " . DB_PREFIX . "oc_food	SET name             = '" . $data['name'] . "' ";
    	if(array_key_exists('description'     , $data)){ $query .= ", description      = '" . $data['description']      ."'"; }
    	if(array_key_exists('restaurant_id'   , $data)){ $query .= ", restaurant_id    =  " . $data['restaurant_id']    . ""; }
    	if(array_key_exists('review_score'    , $data)){ $query .= ", review_score     = '" . $data['review_score']     . "'"; }
    	if(array_key_exists('tags'            , $data)){ $query .= ", tags             = '" . $data['tags']             . "'"; }
    	if(array_key_exists('img_url'         , $data)){ $query .= ", img_url          = '" . $data['img_url']          . "'"; }
    	if(array_key_exists('price'           , $data)){ $query .= ", price            = '" . $data['price']            . "'"; }
    	if(array_key_exists('available'       , $data)){ $query .= ", available        = '" . $data['available']        . "'"; }
    	if(array_key_exists('sell_number'     , $data)){ $query .= ", sell_number      = '" . $data['sell_number']      . "'"; }
    	$this->db->query("" . $query);
    	$this->event->trigger('post.food.add', $data);
    }

    public function delete($food_id){
    	$this->db->query("DELETE " . DB_PREFIX . "food WHERE food_id = '" . (int)$food_id . "'");
    }

    public function  update(){

    }

    public function  search(){

    }

    public function getFoods($filters = "0", $sort = " sell_number desc, review_score desc", $start = 0, $number = 16) {
    	$sql = "SELECT *,0 as cart_number FROM " . DB_PREFIX . "food ";
    	if($filters != "0"){
    		$sql .= "where tags in (" . $filters .") ";
    	}
    	$sql .= " order by " . $sort . " limit " . $start . "," . $number;
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    public function getFoodsWithRestaurantInfo($filters = "0", $sort = " sell_number desc, review_score desc", $start = 0, $number = 16) {
    	$sql = "SELECT a.*, b.review_score as rest_review, b.name as rest_name, 0 as cart_number FROM " . DB_PREFIX . "food a, " . DB_PREFIX . "restaurant_info b where a.restaurant_id = b.restaurant_id ";
    	if($filters != "0"){
    		$sql .= " and tags in (" . $filters .") ";
    	}
    	$sql .= " order by " . $sort . " limit " . $start . "," . $number;
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    
    public function getFood($food_id){
    	$sql = "SELECT * FROM " . DB_PREFIX . "food where food_id = '" . (int)$food_id . "'" ;
    	$query = $this->db->query($sql);
    	return $query->row;
    }

    public function getFoodByName($foodName){
        $sql = "SELECT * FROM ".DB_PREFIX."food where name like '%".$foodName."%'";
        $this->log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getFoodsByRestID($restaurant_id)
    { 
    	$sql = "SELECT *,0 as cart_number FROM " . DB_PREFIX . "food where restaurant_id = '" . $restaurant_id . "'";
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    public function getTypes() {
    	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "food_type order by type_id");
    	return $query->rows;
    }
}