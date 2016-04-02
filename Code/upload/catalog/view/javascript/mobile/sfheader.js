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
		
		$(".place_img,.address_frame,#goto_address").click(function(){
			window.location.href="http://localhost:8080/index.php?route=account/account&updateaddress=1&returnUrl=/index.php?route=common/list";
		});
});