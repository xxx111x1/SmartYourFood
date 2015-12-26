<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo $Register; ?></title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/reg.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/simplegrid.css">
    <script type="text/javascript" src="/catalog/view/javascript/jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/catalog/view/javascript/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="/catalog/view/javascript/register.js"></script>
    <link href="/catalog/view/javascript/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/catalog/view/javascript/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="/catalog/view/javascript/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/catalog/view/javascript/jquery/google-code-prettify/prettify.css" rel="stylesheet">
</head>
<body>
    <div class="push-2-12 col-4-12" style="float: left">
        <div id="gotohome">
            <a href="/"> <img src="/catalog/view/theme/default/image/youxuan.png" style="margin-left: 0"></a>
        </div>

        <div id="welcome" class="welcome owl-carousel owl-theme">
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
    </div>

    <div class="regarea" style="height: 500px">
        <!--<div style="background-color: #FA7171;margin-top: 0px;width: 100%;height: 8px;border-top-left-radius: 5px;border-top-right-radius: 5px;"></div>-->
        <div style="padding-top: 36px;padding-bottom: 32px; font-size: 32px;font-weight: bolder; text-align: center">
            <?php echo $Register;?>
        </div>
        <div style="margin-left: 30px;color: #f65053;<?php if(empty($error)) echo 'display:none;';?>"><?php if(!empty($error)) echo '*'.$error;?></div>
        <form method="post" id="regform">
            <div class="regitem">
                <div class="regtips">
                    <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/account_icon.png);">
                    </div>
                </div>
                <input class="reg_input" name="accountname" id="accountname" placeholder="<?php echo $Your_Name; ?>"/>
            </div>
            <div class="regitem">
                <div class="regtips">
                    <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/mobile_icon.png);">
                    </div>
                </div>
                <input id="phonenumber"  name="phonenumber" class="reg_input"  placeholder="<?php echo $Cell_Phone_Number; ?>"/>
            </div>
            <div class="regitem">
                <div class="regtips">
                    <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                    </div>
                </div>
                <input id="pwd_1st" class="reg_input"  name="pwd_1st" type="password" placeholder="<?php echo $Enter_a_Password; ?>"/>
            </div>
            <div class="regitem">
                <div class="regtips">
                    <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                    </div>
                </div>
                <input id="pwd_2nd" name="pwd_2nd" class="reg_input" type="password" placeholder="<?php echo $Enter_Password_Again; ?>"/>
            </div>
            <div class="reg_btn" type="submit">
                <button class="btn-search" onclick="regsubmit()"><?php echo $Register;?></button>
            </div>
        </form>
        <!--
        <div class="regtxt">
            <span style="color: #f94e4e;font-weight: bold">《<?php echo $By_clicking_Join_Now; ?>》</span>
        </div>
        -->
        <div class="regtxt">
            <span style="font-weight: bold"></span><a href="/index.php?route=sfaccount/login" style="text-decoration: none"><span style="color: #f94e4e;font-weight: bold"> <?php echo $Already_on_Usays; ?></span></a>
        </div>

    </div>
</body>
</html>