﻿?<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sfaccount.css">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/review.css">
<script type="text/javascript" src="catalog/view/javascript/account_ui.js"></script>
<div class="review-dialog-frame invisible" id="dialog_updateusername">
    <div class="update-dialog-wrap">
        <div class="review-header">
            <div class="review-title">修改用户名</div>
            <div class="review-close"></div>
        </div>

        <div class="updatearea">
            <form method="post">
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/account_icon.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updateusername" id="updateusername" placeholder="输入新的用户名"/>
                </div>
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/account_icon.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updateusername_confirm" id="updateusername_confirm" placeholder="再次输入新的用户名"/>
                </div>
                <div class="reg_btn" id="btn_confirmusername" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
                    <span>确认</span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="review-dialog-frame invisible" id="dialog_updatephone">
    <div class="update-dialog-wrap">
        <div class="review-header">
            <div class="review-title">修改手机号码</div>
            <div class="review-close"></div>
        </div>

        <div class="updatearea">
            <form method="post">
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" id="updatephone"  type="text" placeholder="输入新的手机号码"/>
                </div>
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" id="confirm_updatephone" type="text" placeholder="再次输入新的手机号码"/>
                </div>
                <div class="reg_btn" id="btn_confirmphone" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
                    <span>确认</span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="review-dialog-frame invisible" id="dialog_updateemail">
    <div class="update-dialog-wrap">
        <div class="review-header">
            <div class="review-title">修改用邮箱</div>
            <div class="review-close"></div>
        </div>

        <div class="updatearea">
            <form method="post">
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/account_icon.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updateemail" id="updateemail" placeholder="输入新的用户名"/>
                </div>
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/account_icon.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updateemail_confirm" id="updateemail_confirm" placeholder="再次输入新的用户名"/>
                </div>
                <div class="reg_btn" id="btn_confirmemail" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
                    <span>确认</span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="review-dialog-frame invisible" id="dialog_updatepassowrd">
    <div class="update-dialog-wrap" style="height: 320px">
        <div class="review-header">
            <div class="review-title">修改密码</div>
            <div class="review-close"></div>
        </div>

        <div class="updatearea">
            <form method="post">
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updatepassword" id="input_oldpassword" placeholder="请输入旧密码"/>
                </div>
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updatepassword" id="input_updatepassword" placeholder="输入新的密码"/>
                </div>
                <div class="regitem">
                    <div class="regtips">
                        <div class="reg_icon" style="background-image: url(/catalog/view/theme/default/image/icons/lock.png);">
                        </div>
                    </div>
                    <input class="reg_input" name="updatepassword_confirm" id="input_confirmpassword" placeholder="再次输入新的密码"/>
                </div>
                <div class="reg_btn" id="btn_confirmpasword" style="vertical-align:middle;text-align: center;color: white;font-size: 22px;font-weight: bolder;line-height: 50px">
                    <span>确认</span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="rightpanel" id="updateaccount_" style="">
    <div class="right_header">
        <div class="bt_update">
            基本信息
        </div>
    </div>
    <table class="right_basicinfo">
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
            <th class="moneyarea">
                <div class="moneylabel">
                    <span style="font-size:16px">$</span>0.00
                </div>
                <div>
                    <h3>账户余额</h3>
                </div>
                <div class="bt_update">
                    充值
                </div>
            </th>
            <th class="couponarea">
                <div class="moneylabel">
                    0<span style="font-size:16px">个</span>
                </div>
                <div>
                    <h3>我的优惠券</h3>
                </div>
                <div class="bt_update">
                    充值送优惠
                </div>
            </th>
        </tr>
    </table>
    <table class="right_infodetail">
        <tr class="infoitem">
            <td style="font-size: 18px;font-weight: bolder">用户名</td><td><?php echo $firstname;?></td><td><div class="update" id="label_updateusername">修改</div></td>
        </tr>
        <tr class="infoitem">
            <td style="font-size: 18px;font-weight: bolder">手机号码</td><td><?php echo $telephone;?></td><td class="update" id="label_updatephone">修改</td>
        </tr>
        <tr class="infoitem">
            <td style="font-size: 18px;font-weight: bolder">电子邮箱</td><td><?php echo $email;?></td><td class="update" id="label_updateemail">修改</td>
        </tr>
        <tr class="infoitem">
            <td class="update" id="label_updatepassword">修改密码</td>
        </tr>
    </table>
</div>