/**
 * Created by Min on 2015/8/22.
 */
$(document).ready(function() {
    // all jQuery code goes here
    $('#phonenumber').on('input',function(e){
        validatephonenumber();
    });
});

function regsubmit(){
    //alert('Hello world!');
    var phone_num = $('#phonenumber').val();

    if(validatephonenumber() && validate1stpwd() && validate2ndpwd())
    {
      $('#regform').submit();
        return true;
    }
    else{
        alert('请再次检查输入');
        return false;
    }
    //alert(phone_num);
}

function validatephonenumber(){
    var phone_num = $('#phonenumber').val();
    $("#phonenum_chkres").removeClass("glyphicon-ok");
    $("#phonenum_chkres").removeClass("glyphicon-remove");
    if(phone_num.length==6)
    {
        $("#phonenum_chkres").addClass("glyphicon-ok");
        $("#phonenum_chkres").css("color","darkgreen");
        return true;
    }
    else{
        $("#phonenum_chkres").addClass("glyphicon-remove");
        $("#phonenum_chkres").css("color","red");
        return false;
    }

}

function validate1stpwd(){
    var pwd_1st = $('#pwd_1st').val();
    $("#1stpwd_chkres").removeClass("glyphicon-ok");
    $("#1stpwd_chkres").removeClass("glyphicon-remove");
    if(pwd_1st.length>=6)
    {
        $("#1stpwd_chkres").addClass("glyphicon-ok");
        $("#1stpwd_chkres").css("color","darkgreen");
        return true;
    }
    else{
        $("#1stpwd_chkres").addClass("glyphicon-remove");
        $("#1stpwd_chkres").css("color","red");
        return false;
    }
}

function validate2ndpwd(){
    var pwd_2nd = $('#pwd_2nd').val();
    var pwd_1st = $('#pwd_1st').val();
    $("#2ndpwd_chkres").removeClass("glyphicon-ok");
    $("#2ndpwd_chkres").removeClass("glyphicon-remove");

    if(pwd_1st==pwd_2nd)
    {
        $("#2ndpwd_chkres").addClass("glyphicon-ok");
        $("#2ndpwd_chkres").css("color","darkgreen");
        return true;
    }
    else{
        $("#2ndpwd_chkres").addClass("glyphicon-remove");
        $("#2ndpwd_chkres").css("color","red");
        return false;
    }
}