<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Smart Your Food</title>
    <link rel="stylesheet" type="text/css" href="css/sf.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
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
    <div class="section_header">
        <div class="food_tab">外卖食品</div>
        <div class="rest_tab">外卖餐馆</div>
        <div class="browse_history">浏览历史</div>
    </div>
    <!--
    <div class="search_area">
        <div class="search_option">
            <input type="checkbox" checked>餐厅
            <input type="checkbox">菜品
        </div>
        <div class="search_box">
            <input type="search">
        </div>
        <div class="search_button">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"/></button>
        </div>
    </div>
    -->
    <?php echo $category;?>
    <!--
    <div class="sf_filter">
        <span class="filter_head">餐馆分类:</span>
        <span class="filter_field">不限</span>
        <span class="filter_field_selected">中餐</span>
        <span class="filter_field">川菜</span>
        <span class="filter_field">湘菜</span>
        <span class="filter_field">西餐</span>
        <span class="filter_field">韩餐</span>
        <span class="filter_field">日餐</span>
        <span class="filter_field">港式</span>
        <span class="filter_field">台式</span>
        <span class="filter_field">早茶</span>
        <span class="filter_field">甜点</span>
        <span class="filter_field">冰激凌</span>
        <span class="filter_field">奶茶</span>
        <span class="filter_field">炸鸡</span>
        <span class="filter_field">快餐</span>
        <span class="filter_field">火锅</span>
    </div>
    -->
    <div class="sort_option">
        <span class="sort_default">默认排序</span>
        <span class="by_time glyphicon glyphicon-arrow-down">配送时间</span>
        <span class="by_sv glyphicon glyphicon-arrow-down">销量</span>
        <span class="by_review glyphicon glyphicon-arrow-down">评价</span>
    </div>
    <div class="product_area">
        <div class="sf_product">
            <img src="img/shop.1.jpg" class="sf_product_preview">
            <div class="sf_product_title">老憨豆外卖</div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售986份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.2.jpg" class="sf_product_preview">
            <div class="sf_product_title">吉野家 (中关村店) </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售867份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.3.jpg" class="sf_product_preview">
            <div class="sf_product_title">星巴克 (中关村店) </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售786份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.4.jpg" class="sf_product_preview">
            <div class="sf_product_title">老吕黄焖鸡 </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售1043份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product_skip_line"></div>
        <div class="sf_product">
            <img src="img/shop.5.jpg" class="sf_product_preview">
            <div class="sf_product_title">老憨豆外卖</div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售986份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.6.jpg" class="sf_product_preview">
            <div class="sf_product_title">吉野家 (中关村店) </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售867份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.7.jpg" class="sf_product_preview">
            <div class="sf_product_title">星巴克 (中关村店) </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售786份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.8.jpg" class="sf_product_preview">
            <div class="sf_product_title">老吕黄焖鸡 </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售1043份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product_skip_line"></div>
        <div class="sf_product">
            <img src="img/shop.9.jpg" class="sf_product_preview">
            <div class="sf_product_title">老憨豆外卖</div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售986份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.10.jpg" class="sf_product_preview">
            <div class="sf_product_title">吉野家 (中关村店) </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售867份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.11.jpg" class="sf_product_preview">
            <div class="sf_product_title">星巴克 (中关村店) </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售786份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
        <div class="sf_product">
            <img src="img/shop.12.jpg" class="sf_product_preview">
            <div class="sf_product_title">老吕黄焖鸡 </div>
            <img src="img/stars_2.png" class="sf_product_stars">
            <div class="sf_product_sv">本月销售1043份</div>
            <div class="sf_product_price"><span style="margin-right: 10px">价格:￥20</span><span>配送:￥5  </span><span class="glyphicon glyphicon-time" style="float: right">30分钟</span> </div>
        </div>
    </div>
</div>
<div class="page_nav">
    Page Navigation
</div>
<div class="footer">

</div>
</body>
</html>