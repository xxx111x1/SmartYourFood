<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery-ui.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/javascript/mobile/stars.js" type="text/javascript"></script>
<script src="catalog/view/javascript/mobile/sfdetail.js" type="text/javascript"></script>
<script src="catalog/view/javascript/mobile/sffooter.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/headerAndFooter.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/detail.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
</head>
<body>
<div class="cart_background" style="display: none;"></div>

<div class="header col-1-1" style="background-color: white;">
	<div class="img_frame tab_frame back_button col-3-12" >
		<span class="helper"></span>
	  	<img class="tab_icon" src="../catalog/view/theme/default/image/mobile/mobileRestDetailBack.png" />
	</div>
	<div id="order_tab" class="type_tab col-3-12">        	
        <div class="tab_label tab_selected"><?php echo $Order; ?></div>
 	</div>
	<div id="restaurant_tab" class="type_tab col-3-12">
        <div class="tab_label"><?php echo $Shop; ?></div>
	</div>
</div>

<div class="rest_info" style="display: none;">
		<div class="rest_basic">
			<div class="img_frame tab_frame back_button col-3-12" >
				<span class="helper"></span>
			  	<img class="rest_img" src="<?php echo $restaurant['img_url']; ?>" />
			</div>
			<div class="rest_info_description col-8-12">
				<div class="rest_name"><?php if($language=='en' && $restaurant['name_en'] != ''){echo $restaurant['name_en'];} else {echo $restaurant['name'];} ?></div>
				<div class="sf_product_stars stars" rate="<?php echo $restaurant['review_score']; ?>" ></div>
			</div>
		</div>
		

		<div class="rest_distance_info">
			<div class="info_col">
				<div class="info_value border-right">45min</div>
				<div class="info_label border-right"><?php echo $Averagearrivaltime ;?></div>
			</div>
			<div class="info_col">
				<div class="info_value  left_border"><?php echo $distance; ?>KM</div>
				<div class="info_label  left_border"><?php echo $Distance ;?></div>
			</div>
		</div>
		<div class="rest_detail">
			<div class="rest_detail_content rest_workinghour"><?php echo $BusinessHours ;?>： <?php echo $restaurant['working_hour']; ?></div>
			<div class="rest_detail_content rest_address"><?php echo $RestaurantAddress ;?>： <?php echo $restaurant['address']; ?></div>
			<div class="rest_detail_content rest_contact"><?php echo $ContactNumber ;?>： <?php echo $restaurant['phone']; ?></div>	
			
		</div>
</div>

<div class="container">
	<input id="rest-id" type="hidden" value="<?php echo $rest_id; ?>" />
	<div class="tagarea">
        	<div class="tagitem tagitemSelected" value="0"><?php echo $All; ?></div>	
	    	<?php foreach ($tags as $tag) { ?>
				<div class="tagitem" title="<?php if($language == 'en') { echo $tag['tag_name_en'];} else {echo $tag['tag_name_cn'];} ?>" value="<?php echo $tag['tag_id'];?>"><?php if($language == 'en') { echo $tag['tag_name_en'];} else {echo $tag['tag_name_cn'];} ?></div>	
			<?php } ?>	       
	</div>
	
	<div class="product_content">
		<input type='hidden' id="purchaseRest" value="<?php echo $cart_rest_id;?>" />
		<input type="hidden" id="page_number" value="0" />
		<div class=product_area >
			
		</div>
	</div>
</div>



<div id="cart_preview">
	<?php echo $cartthumbnail;?>
</div>


<div class="footer col-1-1">
  <div class="detail_navigation">
  	<div id="cart_nav" class="detail_navigation_item cart_navigation">
  		<div class="cart_number_frame"> 
  			<div id="cart_number">0</div>
  		</div>
  		<div class="img_frame navigation_frame cart_img_navigation" >
	  		<img class="navigation_icon cart_icon" src="../catalog/view/theme/default/image/mobile/mobileRestDetailCart.png" />
  		</div>
  	</div>
  	<div class="detail_navigation_item">
  		<div id="all_price" class="cart_navigation_label navigation_frame" style="font-size: 22px; font-weight: bolder;">$0</div>
  	</div>
  	<div class="detail_navigation_item">
  		<div id="transfer_fee" class="cart_navigation_label navigation_frame" style="font-size: 10px; color: #888888;font-weight: normal;margin-left: 5px;"></div>
  	</div>
  	<div class="detail_navigation_item col-3-12" style="float:right;margin-right: 20px;">
  		<a class="cart_navigation_label navigation_frame" id="orderConfirm" href="/index.php?route=sfcheckout/checkout">
  		<div class="cart_navigation_label navigation_frame" style="margin-top: 5px;height: 40px; line-height: 40px;margin-right: 20px;width: 100%;background: #f65053; text-align: center; color: white;-moz-border-radius: 9px; -webkit-border-radius: 9px; border-radius: 9px;">选好了</div>
  		</a >
  	</div>
  </div>      
</div>
</body></html>