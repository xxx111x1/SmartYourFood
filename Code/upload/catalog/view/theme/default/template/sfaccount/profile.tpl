<div class="review-dialog-frame invisible" id="dialog_updateusername">
    <div class="update-dialog-wrap">
        <div class="review-header">
            <div class="review-title"><?php echo $Edit_Name ;?></div>
            <div class="review-close"></div>
        </div>

        <div class="updatearea">
            <form method="post">
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/account_icon.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updateusername" id="updateusername" placeholder="<?php echo $Please_Enter_Name_Here ;?>"/>
                </div>
                <div class="reg_btn" id="btn_confirmusername" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
                    <span><?php echo $Confirm ;?></span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="review-dialog-frame invisible" id="dialog_updatephone">
    <div class="update-dialog-wrap">
        <div class="review-header">
            <div class="review-title"><?php echo $Edit_Phone_Number ;?></div>
            <div class="review-close"></div>
        </div>

        <div class="updatearea">
            <form method="post">
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" id="updatephone"  type="text" placeholder="<?php echo $Enter_New_Phone_Number ;?>"/>
                </div>
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" id="confirm_updatephone" type="text" placeholder="<?php echo $Reenter_New_Phone_Number ;?>"/>
                </div>
                <div class="reg_btn" id="btn_confirmphone" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
                    <span><?php echo $Confirm ;?></span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="review-dialog-frame invisible" id="dialog_updateemail">
    <div class="update-dialog-wrap">
        <div class="review-header">
            <div class="review-title"><?php echo $Edit_Your_Email ;?></div>
            <div class="review-close"></div>
        </div>

        <div class="updatearea">
            <form method="post">
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/account_icon.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updateemail" id="updateemail" placeholder="<?php echo $Enter_Your_New_Email ;?>" />
                </div>
                <div class="reg_btn" id="btn_confirmemail" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
                    <span><?php echo $Confirm ;?></span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="review-dialog-frame invisible" id="dialog_updatepassowrd">
    <div class="update-dialog-wrap" style="height: 320px">
        <div class="review-header">
            <div class="review-title"><?php echo $Change_Password ;?></div>
            <div class="review-close"></div>
        </div>

        <div class="updatearea">
            <form method="post">
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" type="password" name="updatepassword" id="input_oldpassword" placeholder="<?php echo $Enter_Old_Password ;?>"/>
                </div>
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" type="password" name="updatepassword" id="input_updatepassword" placeholder="<?php echo $Enter_New_Password ;?>"/>
                </div>
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" type="password" name="updatepassword_confirm" id="input_confirmpassword" placeholder="<?php echo $Reenter_New_Password ;?>"/>
                </div>
                <div class="reg_btn" id="btn_confirmpassword" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
                    <span><?php echo $Confirm ;?></span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="rightpanel" id="updateaccount_" style="">
    <div class="right_header">
        <div class="bt_update">
            <?php echo $Profile ;?>
        </div>
    </div>
    <!--<table class="right_basicinfo">
        <tr>
            <th class="iconarea">
                <div id="icon">
                    <img src="catalog/view/theme/default/image/headpic.png">
                </div>
                <div id="showname">
                    <h3>下午好，<?php echo $firstname;?></h3>
                    <div id="bt_update">
                        修改头像
                    </div>
                </div>
            </th>
        </tr>
    </table>
    -->
    <table class="right_infodetail">
        <tr class="infoitem">
            <td style="font-size: 18px;font-weight: bolder"><?php echo $User_Name ;?></td><td><?php echo $firstname;?></td><td><div class="update" id="label_updateusername"><?php echo $Edit ;?></div></td>
        </tr>
        <tr class="infoitem">
            <td style="font-size: 18px;font-weight: bolder"><?php echo $Phone_Number ;?></td><td><?php echo $telephone;?></td><td class="update" id="label_updatephone"><?php echo $Edit ;?></td>
        </tr>
        <tr class="infoitem">
            <td style="font-size: 18px;font-weight: bolder"><?php echo $Email ;?></td><td><?php echo $email;?></td><td class="update" id="label_updateemail"><?php echo $Edit ;?></td>
        </tr>
        <tr class="infoitem">
            <td class="update" id="label_updatepassword"><?php echo $Change_Password ;?></td>
        </tr>
    </table>
</div>
