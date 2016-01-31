$(document).ready(function () {
	$(document).on('click', "#cart_nav,.cart_hide", function () { 
		if($('#cart_dropdown').css('display') == 'none'){ 
			$('#cart_dropdown').css('display','block');
			$('.cart_background').css('display','block');
			$('#cart_dropdown').css('z-index','2');
			$('.footer').css('z-index','2');
		} else { 
			$('#cart_dropdown').css('display','none');
			$('.cart_background').css('display','none');
			$('#cart_dropdown').css('z-index','0');
			$('.footer').css('z-index','0');
		}
	});
});