$(document).ready(function () {
	$(document).on('click', '.add_food', function(){
		var id = $(this).attr('value');
		var number = parseInt($('#food_'+id+'_number').val());
		number++;
		cart.add(id,number);
		$('#food_'+id+'_number').val(number);
	});
	
	$(document).on('click', '.minus_food', function(){
		var id = $(this).attr('value');
		var number = parseInt($('#food_'+id+'_number').val());
		if(number>0){
			number--;
			cart.add(id,number);
		}
		$('#food_'+id+'_number').val(number);
	});
});