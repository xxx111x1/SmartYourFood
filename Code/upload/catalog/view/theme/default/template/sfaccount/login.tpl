<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo $Log_In; ?></title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/reg.css">
    <script type="text/javascript" src="/catalog/view/javascript/jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/catalog/view/javascript/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="/catalog/view/javascript/register.js"></script>
    <link href="/catalog/view/javascript/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/catalog/view/javascript/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="/catalog/view/javascript/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/catalog/view/javascript/jquery/google-code-prettify/prettify.css" rel="stylesheet">
</head>
    <a href="/">
        <div id="gotohome" style="color: white; font-size: 64px;font-weight: bolder;position: absolute;margin-top: 140px;margin-left: 150px; text-decoration: none;text-decoration-line: none">
            <img src="/catalog/view/theme/default/image/youxuan.png"/>
        </div>
    </a>
<div id="welcome" class="welcome owl-carousel owl-theme" style="width: 540px;height: 330px">
    <div class="item">
        <line>Welcome to</line>
        <p style="float: right;margin-right: 100px; margin-bottom: 30px"><span>U-Says</span></p>
        <p style="font-size: 24px;margin-top: 0px;clear: both">Hungry? Empty fridge or no time to cook? You've come to the right place!</p>
    </div>
    <div class="item">
        <line>Welcome to</line>
        <p style="float: right;margin-right: 100px; margin-bottom: 30px"><span>U-Says</span></p>
        <p style="font-size: 24px;margin-top: 0px;clear: both">Our website helps foodies spend less time wondering what to eat and more time enjoying food.</p>
    </div>
    <div class="item">
        <line>Welcome to</line>
        <p style="float: right;margin-right: 100px; margin-bottom: 30px"><span>U-Says</span></p>
        <p style="font-size: 24px;margin-top: 0px;clear: both">We're here to help you make choices that satisfy your palette</p>
    </div>
</div>
<div class="regarea">
    <!--<div style="background-color: #FA7171;margin-top: 0px;width: 100%;height: 8px;border-top-left-radius: 5px;border-top-right-radius: 5px;"></div>-->
    <div style="padding-top: 36px;padding-bottom: 32px; font-size: 32px;font-weight: bolder; margin-left: 175px">
        <?php echo $Log_In; ?>
    </div>
    <div style="margin-left: 30px;color: #f65053;<?php if(!$validfailed) echo 'display:none;';?>">*用户名或密码错误</div>
    <form method="post" id="loginform">
    	<input type="hidden" id="redirect" name="redirect" value="<?php echo $redirect;?>"/>
        <div class="regitem">
            <div class="regtips">
                <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/mobile_icon.png);">
                </div>
            </div>
            <input class="reg_input" id="phonenum" name="phonenumber" placeholder="<?php echo $Phone_Number; ?>"/>
        </div>
        <div class="regitem">
            <div class="regtips">
                <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                </div>
            </div>
            <input class="reg_input" id="password" name="password" type="password" placeholder="<?php echo $Enter_a_Password; ?>"/>
        </div>
        <a href="#" onclick="loginsubmit();" style="text-decoration: none">
        <div class="reg_btn" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
             <span><?php echo $Log_In; ?></span>
        </div>
        </a>
    </form>

    <div class="regtxt">
        <span style="font-weight: bold"></span><a href="/index.php?route=sfaccount/register" style="text-decoration: none"><span style="color: #f94e4e;font-weight: bold"><?php echo $Register_here; ?></span></a>
    </div>

</div>
</body>
</html>