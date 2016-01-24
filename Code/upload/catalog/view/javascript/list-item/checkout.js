/**
 * Created by Min on 2015/8/29.
 */
$(document).ready(function () {
	
	$('.orderPreview').click(function(){
		var foodId = $(this).attr('foodId');
		var restId = $(this).attr('restId');		
		var url = '/index.php?route=sfrest/detail&restaurant_id=' + restId + '&food_id=' + foodId +'#' + foodId;
		window.location.href=url;
	})
	
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
    	//shippaddress.set_address(addr_id);
    }

    $('.addressbox').click(function(){
            $('.addressbox').removeClass('addressbox_selected');
            $(this).addClass('addressbox_selected');
            var isNight = $('#deliveryFeeInfor').attr('isNight');
            var addr_id = $(this).attr('addr_id');
            var restLat = $('#deliveryFeeInfor').attr('lat');
            var restLng = $('#deliveryFeeInfor').attr('lng');
            var lat = $(this).attr('lat');
            var lng = $(this).attr('lng');
            var distance = gpsDistance(lat,lng,restLat,restLng,'K');
            var deliveryFee = 4 + Math.max(0,Math.round(distance-4)) + (Math.max(0,Math.round(distance-8)))*0.5;
            if(isNight == 1 ){
            	deliveryFee = deliveryFee + 2;
            }
            $('#deliverfee').text(" $"+deliveryFee);
            var beforetax = parseFloat($('#beforetax').text().replace('$',''));
            var taxcost = parseFloat($('#taxcost').text().replace('$',''));
            var sum = beforetax + deliveryFee + taxcost;
            if($("#fastDelivery").is(':checked')){
            	var fastdeliverfee = parseFloat($('#fastdeliverfee').text().replace('$',''));
            	sum = sum + fastdeliverfee
            }
            $('#totalcost').text(" $ "+sum.toFixed(2));
            //shippaddress.set_address(addr_id);
            
        }
    );
    
    $('#fastDelivery').click(function(){
    	var beforeTax = parseFloat($('#beforetax').text().replace('$', ''));
    	var deliverfee = parseFloat($('#deliverfee').text().replace('$', ''));
    	var taxcost = parseFloat($('#taxcost').text().replace('$', ''));
    	var total = beforeTax + deliverfee + taxcost;
    	if($("#fastDelivery").is(':checked')){
    		total += beforeTax * 0.05;
    		$('#orderConfirm').attr("href","/index.php?route=sfcheckout/confirm&isFast=true");
    	}
    	else{
    		$('#orderConfirm').attr("href","/index.php?route=sfcheckout/confirm");
    	}
    	$('#totalcost').text("$" + total.toFixed(2));
    });
    
    $(".deleteAddress").click(function(e){
    	e.stopPropagation();
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
    
    $(".editAddress").click(function(e){
    	e.stopPropagation();
        var addressId = $(this).attr('addr_id');
        var phone = $('#phone_' + addressId).text();
        var contact = $('#contact_' + addressId).text();
        window.location.href = 'index.php?route=address/address&phone=' +phone+  '&contact=' + contact + '&returnUrl=/index.php?route=sfcheckout/checkout&addressId=' + addressId;
    });

    
});

function gpsDistance(lat1, lon1, lat2, lon2, unit) {
	if(lat2<=0){
		return 0 ;
	}
	var radlat1 = Math.PI * lat1/180;
	var radlat2 = Math.PI * lat2/180;
	var radlon1 = Math.PI * lon1/180;
	var radlon2 = Math.PI * lon2/180;
	var theta = lon1-lon2;
	var radtheta = Math.PI * theta/180;
	var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
	dist = Math.acos(dist);
	dist = dist * 180/Math.PI;
	dist = dist * 60 * 1.1515;
	if (unit=="K") { dist = dist * 1.609344; }
	if (unit=="N") { dist = dist * 0.8684; }
	return dist.toFixed(2);
}

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

