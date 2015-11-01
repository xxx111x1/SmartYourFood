<?php echo $header;?>
<?php echo $review;?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sflist.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfdetail.css">
<script src="catalog/view/javascript/sfdetail.js" type="text/javascript"></script>
<script src="catalog/view/javascript/sfhome.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkvY-Zv3LB0uIoS-Yt4MMYyi0gug1ykCg&libraries=places&callback=initMap" async defer></script>

<div class="container">
	<input id="rest-id" type="hidden" value="<?php echo $rest_id; ?>" />
	<div class="rest-info">
		<img class="rest-img" src="<?php echo $restaurant['img_url']; ?>" />
		<div class="rest-detail">
			<div class="rest-basic">
				<div class="rest-name"><?php echo $restaurant['name']; ?></div>
				<!--<div class="rest-average">人均： <?php echo $restaurant['avg_cost']; ?></div>-->
			</div>
			<div class="rest-review">
				<div class="sf_product_stars stars" rate="<?php echo $restaurant['review_score']; ?>" ></div>
				<div class="rest-review-score"><?php echo $restaurant['review_score']; ?>分</div>
				<div class="rest-score-label">(我要评价)</div>
			</div>
			<div class="rest-contact">联系电话： <?php echo $restaurant['phone']; ?></div>
			<div class="rest-address">商户地址： <?php echo $restaurant['address']; ?></div>
			<div class="rest-workinghour">营业时间： <?php echo $restaurant['working_hour']; ?></div>
		</div>
		<div class="rest-distance-info">
			<!--
			<div class="info-col">
				<div class="info-value border-right">$5</div>
				<div class="info-label border-right">配送费</div>
			</div>
			-->
			<div class="info-col">
				<div class="info-value border-right">45min</div>
				<div class="info-label border-right">平均送达时间</div>
			</div>
			<div class="info-col">
				<div class="info-value"><?php echo $distance; ?>K</div>
				<div class="info-label">商家距离</div>
			</div>
		</div>
	</div>
    <div class="tabmenu">
        <div class="contenttab">
        	<div id="sepcial-tab" class="type_tab">特色菜品</div>
        	<div id="food-tab" class="type_tab">全部菜品</div>
        	<div id="back-tab" class="type_tab" url="<?php echo $return_url;?>">返回重选</div>                           
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
		<input type="hidden" id="sort" value="sort_default"/>
	</div>

	<div class=product_content>
		<input type=hidden id=page_number value=0 />
		<div class=product_area >
			
		</div>
	</div>
	<?php echo $backtop; ?>
</div>
<?php echo $footer;?>