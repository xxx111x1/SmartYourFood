<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Smart Your Food</title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap-theme.min.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="catalog/view/javascript/list-item/cart.js" type="text/javascript"></script>
	<script src="catalog/view/javascript/starts.js" type="text/javascript"></script>
</head>
<body>
<!--
<div class="header">Header part</div>
-->
<?php echo $header;?>
<div class="main_body">
    <!--<div class="bill_board">billboard part</div>-->
    <div class="address_info">
        <span class="address_info_label">送餐地址:</span>
        <span class="address_info_address"><?php echo $address;?></span>
        <a class="address_info_chg" href="index.php?route=address/address&returnUrl=index.php?route=sffood/list">切换地址</a></div>
    </div>
   
    <div class=sf_product_content>
    	
	 	<div class=product_area >
	 	<div class=rest_information>
    		<img class=rest_img  src="<?php echo $restaurant['img_url'];?>"></img>
    		<div class=rest_details>
    			<div class=rest_detail >餐厅名称：<?php echo $restaurant['name'];?></div>
				<div class=rest_detail >餐厅简介：<?php echo $restaurant['description'];?></div>
				<div class=rest_detail >餐厅地址：<?php echo $restaurant['address'];?></div>
				<div class=rest_detail >联系人： <?php echo $restaurant['contacts'];?></div>
				<div class=rest_detail >联系电话：<?php echo $restaurant['phone'];?></div>
				<div class=rest_detail >餐厅评价：<?php echo $restaurant['review_score'];?></div>
    		</div>
			
    	</div>
    	<div class=food_information>
			<?php foreach ($foods as $food) { ?>
				<div class=sf_product id="<?php echo $food['food_id'];?>" title="<?php echo $food['name'];?>" >
					<img class=sf_product_preview src="<?php echo $food['img_url'];?>" />
					<div class=sf_product_title ><?php echo $food['name'];?></div>
					<span class="sf_product_stars stars" rate="<?php echo $food['review_score']; ?>" ></span>
					<div class=sf_product_price>
						<span style="MARGIN-RIGHT: 10px">价格:<?php echo $food['price'];?></span>
						<span>配送: </span>
						<span >分钟</span>
						<span class=sf_product_sv >销量<?php $food['sell_number']; ?>份</span> 
					</div>
					<div class="sf_food_cart">
						<div class="minus_food" value="<?php echo $food['food_id'];?>" >-</div>
						<input class="food_number" id="food_<?php echo $food['food_id'];?>_number" value="<?php echo $food['cart_number'];?>" />
						<div class="add_food" value="<?php echo $food['food_id'];?>" >+</div> 
					</div>
				</div>
			<?php } ?>
		</div>
 		</div>
 	</div>
</div>
<!--
<div class="footer">
-->

</div>
</body>
</html>