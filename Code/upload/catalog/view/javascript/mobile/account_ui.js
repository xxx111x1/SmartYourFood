/**
 * Created by Min on 2015/9/30.
 */
$(document).ready(function() {
    var curpage="";
    var url=window.location.href;
    if(url.indexOf("success")>0){
    	curpage = "#orderhistory";
    }else if(url.indexOf("updateaddress")>0){
    	curpage = "#updateaddress";
    }else if(url.indexOf("updateaccount")>0){
    	curpage = "#updateaccount";
    }else if(url.indexOf('orderhistory')>0){
    	curpage='#orderhistory';
    }
    if(curpage!=""){
    	hideInitalContent();
		$("html").css("background-color","white");
		var title = $(curpage).find(".bar_label").text();
		updateTitle(title);
		$('.content_modify').css("display","block");
        $(curpage+"_").show();
        if(curpage == "#updateaddress"){
            $('.mark').first().css('visibility','visible');
        }
    }
    

    // all jQuery code goes here
    $("#orderhistory").click(function(){
            hideInitalContent();
    		$("html").css("background-color","#eeeeee");
    		var title = $(this).find(".bar_label").text();
    		updateTitle(title);
    		$('.content_modify').css("display","block");
            $("#orderhistory_").show();
            
    });
    $("#updateaddress").click(function(){
    		hideInitalContent();
    		$("html").css("background-color","white");
    		var title = $(this).find(".bar_label").text();
    		updateTitle(title);
    		$('.content_modify').css("display","block");
            $("#updateaddress_").show();
            
        }
    );

    $("#updateaccount").click(function(){
    		hideInitalContent();
    		var title = $(this).find(".bar_label").text();
    		updateTitle(title);
    		$('.content_modify').css("display","block");
            $("#updateaccount_").show();
            $('.addressbox').first('.mark').css('visibility','visible');
        }
    );
    
    $(".order_rest").click(function(){
    	var restid = $(this).attr('restid');
    	if(restid>0){
    		window.location.href = '/index.php?route=sfrest/detail&restaurant_id=' + restid;
    	}
    });

    $("#newsletter").click(function(){
            $(".rightpanel").hide();
            url='/index.php?route=account/account#newsletter_';
            window.location.href = url;
            $("#newsletter_").show();
        }
    );
    
    function showInitalContent(){
    	$(".initial_content").css("display","block");
    	$(".content_modify").css("display","none");
    	$(".edit_content").css("display","none");
    	$("html").css("background-color","#eeeeee");
    }
    
    function hideInitalContent(){
    	$(".initial_content").css("display","none");
    }
    
    function updateTitle(title){
    	$("#header_title").text(title);
    }
    
    $("#back_initial_content").click(function(){
    	var returnUrl = getParameterByName("returnUrl")
    	if(returnUrl!= null && returnUrl != ""){
    		window.location.href=returnUrl;
    	}
    	else{
    		showInitalContent();
    	}
    	
    });
    
    $('.addressbox').click(function(){
        $('.addressbox').find('.mark').css('visibility','hidden');
        $(this).find('.mark').css('visibility','visible');
        var addr_id = $(this).attr('addr_id');
        if(addr_id){
        	setAddress(addr_id);
    	}
        //shippaddress.set_address(addr_id);        
    });
    function setAddress(addr_id) {
        console.log('start to set address: '+addr_id);
        $.ajax({
            url: 'index.php?route=sfcheckout/checkout/set_address',
            type: 'post',
            data: 'addr_id=' + addr_id,
            dataType: 'json',
            success: function(json) {
                
            }
        });
    }
    
    $(".deleteAddress").click(function(){
        var addressId = $(this).attr('addr_id');
        $.ajax({
            url: 'index.php?route=api/address/deleteShippingAddress',
            type: 'post',
            data: 'addressId='+addressId,
            timeout: 3000,
            dataType: 'json',
            error: function(){
                alert("Delete address failed, please try later.(删除地址失败,请稍后再试)");
            },
            success: function(data) {
                if (!data['status'] || !(data['status']==='ok')){
                	alert("Delete address failed, please try later.(删除地址失败,请稍后再试)");
                }
                else{
                	alert("Delete succeed.(地址删除成功)");
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
    
    $(".confirm").click(function(){
    	var username = $('#updateusername').val();
    	var phone = $('#updatephone').val();
    	var value = $('#input_oldpassword').val();
        var newpwd=$('#input_updatepassword').val();
        var newpwdConfirm=$('#input_confirmpassword').val();
        if(newpwd != "" && newpwdConfirm !="" && newpwd != newpwdConfirm){
        	alert("The passwords are different, please input again. (输入的新密码不一致，请重新输入新密码)");
        }
        else{
        	$.ajax({
                url: 'index.php?route=account/account/editaccount',
                type: 'post',
                data: 'username='+username + '&phone=' + phone + '&oldpassword='+value+'&newpassword='+newpwd,
                timeout: 32000,
                dataType: 'json',
                error: function(){
                    alert("Moidfy failed, please try again. (修改失败)");
                },
                success: function(data) {
                	if (!(data['status']=='ok')){
                        alert(data['status']);
                    }
                	else{
                		alert("Modify succeed. (修改成功)");
                		window.location.href="/index.php?route=account/account";
                	}
                }
            });
        }       
        
    });

    $('.log_out').click(function(){
		window.location.href="index.php?route=common/sfhome&logout=1";
	});
    
    $('.pagebutton').click(function(){    	
        var page = $('#pageNumber').val();
        var totalPageNumber = $('#totalPageNumber').val();
        if ($(this).hasClass('add') && page<totalPageNumber){
        	page++;
        }
        else if($(this).hasClass('minus') &&page>1){
        	page--;
        }
        else{
        	if($(this).text().indexOf('Next')>-1){
        		alert('It is the last page.');
        	}
        	else{
        		alert('It is the first page.');
        	}
        	
        	return;
        }
        updateOrderContent(page);
       	            
    });
    
    $('.pagenumber').click(function(){    	
        var page = $(this).attr('value');  
        updateOrderContent(page);
       	            
    });
    
    $( "input[type='text']" ).change(function() {
    	  var page = $(this).val();
    	  var totalPageNumber = $('#totalPageNumber').val();
    	  if(page>0 && page<=totalPageNumber){
    		  updateOrderContent(page);  
    	  }
    	  else if(page<1){
    		  updateOrderContent(1);
    	  }
    	  else if(page>totalPageNumber){
    		  updateOrderContent(totalPageNumber);
    	  }
    	  
    });

    function updateOrderContent(page){
    	$.ajax({
            url: 'index.php?route=api/order/getHistoryOrderByPage&page=' + page,
            type: 'get',
            timeout: 32000,
            dataType: 'json',
            error: function(){
                alert("Sorry, there is an error, please try again later.");
                
            },
            success: function(data) {
            	if (data['error']){
                    alert("Please login again.");
                }
            	else{
            		$('.pagenumber').removeClass('selectedPage');
                    $('#page'+page).addClass('selectedPage');
            		$( ".orderContent" ).remove()
					$('#pageNumber').val(data['page']);
					var elementString = "";
            		$.each(data['orders'], function(i, v) {
            			 elementString = elementString + '<tr class="orderContent"><td class="col1"><div class="orderthumb"><div class="foodpic"><img width="85px" height="85px" src="img/shop.1.jpg"/></div><div class="orderdesc"><div class="foodname">'+v.shipping_address_1+'</div>';
            			elementString = elementString + '<div class="ordertime">' + v.date_added + '</div></div></div></td><td class="col2">'+v.name+'</td><td class="col3">'+v.total+'</td><td class="col4">'+ v.status + '</td></tr>';
            		});
					$('.ordertable').append(elementString);
            	}
            }
     });   
    }
    
    function getParameterByName(name) {
        var url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
});