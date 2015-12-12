<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Usays</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfhome.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/sfhome.js?<?php echo $random;?>" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkvY-Zv3LB0uIoS-Yt4MMYyi0gug1ykCg&libraries=places&language=en&callback=initMap&rd=<?php echo $random;?>" defer></script>
    <script src="catalog/view/javascript/language.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mediumfontstyle.css">
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/common.css">
  </head>
  <body>
  	<div class="header">
  		<div class="language"><?php echo $Language; ?></div>
  		<div class="dash">|</div>
  		<div class="account">
	  		<?php if ($first_name) { ?>
	  			<?php if($first_name=='null') { ?>
	  			<?php echo $Welcome; } else { ?>
	            	<a href="index.php?route=account/account" style="text-decoration: none;"> <?php echo $first_name ;?></a>
	            <?php }?>
	            <?php } else { ?>
	    		<a href="index.php?route=sfaccount/login"><?php echo $Login_Register; ?></a>
	        <?php } ?>
  		</div>
		<a href="index.php?route=sfaccount/login">
  			<div class="account-icon"></div>
		</a>
  	</div>
  	<div class="content">
  		<div class="search-bar">
  			<input id="searchType" type="hidden" value="food" />
  			<div id="mapSelect" >
            </div>
  			<input id="pac-input" class="controls" type="text" placeholder="<?php echo $address ; ?>" />
  			<div id="dropdown"></div>
  			<input id="serach-input" class="controls" type="text" placeholder="<?php echo $Search_Restaurant_name_Food_Keywords; ?>" />
  			<!--<div id="search-button"><span><?php echo $Search; ?></span></div>-->
            <div id="search-button"><button class="btn-search"><?php echo $Search; ?></button></div>
  			<div class="history-addresses hide">
  				<div id="history-label"><?php echo $History; ?></div>
  				<?php if($history_address) {?>
  				<?php foreach ($history_address as $address) { ?>
					<div class='address' lat='<?php echo $address['lat']; ?>' lng='<?php echo $address['lng']; ?>'><?php echo $address['address']; ?></div>
				<?php } } ?>
  			</div>
  		</div>


        <div id="first-honey-point">
            <div class="tip-content"><a href="index.php?route=common/list&type=food"><?php echo $More_Dishes; ?></a></div>
        </div>

  		<div id="second-honey-point">
            <div class="tip-content"><a href="index.php?route=common/list&type=restaurant"><?php echo $Selected_Restaurants; ?></a></div>
  		</div>
  	</div>
    <div id="bottom_part">

        <div id="bottom_center">
            <?php foreach ($foods as $food) { ?>
            <div class="bottom_item" restid="<?php echo $food['restaurant_id']; ?>" foodid="<?php echo $food['food_id'] ;?>">
                <div class="bottom_out_circle">
                    <div class="bottom_inner_circle" style="background-image: url('<?php echo $food['img_url'] ;?>');" restid="<?php echo $food['restaurant_id']; ?>" foodid="<?php echo $food['food_id'] ;?>">

                    </div>
                </div>
                <div class="bottom_label hide">
                    推荐美食
                </div>
                <div class="bottom_desc_area">
                    <div class="bottom_food_name">
                        <?php if($lang == 'en' && isset($food['food_name_en'])) {echo $food['food_name_en'];} else {echo $food['food_name'];}?>
                    </div>
                    <div class="bottom_rest_name">
                        Dragon House 龙顺园
                    </div>
                </div>
                <div class="buy-cart hide">

                </div>
            </div>
            <?php } ?>

        </div>

    </div>
</body></html>