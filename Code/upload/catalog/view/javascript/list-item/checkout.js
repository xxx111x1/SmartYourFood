/**
 * Created by Min on 2015/8/29.
 */
$(document).ready(function () {
    $('.ck_add_food').click(function(){
            var id = $(this).attr('value');
            console.log('id: '+id);
            var number = parseInt($('#food_'+id+'_number').text());
            console.log('number: '+number);
            number++;
            if(number<=1000)
            {
                cart.add(id,number);
                $('#food_'+id+'_number').text(number);
            }
        }
    );

    $('.ck_remove_food').click(function(){
            var id = $(this).attr('value');
            var number = parseInt($('#food_'+id+'_number').text());
            if(number>=1)
            {
                number--;
                cart.add(id,number);
                $('#food_'+id+'_number').text(number);
            }
        }
    );
    
    intialAddress();
    
    function intialAddress(){
    	$('.addressbox').first().addClass('addressbox_selected');
    	var addr_id = $('.addressbox').first().attr('addr_id');
    	shippaddress.set_address(addr_id);
    }

    $('.addressbox').click(function(){
            $('.addressbox').removeClass('addressbox_selected');
            $(this).addClass('addressbox_selected');
            var addr_id = $(this).attr('addr_id');
            shippaddress.set_address(addr_id);
        }
    );
    
    $('#fastDelivery').click(function(){
    	var beforeTax = parseFloat($('#beforetax').text().replace('$', ''));
    	var deliverfee = parseFloat($('#deliverfee').text().replace('$', ''));
    	var taxcost = parseFloat($('#taxcost').text().replace('$', ''));
    	var total = beforeTax + deliverfee + taxcost;
    	if($("#fastDelivery").is(':checked')){
    		total += 5;
    		$('#orderConfirm').attr("href","/index.php?route=sfcheckout/confirm&isFast=true");
    	}
    	else{
    		$('#orderConfirm').attr("href","/index.php?route=sfcheckout/confirm");
    	}
    	$('#totalcost').text("$" + total.toFixed(2));
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
        window.location.href = 'index.php?route=address/address&phone=' +phone+  '&contact=' + contact + '&returnUrl=/index.php?route=sfcheckout/checkout&addressId=' + addressId;
    });

    
});

//shipping address
var shippaddress = {
    'set_address': function(addr_id) {
        console.log('start to set address: '+addr_id);
        $.ajax({
            url: 'index.php?route=sfcheckout/checkout/set_address',
            type: 'post',
            data: 'addr_id=' + addr_id,
            dataType: 'json',
            success: function(json) {
                console.log('set address id succeeded');
            }
        });
    },
    'remove': function() {

    }
}

function onDishImgError(source){
	source.src = "./catalog/view/theme/default/image/foodImages/dish_default.jpg";
	source.onerror="";
}

