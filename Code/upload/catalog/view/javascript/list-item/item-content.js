$(document).ready(function () {
	
	var type='';	
	if(window.location.search.indexOf('restaurant') >= 0){
		type='rest'
		$('#restaurant_tab').addClass('selected_type_tab');
		$('#food_tab').removeClass('selected_type_tab');
	
	}
	else{		
		type = 'food';
		$('#food_tab').addClass('selected_type_tab');
		$('#restaurant_tab').removeClass('selected_type_tab');
	}
	var isRefreshType = true;
	$('#food_tab').click(function() {
		if(!$('#food_tab').hasClass('selected_type_tab')){
			type = 'food';
			isRefreshType = true;
			$('#food_tab').addClass('selected_type_tab');
			$('#restaurant_tab').removeClass('selected_type_tab');
			$('.filter_field').remove();
			addContents('0',getSortString('sort_default'),0,1,isRefreshType);
			isRefreshType = false;
		}		
	});
	
	$('#restaurant_tab').click(function() {
		if(!$('#restaurant_tab').hasClass('selected_type_tab')){
			type='rest';
			isRefreshType = true;
			$('#restaurant_tab').addClass('selected_type_tab');
			$('#food_tab').removeClass('selected_type_tab');
			$('.filter_field').remove();
			addContents('0',getSortString('sort_default'),0,1,isRefreshType);
			isRefreshType = false;
		}		
	});
	
	
	$.fn.stars = function() {
		return $(this).each(function() {
	        $(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).attr('rate'))))) * 16));
		});
	}
	
	$('#filter_0').addClass('filter_field_selected');
	$('#sort_default').addClass('sort_field_selected');
	
	addContents('0',getSortString('sort_default'),0,1,isRefreshType);
	isRefreshType = false;
	
	$(document).on('click', '.filter_field', function(){
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
		addContents(filters,sort,0,1,isRefreshType);
	});
	
	$('.sort_field').click(function(){
		$('.sort_field').removeClass('sort_field_selected');
		$(this).addClass('sort_field_selected');
		var filters = $('#filters').attr('value');
		var sortId = $(this).attr('id');
		$('#sort').val(sortId);
		var sort = getSortString(sortId);				
		addContents(filters,sort,0,1,isRefreshType);
	});
	
	$(document).on('click', '.sf_product_preview', function(){
		var restId = $(this).attr('restid');
		var url = '/index.php?route=sfrest/detail&restaurant_id=' + restId;
		if (type=='food'){			
			var foodId = $(this).attr('foodid');
			url = url+ '&food_id=' + foodId;
		}						
		window.location.href = url;
	});
	
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
	
	function addContents(filters,sort,pageNumber,isRefresh, isRefreshType){
		if(isRefreshType){			
			$.ajax({
				url: 'index.php?route=api/'+type+'/getType',
				dataType: 'json',
				success: function(data) {
					$('.filter_field').remove();
					var ele = "";
					$.each(data['types'], function(i, v) {							
						ele = ele + '<span class=filter_field id=filter_'+v['type_id']+' value='+ v['type_id']+' > '+ v['type_name_cn']+'</span>';
					});	
					$('.sf_filter').append(ele);
				}
			});		
		}	
		
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
					var review_score = v.review_score;
					var name = v.name;
					var restId = id;
					var tag= "";
					if(type=='food'){
						id = v.food_id;
						cost = v.price;
						review_score = v.rest_review;
						restId = v.restaurant_id;
						name = v.rest_name
						tag = '<div class="tag">'+v.review_score+'</div>';
					}
								      
					var ele = '<div class=sf_product id='+id+' title='+v.name+ ' name='+v.tagId+' ><div class="image_container">' + tag + '<img class=sf_product_preview restId='+restId+' foodId='+id+' src='+v.img_url +' /></div>'
					+'<div class=sf_product_title >'+name+'</div><span class="sf_product_stars stars" rate="'+review_score+'" ></span>'+
					'<div class=sf_product_price><span style="MARGIN-RIGHT: 10px">价格:'+cost+'</span><span>配送: </span><span >分钟</span><span class=sf_product_sv>本月销量'+v.sell_number+'份</span> </div>';
					
					if (type=='food'){
						ele = ele +'<div class="sf_food_cart">	<div class="minus_food" value="'+id+'" >-</div><input class="food_number" id="food_'+id+'_number" value="'+v.cart_number+'" />'
						+'<div class="add_food" value="'+id+'" >+</div> </div>';
					}
					ele = ele + '</div>';
					$('.product_area').append(ele);
				});					
				$('span.stars').stars();
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