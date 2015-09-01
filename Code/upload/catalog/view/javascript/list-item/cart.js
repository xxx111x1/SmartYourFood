$(document).ready(function () {
    $('.ck_add_food').click(function(){
            var id = $(this).attr('value');
            var number = parseInt($('#food_'+id+'_number').text());
            number++;
            cart.add(id,number);
            $('#food_'+id+'_number').text(number);

        }
    );

    $('.ck_remove_food').click(function(){
            //console.error('add food cliked');
            var id = $(this).attr('value');
            //console.error('food id: '+id);
            var number = parseInt($('#food_'+id+'_number').text());
            //console.error('qty: '+number);
            if(number>=1)
            {
                number--;
                cart.add(id,number);
                $('#food_'+id+'_number').text(number);
            }
        }
    );
    
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