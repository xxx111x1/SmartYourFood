<?php echo $header;?>
<title>订单确认</title>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf_cart.css">
<script src="catalog/view/javascript/list-item/item-content.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>

<div class="container" style="opacity: 1.0">
    <div class="cart_panel">
        <div class="cart_header">
            <!--<h2 style="float: left;">订单确认</h2>-->
            <div class="confirmlabel">订单确认</div>
            <div class="gobackcart"><a href="/index.php?route=sfcheckout/checkout" style="text-decoration: none;color: #555555">返回购物车修改</a></div>
        </div>
        <hr width="96%" color="#DFDFDF" style="margin-left: auto;margin-right: auto"/>
        <table id="cart">
            <caption>订单编号: <?php echo $order_id;?></caption>
            <tbody>
                <tr class="carttableheader">
                    <th class="col1">
                        <div class="header_foodname" style="margin-left: 40px">
                            菜品
                        </div>
                    </th>
                    <th class="col2">单价</th>
                    <th class="col3">数量</th>
                    <th class="col4">小计</th>
                </tr>
                <?php foreach ($food_list as $food) { ?>
                <tr>
                    <td class="col1">
                        <div class="orderthumb">
                            <div class="foodpic">
                                <img width="65px" height="65px" src="<?php echo $food['image'];?>"/>
                            </div>
                            <div class="orderdesc">
                                <div class="foodname">
                                    <?php echo $food['food_name']; ?> (<?php echo $food['rest_name']; ?>)
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="col2"> $<?php echo $food['price'];?></td>
                    <td class="col3">
                        <div style="margin-left:50px;margin-top:10px">
                            <div class="foodnum" id="food_<?php echo $food['product_id']?>_number"><?php echo $food['quantity'];?></div>
                        </div>
                    </td>
                    <td class="col4"> $<?php echo $food['total'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div id="cost_summary">
            <span class="summary_item">菜品总价:<span id="beforetax">$<?php echo $beforetax;?></span></span>
            <span class="summary_item">配送费:<span id="deliverfee"> $<?php echo $deliverfee;?> </span></span>            
            <span class="summary_item">税(5%):<span id="taxcost"> $<?php echo $tax;?></span></span>
            <span class="summary_item">优先配送:<span id="deliverfee"><?php if($fast_deliverfee > 0) {echo " 是";} else {echo " 否" ;}?> ($<?php echo $fast_deliverfee;?>) </span></span>
            <span class="summary_item" style="float:right;margin-right:120px">总金额: <span id="totalcost">$ <?php echo $totalcost;?></span></span>
        </div>
    </div>
    <div id="deliverlabel">
    配送信息
    </div>
    <div class="addressarea">
        <?php if($validaddress){ ?>
        <div class="addressbox" style="border-style: solid;border-color: #f65053;border-width: 1px;">
            <div style="margin-bottom: 20px;margin-top: 20px">
                <span><?php echo $contact;?></span>
            </div>
            <br/>
            <line><?php echo $address;?></line>
            <br/>
            <br/>
            <span><?php echo $phone;?></span>
        </div>
        <?php } else { echo '配送信息不完整，请返回购物车修改';}?>
    </div>
    <div id="payment">
        <div id="paymentlabel">付款方式：货到付款</div>
    </div>
    <div class="btn" style="float: right;margin-right: 20px;background-color: #f1f1f1;color: #555555">打印订单</div>
    <a href="/index.php?route=sfcheckout/success">
        <div class="btn" style="float: right;margin-right: 20px">确认付款</div>
    </a>
</div>

<?php echo $footer;?>