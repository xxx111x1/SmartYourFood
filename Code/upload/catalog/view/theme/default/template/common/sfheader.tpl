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
<link href="catalog/view/theme/default/stylesheet/sfcommon.css" rel="stylesheet">
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/javascript/sfheader.js" type="text/javascript"></script>
</head>

<body>
<div class="header">
	<div class="header-content">
	  <div id="logo"></div>
	  <div class="tag" id="go-to-home">首页</div>
	  <div class="tag" id="go-to-food">美食</div>
	  <div class="tag" id="go-to-order">订单结算</div>
	  <div class="language">English</div>
	  		<div class="dash">|</div>
	  		<div class="account">
		  		<?php if ($first_name) { ?>
		  			<?php if($first_name=='null') {?>
		  			<?php echo "欢迎光临"; } else { ?>
		            	<?php echo $first_name ;?>
		            <?php }?>
		            <?php } else { ?>
		    		<a href="index.php?route=sfaccount/login">登陆/注册</a>
		        <?php } ?>  		
	  		</div>
		<a href="index.php?route=account/account">
	  		<div class="account-icon"></div>
		</a>
  	</div>  		
</div>
