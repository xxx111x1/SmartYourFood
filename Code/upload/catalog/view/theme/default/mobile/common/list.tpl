<?php echo $header;?>
<script src="catalog/view/javascript/mobile/stars.js" type="text/javascript"></script>
<!--<script src="catalog/view/javascript/mobile/sflist.js" type="text/javascript"></script>-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/list.css">
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
			<div class="product product_rest" restid="0">
			<div class="img_frame product_frame" >
					<span class="helper"></span>
					<img class="preview" src="http://img.epochtimes.com/i6/1105290902081983.jpg" alt="Image not found" onerror="onDishImgError(this)" />
				</div>
				<div class="rest_description">
					<div class="product_name" title="龙顺园">龙顺园</div>
					<div class="sf_product_stars stars" rate="4.00">
						<span />
					</div>
					<div class="product_price col-1-1">均价：$ 12.50</div>
					<div class="extra_info">北方菜 | 90分钟内送达</div>
				</div>
				<div class="go_to_rest img_frame col-1-12">
					<span class="helper"></span>
					<img class="preview" src="../catalog/view/theme/default/image/mobile/mobileGotoGrey.png"/>
				</div>
		</div>
		</div>
	</div>	
</div>

<?php echo $footer;?>