update smartyourfood.oc_food set img_url = REPLACE(img_url, '.PNG', '.jpg') where food_id>= 0;
update smartyourfood.oc_food set img_url = REPLACE(img_url, '.png', '.jpg') where food_id>= 0;
update smartyourfood.oc_restaurant_info set img_url = REPLACE(img_url, '。PNG', '.jpg') where restaurant_id>= 0;
update smartyourfood.oc_restaurant_info set img_url = REPLACE(img_url, '。png', '.jpg') where restaurant_id>= 0;