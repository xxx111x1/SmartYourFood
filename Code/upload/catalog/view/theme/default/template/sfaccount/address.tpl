<div class="addressarea">
    <?php foreach ($addresslist as $address) { ?>
    <div class="addressbox" addr_id="<?php echo $address['address_id'];?>">
        <div style="margin-bottom: 20px;margin-top: 20px">
            <span><?php echo $address['contact'];?></span>
            <span style="float: right;margin-right: 20px;color: red;">删除</span>
            <span style="float: right;margin-right: 20px;color: red;">修改</span>
        </div>
        <br/>
        <line title="<?php echo $address['address'];?>" ><?php echo $address['address'];?></line>
        <br/>
        <br/>
        <span><?php echo $address['phone'];?></span><span style="float: right;margin-top: -30px" class="mark"><img src="catalog/view/theme/default/image/icons/marked.png"></span>
    </div>
    <?php } ?>
    <a href="/index.php?route=address/address&returnUrl=/index.php?route=sfcheckout/checkout">
        <div class="addressbox" style="line-height: 130px;vertical-align: middle;text-align: center;color: #D8D8D8;font-size: 22px">
            <span>添加新的地址</span>
        </div>
    </a>
</div>