<script src="catalog/view/javascript/backtop.js" type="text/javascript"></script>
<script src="catalog/view/javascript/feedback.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/backtop.css">
<div id="cart_preview" class="unvisible" >
	<?php echo $cartthumbnail ; ?>
</div>
<div id="message" class="unvisible" >
</div>
<div class="backtop_section" id="backtop_section" >	
	<!--<div class="backtopIcons" id="my_message">消息</div>-->
	<div class="backtopIcons" id="orders" onclick="window.location.href= '/index.php?route=sfcheckout/checkout';return false"><?php echo $My_Order ;?></div>
	<div class="backtopIcons" id="feedback"><?php echo $Feedback ;?></div>
	<div class="backtopIcons" id="call_center"><?php echo $Customer_Service ;?></div>		
	<div class="backtopIcons" id="back_top"><?php echo $Back_Top ;?></div>
	<div class="backtopIcons" id="cart_thumbnail"><?php echo $Cart ;?></div>
</div>

<div class="mod-dialog-frame unvisible" style="overflow: auto; position: fixed; left: 0px; top: 0px; right: 0px; bottom: 0px; z-index: 1000; background-color: rgba(0, 0, 0, 0.54902);">
	<div style="overflow: hidden; position: absolute; width: 460px; height: 330px; top: 216.5px; left: 490px; background-color: rgb(255, 255, 255);" class="mod-dialog-wrap">
		<div class="feedback-wrap unvisible">
		    <div class="f-form">
		        <div class="form-group">
		            <label><?php echo $Feedback ;?>：</label>
		            <div class="input-control">
		                <textarea name="content" id="feedback_content"  placeholder="我们真诚的期望听到您的反馈和建议" class="input placeholder-con">
						</textarea>
		            </div>
		        </div>
		        <div class="form-group">
		            <label><?php echo $Contact_Info ;?>：</label>
		            <div class="input-control">
		                <input type="text" name="contact" id="contact" placeholder="<?php echo $Leave_Your_Connection ;?>" class="input placeholder-con">
		            </div>
		        </div>
		        <div class="form-submit">
		            <input type="button" value="<?php echo $Submit ;?>" class="submitBtn">
		            <input type="button" value="<?php echo $Cancel ;?>" class="cancelBtn">
		        </div>
		    </div>
		</div>
		<div class="callcenter-wrap unvisible">
		    <div class="callcenter-contact">
		    	email :  info@usays.ca
		    </div>
		    <input type="button" value="<?php echo $Back ;?>" class="cancelBtn callcenter-cancel">
		</div>
	</div>
</div>