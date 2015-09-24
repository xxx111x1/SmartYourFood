<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/default/stylesheet/sfcommon.css" rel="stylesheet">
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
</head>

<body>
<div class="header">
	<div class="header-content">
	  <div id="logo"></div>
	  <div class="tag">首页</div>
	  <div class="tag">我的订单</div>
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
	  <div class="account-icon"></div>
  	</div>  		
</div>
