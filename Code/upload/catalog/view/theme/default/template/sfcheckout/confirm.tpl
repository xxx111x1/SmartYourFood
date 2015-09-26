<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>订单确认</title>
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap-theme.min.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('input.paymethod').on('change', function () {
                $('input.paymethod').not(this).prop('checked', false);
            });
        });
    </script>
</head>
<body class="container">
    <table class="table" style="margin-top: 50px">
        <caption class="text-left">订单编号: 201509110100</caption>
        <thead>
        <tr>
            <th>#</th>
            <th>菜品</th>
            <th>单价</th>
            <th>数量</th>
            <th>小计</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($food_list as $food) { ?>
        <tr>
            <th scope="row">1</th>
            <td><?php echo $food['food_name']; ?> <span style="font-size: small">(<?php echo $food['rest_name']; ?>)</span></td>
            <td> $<?php echo $food['price'];?></td>
            <td><?php echo $food['quantity'];?></td>
            <td> $<?php echo $food['total'];?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-2">
            <span style="font-weight: bold">总金额: $<?php echo $totalcost;?></span>
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
        <div class="col-md-4">
            <label>送餐联系人</label><input type="text" style="margin-left: 20px" value="邹敏">
        </div>
        <div class="col-md-3">
            <label>送餐电话</label><input type="text" style="margin-left: 20px" value="15001326758">
        </div>
        <div class="col-md-4">
            <label>送餐地址</label><input type="text" readonly="readonly" disabled="disabled" style="margin-left: 20px" value="中关村海淀黄庄"> <span class="glyphicon glyphicon-map-marker"></span>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-2">
            <span style="font-weight: bold;">付款方式</span>
        </div>
        <div class="col-md-2">
            <label style="bottom: 0px">Paypal</label><input type="checkbox" checked class="paymethod">
        </div>
        <div class="col-md-2">
            <label>MasterCard</label><input type="checkbox" class="paymethod">
        </div>
        <div class="col-md-2">
            <label>Visa</label><input type="checkbox" class="paymethod">
        </div>
        <div class="col-md-2">
            <label>Cash</label><input type="checkbox" class="paymethod">
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <a href="/index.php?route=payment/pp_express/checkout" style="float: right"> <div class="btn btn-primary" type="submit">打印</div></a>
        <a href="/index.php?route=payment/pp_express/checkout" style="float: right; margin-right: 10px"> <div class="btn btn-primary" type="submit">付款</div></a>
    </div>
</body>
</html>