<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $Confirm_Order;?></title>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery-ui.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/javascript/mobile/sforder.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/checkout.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/headerAndFooter.css">

</head>

<body>

<div class="sub_header col-1-1">
	<div id="back_checkout" class="img_frame col-3-12" >
		<span class="helper"></span>
	  	<img class="back_img" src="../catalog/view/theme/default/image/mobile/mobileBack.png" />
	</div>
	<div class="col-7-12 sub_header_title">        	
        <div id="header_title"><?php echo $Confirm_Order;?></div>
 	</div>
</div>

<div class="address_area">
	<div class="img_frame col-2-12" >
		<span class="helper"></span>
		<img class="place_img col-5-12" src="../catalog/view/theme/default/image/mobile/mobileOrderPlace.png"/>		
	</div>			
	<div class="col-9-12" style="float:left;">
		<div class="address_info">
			<div class="address_contact"><?php echo $contact;?> <?php echo $phone;?></div>
			<div class="address overflow" title="<?php echo $address;?>"><?php echo $address;?></div>
		</div>
	</div>	
	
	<img class="address_bolder" src="../catalog/view/theme/default/image/mobile/mobileAddressBorderBottom.png">
</div>

<div class="cart_table">
	<?php foreach ($food_list as $product) { ?>
        <div class="food_row">
          <div class="food_infor col-7-12" >
	          	<div class="food_name_detail overflow" title="<?php if($lang ==  'en'){echo $product['food_name_en'];} else {echo $product['food_name'];} ?>" >
	          		<?php if($lang ==  'en'){echo $product['food_name_en'];} else {echo $product['food_name'];} ?>
	          	</div>
	          	<div class="food_price">$<?php echo $product['price']; ?></div>
          </div>
          <div class="food_number col-3-12" foodId ="<?php echo $product['product_id']; ?>" >          
	          <div class="product_number product_number_<?php echo $product['quantity']; ?> product_<?php echo $product['product_id']; ?> col-4-12" foodId="<?php echo $product['product_id']; ?>"><?php echo $product['quantity']; ?></div>
          </div>
          <div class="food_all_price col-2-12" >$<?php echo $product['total']; ?></div>
        </div>
<?php } ?>     
</div>

<div id="cost_summary" class="cost_area">
     <div class="summary_item">
     	<div class="summary_item_label">
     		<?php echo $Sub_Total; ?>:
     	</div>
     	<div class="summary_item_price" id="beforetax">
     		$<?php echo $beforetax;?>
     	</div>
     	</div>
     <div class="summary_item">
     	<div class="summary_item_label">
     		<?php echo $Delivery; ?>:
     	</div>
     	<div class="summary_item_price" id="deliverfee"> $<?php echo $deliverfee;?> </div>
     </div>
     <div class="summary_item">
     	<div class="summary_item_label">
     		<?php echo $Tax; ?>(5%):
     	</div>
     	<div class="summary_item_price" id="taxcost"> $<?php echo $tax;?></div></div>
     <div class="summary_item_last">
     	<div class="summary_item_label">
     		<?php echo $Priority_Delivery; ?>:
     	</div>
     	<div class="summary_item_price" id="fastdeliverfee"> 
     		$<?php echo $fast_deliverfee;?> 
     	</div>
	</div>
    
</div>
<div class="memo">
	
</div>

<div class="note">
	<?php echo $Note; ?>
</div>

<div class="payment_area">
	<div class="payment_label">
		<?php echo $Deliveried_Pay?>:
	</div>
	<div class="payment_method">
        <div class="payment_method" id="paymentlabel" >	<?php echo $By_Cash; ?>  </div>
    </div>
      
</div>


<div class="footer col-1-1">
  <div class="detail_navigation">
  	<div class="detail_navigation_item">
  		<div class="cart_navigation_label navigation_frame" style="font-size: 25px; color: #888888;font-weight: border;margin-left: 5px;">
  			<?php echo $Summary?>
  		</div>
  	</div>
  	<div class="detail_navigation_item">
  		<div id="totalcost" class="cart_navigation_label navigation_frame" style="margin-left: 10px;font-size: 20px; font-weight: bolder;">
  			$<?php echo $totalcost;?>
  		</div>
  	</div>
  	<div class="detail_navigation_item">
  		<div class="cart_navigation_label navigation_frame" style="font-size: 10px; color: #888888;font-weight: normal;margin-left: 5px;">
  			<?php echo $Fee_Info?>
  		</div>
  	</div>
  	<div class="detail_navigation_item" style="float:right;margin-right: 20px;">
  		<a class="cart_navigation_label navigation_frame" id="orderConfirm" href="/index.php?route=sfcheckout/success">
        	<div class="cart_navigation_label navigation_frame" style="margin-top: 5px;height: 40px; line-height: 40px;margin-right: 20px;width: 100%;background: #f65053; text-align: center; color: white;-moz-border-radius: 9px; -webkit-border-radius: 9px; border-radius: 9px;"><?php echo $Confirm?></div>
    	</a>    		
  	</div>
  </div>      
</div>
</body></html>