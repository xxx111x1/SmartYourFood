SET SQL_SAFE_UPDATES = 0;
UPDATE smartyourfood.oc_food_tag_detail d 
   inner join (SELECT a.food_id, a.restaurant_id, a.name as food_name, b.name as rest_name FROM smartyourfood.oc_food a inner join smartyourfood.oc_restaurant_info b on a.restaurant_id = b.restaurant_id) c
   ON d.food_name_cn = c.food_name and d.rest_name_cn = c.rest_name
   SET d.food_id = c.food_id, d.rest_id = c.restaurant_id where d.id>=0;