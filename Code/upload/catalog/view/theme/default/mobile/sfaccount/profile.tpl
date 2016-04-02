<div class="user_info_area">
	<div class="img_frame user_img_frame col-3-12" >
		<span class="helper"></span>
		<img class="user_img" src="../catalog/view/theme/default/image/mobile/mobileAccountPerson.png"/>		
	</div>
	<div class="user_info col-3-12">
		<div class="user_name"><?php echo $firstname;?></div>
		<div class="user_phone_number"><?php echo $telephone;?></div>
	</div>
</div>
<form class="profile_edit_area">
	<div class="edit_item">		
		<div class="item_label"><?php echo $Phone_Number ;?></div>
		<input type="text" placeholder="<?php echo $telephone;?>" id="updatephone" name="updatephone" />	
	</div>
	<div class="edit_item">		
		<div class="item_label"><?php echo $User_Name ;?></div>
		<input type="text" placeholder="<?php echo $firstname;?>" id="updateusername" name="updateusername" />	
	</div>
	<div class="edit_item">		
		<div class="item_label"><?php echo $Old_Password ;?></div>
		<input type="password" name="oldpassword" id="input_oldpassword" />	
	</div>
	<div class="edit_item">		
		<div class="item_label"><?php echo $New_Password ;?></div>
		<input type="password" name="updatepassword" id="input_updatepassword" />	
	</div>
	<div class="edit_item">		
		<div class="item_label"><?php echo $Password_Confirm ;?></div>
		<input type="password" name="updatepassword_confirm" id="input_confirmpassword" />	
	</div>
</form>

<div class="profile_foot">
	<div class="confirm"><?php echo $Confirm ;?></div>
</div>
