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
    
    <div class="filterarea"  style="display: none;">
    	<input type="hidden" id="filters" value="0"/>
    	<div class="filters">
    		<div class="filter_head">
    			<div class="filter_label_icon"></div>
    			<div class="filter_title">热门分类</div>
    		</div>
    		<div class="filter_content">
    			<div class="filteritem" id="filter_0" value="0">
					<div class="filtername"><?php echo $All; ?></div>
				</div>
		        <div class="filteritem" id="filter_1" value="1">
		            <div class="filtername" title="<?php echo $Chinese; ?>" ><?php echo $Chinese; ?></div>
		        </div>
		        <div class="filteritem" id="filter_2" value="2">
		            <div class="filtername" title="<?php echo $Spicy; ?>" ><?php echo $Spicy; ?></div>
		        </div>
		        <div class="filteritem" id="filter_3" value="3">
		            <div class="filtername" title="<?php echo $Chinese_Traditional; ?>" ><?php echo $Chinese_Traditional; ?></div>
		        </div>
		        <div class="filteritem" id="filter_4" value="4">
		            <div class="filtername" title="<?php echo $Deep_Fries; ?>" ><?php echo $Deep_Fries; ?></div>
		        </div>
		        <div class="filteritem" id="filter_5" value="5">
		            <div class="filtername" title="<?php echo $Noodle_Congee; ?>" ><?php echo $Noodle_Congee; ?></div>
		        </div>
		        <div class="filteritem" id="filter_6" value="6">           
		            <div class="filtername" title="<?php echo $Sushi; ?>" ><?php echo $Sushi; ?></div>
		        </div>
		        <div class="filteritem" id="filter_7" value="7">
		            <div class="filtername" title="<?php echo $Cantonese; ?>" ><?php echo $Cantonese; ?></div>
		        </div>
		        <div class="filteritem" id="filter_8" value="8">
		            <div class="filtername" title="<?php echo $Snack_Fast_Food; ?>" ><?php echo $Snack_Fast_Food; ?></div>
		        </div>
		        <div class="filteritem" id="filter_9" value="9">
		            <div class="filtername" title="<?php echo $Vegetarian; ?>" ><?php echo $Vegetarian; ?></div>
		        </div>
		        <div class="filteritem" id="filter_10" value="10">
		            <div class="filtername" title="<?php echo $Dessert_Drink; ?>" ><?php echo $Dessert_Drink; ?></div>
		        </div>
    		</div>
    	</div>
    </div>

	<div class="product_content">
		<input type='hidden' id="purchaseRest" value="<?php echo $rest_id;?>" />
		<input type="hidden" id="page_number" value="0" />
		<div class="product_area" >		
			
		</div>
	</div>	
</div>


<?php echo $footer;?>