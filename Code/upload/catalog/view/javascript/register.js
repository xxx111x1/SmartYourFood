/**
 * Created by Min on 2015/8/22.
 */
var element_id='';
var err_msg='';
var passed=true;
var submitted = false;
$(document).ready(function() {
    // all jQuery code goes here
    /*
    $('#phonenumber').on('input',function(e){
        validatephonenumber();
    });
    */

    $("#welcome").owlCarousel({

        navigation : false, // Show next and prev buttons
        autoPlay: 3000,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true

        // "singleItem:true" is a shortcut for:
        // items : 1,
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false

    });
   // $(".owl-buttons").hide();
});

function regsubmit(){
    if(submitted)
    {
        return;
    }
    var name=$('#accountname').val();
    var phone_num = $('#phonenumber').val();
    var pwd_1st = $('#pwd_1st').val();
    var pwd_2nd = $('#pwd_2nd').val();
    if(isvalidusername(name)&&isvalidphonenum(phone_num)&&isvalidpassword(pwd_1st)&&isvalidconfirm(pwd_1st,pwd_2nd))
    {
        submitted=true;
        document.getElementById('regform').submit();
        return;
    }
    if(err_msg)
    {
        alert(err_msg);
    }
}

function loginsubmit(){
    var phone_num = $('#phonenum').val();
    var pwd = $('#password').val();
    err_msg=null;
    if(isvalidphonenum(phone_num)&&isvalidpassword(pwd))
    {
        document.getElementById('loginform').submit();
        return;
    }
    if(err_msg)
    {
        alert(err_msg);
    }
}

function validate_regform()
{
    var name = document.getElementById('name').value;
    var phonenum = document.getElementById('phone').value;
    var pwd = document.getElementById('password').value;
    if(isvalidusername(name)&&isvalidphonenum(phonenum)&&isvalidpassword(pwd))
    {
        alert('passed!');
    }
    alert(err_msg);
}

function isvalidusername( username)
{
    if(!username || username.length==0)
    {
        err_msg='User name cannot be empty. (用户名不能为空)';
        return false;
    }

    var str_name = username.toString();
    var len = str_name.length;
    if(len<2)
    {
        err_msg='Username is too short. (用户名太短，至少要有2个字符)';
        return false;
    }
    if(len>24)
    {
        err_msg='Username is too long. (用户名太长，不能超过24个字符)';
        return false;
    }
    return true;
}

function isvalidphonenum(phonenum)
{
    if(!phonenum || phonenum.length==0)
    {
        err_msg='Phone number cannot be empty. (电话号码不能为空)';
        return false;
    }
    if(phonenum.length!=10)
    {
        err_msg='Phone number length should be 10. (电话号码长度长度不对)';
        return false;
    }
    var re=/^\d+$/;
    if(phonenum.match(re))
    {
        return true;
    }
    err_msg='Phone number should be number only. (电话号码只能为数字)';
    return false;
}

function isvalidpassword(pwd)
{
    if(!pwd || pwd.length==0)
    {
        err_msg='Password cannot be empty. (密码不能为空)';
        return false;
    }
    var len=pwd.length;
    if(len<6)
    {
        err_msg='Password shoule be longer than 5. (密码太短)';
        return false;
    }
    
    var onlynum = /^\d+$/;
    if(pwd.match(onlynum))
    {
        err_msg="Password is too simple, shouldn't just number. (密码不能全为数字) ";
        return false;
    }
    var onlylowercase = /^[a-z]+$/;// new RegExp('^\w+$');
    if(pwd.match(onlylowercase))
    {
        err_msg="Password is too simple, shouldn't contain just lower case (密码不能全为小写字母)";
        return false;
    }
    return true;
}

function isvalidconfirm(pwd,confirm)
{
    console.log('pwd'+pwd+' confirm'+confirm);
    if(!confirm||confirm.length==0)
    {
        err_msg='Please input confirm password. (请输入确认密码)';
        console.log(err_msg);
        return false;
    }
    if(pwd===confirm)
    {
        return true;
    }
    err_msg='Passwords are different. (两次输入密码不一致)';
    return false;
}
