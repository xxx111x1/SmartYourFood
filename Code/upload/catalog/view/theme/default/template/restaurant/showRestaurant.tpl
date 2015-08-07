<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="catalog/view/theme/default/stylesheet/sf.css" rel="stylesheet">
<div class=orderRestaurant style="margin-left:auto;margin-right:auto;width:980px;background:#F3F3F5;" >
<div class=sf_filter>
	<span class=filter_head>餐馆分类：</span>
	<?php foreach ($types as $type) { ?>
	<span class=filter_field><?php echo $type['type_name_cn']?></span>
	<?php } ?>
</div>
<div class=sort_option>
<span class=sort_default>默认排序</span>
 <span class="by_time glyphicon glyphicon-arrow-down">配送时间</span>
 <span class="by_sv glyphicon glyphicon-arrow-down">销量</span> 
 <span class="by_review glyphicon glyphicon-arrow-down">评价</span>
 </div>
<div class=product_area >
<?php foreach ($restaurants as $restaurant) { ?>
    <div class=sf_product id=<?php echo $restaurant['restaurant_id']; ?> >
    	<img class=sf_product_preview src=<?php echo $restaurant['img_url']?> />
    	<div class=sf_product_title ><?php echo $restaurant['name']; ?></div>
    	<img class=sf_product_stars src=img/stars_2.png > 
    	<div class=sf_product_sv><?php echo "本月销量-份" ?></div>
    	<div class=sf_product_price>
			<span style="MARGIN-RIGHT: 10px">价格:<?php echo $restaurant['avg_cost']; ?>
			</span><span>配送: </span>
			<span class="glyphicon glyphicon-time" style="FLOAT: right">分钟</span> 
		</div>	
    </div>
    
 <?php } ?>
 </div>
 </div>