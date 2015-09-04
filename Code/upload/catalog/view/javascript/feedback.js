$(document).ready(function () {
	$(document).on('click','.submitBtn',function(){
		submitFeedback();
	});
	
	function submitFeedback(){
		var sender = $('#contact').val();
		var message = $('#feedback_content').val();
		if(sender == '')
		{
			alert("请输入您的联系方式。");
			return;
		}
		if(message == '')
		{
			alert("请输入您的意见或建议。");
			return;
		}
		$.ajax({
			url: 'index.php?route=api/feedback/submit',
			type: 'post',
			data: 'sender=' + sender + '&message=' + message,
			dataType: 'json',		
			success: function(data) {
				if (data['success']) {
					alert("多谢您的宝贵意见，我们会继续改进。");
				}
				if(data['error']){
					alert(data['error']);
				}
			}
		});		
	}
	
});