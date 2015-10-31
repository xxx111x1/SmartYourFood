<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfhome.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkvY-Zv3LB0uIoS-Yt4MMYyi0gug1ykCg&libraries=places&callback=initMap" async defer></script>
    <script src="catalog/view/javascript/sfhome.js" type="text/javascript"></script>    
  </head>
  <body>
  	<div class="header">
  		<div class="language">English</div>
  		<div class="dash">|</div>
  		<div class="account">
	  		<?php if ($first_name) { ?>
	  			<?php if($first_name=='null') { ?>
	  			<?php echo "欢迎光临"; } else { ?>
	            	<a href="index.php?route=account/account" style="text-decoration: none;"> <?php echo $first_name ;?></a>
	            <?php }?>
	            <?php } else { ?>
	    		<a href="index.php?route=sfaccount/login">登陆/注册</a>
	        <?php } ?>  		
  		</div>
		<a href="index.php?route=sfaccount/login">
  			<div class="account-icon"></div>
		</a>
  	</div>
  	<div class="content">
  		<div class="search-bar">
  			<input id="searchType" type="hidden" value="food" />
  			<input id="pac-input" class="controls" type="text" placeholder="<?php echo $address ; ?>" />
  			<div id="dropdown"></div>
  			<input id="serach-input" class="controls" type="text" placeholder="请输入餐馆、菜品关键字" />
  			<div id="search-button">查找美食</div>
  			<div class="history-addresses hide">
  				<div id="history-label">历史记录</div>
  				<?php if($history_address) {?>
  				<?php foreach ($history_address as $address) { ?>
					<div class='address' lat='<?php echo $address['lat']; ?>' lng='<?php echo $address['lng']; ?>'><?php echo $address['address']; ?></div>	
				<?php } } ?>
  			</div>
  		</div>  		  		
  		<div class="click-point-first"></div>
  		<div class="first-info">
	  		<div class="first-triangle-left"> </div>
	  		<div class="first-tip">
	  			<div class="first-tip-content"><a href="index.php?route=common/list">更多美食</a></div>
	  		</div>
  		</div>
  		
  		<div class="click-point-second"></div>
  		<div class="second-info">
  			<div class="second-triangle-left"> </div>
	  		<div class="second-tip">
	  			<div class="second-tip-content"><a href="index.php?route=common/list&type=restaurant">精品餐馆</a></div>
	  		</div>
  		</div>
  	</div>
  	<div class="special-foods">
  		<div class="foods-content">
  			<?php foreach ($foods as $food) { ?>
				<div class="food" restid="<?php echo $food['restaurant_id']; ?>" foodid="<?php echo $food['food_id'] ;?>">
	  				<div class="food-background">
	  					<div class="food-thumb" style="background-image: url('<?php echo $food['img_url'] ;?>'); backgournd-repeat: no-repeat;background-size: 140px 140px;">
	  					</div>
  					</div>
  					<div class="food-hover-content hide">推荐美食</div>
  					<div class="food-name"><?php echo $food['food_name'];?></div>
					<div class="food-desc">(配米饭*2)</div>
  					<div class="food-desc">Dragon House 龙顺园</div>
  					<div class="buy-cart hide" ></div>  					
  				</div>
			<?php } ?>  				
  		</div>
  	</div>    
  </body>
</html>