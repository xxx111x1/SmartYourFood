/**
 * Created by Min on 2015/9/30.
 */
$(document).ready(function() {
    $(".rightpanel").hide();
    $("#updateaccount_").show();
    // all jQuery code goes here
    $("#orderhistory").hover(function(){
            $(".rightpanel").hide();
            $("#orderhistory_").show();
        }
    );
    $("#updateaddress").hover(function(){
            $(".rightpanel").hide();
            $("#updateaddress_").show();
        }
    );

    $("#updateaccount").hover(function(){
            $(".rightpanel").hide();
            $("#updateaccount_").show();
        }
    );
});