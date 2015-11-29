<?php echo $header;?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfaccount.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/review.css">
<script type="text/javascript" src="catalog/view/javascript/account_ui.js"></script>
<div class="mainpanel">
    <div class="leftpanel">
        <div class="left_title"><?php echo $My_Account ;?> </div>
        <div class="left_item" id="orderhistory"><?php echo $HistoryOrders ;?> </div>
        <div class="left_item"  id="updateaccount"><?php echo $Change_Account_Information ;?></div>
        <div class="left_item" id="updateaddress"><?php echo $Address_Management ;?> </div>
        <div class="left_item" id="newsletter">NewsLetter</div>
        <div class="left_item logout" id="logout"><?php echo $Log_Out ;?> </div>
    </div>
    <?php echo $profile;?>
    <!--edit address-->
    <div class="rightpanel" id="updateaddress_">
        <?php echo $addresses;?>
    </div>
    <!--order history-->
    <?php echo $orderhistory;?>
    <div class="rightpanel" id="newsletter_">
        <div class="right_header">
        </div>
        <div class="right_infodetail">
            <?php echo $Wecome_Here ;?>
        </div>

    </div>
    <div class="rightpanel" id="logout_">
        <div class="right_header">
        </div>
    </div>
</div>
<!--<?php if($pageid) echo "<div id='currentpage' pageid=$pageid></div>"; ?>-->
<?php echo $footer;?>