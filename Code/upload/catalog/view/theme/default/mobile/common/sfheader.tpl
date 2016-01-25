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
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/headerAndFooter.css">
</head>

<body>
<div class="header col-1-1">
	<div id="category_img" >
		<span class="helper"></span>
		<img class="header_img" src="../catalog/view/theme/default/image/mobile/mobileMore.png" height="20" />		
	</div>
	<div class="label_frame">
		<div id="categoryLabel" class="label"><?php echo $Category; ?></div>
	</div>	
	<div class="img_frame place_img">
		<span class="helper"></span>
		<img class="header_img" src="../catalog/view/theme/default/image/mobile/mobilePlace.png" />
	</div>
	<div class="label_frame">
		<div id="address_name" class="label">Just test</div>
	</div>	
	<div class="img_frame">
		<span class="helper"></span>
		<img class="header_img" src="../catalog/view/theme/default/image/mobile/mobileGoto.png" />
	</div>	
	<div class="img_frame_right col-1-12">
		<span class="helper"></span>
		<img class="header_img" id="search" class="col-1-12" src="../catalog/view/theme/default/image/mobile/mobileSearch.png"/>
	</div>	
</div>