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
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/headerAndFooter.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/detail.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
</head>
<body>

<div class="header col-1-1" style="background-color: white;">
	<div class="img_frame tab_frame back_button col-3-12" >
		<span class="helper"></span>
	  	<img class="tab_icon" src="../catalog/view/theme/default/image/mobile/mobileRestDetailBack.png" />
	</div>
	<div id="order_tab" class="type_tab col-3-12">        	
        <div class="tab_label"><?php echo $Order; ?></div>
 	</div>
	<div id="restaurant_tab" class="type_tab col-3-12">
        <div class="tab_label"><?php echo $Shop; ?></div>
	</div>
</div>

<div class="container">
	<input id="rest-id" type="hidden" value="<?php echo $rest_id; ?>" />
	<div class="tagarea">
        	<div class="tagitem tagitemSelected" value="0"><?php echo $All; ?></div>	
	    	<?php foreach ($tags as $tag) { ?>
				<div class="tagitem" value="<?php echo $tag['tag_id'];?>"><?php if($language == 'en') { echo $tag['tag_name_en'];} else {echo $tag['tag_name_cn'];} ?></div>	
			<?php } ?>	       
	</div>
	
	<div class="product_content">
		<input type='hidden' id="purchaseRest" value="<?php echo $cart_rest_id;?>" />
		<input type=hidden id=page_number value=0 />
		<div class=product_area >
			
		</div>
	</div>
</div>

<div id="cart_thumbnail">
	<?php echo $cartthumbnail;?>
</div>


<div class="footer col-1-1">
	<div class="img_frame foot_logo_frame" >
		<span class="helper"></span>
  		<img class="foot_logo footer_img" src="../catalog/view/theme/default/image/mobile/mobileHomeLogoCn.png" />
	</div>
  <div class="navigation">
  	<div id="cart_nav" class="navigation_item">
  		<div class="img_frame navigation_frame" >
			<span class="helper"></span>
	  		<img class="navigation_icon" src="../catalog/view/theme/default/image/mobile/mobileHomeCart.png" />
  		</div>
  		<div class="navigation_label navigation_frame">cart</div>
  	</div>
  	<div class="navigation_item">
  		<div class="img_frame navigation_frame" >
			<span class="helper"></span>
  			<img class="navigation_icon" src="../catalog/view/theme/default/image/mobile/mobileHomeOrder.png" />
  		</div>
  		<div class="navigation_label navigation_frame">order</div>
  	</div>
  	<div class="navigation_item">
  		<div class="img_frame navigation_frame" >
			<span class="helper"></span>
  			<img class="navigation_icon" src="../catalog/view/theme/default/image/mobile/mobileHomeMe.png" />
  		</div>
  		<div class="navigation_label navigation_frame">my</div>
  	</div>
  </div>      
</div>
</body></html>