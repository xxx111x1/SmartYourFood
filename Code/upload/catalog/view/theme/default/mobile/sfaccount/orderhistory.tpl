    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sforder.css">
    	<input type='hidden' id='pageNumber' value='<?php echo $page;?>'>
    	<input type='hidden' id='totalPageNumber' value='<?php echo $page_number;?>'>
        <div class="ordertable" <?php if (!$noorder) echo "style='display:none;'"?>>
        <?php echo $No_Order_History ;?>
        </div>
        <div class="ordertable" style="<?php if ($noorder) echo 'display:none;'?>">
            <tr class="orderheader">
                <th class="col1"><?php echo $Order_Detail ;?></th>
                <th class="col2"><?php echo $Receiver ;?></th>
                <th class="col3"><?php echo $Total ;?></th>
                <th class="col4"><?php echo $Status ;?></th>
            </tr>
            <?php foreach ($orders as $order) { ?>
            <tr class="orderContent">
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
            </tr>
            <?php } ?>
        </div>
        <div class="pagefoot">
        	<div class="pagebutton minus">Previous Page</div>
        	<?php for ($i = 1; $i <= $page_number && $i<=5; $i++) { ?>
            	<div class="pagenumber <?php if($i==1) echo 'selectedPage';?>" id="page<?php echo $i;?>" value="<?php echo $i;?>">[<?php echo $i;?>]</div>
            <?php } ?>
            <?php if($page_number>2) {?>
            	<div class="inputNumber"><input type="text" id="choosePage" />(in <?php echo $page_number;?>)</div>
            <?php }?>
            <div class="pagebutton add">Next Page</div>
        </div>