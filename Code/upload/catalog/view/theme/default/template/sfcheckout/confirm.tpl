<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>我的餐车</title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap-theme.min.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/list-item/item-content.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/list-item/checkout.js" type="text/javascript"></script>
</head>
<body class="container">
    <div class="row" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-2">
                <h2>订单确认</h2>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <!--
            <div class="col-md-3">
                全选
            </div>
            -->
            <div class="col-md-3">
                菜品
            </div>
            <div class="col-md-2">
                单价$
            </div>
            <div class="col-md-2">
                数量
            </div>
            <div class="col-md-2">
                小计
            </div>
        </div>
        <?php foreach ($food_list as $food) { ?>
        <div class="row">
            <div class="col-md-3">
                <div class="row"><?php echo $food['food_name']; ?> <span style="font-size: small">(<?php echo $food['rest_name']; ?>)</span></div>
            </div>
            <div class="col-md-2">
                $<?php echo $food['price'];?>
            </div>
            <div class="col-md-2">
                <span style="font-size: 20px; margin-left: 10px;margin-right: 10px"><?php echo $food['quantity'];?></span>
            </div>
            <div class="col-md-2">
                $<?php echo $food['total'];?>
            </div>
        </div>
        <?php } ?>

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">
                <span style="font-size: 20px;font-weight: bold">总金额: $<?php echo $totalcost;?></span>
            </div>
            <div class="col-md-2">
                菜品总价:$<?php echo $beforetax;?>
            </div>
            <div class="col-md-2">
                配送费: $<?php echo $deliverfee;?>
            </div>
            <div class="col-md-2">
                税(%12): $<?php echo $tax;?>
            </div>
            <div class="col-md-2">
                小费 (%10): $<?php echo $tips;?>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-3">
                <label>送餐联系人</label><input type="text" style="margin-left: 20px" value="邹敏">
            </div>
            <div class="col-md-3">
                <label>送餐电话</label><input type="text" style="margin-left: 20px" value="15001326758">
            </div>
            <div class="col-md-3">
                <label>送餐地址</label><input type="text" style="margin-left: 20px" value="<?php echo $address;?>"> <span class="glyphicon glyphicon-map-marker"></span>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">
                <span style="font-weight: bold;font-size: 20px">付款方式</span>
            </div>
            <div class="col-md-2">
                <label style="bottom: 0px">Paypal</label><input type="checkbox" checked>
            </div>
            <div class="col-md-2">
                <label>MasterCard</label><input type="checkbox">
            </div>
            <div class="col-md-2">
                <label>Visa</label><input type="checkbox">
            </div>
            <div class="col-md-2">
                <label>Cash</label><input type="checkbox">
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
                <a href="/index.php?route=payment/pp_express/checkout" <div class="btn btn-primary" type="submit">付款</div></a>
        </div>
    </div>
</body>
</html>