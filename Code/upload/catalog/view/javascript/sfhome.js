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
		//alert('<div><strong>' + place.name + '</strong><br>' + address + '<br><a id=selectAddress class=select_address href='+getReturnUrl(latitude,longitude,address)+' >确定</a>' );
	    //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address + '<br><a id=selectAddress class=select_address href='+getReturnUrl(latitude,longitude,address)+' >确定</a>' );
	  });
	}	
	
	function getReturnUrl(lat,lng,address){
		return 'index.php?route=common/sfhome&lat=' + lat + '&lng='+lng+ '&address=' +encodeURIComponent(address);
	}	
	
$(document).ready(function () {
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