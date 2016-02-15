<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery-ui.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/javascript/mobile/stars.js" type="text/javascript"></script>
<script src="catalog/view/javascript/mobile/sflist.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/list.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
</head>
<body>

<div class="header">
	<div class="img_frame tab_frame" >
		<span class="helper"></span>
	  	<img class="tab_icon" src="../catalog/view/theme/default/image/mobile/mobileRestDetailBack.png" />
	</div>
	<div id="order_tab" class="type_tab">        	
        <div class="tab_label"><?php echo $Order; ?></div>
 	</div>
	<div id="restaurant_tab" class="type_tab">
        <div class="tab_label"><?php echo $Selected_Restaurants; ?></div>
        <div class="img_frame tab_frame" >
			<span class="helper"></span>
	  		<img class="tab_icon" src="../catalog/view/theme/default/image/mobile/mobileHomeChooseRest.png" />
	  	</div>
	</div>

</div>

<div class="container">
	<input id="rest-id" type="hidden" value="<?php echo $rest_id; ?>" />
	<div class="rest-info">
		<img class="rest-img" src="<?php echo $restaurant['img_url']; ?>" />
		<div class="rest-detail">
			<div class="rest-basic">
				<div class="rest-name"><?php if($language=='en' && $restaurant['name_en'] != ''){echo $restaurant['name_en'];} else {echo $restaurant['name'];} ?></div>
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
				<div class="info-value"><?php echo $distance; ?>KM</div>
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