    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/mobile/sforder.css">
    	<input type='hidden' id='pageNumber' value='<?php echo $page;?>'>
    	<input type='hidden' id='totalPageNumber' value='<?php echo $page_number;?>'>
        <div class="orders">
        <?php if ($noorder) {?>
        <?php echo $No_Order_History ;?>
        <?php } else {?>
           <?php foreach ($orders as $order) { ?>
             <div class="order_content">
             	<div class="order_rest" restid="<?php echo $order['products_details'][0]['restaurant_id'] ?>">
             		<div class="rest_img_frame" >
						<span class="helper"></span>
						<img class="rest_img" src="<?php echo $order['products_details'][0]['img_url']?>"/>		
					</div>			
					<div class="col-3-12" title="<?php echo $order['products_details'][0]['model'] ;?>" style="float:left;">
						<div class="rest_label"><?php echo $order['products_details'][0]['model'] ;?></div>
					</div>
					<div class="img_frame col-1-12" >
						<span class="helper"></span>
						<img class="col-3-12 goto_img" src="../catalog/view/theme/default/image/mobile/mobileGotoGrey.png"/>		
					</div>
					<div class="col-3-12" style="float:right;padding-top: 5px;padding-bottom:5px;padding-right: 10px;">
						<div class="one_more"><?php echo $One_More ;?></div>
					</div>	
						
             	</div>
             	
             	<div class="order_detail">
             		<div class="detail_info">
	             		<div class="details">
		             		<?php foreach ($order['products_details'] as $detail) { ?>
		             			<div class="detail">
		             				<div class="detail_name"><?php echo $detail['name'];?> x <?php echo $detail['quantity'];?></div>
		             			</div>
		             		<?php }?>
	             		</div>
	             		<div class="other_info">
		             		<div class="price_all"><?php echo $order['total'];?></div>
		             		<div class="order_status"><?php echo $order['status'];?></div>
		             	</div>
             		</div>
             		<div class="order_info">
             			<div class="date"><?php echo $order['date_added'];?></div>
             			<div class="order_id"><?php echo $order['order_id'];?></div>
             		</div>
             	</div>
             	</div>
        <?php } ?>
    <?php }?>        
  </div>
            
        