<?php echo $header;?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfaccount.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/review.css">
<script type="text/javascript" src="catalog/view/javascript/account_ui.js"></script>
<div class="mainpanel">
    <div class="leftpanel">
        <div class="left_title">
            我的账户
        </div>
        <div class="left_item" id="orderhistory">
            历史订单
        </div>
        <div class="left_item"  id="updateaccount">
            账户信息修改
        </div>
        <div class="left_item" id="updateaddress">
            地址管理
        </div>
        <div class="left_item" id="newsletter">
            NewsLetter
        </div>
        <div class="left_item" id="logout">
            退出登录
        </div>
    </div>
    <?php echo $profile;?>
    <!--edit address-->
    <div class="rightpanel" id="updateaddress_">
        <?php echo $addresses;?>
    </div>
    <!--order history-->
    <?php echo $orderhistory;?>
    <div class="rightpanel" id="newsletter_">
        <div class="right_header">
        </div>
        <div class="right_infodetail">
            Welcome! 欢迎来到悠选美食服务区,我们将用待家人的温暖为您递上一份舒适的美食。
        </div>

    </div>
    <div class="rightpanel" id="logout_">
        <div class="right_header">
            <div class="btn" style="float: left">
                退出
            </div>
        </div>
    </div>
</div>
<?php if($pageid) echo "<div id='currentpage' pageid=$pageid></div>";
?>
<?php echo $footer;?>