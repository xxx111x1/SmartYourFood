<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <title>登陆</title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap-theme.min.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/register.js" type="text/javascript"></script>
</head>
<body class="container">
<div class="row" style="color: #ffffff">
    skip
</div>
<div class="row" style="color: #ffffff">
    skip
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-1">
        <img src="img/login_leftv2.png">
    </div>
    <div class="col-md-4">
        <div class="form-group required">
           <h2>登录</h2>
            <!--<span style="font-size: 36px">登录</span> <span style="float: right">Hello World</span>-->
        </div>
        <form method="post" id="loginsubmit" onsubmit="return loginsubmit();">
            <div class="form-group required">
                <input type="text" name="phonenumber" value="" placeholder="手机号" id="phonenumber"
                   class="form-control">
                <!--<label id="phonenum_chkres" class="col-sm-2 glyphicon" style="font-size: 16px; margin-left: -20px;margin-top: 5px;"></label>-->
            </div>

            <div class="form-group required">
                <input type="password" name="password" value="" placeholder="密码" id="passowrd"
                   class="form-control">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" checked> 下次自动登录
                </label>
            </div>
            <div class="form-group required">
                <input type="submit" class="btn btn-primary col-sm-12" value="登录"/>
            </div>
            <div class="form-group required">
                <label class="col-md-5"><a href="register.html">新用户注册</a></label>
                <label class="col-md-5" style="float: right"><a href="register.html" style="float: right">忘记密码</a></label>
            </div>
            <div class="row"  style="color: #ffffff">
                sip
            </div>
            <div class="row"  style="color: #ffffff">
                sip
            </div>
            <div class="row"  style="color: #ffffff">
                sip
            </div>
            <div class="form-group required" style="text-align: center">
                可以使用以下方式注册
            </div>
            <div class="row">
                <div style="margin-left:100px; margin-right:auto;">
                    <img src="img/login_icon.png">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>