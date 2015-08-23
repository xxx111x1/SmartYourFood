<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap-theme.min.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/register.js" type="text/javascript"></script>
    <!--<script type="text/javascript" src="js/jquery-1.11.3.js"></script>-->
    <!--<script type="text/javascript" src="js/register.js"></script>-->
</head>
<body class="container">
<div class="row" style="color: #ffffff">
       skip
</div>
<div class="row" style="color: #ffffff">
    skip
</div>
<div class="row"> <!--style="border: 2px solid #86B0CD;">-->
    <div class="col-md-5 col-md-offset-1">
        <div class="row">
            <h2>使用手机注册</h2>
        </div>
        <form class="form-horizontal" method="post" id="regform" onsubmit="return regsubmit()">
            <div class="form-group required">
                <label class="col-sm-3 control-label" for="phonenumber">手机号码</label>

                <div class="col-sm-7">
                    <input type="text" name="phonenumber" value="" placeholder="输入有效的手机号码" id="phonenumber"
                           class="form-control" onchange="return validatephonenumber()">
                </div>
                 <label id="phonenum_chkres" class="col-sm-2 glyphicon" style="font-size: 16px; margin-left: -20px;margin-top: 5px;"></label>
            </div>
            <div class="form-group required">
                <label class="col-sm-3 control-label" for="pwd_1st">输入密码</label>
                <div class="col-sm-7">
                    <input type="password" name="pwd_1st" value="" placeholder="至少六位数字字母组合" id="pwd_1st"
                           class="form-control" onchange="return validate1stpwd()">
                </div>
                <label id="1stpwd_chkres" class="col-sm-2 glyphicon" style="font-size: 16px; margin-left: -20px;margin-top: 5px;"></label>
            </div>
            <div class="form-group required">
                <label class="col-sm-3 control-label" for="pwd_2nd">再次输入密码</label>
                <div class="col-sm-7">
                    <input type="password" name="pwd_2nd" value="" placeholder="和上次输入一致" id="pwd_2nd"
                           class="form-control" onkeyup="validate2ndpwd()">
                </div>
                <label id="2ndpwd_chkres" class="col-sm-2 glyphicon" style="font-size: 16px; margin-left: -20px;margin-top: 5px;"></label>
            </div>
            <div class="row">
                <!--<button type="submit" class="btn btn-primary col-sm-7 col-sm-offset-3">同意并注册</button>-->
                <div class="col-sm-7 col-sm-offset-3">
                    <input type="submit" class="btn btn-primary col-sm-12" id="registerbutton" value="同意并注册"/>
                </div>
            </div>
            <div class="row">
                <label style="margin-top: 10px" class="col-sm-7 col-sm-offset-3"> <a href="register.html">《使用条款和协议》</a></label>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="row" style="margin-top: 40px">
            <h3>已经注册过?</h3>
        </div>
        <div class="row" style="margin-top: 10px">
            请点击 直接<a href="register.html">登陆</a>
        </div>
        <div class="row" style="margin-top: 30px">
            可以使用以下账号登陆:
        </div>
        <div class="row">
            <img src="img/login_icon.png">
        </div>
             
    </div>
</div>
</body>
</html>