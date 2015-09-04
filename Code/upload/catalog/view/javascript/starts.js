$(document).ready(function () {
	$.fn.stars = function() {
		return $(this).each(function() {
	        $(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).attr('rate'))))) * 16));
		});
	}	
	$('span.stars').stars();	
});