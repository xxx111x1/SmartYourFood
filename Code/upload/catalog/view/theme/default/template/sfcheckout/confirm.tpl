<?php echo $header;?>
<title><?php echo $Confirm_Your_Order; ?></title>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sf_cart.css">
<script src="catalog/view/javascript/list-item/item-content.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>

<div class="container" style="opacity: 1.0">
	<input type="hidden" id="orderNumber" value="<?php echo count($food_list)?>" />
    <div class="cart_panel">
        <div class="cart_header">
            <!--<h2 style="float: left;"><?php echo $Confirm_Your_Order; ?></h2>-->
            <div class="confirmlabel"><?php echo $Confirm_Your_Order; ?></div>
            <div class="gobackcart"><a href="/index.php?route=sfcheckout/checkout" style="text-decoration: none;color: #555555;float:right;margin-right: 40px;"><?php echo $Back_to_your_cart; ?></a></div>
        </div>
        <hr width="96%" color="#DFDFDF" style="margin-left: auto;margin-right: auto"/>
        <table id="cart">
            <caption><?php echo $Order_Number; ?>: <?php echo $order_id;?></caption>
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
                        <div style="margin-left: 60px;">
                            <div class="foodnum" id="food_<?php echo $food['product_id']?>_number"><?php echo $food['quantity'];?></div>
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
            <span class="summary_item"><?php echo $Priority_Delivery; ?>:<span id="deliverfee"><?php if($fast_deliverfee > 0) {echo " <?php echo $Yes ;?>";} else {echo " <?php echo $No ;?>" ;}?> ($<?php echo $fast_deliverfee;?>) </span></span>
            <span class="summary_item" style="float:right;margin-right:120px"><?php echo $Total; ?>: <span id="totalcost">$ <?php echo $totalcost;?></span></span>
        </div>
    </div>
    <div id="deliverlabel">
   <?php echo $Delivery_Information; ?>
    </div>
    <div class="addressarea" style="height: 200px;">
        <?php if($validaddress){ ?>
        <div class="addressbox" style="border-style: solid;border-color: #f65053;border-width: 1px;">
            <div style="margin-bottom: 20px;margin-top: 20px">
                <span><?php echo $contact;?></span>
            </div>
            <br/>
            <line><?php echo $address;?></line>
            <br/>
            <br/>
            <span><?php echo $phone;?></span>
        </div>
        <?php } else { echo $Delivery_Information_Not_Complete;}?>
    </div>
    <div id="payment">
        <div id="paymentlabel"><?php echo $Payment_Cash; ?></div>
    </div>
    <!--<div class="btn" style="float: right;margin-right: 20px;background-color: #f1f1f1;color: #555555"><?php echo $Print; ?></div> -->
    <?php if($validaddress) { ?>
    <a id="orderConfirm" href="/index.php?route=sfcheckout/success">
        <div class="btn" style="float: right;margin-right: 20px"><?php echo $Confirm; ?></div>
    </a>
    <?php } ?>
</div>

<?php echo $footer;?>