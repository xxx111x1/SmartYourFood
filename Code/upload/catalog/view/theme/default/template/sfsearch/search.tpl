<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Smart Your Food</title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap-theme.min.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="catalog/view/javascript/list-item/cart.js" type="text/javascript"></script>
</head>
<body>
<!--
<div class="header">Header part</div>
-->
<?php echo $header;?>
<div class="main_body">
    <!--<div class="bill_board">billboard part</div>-->
    <div class="address_info">
        <span class="address_info_label">送餐地址:</span>
        <span class="address_info_address"><?php echo $address;?></span>
        <span class="address_info_chg">切换地址</span></div>
    </div>
    <div class=sf_product_content>
	 	<div class=product_area >
            <h2>菜品</h2>
            <div class=food_information>
                <?php foreach ($foods as $food) { ?>
                    <div class=sf_product id="<?php echo $food['food_id'];?>" title="<?php echo $food['name'];?>" >
                        <img class=sf_product_preview src="<?php echo $food['img_url'];?>" />
                        <div class=sf_product_title ><?php echo $food['name'];?></div>
                        <img class=sf_product_stars src="img/stars_2.png">
                        <div class=sf_product_sv>本月销量-份</div>
                        <div class=sf_product_price>
                            <span style="MARGIN-RIGHT: 10px">价格:<?php echo $food['price'];?></span>
                            <span>配送: </span>
                            <span class="glyphicon glyphicon-time" style="FLOAT: right">分钟</span>
                        </div>
                        <div class="sf_food_cart">
                            <div class="minus_food" value="<?php echo $food['food_id'];?>" >-</div>
                            <input class="food_number" id="food_<?php echo $food['food_id'];?>_number" value="<?php echo $food['cart_number'];?>" />
                            <div class="add_food" value="<?php echo $food['food_id'];?>" >+</div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div style="clear: both"></div>
            <h2>餐馆</h2>
            <div class="food_information" <?php echo $norest?>>
            <?php foreach ($rests as $restaurant) { ?>
            <div class=sf_product id=<?php echo $restaurant['restaurant_id']; ?> title=<?php echo $restaurant['name']; ?> >
            <img class=sf_product_preview src=<?php echo $restaurant['img_url']?> />
            <div class=sf_product_title ><?php echo $restaurant['name']; ?></div>
            <img class=sf_product_stars src="img/stars_2.png">
            <div class=sf_product_sv><?php echo "本月销量-份" ?></div>
            <div class=sf_product_price>
			<span style="MARGIN-RIGHT: 10px">价格:<?php echo $restaurant['avg_cost']; ?>
			</span><span>配送: </span>
                <span class="glyphicon glyphicon-time" style="FLOAT: right">分钟</span>
            </div>
        </div>

        <?php } ?>
        </div>
        <h3 <?php echo $hasrest?>>暂无相关餐馆信息</h3>
 		</div>
 	</div>
</div>
<!--
<div class="footer">
-->
<div class="currentpage" id="sffood"></div>
</div>
</body>
</html>