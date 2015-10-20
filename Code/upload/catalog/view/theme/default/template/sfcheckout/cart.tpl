<?php echo $header;?>
<title>我的餐车</title>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf_cart.css">
<script src="catalog/view/javascript/list-item/item-content.js" type="text/javascript"></script>
<script src="catalog/view/javascript/list-item/checkout.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>

<div class="container" style="<?php echo $nofood;?>">
    <div class="cart_panel">
        <div class="cart_header">
            <h2 style="float: left;">我的餐车</h2>
        </div>
        <hr width="96%" color="#DFDFDF" style="margin-left: auto;margin-right: auto"/>
        <table id="cart">
            <caption>订单详情</caption>
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
                                <div class="btn_small ck_remove_food" value="<?php echo $food['product_id']?>" style="float: left">
                                    -
                                </div>
                            <div class="foodnum" id="food_<?php echo $food['product_id']?>_number"><?php echo $food['quantity'];?></div>
                                <div class="btn_small ck_add_food" value="<?php echo $food['product_id']?>" style="float: left">
                                    +
                                </div>
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
            <span class="summary_item">优先配送:<span id="deliverfee"> $<?php echo $deliverfee;?> </span></span>
            <span class="summary_item">税(12%):<span id="taxcost"> $<?php echo $tax;?></span></span>
            <span class="summary_item" style="float:right;margin-right:120px">总金额: <span id="totalcost">$ <?php echo $totalcost;?></span></span>
        </div>
    </div>
    <div id="deliverlabel">
    配送信息
    </div>
    <div class="addressarea">
        <?php foreach ($addresslist as $address) { ?>
        <div class="addressbox" addr_id="<?php echo $address['address_id'];?>">
            <div style="margin-bottom: 20px;margin-top: 20px">
                <span><?php echo $address['contact'];?></span>
                <span style="float: right;margin-right: 20px;color: red;">删除</span>
                <span style="float: right;margin-right: 20px;color: red;">修改</span>
            </div>
            <br/>
            <line><?php echo $address['address'];?></line>
            <br/>
            <br/>
            <span><?php echo $address['phone'];?></span><span style="float: right;margin-top: -30px" class="mark"><img src="catalog/view/theme/default/image/icons/marked.png"></span>
        </div>
        <?php } ?>
        <a href="/index.php?route=address/address&returnUrl=/index.php?route=sfcheckout/checkout">
            <div class="addressbox" style="line-height: 130px;vertical-align: middle;text-align: center;color: #D8D8D8;font-size: 22px">
                <span>添加新的地址</span>
            </div>
        </a>
    </div>
    <div id="payment">
        <div id="paymentlabel">	付款方式: 货到付款   </div>        
    </div>
    <a href="/index.php?route=sfcheckout/confirm">
        <div class="btn" style="float: right;margin-right: 20px">结算</div>
    </a>
</div>
<h2 style="<?php echo $hasfood;?>">您还没有点餐</h2>
<?php echo $footer;?>