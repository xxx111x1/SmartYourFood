$(document).ready(function () {
		$("#category_img,#categoryLabel").click(function(){
			if($('.filterarea').css('display') == 'none'){ 
				$('.filterarea').css('display','block');
				$('.cart_background').css('display','block');
				$('.filterarea').css('z-index','2');
				$('.header').css('z-index','2');
			} else { 
				$('.filterarea').css('display','none');
				$('.cart_background').css('display','none');
				$('.filterarea').css('z-index','0');
				$('.header').css('z-index','0');
			}
		});
});