<div class="addressarea">
    <?php foreach ($addresslist as $address) { ?>
    <div class="addressbox" id="address_<?php echo $address['address_id'];?>" addr_id="<?php echo $address['address_id'];?>">
        <div >
            <div id="contact_<?php echo $address['address_id'];?>" class="address_contact col-6-12" ><?php echo $address['contact'];?></div>
            <div class='editAddress' addr_id="<?php echo $address['address_id'];?>" ><?php echo $Edit ;?></div>
            <div class='deleteAddress' addr_id="<?php echo $address['address_id'];?>" ><?php echo $Delete ;?></div>
            
        </div>
        <br/>
        <br/>
        <line class="address_name" title="<?php echo $address['address'];?>"><?php echo $address['address'];?></line>

        <div class="contact_phone" id="phone_<?php echo $address['address_id'];?>" ><?php echo $address['phone'];?></div>
        <div class="mark">
        	<img src="catalog/view/theme/default/image/icons/marked.png">
        </div>
    </div>
    <?php } ?>
    <a href="/index.php?route=address/address&returnUrl=<?php echo $returnUrl;?>#updateaddress_">
        <div class="addressbox" style="line-height: 120px;vertical-align: middle;text-align: center;color: #D8D8D8;font-size: 22px">
            <span><?php echo $New_Address ;?></span>
        </div>
    </a>
</div>