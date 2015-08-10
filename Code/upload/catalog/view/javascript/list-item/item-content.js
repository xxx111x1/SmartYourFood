$(document).ready(function () {
	$('.filter_field').click(function() {
		$(this).toggleClass("filter_field_selected");
		if($(this).hasClass("filter_field_selected")){
			var tagId = $(this).val(); 
			$("#filters").val($("#filters").val()+tagId+",");
			var filters = $("#filters").val().slice(0, -1);
			var orders = " order by ";
			$(".orders").each(function(){
				orders = $(this).attr('id') + " " + $(this).val() +", ";
				});
			$.ajax({
				url: 'index.php?route=api/restaurant/getRestaurants',
				type: 'post',
				data: 'filters=' + filters + '&orders=' + orders,
				dataType: 'json',
				/*beforeSend: function() {
					$('#cart > button').button('loading');
				},
				complete: function() {
					$('#cart > button').button('reset');
				},
				*/			
				success: function(json) {
					
					if (json['redirect']) {
						location = json['redirect'];
					}

					if (json['success']) {
						$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						
						// Need to set timeout otherwise it wont update the total
						setTimeout(function () {
							$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
						}, 100);
					
						$('html, body').animate({ scrollTop: 0 }, 'slow');

						$('#cart > ul').load('index.php?route=common/cart/info ul li');
					}
				}
			});		
		}
		
		
	});
	
	$('.sf_product').click(function() {
		var restaurantId = $(this).attr('id');
		window.location = "index.php?id="+restaurantId;
	});

});