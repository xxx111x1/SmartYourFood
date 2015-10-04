<?php echo $header;?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfsearch.css">
<script type="text/javascript" src="catalog/view/javascript/ui.js"></script>
<script src="catalog/view/javascript/sfsearch.js" type="text/javascript"></script>
<script src="catalog/view/javascript/sfhome.js" type="text/javascript"></script>
<div class="container">
    <div id="search_top">
        <div id="search_desc">
            <span class="bold">搜索</span> <span class="highlight">[<?php echo $query;?>]</span><span class="bold">的结果:</span>  <span class="normal">共搜到<?php echo $food_result_num;?>个菜品</span>
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
                <img  class="thumb_preview" width="370" height="256" src="<?php echo $food['img_url'];?>"/>
                <div class="thumboverlay">
                    <div class="thumb_add2cart" foodid="<?php echo $food['food_id'];?>">
                    </div>
                </div>
            </div>
            <div class="thumb_desc">
                <div class="thumb_desc_foodname"><?php echo $food['food_name'];?></div>
                <div class="thumb_desc_restname"><?php echo $food['rest_name'];?></div>
                <div class="thumb_desc_restdist">距离 7.5km</div>
                <div class="thumb_desc_productinfo">
                    <div class="thumb_desc_productfav"><?php echo $food['score'];?></div>
                    <div class="thumb_desc_productprice">$<?php echo $food['price'];?></div>
                </div>
            </div>
        </div>
        <?php  $productnum++; } ?>
    </div>
</div>
<?php echo $backtop; ?>
<?php echo $footer;?>