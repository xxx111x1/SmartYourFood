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
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mediumfontstyle.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/common.css">
</head>

<body>
<div class="header">
	<div class="header-content">
	  <div id="logo"></div>
	  <div class="tag" id="go-to-rest"><?php echo $Home; ?></div>
	  <div class="tag" id="go-to-food"><?php echo $Food; ?></div>
	  <div class="tag" id="go-to-order"><?php echo $Order_Amount; ?></div>
	  <div class="language"><?php echo $Language; ?></div>
	  		<div class="dash">|</div>
	  		<div class="account">
		  		<?php if ($first_name) { ?>
		  			<?php if($first_name=='null') {?>
		  			<?php echo $Welcome; } else { ?>
		            	<?php echo $first_name ;?>
		            <?php }?>
		            <?php } else { ?>
		    		<a href="index.php?route=sfaccount/login"><?php echo $Login_Register; ?></a>
		        <?php } ?>  		
	  		</div>
		<a href="index.php?route=account/account">
	  		<div class="account-icon"></div>
		</a>
  	</div>  		
</div>

<div class="blankLine"></div>