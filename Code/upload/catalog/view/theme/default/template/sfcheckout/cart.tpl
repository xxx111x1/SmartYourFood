<?php echo $header;?>
<title><?php echo $My_Cart; ?></title>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf_cart.css">
<script src="catalog/view/javascript/list-item/item-content.js" type="text/javascript"></script>
<script src="catalog/view/javascript/list-item/checkout.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>

<div class="container" style="<?php echo $nofood;?>">
	<input type="hidden" id="deliveryFeeInfor" lat="<?php echo $rest_lat ;?>" lng="<?php echo $rest_lng ;?>" isNight="<?php echo $is_night ;?>" />
	<input type="hidden" id="orderNumber" value="<?php echo count($food_list);?>" />
	<input type="hidden" id="moreRest" value="<?php echo $more_rests;?>" />
    <div class="cart_panel">
        <div class="cart_header">
            <h2 style="float: left;"><?php echo $My_Cart; ?></h2>
        </div>
        <hr width="96%" color="#DFDFDF" style="margin-left: auto;margin-right: auto"/>
        <table id="cart">
            <caption><?php echo $Order_Detail; ?></caption>
            <tbody>
                <tr class="carttableheader">
                    <th class="col1">
                        <div class="header_foodname" style="margin-left: 40px"><?php echo $Order; ?></div>
                    </th>
                    <th class="col2"><?php echo $Price; ?></th>
                    <th class="col3"><?php echo $Count; ?></th>
                    <th class="col4"><?php echo $Total_Price; ?></th>
                </tr>
                <?php foreach ($food_list as $food) { ?>
                <tr>
                    <td class="col1">
                        <div class="orderthumb orderPreview" foodId="<?php echo $food['product_id']; ?>" restId="<?php echo $food['rest_id']; ?>">
                            <div class="foodpic">
                                <img width="65px" height="65px" src="<?php echo $food['image'];?>"   alt="Image not found" onerror="onDishImgError(this)"/>
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
            <span class="summary_item"><?php echo $Sub_Total; ?>:<span id="beforetax">$<?php echo $beforetax;?></span></span>
            <span class="summary_item"><?php echo $Delivery; ?>:<span id="deliverfee"> $<?php echo $deliverfee;?> </span></span>
            <span class="summary_item"><?php echo $Tax; ?>(5%):<span id="taxcost"> $<?php echo $tax;?></span></span>
            <span class="summary_item"><?php echo $Priority_Delivery; ?>:<span id="fastdeliverfee"> $<?php echo $fast_deliverfee;?> </span><input type="checkbox" id="fastDelivery" checked></span>
            <span class="summary_item" style="float:right;margin-right:120px"><?php echo $Total; ?>: <span id="totalcost">$ <?php echo $totalcost;?></span></span>
        </div>
    </div>
    <div id="deliverlabel">
    <?php echo $Delivery_Information; ?>
    </div>
    ﻿<div class="addressarea">
    <?php foreach ($addresslist as $address) { ?>
    <div class="addressbox" id="address_<?php echo $address['address_id'];?>" addr_id="<?php echo $address['address_id'];?>" lat="<?php echo $address['lat'];?>" lng="<?php echo $address['lng'];?>">
        <div style="margin-bottom: 20px;margin-top: 20px">
            <span id="contact_<?php echo $address['address_id'];?>" ><?php echo $address['contact'];?></span>
            <span class='deleteAddress' addr_id="<?php echo $address['address_id'];?>" ><?php echo $Delete ;?></span>
            <span class='editAddress' addr_id="<?php echo $address['address_id'];?>" ><?php echo $Edit ;?></span>
        </div>
        <br/>
        <line title="<?php echo $address['address'];?>"><?php echo $address['address'];?></line>
        <br/>
        <br/>
        <span id="phone_<?php echo $address['address_id'];?>" ><?php echo $address['phone'];?></span><span style="float: right;margin-top: -9px" class="mark"><img src="catalog/view/theme/default/image/icons/marked.png"></span>
    </div>
    <?php } ?>
    <a href="/index.php?route=address/address&returnUrl=<?php echo $returnUrl;?>">
        <div class="addressbox" style="line-height: 130px;vertical-align: middle;text-align: center;color: #D8D8D8;font-size: 22px">
            <span><?php echo $New_Address ;?></span>
        </div>
    </a>
</div>
    <div id="payment">
        <div id="paymentlabel" >	<?php echo $Payment_Cash; ?>  </div>     
    </div>
    <a id="orderConfirm" href="/index.php?route=sfcheckout/confirm&isFast=true">
        <div class="btn"><?php echo $Pay_Bill; ?></div>
    </a>      
    
</div>
<h2 style="<?php echo $hasfood;?> text-align:center;"><?php echo $No_Any_Order ;?></h2>
<?php echo $footer;?>