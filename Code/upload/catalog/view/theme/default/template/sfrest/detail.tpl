<?php echo $header;?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sflist.css">
<script src="catalog/view/javascript/sfdetail.js" type="text/javascript"></script>
<script src="catalog/view/javascript/sfhome.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkvY-Zv3LB0uIoS-Yt4MMYyi0gug1ykCg&libraries=places&callback=initMap" async defer></script>

<div class="container">
	<img class="advertisement" src="./catalog/view/theme/default/image/ads.gif"></img>
    <div class="tabmenu">
        <div class="contenttab">
        	<div id="food-tab" class="type_tab">全部菜品</div>
            <div id="review-tab" class="type_tab">评价</div>            
        </div>
		<div class="search-bar">
			<input id="searchType" type="hidden" value="food" />
  			<input id="pac-input" class="controls" type="text" placeholder="<?php echo $address ; ?>" />
  			<div id="dropdown"></div>
  			<input id="serach-input" class="controls" type="text" placeholder="请输入餐馆、菜品关键字" />
  			<div id="search-button">快速查找</div>
  			<div class="history-addresses hide">
  				<div id="history-label">历史记录</div>
  				<?php if($history_address) {?>
  				<?php foreach ($history_address as $address) { ?>
					<div class='address' lat='<?php echo $address['lat']; ?>' lng='<?php echo $address['lng']; ?>'><?php echo $address['address']; ?></div>	
				<?php } } ?>
  			</div>
  		</div>
    </div>   
        
	<div class=sort_option>
		<div class="sortlabel glyphicon">排序:</div>
		<span class="sort_field glyphicon sort_selected" id="sort_default" >默认</span>
		<span class="sort_field glyphicon down_arrow_icon" id="sell_number" >销量</span> 
		<span class="sort_field glyphicon down_arrow_icon" id="review_score" >评价</span>
		<span class="sort_field glyphicon up_arrow_icon" id="send_time" >配送时间</span>		
		<input type="hidden" id="sort" value="sort_default"/>
	</div>

	<div class=product_content>
		<input type=hidden id=page_number value=0 />
		<div class=product_area >
			<?php foreach ($foods as $food) { ?>
				<div class="product">
					<div class="thumb" id="<?php echo $food['food_id']; ?>">
						<img class="thumb_preview" src="<?php echo $food['img_url']; ?>" />
						<div class="thumboverlay" style="display: none;">
							<div class="thumb_add2cart" foodId="<?php echo $food['food_id']; ?>" id="food_<?php echo $food['food_id']; ?>_number" number="<?php echo $food['cart_number']; ?>"> 添加到餐车</div>
						</div>
					</div>
					<div class="thumb_desc">
						<div class="thumb_desc_foodname"><?php echo $food['name']; ?></div>
						<div class="thumb_desc_restname" >餐馆 <?php echo $restaurant['name']; ?></div>
						<div class="thumb_desc_restdist">距离-KM</div>
						<div class="thumb_desc_productinfo">
							<div class="thumb_desc_productfav"><?php echo $food['review_score']; ?></div>
							<div class="thumb_desc_productprice">C$ <?php echo $food['price']; ?></div>
						</div>
					</div>	
				</div>
			<?php }  ?>
		</div>
	</div>
	<?php echo $backtop; ?>
</div>
<?php echo $footer;?>