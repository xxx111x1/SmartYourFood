<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/cart.css">
<div class="cart_dropdown" id="cart_dropdown" style="display: <?php echo $is_block ?>; z-index: <?php echo $z_index;?>">
      <div class="cart_thumbenail_head" >
	      <div class="img_frame cart_hide" >
				<span class="helper"></span>
		  		<img class="" src="../catalog/view/theme/default/image/mobile/mobileCartHide.png" />
		  </div>
	      <div class="cart_head claer_all">
	      	<div class="img_frame cart_bin" >
				<span class="helper"></span>
		  		<img class="" src="../catalog/view/theme/default/image/mobile/mobileCartBin.png" />
		  	</div>
		  	<div class="label_frame">
				<div class="cart_label"><?php echo $Clear_Cart;?></div>
			</div>	      	
	      </div>
     </div>
    <?php if ($products) { ?>
      <div class="cart_table">
        <?php foreach ($products as $product) { ?>
        <div class="food_row">
          <div class="food_infor col-7-12" >
	          	<div class="food_name_detail product_name_overflow" title="<?php if($lang ==  'en'){echo $product['name_en'];} else {echo $product['name'];} ?>" href="<?php echo $product['href']; ?>">
	          		<?php if($lang ==  'en'){echo $product['name_en'];} else {echo $product['name'];} ?>
	          	</div>
	          	<div class="food_price"><?php echo $product['price']; ?></div>
          </div>
          <div class="food_number col-3-12" foodId ="<?php echo $product['product_id']; ?>" >
          	  <div class="img_frame col-4-12" >
				<span class="helper"></span>
		  		<img class="minus_product product_number_<?php echo $product['quantity']; ?> minus_product_<?php echo $product['product_id']; ?> cart_operation" src="../catalog/view/theme/default/image/mobile/mobileMinus.png" restid="<?php echo $product['rest_id']; ?>" foodid="<?php echo $product['product_id']; ?>" />
		  	  </div>	          
	          <div class="product_number product_number_<?php echo $product['quantity']; ?> product_<?php echo $product['product_id']; ?> col-4-12" foodId="<?php echo $product['product_id']; ?>"><?php echo $product['quantity']; ?></div>
	          <div class="img_frame col-4-12" >
				<span class="helper"></span>
		  		<img class="add_product cart_operation" src="../catalog/view/theme/default/image/mobile/mobileAdd.png" restid="<?php echo $product['rest_id']; ?>" foodId="<?php echo $product['product_id']; ?>"/>
		  	  </div>	          
          </div>
          <div class="food_all_price col-2-12"><?php echo $product['total']; ?></div>
        </div>
        <?php } ?>
     </div>
    <?php } else { ?>
    <div class="empty_cart"><?php echo $Empty_Cart;?> </div>
    <?php } ?>
  </div>