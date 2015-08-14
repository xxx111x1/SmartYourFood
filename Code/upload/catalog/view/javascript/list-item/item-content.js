$(document).ready(function () {
	
	var type='rest';	
	if(window.location.search.indexOf('food') >= 0){
		type = 'food';
	}
	
	$('#filter_0').addClass('filter_field_selected');
	$('#sort_default').addClass('sort_field_selected');
	
	addContents('0',getSortString('sort_default'),0,1);
	
	$('.filter_field').click(function() {
		$(this).toggleClass('filter_field_selected');
		var tagId = $(this).attr('value');
		var filters = $('#filters').attr('value');
		if($(this).hasClass('filter_field_selected')){						
			if(tagId=='0'){
				$('.filter_field').removeClass('filter_field_selected');
				$(this).addClass('filter_field_selected');
				filters = '0';
			}
			else{
				$('#filter_0').removeClass('filter_field_selected');
				filters = filters + ','+tagId;
				filters = filters.replace('0,', '').replace('0','');
			}				
		}
		else{
			filters = filters.replace(','+ tagId,'').replace(tagId,'');
			if(filters==''){
				$('#filter_0').addClass('filter_field_selected');
				filters='0';
			}
		}
		if(filters.substring(0,1)==','){
			filters = filters.replace(',','');
		}
		$('#filters').attr('value',filters);
		
		var sortId = $('#sort').attr('value');
		var sort = getSortString(sortId);				
		addContents(filters,sort,0,1);
	});
	
	$('.sort_field').click(function(){
		$('.sort_field').removeClass('sort_field_selected');
		$(this).addClass('sort_field_selected');
		var filters = $('#filters').attr('value');
		var sortId = $(this).attr('id');
		$('#sort').val(sortId);
		var sort = getSortString(sortId);				
		addContents(filters,sort,0,1);
	});
	
	$(document).on('click', '.sf_product', function(){
		var id = $(this).attr('id');
		alert(type + ' id:' + id + "! You can modify click action in $(document).on('click', '.sf_product', function() !" );
	});
	
	$(window).scroll(function () { 
		   if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
			  var pageNumber = $('#page_number').val();
			  var filters = $('#filters').attr('value');
			  var sortId = $('#sort').attr('value');
			  pageNumber = parseInt(pageNumber) + 1;
			  var sort = getSortString(sortId);
			  addContents(filters,sort,pageNumber,0);
			  $('#page_number').val(pageNumber);
		   }
	});
	
	function addContents(filters,sort,pageNumber,isRefresh){
		$.ajax({
			url: 'index.php?route=api/'+type+'/getData',
			type: 'post',
			data: 'filters=' + filters + '&sort=' + sort+ '&page_number=' + pageNumber,
			dataType: 'json',
			/*
			 * beforeSend: function() { $('#cart >
			 * button').button('loading'); }, complete: function() {
			 * $('#cart > button').button('reset'); },
			 */			
			success: function(data) {
				if(isRefresh==1){
					$('.product_area').empty();
					$('#page_number').val(0);
				}							
				$.each(data, function(i, v) {	
					var id = v.restaurant_id;
					var cost = v.avg_cost;
					if(type=='food'){
						id = v.food_id;
						cost = v.price;
					}
					var ele = '<div class=sf_product id='+id+' title='+v.name+ ' name='+v.tagId+' ><img class=sf_product_preview src='+v.img_url +' />'
					+'<div class=sf_product_title >'+v.name+'</div><img class=sf_product_stars src="img/stars_2.png"> <div class=sf_product_sv>本月销量-份</div>'+
					'<div class=sf_product_price><span style="MARGIN-RIGHT: 10px">价格:'+cost+'</span><span>配送: </span><span class="glyphicon glyphicon-time" style="FLOAT: right">分钟</span> </div></div>';
					$('.product_area').append(ele);
				});					
			}
		});		
	}
	
	function getSortString(sortId){
		if(sortId=="sell_number"){
			return " sell_number desc, review_score desc ";
		}else if(sortId=="review_score"){
			return " review_score desc,sell_number desc ";
		}else{
			return " sell_number desc, review_score desc ";
		}	
	}

});