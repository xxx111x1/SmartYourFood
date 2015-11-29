    <div class="rightpanel" id="orderhistory_">
        <!--<div class="right_header">
            <div class="btn" style="float:left">
            全部
            </div>
        </div>
        -->
        <div class="ordertable" <?php if (!$noorder) echo "style='display:none;'"?>>
        <?php echo $No_Order_History ;?>
        </div>
        <table class="ordertable" style="<?php if ($noorder) echo 'display:none;'?>">
            <tr class="orderheader">
                <th class="col1"><?php echo $Order_Detail ;?></th>
                <th class="col2"><?php echo $Receiver ;?></th>
                <th class="col3"><?php echo $Total ;?></th>
                <th class="col4"><?php echo $Status ;?></th>
                <!--<th class="col5">操作</th>-->
            </tr>
            <?php foreach ($orders as $order) { ?>
            <tr>
                <td class="col1">
                    <div class="orderthumb">
                        <div class="foodpic">
                            <img width="85px" height="85px" src="img/shop.1.jpg"/>
                        </div>
                        <div class="orderdesc">
                            <div class="foodname"><?php echo $order['shipping_address_1'];?> </div>
                            <div class="ordertime">
                                <?php echo $order['date_added'];?>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="col2"><?php echo $order['name'];?></td>
                <td class="col3"><?php echo $order['total'];?></td>
                <td class="col4"><?php echo $order['status'];?></td>
                <!--
                <td class="col5">
                    <div><strong>评价</strong></div>
                    <div class="btn">                        
                            再次购买                        
                    </div>
                </td>
                -->
            </tr>
            <?php } ?>
        </table>
    </div>