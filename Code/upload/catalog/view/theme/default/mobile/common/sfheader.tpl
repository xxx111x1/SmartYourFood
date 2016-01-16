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
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/headerAndFooter.css">
</head>

<body>
<div class="header col-1-1">
	<div id="categoryImg" >
		<span class="helper"></span>
		<img class="headerImg" src="../catalog/view/theme/default/image/mobile/mobileMore.png" height="20" />		
	</div>
	<div class="labelFrame">
		<div id="categoryLabel" class="label"><?php echo $Category; ?></div>
	</div>	
	<div class="imgFrame placeImg">
		<span class="helper"></span>
		<img class="headerImg" src="../catalog/view/theme/default/image/mobile/mobilePlace.png" />
	</div>
	<div class="labelFrame">
		<div id="addressname" class="label">Just test</div>
	</div>	
	<div class="imgFrame">
		<span class="helper"></span>
		<img class="headerImg" src="../catalog/view/theme/default/image/mobile/mobileGoto.png" />
	</div>	
	<div class="imgFrameRight col-1-12">
		<span class="helper"></span>
		<img class="headerImg" id="search" class="col-1-12" src="../catalog/view/theme/default/image/mobile/mobileSearch.png"/>
	</div>	
</div>