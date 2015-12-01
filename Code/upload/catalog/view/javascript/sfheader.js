$(document).ready(function () {
	$(document).on('click','#go-to-home,#logo', function(){
		window.location.href='/index.php?route=common/sfhome';
	});
	$(document).on('click','#go-to-food', function(){
		window.location.href='/index.php?route=common/list&food=1';
	});
	$(document).on('click','#go-to-rest', function(){
		window.location.href='/index.php?route=common/list&restaurant=1';
	});
	$(document).on('click','#go-to-order', function(){
		window.location.href='/index.php?route=sfcheckout/checkout';
	});
	$('.account').click(function(){
		window.location.href='/index.php?route=account/account';
	});	
	
	$('.logout').click(function(){
		window.location.href="index.php?route=common/sfhome&logout=1";
	});
	
	$('.language').click(function(){
		var language = $(this).text();
		var code = '';
		if(language.indexOf('Eng')>-1){
			code = 'en';
		}
		else{
			code = 'cn';
		}
		var redirectUrl = encodeURIComponent(window.location.href);
		window.location.href="index.php?route=common/language/changeLanguage&code=" + code + "&redirect=" + redirectUrl;
	});
});