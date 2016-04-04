<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $My_Account; ?></title>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery-ui.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/javascript/mobile/sfheader.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/list.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/accountHeader.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/headerAndFooter.css">
</head>

<body>
<div class="col-1-1 accoount_header initial_content">
	<div class="img_frame col-2-12" >
		<span class="helper"></span>
		<img class="account_img" src="../catalog/view/theme/default/image/mobile/mobileAccountPerson.png"/>		
	</div>
	<div class="account_label_frame col-4-12">
		<div class="accoount_label account_name"><?php echo $first_name; ?></div>
		<a class="accoount_label log_out" href="index.php?route=common/sfhome&logout=1" >[<?php echo $Log_Out; ?>]</a>
	</div>	
	
	<div class="account_label_frame col-4-12">
		<div id="address_name" class="type_label"><?php echo $Primary_Fooder; ?></div>
	</div>	
	<div class="img_frame place_img col-2-12">
		<span class="helper"></span>
		<img class="header_img" src="../catalog/view/theme/default/image/mobile/mobileAccountLevel1.png" />
	</div>
</div>
<script type="text/javascript" src="catalog/view/javascript/mobile/account_ui.js"></script>
<div class="content_bar initial_content">
	<div class="select_bars">
	    <div class="item_bar" id="updateaddress" >
	    	<div class="img_frame col-2-12" >
				<span class="helper"></span>
				<img class="bar_img col-4-12" src="../catalog/view/theme/default/image/mobile/mobileAccountPlace.png"/>		
			</div>			
			<div class="col-9-12" title="<?php echo $Address_Management ;?>" style="float:left;">
			<div class="bar_label"><?php echo $Address_Management ;?></div></div>
			<div class="img_frame col-1-12" >
				<span class="helper"></span>
				<img class="col-4-12 goto_img" src="../catalog/view/theme/default/image/mobile/mobileGotoGrey.png"/>		
			</div>			
	    </div>
	    <div class="item_bar" id="orderhistory" >
	    	<div class="img_frame col-2-12" >
				<span class="helper"></span>
				<img class="bar_img col-4-12" src="../catalog/view/theme/default/image/mobile/mobileTime.png"/>		
			</div>			
			<div class="col-9-12" title="<?php echo $HistoryOrders ;?>" style="float:left;">
			<div class="bar_label"><?php echo $HistoryOrders ;?></div></div>
			<div class="img_frame col-1-12" >
				<span class="helper"></span>
				<img class="col-4-12 goto_img" src="../catalog/view/theme/default/image/mobile/mobileGotoGrey.png"/>		
			</div>			
	    </div>
	    <div class="item_bar" id="updateaccount" >
	    	<div class="img_frame col-2-12" >
				<span class="helper"></span>
				<img class="bar_img col-4-12" src="../catalog/view/theme/default/image/mobile/mobileEdit.png"/>		
			</div>			
			<div class="col-9-12" title="<?php echo $Change_Account_Information ;?>" style="float:left;">
			<div class="bar_label"><?php echo $Change_Account_Information ;?></div></div>
			<div class="img_frame col-1-12" >
				<span class="helper"></span>
				<img class="col-4-12 goto_img" src="../catalog/view/theme/default/image/mobile/mobileGotoGrey.png"/>		
			</div>			
	    </div>
	</div>
	
	<div class="select_bars">
	     <div class="item_bar" id="updateaccount" >
	    	<div class="img_frame col-2-12" >
				<span class="helper"></span>
				<img class="bar_img col-4-12" src="../catalog/view/theme/default/image/mobile/mobileAccountAbout.png"/>		
			</div>			
			<div class="col-9-12" title="<?php echo $About ;?>" style="float:left;">
			<div class="bar_label"><?php echo $About ;?></div></div>
			<div class="img_frame col-1-12" >
				<span class="helper"></span>
				<img class="col-4-12 goto_img" src="../catalog/view/theme/default/image/mobile/mobileGotoGrey.png"/>		
			</div>			
	    </div>
	</div>
</div>

<div class="content_modify" style="display: none;">
	<div class="sub_header col-1-1">
		<div id="back_initial_content" class="img_frame col-3-12" >
			<span class="helper"></span>
		  	<img class="back_img" src="../catalog/view/theme/default/image/mobile/mobileBack.png" />
		</div>
		<div class="col-7-12 sub_header_title">        	
	        <div id="header_title">关于悠选</div>
	 	</div>
	</div>
	
	<div class="sub_content">
	    <div class="edit_content" id="updateaddress_">
	        <?php echo $addresses;?>
	    </div>
	    <div class="edit_content" id="updateaccount_">
	        <?php echo $profile;?>
	    </div>
	    <div class="edit_content" id="orderhistory_">
	        <?php echo $orderhistory;?>
	    </div>	    
	</div>
</div>

<?php echo $footer;?>