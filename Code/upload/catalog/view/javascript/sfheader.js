$(document).ready(function () {
	$(document).on('click','#go-to-home,#logo', function(){
		window.location.href='/index.php?route=common/sfhome';
	});
	$(document).on('click','#go-to-food', function(){
		window.location.href='/index.php?route=common/list';
	});	
	$(document).on('click','#go-to-order', function(){
		window.location.href='/index.php?route=common/list';
	});
});