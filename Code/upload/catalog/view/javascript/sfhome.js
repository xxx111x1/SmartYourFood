function initMap() {
  var input = /** @type {!HTMLInputElement} */(document.getElementById('pac-input'));
  var options = {	  componentRestrictions: {country: "ca"}	 };
  var autocomplete = new google.maps.places.Autocomplete(input, options);
  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }	
    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }
	var latitude = place.geometry.location.lat();
	var longitude = place.geometry.location.lng(); 
	$.ajax({
		url: 'index.php?route=api/address/setAddress',
		type: 'get',
		data: 'lat=' + latitude + '&lng=' + longitude+ '&address=' + encodeURIComponent(address) + '&isInsert=1',
		dataType: 'json',
		success: function(data) {
		}
	});		
  });
}	

function getReturnUrl(lat,lng,address){
	return 'index.php?route=common/sfhome&lat=' + lat + '&lng='+lng+ '&address=' +encodeURIComponent(address);
}
	
$(document).ready(function () {
	
	$(document).on('click', '.buy-cart', function(){
		var foodId = $(this).parent().attr('foodid');
		$.ajax({
			url: 'index.php?route=checkout/cart/add',
			type: 'post',
			data: 'product_id=' + foodId + '&quantity=' + 1,
			dataType: 'json',
			success: function(json) {
				var url = '/index.php?route=sfcheckout/checkout';				
				window.location.href = url;
			}
		});		
	});
	
	$(document).on('click', '.food-background,.food-hover-content,.food-name,.food-desc', function(){
		var restId = $(this).parent().attr('restid');
		var foodId = $(this).parent().attr('foodid');
		var url = '/index.php?route=sfrest/detail&restaurant_id=' + restId + '&food_id=' + foodId;				
		window.location.href = url;
	});
	
	$(document).on('click', '#dropdown', function(){
		$('.history-addresses').toggleClass("hide");
	});
	
	$('div:not(#dropdown,.address,.search-bar)').click( function(){
		$('.history-addresses').addClass("hide");
	});
	
	$(document).on('click', '.address', function(){
		var address = $(this).text();
		var lat = $(this).attr('lat');
		var lng = $(this).attr('lng');
		$('#pac-input').val(address);
		$.ajax({
			url: 'index.php?route=api/address/setAddress',
			type: 'get',
			data: 'lat=' + lat + '&lng=' + lng + '&address=' + encodeURIComponent(address) + '&isInsert=0',
			dataType: 'json',
			success: function(data) {
			}
		});	
		$('.history-addresses').addClass("hide");
	});
	
	$('#search-button').on('click', function () {		
        var searchKeyWords = $('#serach-input').val();
        var type=$('#searchType').val();	
        var url = '/index.php?route=sffood/search&search=' +searchKeyWords;
        window.location.href = url;
    });
	$('#serach-input').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the enter key code
		{
			var searchKeyWords = $('#serach-input').val();
			var type=$('#searchType').val();
			var url = '/index.php?route=sffood/search&search=' +searchKeyWords;
			window.location.href = url;
		}
	});

	$(".click-point-first,.first-triangle-left,.first-tip").hover(
			function(){
				$(".second-tip").css("background","rgba(0, 0, 0, 0)");
				$(".second-tip-content,.second-triangle-left").css("opacity","0");
			},
			function(){
				$(".second-tip").css("background","rgba(0, 0, 0, .4)");
				$(".second-tip-content,.second-triangle-left").css("opacity","");
			}
	);
	
	$(".click-point-second,.second-triangle-left,.second-tip").hover(
			function(){
				$(".first-tip").css("background","rgba(0, 0, 0, 0)");
				$(".first-tip-content,.first-triangle-left").css("opacity","0");
			},
			function(){
				$(".first-tip").css("background","rgba(0, 0, 0, .4)");
				$(".first-tip-content,.first-triangle-left").css("opacity","");
			}
	);
	
	$(".food").hover(
			function(){
				$(this).addClass( "food-hover" );
				$(this).find(".food-background").css("margin-top","-50px");
				$(this).find(".food-hover-content").removeClass("hide");
				$(this).find(".buy-cart").removeClass("hide");
			},
			function(){
				$(this).find(".fond-hover-content").hide();
				$(this).find(".food-background").css("margin-top","28px");
				$(this).find(".food-hover-content").addClass("hide");
				$(this).find(".buy-cart").addClass("hide");
				$(this).removeClass( "food-hover" );				
			}
	);	
});