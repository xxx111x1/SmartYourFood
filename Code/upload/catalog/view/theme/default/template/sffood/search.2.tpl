<?php echo $header;?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfsearch.css">
<script type="text/javascript" src="catalog/view/javascript/ui.js"></script>
<script src="catalog/view/javascript/sfsearch.js" type="text/javascript"></script>
<script src="catalog/view/javascript/sfhome.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkvY-Zv3LB0uIoS-Yt4MMYyi0gug1ykCg&libraries=places&callback=initMap" async defer></script>
<div class="container">
    <div class="search_top">
        <div class="search_desc">
            <span class="bold">搜索</span> <span class="highlight">[<?php echo $query;?>]</span><span class="bold">的结果:</span>  <span class="normal">共搜到<?php echo $food_result_num;?>个菜品</span>
        </div>
        <div class="search-bar">
            <input id="searchType" type="hidden" value="food" />
            <input id="pac-input" class="controls" type="text" placeholder="<?php echo $address ; ?>" />
            <div id="dropdown"></div>
            <input id="serach-input" class="controls" type="text" placeholder="请输入餐馆、菜品关键字" />
            <div id="search-button">快速查找</div>
            <div class="history-addresses hide">
                <div id="history-label">历史记录</div>
                <?php if($history_address) {?>
                <?php foreach ($history_address as $address) { ?>
                <div class='address' lat='<?php echo $address['lat']; ?>' lng='<?php echo $address['lng']; ?>'><?php echo $address['address']; ?></div>
                <?php } } ?>
            </div>
        </div>
    </div>
    <div class="sepline">
        <hr width="1230px" color="#DFDFDF"/>
    </div>
    <div class="product_area">
        <?php $productnum=0; foreach ($foods as $food) { ?>
        <div class="<?php if( ($productnum+1)%3==0) echo 'product_end'; else echo 'product';?>">
            <div class="thumb" id="<?php echo $food['food_id'];?>">
                <img  class="thumb_preview" width="370" height="256" src="<?php echo $food['img_url'];?>"  alt="Image not found" onerror="onDishImgError(this)" />
                <?php if($food['is_open']==1){ ?>
                <div class="thumboverlay">
                    <div class="thumb_add2cart" foodid="<?php echo $food['food_id'];?>" restId = "<?php echo $food['restaurant_id']; ?>">
                    </div>
                </div>
                <?php } ?>
                <?php if($food['is_open']==0){ ?>
                <div class="thumb_closed">
                </div>
                <?php } ?>
            </div>
            <div class="thumb_desc">
                <div class="thumb_desc_foodname"><?php echo $food['food_name'];?></div>
                <div class="thumb_desc_restname"><?php echo $food['rest_name'];?></div>
                <div class="thumb_desc_restdist">距离 <?php if($food['dist']==-1) echo '--'; else echo $food['dist'];?>km</div>
                <div class="thumb_desc_productinfo">
                    <div class="thumb_desc_productfav"><?php echo $food['score'];?></div>
                    <div class="thumb_desc_productprice">$<?php echo $food['price'];?></div>
                </div>
            </div>
        </div>
        <?php  $productnum++; } ?>
    </div>
    <div style="clear: both"></div>
    <div class="search_top" style="margin-top: 30px;">
        <div class="search_desc">
            <span class="bold">共搜到 <?php echo $rest_num;?>个和</span> <span class="highlight">[<?php echo $query;?>]</span><span class="bold">相关的餐馆:</span>
        </div>
    </div>
    <div class="sepline">
        <hr width="1230px" color="#DFDFDF"/>
    </div>
    <!--rest list-->

    <div class="product_area">
        <?php foreach ($rests as $restaurant) { ?>
        <div class="<?php if( ($productnum+1)%3==0) echo 'product_end'; else echo 'product';?>">
            <div class="thumb" id="<?php echo $restaurant['restaurant_id']; ?> ">
                <?php if($restaurant['is_open']==0){ ?>
                <img  class="thumb_preview" width="370" height="256" src="<?php echo $restaurant['img_url']?>" alt="Image not found" onerror="onRestImgError(this)"/>
                <?php }?>

                <?php if($restaurant['is_open']==1){ ?>
                <a href="/index.php?route=sfrest/detail&restaurant_id=<?php echo $restaurant['restaurant_id']; ?>">
                <img  class="thumb_preview" width="370" height="256" src="<?php echo $restaurant['img_url']?>" alt="Image not found" onerror="onRestImgError(this)"/>
                </a>
                <?php }?>

                <?php if($restaurant['is_open']==0){ ?>
                <div class="thumb_closed">
                </div>
                <?php } ?>
            </div>
            <div class="thumb_desc">
                <div class="thumb_desc_foodname"><?php echo $restaurant['name']; ?></div>
                <div class="thumb_desc_restname"></div>
                <div class="thumb_desc_restdist">距离： <?php echo $restaurant['distance']; ?>KM</div>
                <div class="thumb_desc_productinfo">
                    <div class="thumb_desc_productfav">评分： <?php echo $restaurant['review_score']; ?></div>
                </div>
            </div>
        </div>
        <?php  $productnum++; } ?>
    </div>
</div>
<?php echo $backtop; ?>
<?php echo $footer;?>