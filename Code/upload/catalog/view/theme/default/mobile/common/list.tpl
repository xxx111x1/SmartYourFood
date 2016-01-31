<?php echo $header;?>
<script src="catalog/view/javascript/mobile/stars.js" type="text/javascript"></script>
<script src="catalog/view/javascript/mobile/sflist.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/list.css">
<div class="cart_background" style="display: none;"></div>

<div class="container">
	<div id="ads" >
		 <img class="advertisement col-1-1" id="show_restaurant" src="../catalog/view/theme/default/image/mobile/Ad1.jpg"></img>
	</div>
    <div class="tabmenu">
        <div id="restaurant_tab" class="type_tab">
        	<div class="tab_label"><?php echo $Selected_Restaurants; ?></div>
        	<div class="img_frame tab_frame" >
				<span class="helper"></span>
	  			<img class="tab_icon" src="../catalog/view/theme/default/image/mobile/mobileHomeChooseRest.png" />
	  		</div>
	  	</div>
        <div id="food_tab" class="type_tab">        	
        	<div class="tab_label"><?php echo $Selected_Food; ?></div>
        	<div class="img_frame tab_frame" >
				<span class="helper"></span>
	  			<img class="tab_icon" src="../catalog/view/theme/default/image/mobile/mobileHomeChooseFood.png" />
	  		</div>
 	    </div>
            <!--<div class="type_tab">猜你喜欢</div>-->
    </div>  

	<div class="product_content">
		<input type='hidden' id="purchaseRest" value="<?php echo $rest_id;?>" />
		<input type="hidden" id="page_number" value="0" />
		<div class="product_area" >		
			
		</div>
	</div>	
</div>


<?php echo $footer;?>