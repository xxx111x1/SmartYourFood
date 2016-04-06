/**
 * Created by Min on 2015/9/30.
 */
$(document).ready(function() {
	
	$("#back_checkout").click(function(){
    	window.location.href="/index.php?route=sfcheckout/checkout";
    	
    });
	
	$("#back_initial_content").click(function(){
    	var returnUrl = getParameterByName("returnUrl")
    	var url=""
    	if(returnUrl!= null && returnUrl != ""){
    		url = returnUrl;
    	}
    	else{
    		url = "/index.php?route=common/list";
    	}
    	window.location.href=url;
    	
    });
	
	$(".address_area").click(function(){
		window.location=href="/index.php?route=account/account&updateaddress=1&returnUrl=index.php?route=sfcheckout/checkout";
	});
	
	$(document).on('click', '.minus_product,.add_product', function(){
		var id = $(this).attr('foodid');
		var number = $('.product_'+id).first().text();
		if($(this).hasClass("minus_product")&&number>=0){
				number--;
				if(number>=0){
					add(id,number);
					$('.product_'+id).text(number);
					updateRestId();
				}
				
			}
			else{
				number++;
				$('.minus_product_'+id).removeClass('product_number_0');
				$('.product_'+id).removeClass('product_number_0');
				add(id,number);
				$('.product_'+id).text(number);
				updateRestId();
				
			}
	});		
	
	$('#fastDelivery').click(function(){
    	var beforeTax = parseFloat($('#beforetax').text().replace('$', '').replace(',', ''));
    	var deliverfee = parseFloat($('#deliverfee').text().replace('$', '').replace(',', ''));
    	var taxcost = parseFloat($('#taxcost').text().replace('$', '').replace(',', ''));
    	var total = beforeTax + deliverfee + taxcost;
    	if($("#fastDelivery").is(':checked')){
    		total = total　+　(Math.round(beforeTax * 5)/100);
    		$('#orderConfirm').attr("href","/index.php?route=sfcheckout/confirm&isFast=true");
    	}
    	else{
    		$('#orderConfirm').attr("href","/index.php?route=sfcheckout/confirm");
    	}
    	$('#totalcost').text("$" + total.toFixed(2));
    });
	
	function add(product_id, quantity) {
		$.ajax({
			url: 'index.php?route=checkout/cart/add',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				/*$('#cart > button').button('loading');*/
			},
			complete: function() {
				/*$('#cart > button').button('reset');*/
			},			
			success: function(json) {
				$('.alert, .text-danger').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
                    update_cost_info(json);
					$('.cart_table').load('index.php?route=sfcheckout/checkout/info');
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