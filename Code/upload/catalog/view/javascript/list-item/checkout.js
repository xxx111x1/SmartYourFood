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

    $('.addressbox').click(function(){
            //console.error('add food cliked');
            $('.addressbox').removeClass('addressbox_selected');
            $(this).addClass('addressbox_selected');
            var addr_id = $(this).attr('addr_id');
            console.log('address id: '+addr_id);
            shippaddress.set_address(addr_id);
        }
    );
});

//shipping address
var shippaddress = {
    'set_address': function(addr_id) {
        console.log('start to set address: '+addr_id);
        $.ajax({
            url: 'index.php?route=sfcheckout/checkout/set_address',
            type: 'post',
            data: 'addr_id=' + addr_id,
            dataType: 'json',
            success: function(json) {
                console.log('set address id succeeded');
            }
        });
    },
    'remove': function() {

    }
}


