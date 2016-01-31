$(document).ready(function () {
	$("#cart_nav,.cart_hide").click(function(){
		if($('#cart_dropdown').css('display') == 'none'){ 
			$('#cart_dropdown').css('display','block');
			$('.cart_background').css('display','block');
			
		} else { 
			$('#cart_dropdown').css('display','none');
			$('.cart_background').css('display','none');
		}
	});
});