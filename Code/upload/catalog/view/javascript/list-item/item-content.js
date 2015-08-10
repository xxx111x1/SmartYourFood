$(document).ready(function () {
	$('.filter_field').click(function() {
		$(this).toggleClass("filter_field_selected");
		if($(this).hasClass("filter_field_selected")){
			var tagId = $(this).attr('value'); 
			$("#filters").attr('value',($("#filters").attr('value')+","+tagId));
			var filters = $("#filters").attr('value');
			filters = filters.replace("0,", "").replace("0","");
			var orders = "";
			$(".orders").each(function(){
				orders = orders + $(this).attr('id') + " " + $(this).attr('value') +", ";
				});
			orders = orders.substring(0,orders.length - 2)
			$.ajax({
				url: 'index.php?route=api/restaurant/getRestaurants',
				type: 'post',
				data: 'filters=' + filters + '&orders=' + orders,
				dataType: 'json',
				/*
				 * beforeSend: function() { $('#cart >
				 * button').button('loading'); }, complete: function() {
				 * $('#cart > button').button('reset'); },
				 */			
				success: function(data) {
					$(".product_area").empty();
					$.each(data, function(i, v) {
						var ele = "<div class=sf_product id="+v.restaurant_id+" title="+v.name+ " ><img class=sf_product_preview src="+v.img_url +" />"
						+"<div class=sf_product_title >"+v.name+"</div><img class=sf_product_stars src='img/stars_2.png'> <div class=sf_product_sv>本月销量-份</div>"+
						"<div class=sf_product_price><span style='MARGIN-RIGHT: 10px'>价格:"+v.avg_cost+"</span><span>配送: </span><span class='glyphicon glyphicon-time' style='FLOAT: right'>分钟</span> </div></div>";
						$(".product_area").append(ele);

					});					
				}
			});		
		}
		
		
	});
	
	$('.sf_product').click(function() {
		var restaurantId = $(this).attr('id');
		window.location = "index.php?id="+restaurantId;
	});

});