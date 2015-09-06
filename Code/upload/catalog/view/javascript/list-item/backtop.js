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
	
	$('#my_message').click(function(){
		$('#message').toggleClass('unvisible');
		if(!$('#message').hasClass('unvisible')) readMessage();
	});
	
	
	$('#feedback').click(function(){
		$('.mod-dialog-frame').toggleClass('unvisible');
	});
	
	$('.cancelBtn').click(function(){
		$('.mod-dialog-frame').toggleClass('unvisible');
	});
	
	function getMessage(){
		$.ajax({
			url: 'index.php?route=api/message/get',
			type: 'post',
			dataType: 'json',		
		});		
	}
	
	function readMessage(){
		var messageIds = [];
		$(".message_id").each(function() {
		    messageIds.push($(this).val());
		});;
		//alert(messageIds);
		$.ajax({
			url: 'index.php?route=api/message/read',
			type: 'post',
			data: 'message_ids=' + messageIds,
			dataType: 'json',		
		});		
	}
});