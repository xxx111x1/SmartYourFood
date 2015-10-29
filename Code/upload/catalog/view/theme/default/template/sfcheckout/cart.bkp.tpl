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
<?php echo $header;?>
<!--<body class="container">-->
    <div class="row" style="margin-left: 100px; margin-top: 50px; <?php echo $nofood; ?>">
        <div class="row">
            <div class="col-md-2">
                <h2>我的餐车</h2>
            </div>
            <div class="col-md-7" style="padding-top: 30px; margin-left: -50px">
               送餐地址:<span style="margin-left: 10px; font-weight: bold"><?php echo $address ?></span>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-3">
                全选
            </div>
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
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-3">
                <img src="<?php echo $food['image'];?>" width="208px" height="156px"/>
            </div>
            <div class="col-md-3">
                <div class="row"><h3><?php echo $food['food_name']; ?></h3></div>
                <div class="row" style="margin-top: 20px"><?php echo $food['rest_name']; ?></div>
                <div class="row" style="margin-top: 10px"><span class="glyphicon glyphicon-phone-alt"></span><?php echo $food['phone']; ?></div>
                <div class="row" style="margin-top: 10px"><span class="glyphicon glyphicon-map-marker"></span><?php echo $food['rest_address']; ?></div>
            </div>
            <div class="col-md-2">
                $<?php echo $food['price'];?>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary ck_add_food" value="<?php echo $food['product_id']?>"> <span class="glyphicon glyphicon-plus" style="font-size: 20px"></span></button>
                <span style="font-size: 20px; margin-left: 10px;margin-right: 10px" id="food_<?php echo $food['product_id']?>_number"><?php echo $food['quantity'];?></span>
                <button class="btn btn-primary ck_remove_food" value="<?php echo $food['product_id']?>"> <span class="glyphicon glyphicon-minus" style="font-size: 20px"></span></button>
            </div>
            <div class="col-md-2">
                $<?php echo $food['total'];?>
            </div>
        </div>
        <?php } ?>
        <div class="col-md-5 col-md-offset-8">
            <form class="form-horizontal" id="cost_summary">
                <div class="form-group required">
                    <label class="col-md-3 control-label">配送方式:</label>
                    <label>
                        <input type="checkbox" value="" checked> 拆分配送
                    </label>
                    <label>
                        <input type="checkbox" value=""> 统一配送
                    </label>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">配送时间:</label>
                    <span class="glyphicon glyphicon-time" style="font-size: 20px">大约25分钟</span>
                </div>

                <div class="form-group required">
                    <label class="col-md-6 col-md-offset-1 control-label">价格:<span style="font-size: 20px" id="beforetax">$<?php echo $beforetax;?></span></label>
                </div>
                <div class="form-group required">
                    <label class="col-md-6 col-md-offset-1 control-label">总计:7.5KM<span>  </span>配送费:<span style="font-size: 20px" id="deliverfee">$<?php echo $deliverfee;?> </span></label>
                </div>
                <!--
                <div class="form-group required">
                    <label class="col-md-5 col-md-offset-2 control-label">12% TAX<span style="font-size: 12px">$2.4</span> </label>
                </div>
                <div class="form-group required">
                    <label class="col-md-5 col-md-offset-2 control-label">小费(10%)<span style="font-size: 12px">$2.00</span> </label>
                </div>
                <div class="form-group required">
                    <label class="col-md-5 col-md-offset-2 control-label">总价(10%)<span style="font-size: 12px; color:#DE3D3">$2.00</span> </label>
                </div>
                -->
                <div class="row">
                    <div class="col-md-5" style="margin-left: -60px;margin-top: 15px">
                        <a href="/index.php?route=sfcheckout/confirm">
                            <div class="btn btn-primary" type="submit" style="width: 156px;height: 88px;font-size: 32px;">结算</div>
                        </a>
                    </div>
                    <div class="col-md-6" style="margin-left: 0px">
                        <div class="row">
                            <label class="control-label">12% TAX: <span style="font-size: 20px" id="taxcost">$<?php echo $tax;?></span></label>
                        </div>
                        <div class="row">
                            <label class="control-label">小费(10%):<span style="font-size: 20px" id="tipscost">$<?php echo $tips;?></span></label>
                        </div>
                        <div class="row">
                            <label class="control-label">总价:<span style="font-size: 20px; color:#DE3D36" id="totalcost">$ <?php echo $totalcost;?></span></label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<h2 style="<?php echo $hasfood;?>">您还没有点餐</h2>
</html>