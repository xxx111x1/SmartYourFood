$(document).ready(function () {
	$('#back_top').hide();
	$(window).scroll(function(){
	    if($(this).scrollTop()>=300){
	    	$('#back_top').show();
	    }
	    else{
	    	$('#back_top').hide();
	    }
	  });
	
	$('#back_top').click(function(){	
		$('html, body').animate({ scrollTop: 0 }, 'slow');
	});
	
	$('#cart_thumbnail').click(function(){
		$('#cart_preview').toggleClass('unvisible');
	});
	
	$(document).on('click', '.remove-food,.add-food', function(){
		var id = $(this).parent('.food-number').attr('foodId');
		var number = $(this).siblings('.purchase-number').text();
		if($(this).hasClass('remove-food')){
			number--;
		}
		else{
			number++;
		}
		cart.add(id,number);		
		$('#food_'+id+'_number').attr('number',number);
	});
	
	$(document).on('click', '.claer-all', function(){
		cart.clear();
		$('.thumb_add2cart').attr('number',0);
	});	
	
	$(document).on('click', '.food-remove', function(){
		var key = $(this).attr("key");
		var id = $(this).attr("id");
		cart.remove(key,id);
	});
	
	$('#my_message').click(function(){
		$('#message').empty();
		$('#message').toggleClass('unvisible');		
		if(!$('#message').hasClass('unvisible')) {			
			getMessage();
		}
	});	
	
	$('#feedback').click(function(){
		$('.mod-dialog-frame').toggleClass('unvisible');
	});
	
	$('.cancelBtn').click(function(){
		$('.mod-dialog-frame').toggleClass('unvisible');
	});
	
	$( ".backtopIcons" )
	  .mouseover(function() {
	    var backgroundImage = $(this).css("background-image");
	    $(this).css("background-image",backgroundImage.replace("Off","On"));
	  })
	  .mouseout(function() {
		  var backgroundImage = $(this).css("background-image");
		    $(this).css("background-image",backgroundImage.replace("On","Off"));
	  });
	
	function getMessage(){
		$.ajax({
			url: 'index.php?route=api/message/get',
			type: 'post',
			dataType: 'json',	
			success: function(data) {
				$.each(data['my_message'], function(i, v) {	
					var id = v.message_id;
					var content = v.content;
					var ele = '<div class="message_content"><input type="hidden" class="message_id" value="'+id+'" />'
					+'<div class="content">'+content+'</div> </div>';					
					$('#message').append(ele);
				});		
				readMessage();
			}
		});		
	}
	
	function readMessage(){
		var messageIds = [];
		$(".message_id").each(function() {
		    messageIds.push($(this).val());
		});
		$.ajax({
			url: 'index.php?route=api/message/read',
			type: 'post',
			data: 'message_ids=' + messageIds,
			dataType: 'json',		
		});		
	}
});