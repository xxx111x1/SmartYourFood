<!DOCTYPE html>
<html>
<head lang="<?php echo $lang; ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $Log_In; ?></title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/login.css">
    <script type="text/javascript" src="/catalog/view/javascript/jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/catalog/view/javascript/mobile/register.js"></script>
    
</head>
<body>
	<div class="logo col-8-12">
		<img class="col-1-1" src="../catalog/view/theme/default/image/mobile/mobileLogoCn.png" />
	</div>
    
    <div class="login_section col-1-1">
    	<div style="margin-left: 30px;color: #f65053;<?php if(empty($error)) echo 'display:none;';?>"><?php if(!empty($error)) echo '*'.$error;?></div>
    	<form class="col-1-1" method="post" id="login_form">
            <div class="col-1-1 input_line">
            	<div class="col-1-12 input_icon">
            		<img class="col-1-1" src="../catalog/view/theme/default/image/mobile/mobileLoginName.png" />
            	</div>
            	<input class="col-8-12 login_input" id="accountname" name="accountname" placeholder="<?php echo $Your_Name; ?>"/>
            </div>
            <div class="col-1-1 input_line">
            	<div class="col-1-12 input_icon">
            		<img class="col-1-1" src="../catalog/view/theme/default/image/mobile/mobileLoginPhone.png" />
            	</div>
            	<input class="col-8-12 login_input" id="phonenumber" name="phonenumber" placeholder="<?php echo $Cell_Phone_Number; ?>"/>
            </div>
            <div class="col-1-1 input_line">
            	<div class="col-1-12 input_icon">
            		<img class="col-1-1" src="../catalog/view/theme/default/image/mobile/mobileLoginKey.png" />
            	</div>
            	<input class="col-8-12 login_input" id="pwd_1st" name="pwd_1st" type="password" placeholder="<?php echo $Enter_a_Password; ?>"/>
            </div>
            <div class="col-1-1 input_line">
            	<div class="col-1-12 input_icon">
            		<img class="col-1-1" src="../catalog/view/theme/default/image/mobile/mobileLoginKey.png" />
            	</div>
            	<input class="col-8-12 login_input" id="pwd_2nd" name="pwd_2nd" type="password" placeholder="<?php echo $Enter_Password_Again; ?>"/>
            </div>
            <button class="col-1-1" onclick="regsubmit()"><?php echo $Register; ?></button>
        </form>
    </div>
    <div class="col-4-12">
    	<a href="index.php?route=sfaccount/login" class="push-1-12 bottom_nav float-left"><?php echo $Already_on_Usays; ?></a>
    </div>
</body>
</html>
