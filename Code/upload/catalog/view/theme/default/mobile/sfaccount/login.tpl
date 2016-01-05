<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo $Log_In; ?></title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/login.css">
    <script type="text/javascript" src="/catalog/view/javascript/jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/catalog/view/javascript/mobile/autoFitScreen.js"></script>
    
</head>
<body>
    <div class="logo col-8-12"></div>
    <div class="loginSection col-1-1">
    	<form class="col-1-1" method="post" id="loginform">
            <input type="hidden" id="redirect" name="redirect" value="<?php echo $redirect;?>"/>
            <div class="col-1-1 inputLine">
            	<div class="col-1-12 inputIcon phoneIcon"></div>
            	<input class="col-8-12 loginInput" id="phonenum" name="phonenumber" placeholder="<?php echo $Cellphone; ?>"/>
            </div>
            <div class="col-1-1 inputLine">
            	<div class="col-1-12 inputIcon keyIcon"></div>
            	<input class="col-8-12 loginInput" id="password" name="password" type="password" placeholder="<?php echo $Enter_a_Password; ?>"/>
            </div>
            <button class="col-1-1"><?php echo $Sign_In; ?></button>
        </form>
    </div>
    <div class="col-2-12">
    	<a href="" class="push-1-12 bottomNav float-left"><?php echo $Quick_Register;?></a>
    </div>
</body>
</html>