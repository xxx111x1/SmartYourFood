<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $Log_In; ?></title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/login.css">
    <script type="text/javascript" src="/catalog/view/javascript/jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/catalog/view/javascript/mobile/autoFitScreen.js"></script>
    
</head>
<body>
	<div class="logo col-8-12">
		<img class="col-1-1" src="../catalog/view/theme/default/image/mobile/mobileLogoCn.png" />
	</div>
    
    <div class="login_section col-1-1">
    	<form class="col-1-1" method="post" id="login_form">
            <input type="hidden" id="redirect" name="redirect" value="<?php echo $redirect;?>"/>
            <div class="col-1-1 input_line">
            	<div class="col-1-12 input_icon">
            		<img class="col-1-1" src="../catalog/view/theme/default/image/mobile/mobileLoginPhone.png" />
            	</div>
            	<input class="col-8-12 login_input" id="phonenum" name="phonenumber" placeholder="<?php echo $Cellphone; ?>"/>
            </div>
            <div class="col-1-1 input_line">
            	<div class="col-1-12 input_icon">
            		<img class="col-1-1" src="../catalog/view/theme/default/image/mobile/mobileLoginKey.png" />
            	</div>
            	<input class="col-8-12 login_input" id="password" name="password" type="password" placeholder="<?php echo $Enter_a_Password; ?>"/>
            </div>
            <button class="col-1-1"><?php echo $Sign_In; ?></button>
        </form>
    </div>
    <div class="col-2-12">
    	<a href="index.php?route=sfaccount/register" class="push-1-12 bottom_nav float-left"><?php echo $Quick_Register;?></a>
    </div>
</body>
</html>