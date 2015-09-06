<script src="catalog/view/javascript/list-item/backtop.js" type="text/javascript"></script>
<script src="catalog/view/javascript/feedback.js" type="text/javascript"></script>
<div id="cart_preview" class="unvisible" >
	<?php echo $cartthumbnail ; ?>
</div>
<div id="message" class="unvisible" >
	<?php foreach ($my_message as $message) { ?>
      <div class="message_content">
      	<input type="hidden" class="message_id" value="<?php echo $message['message_id']; ?>" />
      	<div class="content"> <?php echo $message['content']; ?> </div>
      </div>
    <?php } ?>
</div>
<div class="backtop_section" id="backtop_section" >	
	<div id="cart_thumbnail"></div>
	<div id="my_message"></div>
	<div id="feedback"></div>
	<div id="back_top"></div>
		
</div>

<div class="mod-dialog-frame unvisible" style="overflow: auto; position: fixed; left: 0px; top: 0px; right: 0px; bottom: 0px; z-index: 1000; background-color: rgba(0, 0, 0, 0.54902);">
<div style="overflow: hidden; position: absolute; width: 460px; height: 330px; top: 216.5px; left: 490px; background-color: rgb(255, 255, 255);" class="mod-dialog-wrap">
<div class="feedback-wrap">
    <div class="f-form">
        <div class="form-group">
            <label>功能建议：</label>
            <div class="input-control">
                <textarea name="content" id="feedback_content"  placeholder="我们真诚的期望听到您的反馈和建议" class="input placeholder-con">
				</textarea>
            </div>
        </div>
        <div class="form-group">
            <label>联系方式：</label>
            <div class="input-control">
                <input type="text" name="contact" id="contact" placeholder="请留下您的手机号或邮箱" class="input placeholder-con">
            </div>
        </div>
        <div class="form-submit">
            <input type="button" value="提交" class="submitBtn">
            <input type="button" value="取消" class="cancelBtn versa">
        </div>
    </div>
</div>
</div>
</div>