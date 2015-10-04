$(document).ready(function () {
	

	
	$(document).on('click', '.thumb_view,.thumb_desc_restname', function(){
		var restId = $(this).attr('restid');
		var url = '/index.php?route=sfrest/detail&restaurant_id=' + restId;
		if (type=='food'){			
			var foodId = $(this).attr('foodid');
			url = url+ '&food_id=' + foodId;
		}						
		window.location.href = url;
	});
	
	$(document).on('mouseover','.thumb', function(){
		$(this).find(".thumboverlay").show();
	});
	
	$(document).on('mouseout','.thumb', function(){
		$(this).find(".thumboverlay").hide();
	});
	
	$(document).on('click', '.thumb_add2cart', function(){
		var id = $(this).attr('foodid');
		cart.addone(id);
		var cartIcon = $('#cart_thumbnail');
        var imgtodrag = $(this).parent('.thumboverlay').siblings(".thumb_preview").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': cartIcon.offset().top + 10,
                    'left': cartIcon.offset().left + 10,
                    'width': 75,
                    'height': 75
                	},          1000
               );
            
            setTimeout(function () {
            	cartIcon.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        	$('#cart_preview').removeClass('unvisible');        	
        }
	});
});