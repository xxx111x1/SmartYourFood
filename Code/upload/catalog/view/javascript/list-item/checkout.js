/**
 * Created by Min on 2015/8/29.
 */
$(document).ready(function () {
    $('.ck_add_food').click(function(){
            var id = $(this).attr('value');
            console.log('id: '+id);
            var number = parseInt($('#food_'+id+'_number').text());
            console.log('number: '+number);
            number++;
            if(number<=1000)
            {
                cart.add(id,number);
                $('#food_'+id+'_number').text(number);
            }
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
});

