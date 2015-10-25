/**
 * Created by Min on 2015/9/30.
 */
$(document).ready(function() {
    var curpage="#updateaccount_";
    if(window.location.href.indexOf("success")){
    	curpage = "#orderhistory_";
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



    $('#btn_confirmusername').click(function(){
        var new_username = $('#updateusername').val();
        $.ajax({
            url: 'index.php?route=account/account/editusername',
            type: 'post',
            data: 'username='+new_username,
            timeout: 32000,
            dataType: 'json',
            error: function(){
                alert("�û����޸�ʧ�ܣ����Ժ�����.");
                $('.review-dialog-frame').addClass('invisible');
            },
            success: function(data) {
                if (data['status'] && data['status']==='ok'){
                    alert(data['status']);
                }
                else{
                    alert("�û����޸�ʧ�ܣ����Ժ�����.");
                }
                $('.review-dialog-frame').addClass('invisible');
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
                alert("�ֻ������޸�ʧ�ܣ����Ժ�����.");
                $('.review-dialog-frame').addClass('invisible');
            },
            success: function(data) {
                alert(data['status']);
                if (data['status']){
                    alert(data['status']);
                }
                $('.review-dialog-frame').addClass('invisible');
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
                alert("update email failed.");
                $('.review-dialog-frame').addClass('invisible');
            },
            success: function(data) {
                if (data['status'] && data['status']==='ok'){
                    alert(data['status']);
                }
                else{
                    alert("update email failed.");
                }
                $('.review-dialog-frame').addClass('invisible');
            }
        });
    });

    $('#btn_confirmpassword').click(function(){
        var value = $('#input_oldpassword').val();
        var newpwd=$('#input_updatepassword').val();
        $.ajax({
            url: 'index.php?route=account/account/editpassword',
            type: 'post',
            data: 'oldpassword='+value+'&newpassword='+newpwd,
            timeout: 32000,
            dataType: 'json',
            error: function(){
                alert("�����޸�ʧ�ܣ����Ժ�����.");
                $('.review-dialog-frame').addClass('invisible');
            },
            success: function(data) {
                if (data['status'] && data['status']==='ok'){
                    alert(data['status']);
                }
                else{
                    alert("�����޸�ʧ�ܣ����Ժ�����.");
                }
                $('.review-dialog-frame').addClass('invisible');
            }
        });
    });

});