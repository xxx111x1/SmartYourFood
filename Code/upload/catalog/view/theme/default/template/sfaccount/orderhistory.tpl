<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>历史订单</title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfaccount.css">
    <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="catalog/view/javascript/account_ui.js"></script>
</head>
<body style="background: url(./8.png) no-repeat top left">
<div class="header">
    <div class="header_logo">
        悠选
    </div>
    <div class="header_menuhome header_selected">
        <div class="header_txt">
            首页
        </div>
    </div>
    <div class="header_menuorder">
        <div class="header_txt">
            我的订单
        </div>
    </div>
    <div class="header_rightinfo">
        <div class="header_lang">
            <div class="header_txt">
                English
            </div>
        </div>
        <div class="header_login">
            <div class="header_login_txt">
                登录/注册
            </div>
        </div>
    </div>
</div>
<div class="mainpanel">
    <div class="leftpanel">
        <div class="left_title">
            我的账户
        </div>
        <div class="left_item">
            历史订单
        </div>
        <div class="left_item">
            账户信息修改
        </div>
        <div class="left_item">
            密码修改
        </div>
        <div class="left_item">
            地址管理
        </div>
        <div class="left_item">
            退出登录
        </div>
    </div>
    <div class="rightpanel" id="orderhistory_">
        <div class="right_header">
            <div class="btn" style="float:left">
            全部
            </div>
        </div>
        <div class="ordertable" <?php if (!$noorder) echo "style='display:none;'"?>>
        暂无购买记录。
        </div>
        <table class="ordertable" style="<?php if ($noorder) echo 'display:none;'?>">
            <tr class="orderheader">
                <th class="col1">订单详情</th>
                <th class="col2">收货人</th>
                <th class="col3">总计金额</th>
                <th class="col4">状态</th>
                <th class="col5">操作</th>
            </tr>
            <?php foreach ($orders as $order) { ?>
            <tr>
                <td class="col1">
                    <div class="orderthumb">
                        <div class="foodpic">
                            <img width="85px" height="85px" src="img/shop.1.jpg"/>
                        </div>
                        <div class="orderdesc">
                            <div class="foodname">
                                宫保鸡丁
                            </div>
                            <div class="ordertime">
                                <?php echo $order['date_added'];?>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="col2"><?php echo $order['name'];?></td>
                <td class="col3"><?php echo $order['total'];?></td>
                <td class="col4"><?php echo $order['status'];?></td>
                <td class="col5">
                    <div><strong>评价</strong></div>
                    <div class="btn">                        
                            再次购买                        
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div id="currentpage" pageid="#orderhistory_"></div>
</div>
</body>
</html>