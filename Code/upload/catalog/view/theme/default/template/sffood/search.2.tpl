<?php echo $header;?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf_v2.css">
<script type="text/javascript" src="catalog/view/javascript/ui.js"></script>
<!--<script src="catalog/view/javascript/sflist.js" type="text/javascript"></script>-->
<script src="catalog/view/javascript/sfhome.js" type="text/javascript"></script>
<div class="container">
    <div id="search_top">
        <div id="search_desc">
            <span class="bold">搜索</span> <span class="highlight">[宁香烤鸡]</span><span class="bold">的结果:</span>  <span class="normal">共搜到3个菜品</span>
        </div>
    </div>
    <div class="sepline">
        <hr width="1230px" color="#DFDFDF"/>
    </div>
    <div id="search_location">
        当前位置: <?php echo $address;?>
    </div>
    <div class="product_area">
        <?php $productnum=0; foreach ($foods as $food) { ?>
        <div class="<?php if( ($productnum+1)%3==0) echo 'product_end'; else echo 'product';?>">
            <div class="thumb" id="<?php echo $food['food_id'];?>">
                <img  width="370" height="256" src="<?php echo $food['img_url'];?>"/>
                <div class="thumboverlay">
                    <div class="thumb_add2cart">
                    </div>
                </div>
            </div>
            <div class="thumb_desc">
                <div class="thumb_desc_foodname"><?php echo $food['name'];?></div>
                <div class="thumb_desc_restname">Have Fun! 有饭(上地店)</div>
                <div class="thumb_desc_restdist">距离 7.5km</div>
                <div class="thumb_desc_productinfo">
                    <div class="thumb_desc_productfav">998</div>
                    <div class="thumb_desc_productprice">$<?php echo $food['price'];?></div>
                </div>
            </div>
        </div>
        <?php  $productnum++; } ?>
    </div>
</div>
<?php echo $backtop; ?>
<?php echo $footer;?>