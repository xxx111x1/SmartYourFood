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
				<div class="rest-score-label">(<?php echo $Comment_Here ;?>)</div>
			</div>
			<div class="rest-contact"><?php echo $ContactNumber ;?>： <?php echo $restaurant['phone']; ?></div>
			<div class="rest-address"><?php echo $RestaurantAddress ;?>： <?php echo $restaurant['address']; ?></div>
			<div class="rest-workinghour"><?php echo $BusinessHours ;?>： <?php echo $restaurant['working_hour']; ?></div>
		</div>
		<div class="rest-distance-info">
			<div class="info-col">
				<div class="info-value border-right">45min</div>
				<div class="info-label border-right"><?php echo $Averagearrivaltime ;?></div>
			</div>
			<div class="info-col">
				<div class="info-value"><?php echo $distance; ?>K</div>
				<div class="info-label"><?php echo $Distance ;?></div>
			</div>
		</div>
	</div>
    <div class="tabmenu">    
		<div class="search-bar">
			<input id="searchType" type="hidden" value="food" />
  			<input id="pac-input" class="controls" type="text" placeholder="<?php echo $address ; ?>" />
  			<div id="dropdown"></div>
  			<input id="serach-input" class="controls" type="text" placeholder="<?php echo $Search_Restaurant_name_Food_Keywords; ?>" />
  			<div id="search-button"><?php echo $Go; ?></div>
  			<div class="history-addresses hide">
  				<div id="history-label"><?php echo $History_Record;?></div>
  				<?php if($history_address) {?>
  				<?php foreach ($history_address as $address) { ?>
					<div class='address' lat='<?php echo $address['lat']; ?>' lng='<?php echo $address['lng']; ?>'><?php echo $address['address']; ?></div>	
				<?php } } ?>
  			</div>
  		</div>
    </div>   
    
    
    <div class="tagarea">
        	<div class="tagitem" value="0"><?php echo $All; ?></div>	
	    	<?php foreach ($tags as $tag) { ?>
				<div class="tagitem" value="<?php echo $tag['tag_id'];?>"><?php if($language == 'en') { echo $tag['tag_name_en'];} else {echo $tag['tag_name_cn'];} ?></div>	
			<?php } ?>	       
	    </div>
	        
	<div class=sort_option>
		<div class="sortlabel glyphicon"><?php echo $Filter; ?>:</div>
		<span class="sort_field glyphicon sort_selected" id="sort_default" ><?php echo $Default; ?></span>
		<span class="sort_field glyphicon down_arrow_icon" id="sell_number" ><?php echo $Popular; ?></span> 
		<span class="sort_field glyphicon down_arrow_icon" id="review_score" ><?php echo $Comments; ?></span>
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