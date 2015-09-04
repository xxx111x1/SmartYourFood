$(document).ready(function () {
	$('#back_top').click(function(){	
		$('html, body').animate({ scrollTop: 0 }, 'slow');
	});
	
	$('#cart_thumbnail').click(function(){
		$('#cart_preview').toggleClass('unvisible');
	});
	
	$('#feedback').click(function(){
		$('.mod-dialog-frame').toggleClass('unvisible');
	});
	
	$('.cancelBtn').click(function(){
		$('.mod-dialog-frame').toggleClass('unvisible');
	});
});