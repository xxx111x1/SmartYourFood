window.onload = function() {
	$(".rest-score-label").click(function(){
		$('.review-dialog-frame').css('display','block');
	});
	
	$(".review-close").click(function(){
		$('.review-dialog-frame').css('display','none');
	});
	
	$(document).ready(function () {
			
	$(".score1,.score2,.score3,.score4,.score5").click(function(){
		var rate = parseInt($(this).attr("rate"));
		for (var i=1;i<=5;i++)
		{
			$(this).siblings(".score"+i).css("background","url(/catalog/view/theme/default/image/stars.png) 0 -21px no-repeat");
		}
		for (var i=1;i<rate;i++)
		{
			$(this).siblings(".score"+i).css("background","url(/catalog/view/theme/default/image/stars.png) 0 0px no-repeat");
		}
		$(this).css("background","url(/catalog/view/theme/default/image/stars.png) 0 0px no-repeat");
		$(this).parents(".review-score").find("input").val(rate);
	});
	
	$(document).on('mouseover','.score1,.score2,.score3,.score4,.score5', function(){
		var rate = parseInt($(this).attr("rate"));
		for (var i=1;i<=5;i++)
		{
			$(this).siblings(".score"+i).css("background","url(/catalog/view/theme/default/image/stars.png) 0 -21px no-repeat");
		}
		for (var i=1;i<rate;i++)
		{
			$(this).siblings(".score"+i).css("background","url(/catalog/view/theme/default/image/stars.png) 0 0px no-repeat");
		}
		$(this).css("background","url(/catalog/view/theme/default/image/stars.png) 0 0px no-repeat");
	});
	
	$(document).on('mouseout','.score1,.score2,.score3,.score4,.score5', function(){
		var rate = $(this).parents(".review-score").find("input").val()
		for (var i=1;i<=5;i++)
		{
			$(this).siblings(".score"+i).css("background","url(/catalog/view/theme/default/image/stars.png) 0 -21px no-repeat");
		}
		$(this).css("background","url(/catalog/view/theme/default/image/stars.png) 0 -21px no-repeat");
		for (var i=1;i<=rate;i++)
		{
			$(this).parents(".review-score").find(".score"+i).css("background","url(/catalog/view/theme/default/image/stars.png) 0 0px no-repeat");
		}
	});
	
	$('.review-dialog-wrap').on('click','#send-review',function(){
		var restid = $('#rest-id').val();
		var overallScore =$(this).siblings().find("#all-score").val();
		var tasteScore = $(this).siblings().find('#taste-score').val();
		var serviceScore= $(this).siblings().find('#service-score').val();
		var comment = $(this).siblings().find('#comment').val();
		$.ajax({
			url: 'index.php?route=api/rest/addreview',
			type: 'post',
			data: 'restid=' + restid + '&overallScore=' + overallScore+ '&tasteScore=' + tasteScore+ '&serviceScore=' + serviceScore+ '&comment=' + comment,
			dataType: 'json',
			error: function(){
				alert("发表失败, 请稍后再试");
				$('.review-dialog-frame').addClass('unvisible');
			},
			success: function(data) {
				$('.review-dialog-frame').addClass('unvisible');
			}
		});		
	});

});
}