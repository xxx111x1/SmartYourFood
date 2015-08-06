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
<div class=sf_filter>
	<span class=filter_head>餐馆分类：</span>
	<?php foreach ($types as $type) { ?>
	<SPAN class=filter_field><?php echo $type['type_name_cn']?></SPAN>
	<?php } ?>
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