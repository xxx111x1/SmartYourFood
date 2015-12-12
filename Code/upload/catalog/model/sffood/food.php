<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/9
 * Time: 15:38
 * force push  force push force push
 */
class ModelSffoodFood extends Model{

    public function add($data){
    	$this->event->trigger('pre.food.add', $data);
    	$query =  "INSERT INTO " . DB_PREFIX . "food	SET name             = '" . $data['name'] . "' ";
    	if(array_key_exists('description'     , $data)){ $query .= ", description      = '" . $data['description']      ."'"; }
    	if(array_key_exists('restaurant_id'   , $data)){ $query .= ", restaurant_id    =  " . $data['restaurant_id']    . ""; }
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
    	if(array_key_exists('price'           , $data)){ $query .= ", price            = '" . $data['price']            . "'"; }
    	if(array_key_exists('available'       , $data)){ $query .= ", available        = '" . $data['available']        . "'"; }
    	if(array_key_exists('sell_number'     , $data)){ $query .= ", sell_number      = '" . $data['sell_number']      . "'"; }
    	$this->db->query($query);
    	$this->event->trigger('post.food.add', $data);
    }
    
    public function getAddSql($data){
    	$this->event->trigger('pre.food.add', $data);
    	$query =  "INSERT INTO " . DB_PREFIX . "food	SET name             = '" . $data['name'] . "' ";
    	if(array_key_exists('description'     , $data)){ $query .= ", description      = '" . $data['description']      ."'"; }
    	if(array_key_exists('restaurant_id'   , $data)){ $query .= ", restaurant_id    =  " . $data['restaurant_id']    . ""; }
    	if(array_key_exists('review_score'    , $data)){ $query .= ", review_score     = '" . $data['review_score']     . "'"; }
    	if(array_key_exists('tags'            , $data)){ $query .= ", tags             = '" . $data['tags']             . "'"; }
    	if(array_key_exists('img_url'         , $data))
    	{
    
    		$img_url = $data['img_url'];
    		if(strpos($img_url,'http') == false){
    			$img_url = "./catalog/view/theme/default/image/foodImages/" . $img_url;
    		}
    		$query .= ', img_url          = "' . $img_url . '"';
    	}
    	if(array_key_exists('price'           , $data)){ $query .= ", price            = '" . $data['price']            . "'"; }
    	if(array_key_exists('available'       , $data)){ $query .= ", available        = '" . $data['available']        . "'"; }
    	if(array_key_exists('sell_number'     , $data)){ $query .= ", sell_number      = '" . $data['sell_number']      . "'"; }
    	return $query . ";\r\n";
    }
    
    public function getFoodTypeAddSql($data){
    	$query =  "";
    	if(strpos($data['tags'],',') !== false){
    		$tags = explode(",", $data['tags']);
    		foreach ($tags as $tag) {
    			$query .= $this->buildFoodTypeSql($data,$tag);
    		}
    	}
    	else{
    		$tag = $data['tags'];
    		$query = $this->buildFoodTypeSql($data,$tag);
    	}
    	
    	return $query;
    }
    
    public function buildFoodTypeSql($data,$tag){
    	$query =  "INSERT INTO " . DB_PREFIX . "food_tag_detail	SET food_name_cn             = '" . $data['name'] . "' ";
    	$query .= ", tag_id      = '" . $tag      ."'"; 
    	if(array_key_exists('is_special'   , $data)){ 
    		if($data['is_special'] != 1){
    			$data['is_special'] = 0;
    		}
    		$query .= ", is_special    =  '" . $data['is_special']    . "'"; 
    	}
    	if(array_key_exists('keywords'    , $data)){ $query .= ", keywords     = '" . $data['keywords']     . "'"; }
    	if(array_key_exists('rest_name'            , $data)){ $query .= ", rest_name_cn             = '" . $data['rest_name']             . "'"; }
    	return $query . ";\r\n";
    }

    public function delete($food_id){
    	$this->db->query("DELETE " . DB_PREFIX . "food WHERE food_id = '" . (int)$food_id . "'");
    }

    public function  update(){

    }

    public function  search(){

    }

    public function getFoods($filters = "0", $sort = " sell_number desc, review_score desc", $start = 0, $number = 16) {
    	$sql = "SELECT *,0 as cart_number FROM " . DB_PREFIX . "food where available= 1";
    	if($filters != "0"){
    		$filters = str_replace(',','|',$filters);
    		$sql .= "and tags REGEXP '" . $filters ."' ";
    	}
    	$sql .= " order by " . $sort . " limit " . $start . "," . $number;
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    public function getFoodsWithRestaurantInfo($filters = "0", $sort = " sell_number desc, review_score desc", $start = 0, $number = 16) {
    	$sql = "SELECT a.*, b.lat as lat, b.lng as lng, b.review_score as rest_review, b.name as rest_name, b.name_en as rest_name_en, 0 as cart_number FROM " . DB_PREFIX . "food a, " . DB_PREFIX . "restaurant_info b where a.restaurant_id = b.restaurant_id and a.available =1 ";
    	if($filters != "0"){
    		$filters = str_replace(',','|',$filters);
    		$sql .= "and a.tags REGEXP '" . $filters ."' ";
    	}
    	$sql .= " order by " . $sort . " limit " . $start . "," . $number;
    	//echo $sql;
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    
    public function getFood($food_id){
    	$sql = "SELECT * FROM " . DB_PREFIX . "food where available = 1 and food_id = '" . (int)$food_id . "'" ;
    	$query = $this->db->query($sql);
    	return $query->row;
    }

    public function getFoodByName($foodName){
		$sql = "select a.name as rest_name, a.name_en as rest_name_en,a.lat as lat, a.lng as lng, a.restaurant_id as restaurant_id, b.name as food_name, b.name_en as food_name_en, b.price as price,b.review_score as score,b.sell_number as sells, b.food_id as food_id,b.img_url as img_url, -1 as dist from "
			.DB_PREFIX."food b inner join "
			.DB_PREFIX."restaurant_info a on a.restaurant_id = b.restaurant_id where ( LOWER(b.name) like LOWER('%".$foodName."%') or LOWER(b.name_en) like LOWER('%".$foodName."%') ) and b.available = 1 and a.restaurant_id>0 ";
		$this->log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;
    }
    
    public function getSpecialFoods(){
    	$sql = "(select a.name as rest_name,a.name_en as rest_name_en, a.restaurant_id as restaurant_id, b.name as food_name,b.name_en as food_name_en, b.food_id as food_id,b.img_url as img_url from ".DB_PREFIX."restaurant_info a, oc_food b where a.restaurant_id = b.restaurant_id and b.available = 1 and a.restaurant_id=0  order by b.date_added desc limit 0,1) union ";
    	$sql .= "(select a.name as rest_name,a.name_en as rest_name_en, a.restaurant_id as restaurant_id, b.name as food_name,b.name_en as food_name_en, b.food_id as food_id,b.img_url as img_url from ".DB_PREFIX."restaurant_info a, oc_food b where a.restaurant_id = b.restaurant_id and b.available = 1 and a.restaurant_id>0 ";
		$sql .= " order by b.sell_number desc limit 0,3)";
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    public function getTempSpecialFoods(){
    	$sql = "SELECT a.name as rest_name, a.name_en as rest_name_en, a.restaurant_id as restaurant_id, b.name as food_name,b.name_en as food_name_en, b.food_id as food_id,b.img_url as img_url FROM smartyourfood.oc_food b inner join smartyourfood.oc_restaurant_info a on a.restaurant_id = b.restaurant_id where b.name like N'新疆大盘鸡' or b.name like N'干锅牛蛙' or b.name like N'香辣虾' or b.name like N'麻辣香锅'";
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    public function getFoodsByRestID($restaurant_id, $sort)
    { 
    	$sql = "SELECT a.*, b.lat as lat, b.lng as lng, b.review_score as rest_review, b.name as rest_name, b.name_en as rest_name_en , 0 as cart_number FROM " . DB_PREFIX . "food a, " . DB_PREFIX . "restaurant_info b where a.restaurant_id = '" . $restaurant_id . "' and a.restaurant_id = b.restaurant_id ";
    	if(isset($sort)){
    		$sql .= " order by " . $sort ;
    	}    	
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    public function getFoodsByRestIDAndTags($restaurant_id,$tag, $sort)
    {
    	$sql = "SELECT a.*, b.lat as lat, b.lng as lng, b.review_score as rest_review, b.name as rest_name, b.name_en as rest_name_en, 0 as cart_number FROM " . DB_PREFIX . "food a, " . DB_PREFIX . "restaurant_info b, " . DB_PREFIX . "food_tag_detail c where a.restaurant_id = '" . $restaurant_id . "' and a.restaurant_id = b.restaurant_id and a.food_id = c.food_id and c.tag_id ='".$tag."'";
    	if(isset($sort)){
    		$sql .= " order by " . $sort ;
    	}
    	$query = $this->db->query($sql);
    	return $query->rows;
    }
    
    
    public function getTypes() {
    	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "food_type order by type_id");
    	return $query->rows;
    }
}