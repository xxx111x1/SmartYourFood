<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Smart Your Food</title>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap/css/bootstrap-theme.min.css">
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="catalog/view/javascript/list-item/item-content.js" type="text/javascript"></script>
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
        <a class="address_info_chg" href="index.php?route=address/address&returnUrl=index.php?route=sffood/list">切换地址</a></div>
    <div class="section_header">
        <div class="type_tab selected_type_tab"><a href="/index.php?route=sffood/list" >外卖食品</a></div>
        <div class="type_tab"><a href="/index.php?route=sfrest/list" >外卖餐馆</a></div>
        <div class="search_area">
        <div class="search_box">
            <input type="search">
        </div>
        <div class="search_button">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"/></button>
        </div>
        </div>
    </div>
    <div class=sf_product_content>
  	<div class=sf_filter>
		<span class=filter_head>菜品分类：</span>
		<?php foreach ($types as $type) { ?>
		<span class=filter_field id=filter_<?php echo $type['type_id']?> value=<?php echo $type['type_id'] ?> ><?php echo $type['type_name_cn']?></span>
		<?php } ?>
		<input type="hidden" id="filters" value="0"/>
	</div>
    <div class=sort_option>
	 <span class="sort_field " id="sort_default" >默认排序</span>
	 <span class="sort_field glyphicon glyphicon-arrow-up" id="send_time" >配送时间</span>
	 <span class="sort_field glyphicon glyphicon-arrow-down" id="sell_number" >销量</span> 
	 <span class="sort_field glyphicon glyphicon-arrow-down" id="review_score" >评价</span>
	 <input type="hidden" id="sort" value="sort_default"/>
	 </div>
	 <input type=hidden id=page_number value=0 />
	 <div class=product_area ></div>
 	</div>
</div>
<div class="currentpage" id="sfrest"></div>
<!--
<div class="footer">
-->

</div>
</body>
</html>