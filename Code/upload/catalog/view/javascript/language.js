$(document).ready(function () {
	$('.language').click(function(){
		var language = $(this).text();
		var code = '';
		if(language.indexOf('Eng')>-1){
			code = 'en';
		}
		else{
			code = 'cn';
		}
		var redirectUrl = window.location.href;
		window.location.href="index.php?route=common/language/changeLanguage&code=" + code + "&redirect=" + redirectUrl;
	});
});
