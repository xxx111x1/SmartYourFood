/**
 * Created by Min on 2015/9/30.
 */
$(document).ready(function() {
    var curpage="#updateaccount_";
    if(window.location.href.indexOf("success")>0){
    	curpage = "#orderhistory_";
    }else if(window.location.href.indexOf("address")>0){
    	curpage = "#updateaddress_";
    }
    var pageid = $("#currentpage").attr('pageid');
    if(pageid)
    {
        curpage=pageid;
    }
    $(".rightpanel").hide();
    console.log(curpage);
    $(curpage).show();
    // all jQuery code goes here
    $("#orderhistory").click(function(){
            $(".rightpanel").hide();
            $("#orderhistory_").show();
        }
    );
    $("#updateaddress").click(function(){
            $(".rightpanel").hide();
            $("#updateaddress_").show();
        }
    );

    $("#updateaccount").click(function(){
            $(".rightpanel").hide();
            $("#updateaccount_").show();
        }
    );

    $("#newsletter").click(function(){
            $(".rightpanel").hide();
            $("#newsletter_").show();
        }
    );

    $(".review-close").click(function(){
        $('.review-dialog-frame').addClass('invisible');
    });

    $("#label_updateusername").click(function(){
        $('#dialog_updateusername').removeClass('invisible');
    });

    $("#label_updatephone").click(function(){
        $('#dialog_updatephone').removeClass('invisible');
    });

    $("#label_updateemail").click(function(){
        $('#dialog_updateemail').removeClass('invisible');
    });

    $("#label_updatepassword").click(function(){
        $('#dialog_updatepassowrd').removeClass('invisible');
    });

    $(".deleteAddress").click(function(){
        var addressId = $(this).attr('addr_id');
        $.ajax({
            url: 'index.php?route=api/address/deleteShippingAddress',
            type: 'post',
            data: 'addressId='+addressId,
            timeout: 3000,
            dataType: 'json',
            error: function(){
                alert("删除地址失败");
            },
            success: function(data) {
                if (!data['status'] || !(data['status']==='ok')){
                	alert("删除地址失败");
                }
                else{
                	alert("地址删除成功");
                	$('#address_' +addressId).remove();
                }
            }
        });
    });
    
    $(".editAddress").click(function(){
        var addressId = $(this).attr('addr_id');
        var phone = $('#phone_' + addressId).text();
        var contact = $('#contact_' + addressId).text();
        window.location.href = 'index.php?route=address/address&phone=' +phone+  '&contact=' + contact + '&returnUrl=/index.php?route=account/account&addressId=' + addressId;
    });

    $('#btn_confirmusername').click(function(){
        var new_username = $('#updateusername').val();
        $.ajax({
            url: 'index.php?route=account/account/editusername',
            type: 'post',
            data: 'username='+new_username,
            timeout: 32000,
            dataType: 'json',
            error: function(){
                alert("修改用户名失败");
                $('.review-dialog-frame').addClass('invisible');
            },
            success: function(data) {
                if (!data['status'] || !(data['status']==='ok')){
                    alert("修改用户名失败");
                }
                else{
                	window.location.href=window.location.href;
                }
            }
        });
    });

    $('#btn_confirmphone').click(function(){
        var value = $('#updatephone').val();
        $.ajax({
            url: 'index.php?route=account/account/editphone',
            type: 'post',
            data: 'phone='+value,
            timeout: 32000,
            dataType: 'json',
            error: function(){
                alert("修改手机失败，请联系客服");
                $('.review-dialog-frame').addClass('invisible');
            },
            success: function(data) {
                if (!data['status'] || !(data['status']==='ok')){
                    alert("修改手机号码失败，该手机号已被注册，请使用其他手机号。");
                }
                else{
                	window.location.href=window.location.href;
                }
            }
        });
    });


    $('#btn_confirmemail').click(function(){
        var value = $('#updateemail').val();
        $.ajax({
            url: 'index.php?route=account/account/editemail',
            type: 'post',
            data: 'email='+value,
            timeout: 32000,
            dataType: 'json',
            error: function(){
                alert("修改邮箱失败");
                $('.review-dialog-frame').addClass('invisible');
            },
            success: function(data) {
            	if (!data['status'] || !(data['status']==='ok')){
                    alert("修改邮箱失败");
                }
                else{
                	window.location.href=window.location.href;
                }
            }
        });
    });

    $('#btn_confirmpassword').click(function(){
        var value = $('#input_oldpassword').val();
        var newpwd=$('#input_updatepassword').val();
        var newpwdConfirm=$('#input_confirmpassword').val();
        if(newpwd != newpwdConfirm){
        	alert("输入的新密码不一致，请重新输入新密码");
        }
        else{
        	$.ajax({
                url: 'index.php?route=account/account/editpassword',
                type: 'post',
                data: 'oldpassword='+value+'&newpassword='+newpwd,
                timeout: 32000,
                dataType: 'json',
                error: function(){
                    alert("修改密码失败");
                    $('.review-dialog-frame').addClass('invisible');
                },
                success: function(data) {
                	if (!data['status'] || !(data['status']==='ok')){
                        alert("修改密码失败");
                    }
                	else{
                		alert("密码修改成功");
                		$('.review-dialog-frame').addClass('invisible');
                	}
                }
            });
        }        
    });

});