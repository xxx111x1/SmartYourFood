<?php echo $header;?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sflist.css">
<script src="catalog/view/javascript/sflist.js" type="text/javascript"></script>
<script src="catalog/view/javascript/sfhome.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkvY-Zv3LB0uIoS-Yt4MMYyi0gug1ykCg&libraries=places&callback=initMap" async defer></script>

<div class="container">
	<div id="ads" >
		 <img class="advertisement active" id="showRestaurant" src="./catalog/view/theme/default/image/ads.gif"></img>
		 <img class="advertisement"  src="./catalog/view/theme/default/image/ads2.png"></img>
	</div>
    <div class="tabmenu">
        <div class="contenttab">
            <div id="restaurant_tab" class="type_tab"><?php echo $Selected_Restaurants; ?></div>
            <div id="food_tab" class="type_tab"><?php echo $Selected_Food; ?></div>
            <!--<div class="type_tab">猜你喜欢</div>-->
        </div>
		<div class="search-bar">
			<input id="searchType" type="hidden" value="food" />
  			<input id="pac-input" class="controls" type="text" placeholder="<?php echo $address ; ?>" />
  			<div id="dropdown"></div>
  			<input id="serach-input" class="controls" type="text" placeholder="<?php echo $Search_Restaurant_name_Food_Keywords; ?>" />
  			<div id="search-button"><?php echo $Go; ?></div>
  			<div class="history-addresses hide">
  				<div id="history-label">历史记录</div>
  				<?php if($history_address) {?>
  				<?php foreach ($history_address as $address) { ?>
					<div class='address' lat='<?php echo $address['lat']; ?>' lng='<?php echo $address['lng']; ?>'><?php echo $address['address']; ?></div>	
				<?php } } ?>
  			</div>
  		</div>
    </div>   
    
    <div class="filterarea">
    	<input type="hidden" id="filters" value="0"/>
        <div class="filterlabel"><?php echo $Categories; ?></div>
        <div class="filteritem" id="filter_0" value="0">
			<div class="filtername"><?php echo $All; ?></div>
		</div>
        <div class="filteritem" id="filter_1" value="1">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/zhongcanoff.png)"></div>
            <div class="filtername"><?php echo $Chinese; ?></div>
        </div>
        <div class="filteritem" id="filter_2" value="2">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/chuancaioff.png)"></div>
            <div class="filtername"><?php echo $Spicy; ?></div>
        </div>
        <div class="filteritem" id="filter_3" value="3">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/xiangcaioff.png)"></div>
            <div class="filtername" ><?php echo $Chinese_Traditional; ?></div>
        </div>
        <div class="filteritem" id="filter_4" value="4">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/xicanoff.png)"></div>
            <div class="filtername" ><?php echo $Deep_Fries; ?></div>
        </div>
        <div class="filteritem" id="filter_5" value="5">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/hancanoff.png)"></div>
            <div class="filtername" ><?php echo $Noodle_Congee; ?></div>
        </div>
        <div class="filteritem" id="filter_6" value="6">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/ricanoff.png)"></div>
            <div class="filtername" ><?php echo $Sushi; ?></div>
        </div>
        <div class="filteritem" id="filter_7" value="7">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/gangshioff.png)"></div>
            <div class="filtername" ><?php echo $Cantonese; ?></div>
        </div>
        <div class="filteritem" id="filter_8" value="8">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/zaochaoff.png)"></div>
            <div class="filtername" ><?php echo $Snack_Fast_Food; ?></div>
        </div>
        <div class="filteritem" id="filter_9" value="9">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/zhajioff.png)"></div>
            <div class="filtername" ><?php echo $Deep_Fries; ?></div>
        </div>
        <div class="filteritem" id="filter_10" value="10">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/tiandianoff.png)"></div>
            <div class="filtername" ><?php echo $Dessert_Drink; ?></div>
        </div>
        <div class="filteritem" id="filter_11" value="11">
            <div class="filtericon" style="background-image: url(./catalog/view/theme/default/image/bingjilingoff.png)"></div>
            <div class="filtername" >冰激凌</div>
        </div>
    </div>
    
	<div class=sort_option>
		<div class="sortlabel glyphicon"><?php echo $Filter; ?>:</div>
		<span class="sort_field glyphicon sort_selected" id="sort_default" ><?php echo $Default; ?></span>
		<span class="sort_field glyphicon down_arrow_icon" id="sell_number" ><?php echo $Popular; ?></span> 
		<span class="sort_field glyphicon down_arrow_icon" id="review_score" ><?php echo $Comments; ?></span>
		<span class="sort_field glyphicon up_arrow_icon" id="send_time" ><?php echo $Delivery_Time; ?></span>		
		<input type="hidden" id="sort" value="sort_default"/>
	</div>

	<div class=product_content>
		<input type=hidden id=page_number value=0 />
		<div class=product_area ></div>
	</div>
	<?php echo $backtop; ?>
</div>
<?php echo $footer;?>