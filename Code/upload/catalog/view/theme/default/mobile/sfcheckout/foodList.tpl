<?php foreach ($food_list as $product) { ?>
        <div class="food_row">
          <div class="food_infor col-7-12" >
	          	<div class="food_name_detail overflow" title="<?php if($lang ==  'en'){echo $product['food_name_en'];} else {echo $product['food_name'];} ?>" >
	          		<?php if($lang ==  'en'){echo $product['food_name_en'];} else {echo $product['food_name'];} ?>
	          	</div>
	          	<div class="food_price">$<?php echo $product['price']; ?></div>
          </div>
          <div class="food_number col-3-12" foodId ="<?php echo $product['product_id']; ?>" >
          	  <div class="img_frame col-4-12" >
				<div class="helper"></div>
		  		<img class="minus_product product_number_<?php echo $product['quantity']; ?> minus_product_<?php echo $product['product_id']; ?> cart_operation" src="../catalog/view/theme/default/image/mobile/mobileMinus.png" restid="<?php echo $product['rest_id']; ?>" foodid="<?php echo $product['product_id']; ?>" />
		  	  </div>	          
	          <div class="product_number product_number_<?php echo $product['quantity']; ?> product_<?php echo $product['product_id']; ?> col-4-12" foodId="<?php echo $product['product_id']; ?>"><?php echo $product['quantity']; ?></div>
	          <div class="img_frame col-4-12" >
				<div class="helper"></div>
		  		<img class="add_product cart_operation" src="../catalog/view/theme/default/image/mobile/mobileAdd.png" restid="<?php echo $product['rest_id']; ?>" foodId="<?php echo $product['product_id']; ?>"/>
		  	  </div>	          
          </div>
          <div class="food_all_price col-2-12" >$<?php echo $product['total']; ?></div>
        </div>
<?php } ?>