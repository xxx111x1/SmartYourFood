$(document).ready(function () {
	
	var type=$('#searchType').val();	
	if(window.location.search.indexOf('restaurant') >= 0){
		type='rest';
		$('#restaurant_tab').addClass('selected_type_tab');
		$('#food_tab').removeClass('selected_type_tab');
	
	}
	else{		
		type = 'food';
		$('#food_tab').addClass('selected_type_tab');
		$('#restaurant_tab').removeClass('selected_type_tab');
	}
	$('#searchType').val(type);
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
		
	$('#filter_0').addClass('filter_field_selected');
	$('#sort_default').addClass('sort_field_selected');
	
	addContents('0',getSortString('sort_default'),0,1,isRefreshType);
	isRefreshType = false;
	
	$(document).on('click', '.filteritem', function(){
		$(this).toggleClass('filter_field_selected');
		var tagId = $(this).attr('value');
		var filters = $('#filters').attr('value');
		var background = $(this).find('.filtericon').css('background-image');
		if($(this).hasClass('filter_field_selected')){						
			if(tagId=='0'){
				$('.filteritem').removeClass('filter_field_selected');
				$('.filtericon').each(function(){
					var backgroundImage = $(this).css('background-image');
					$(this).css('background-image',backgroundImage.replace('on.','off.'));
				});
				$(this).addClass('filter_field_selected');				
				filters = '0';				
			}
			else{
				if(filters == "0," || filters == "0"){
					filters = "";
				}
				$('#filter_0').removeClass('filter_field_selected');
				filters = filters + ','+tagId;
				$(this).find('.filtericon').css('background-image',background.replace('off.','on.'));
			}				
		}
		else{
			filters = filters.replace(','+ tagId,'').replace(tagId,'');
			if(filters==''){
				$('#filter_0').addClass('filter_field_selected');
				filters='0';
			}
			$(this).find('.filtericon').css('background-image',background.replace('on.','off.'));
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
		$('.sort_field').removeClass('sort_selected');
		$(this).addClass('sort_selected');
		var filters = $('#filters').attr('value');
		var sortId = $(this).attr('id');
		$('#sort').val(sortId);
		var sort = getSortString(sortId);				
		addContents(filters,sort,0,1,isRefreshType);
	});
	
	$(document).on('click', '.thumb_view,.thumb_desc_restname', function(){
		var restId = $(this).attr('restid');
		var url = '/index.php?route=sfrest/detail&restaurant_id=' + restId;
		if (type=='food'){			
			var foodId = $(this).attr('foodid');
			url = url+ '&food_id=' + foodId;
		}						
		window.location.href = url;
	});
	
	$(document).on('mouseover','.thumb', function(){
		$(this).find(".thumboverlay").show();
	});
	
	$(document).on('mouseout','.thumb', function(){
		$(this).find(".thumboverlay").hide();
	});
	
	$(document).on('click', '.thumb_add2cart', function(){
		var id = $(this).attr('foodid');
		var number = $(this).attr('number');
		number++;
		cart.add(id,number);
		$(this).attr('number',number);
		
		var cartIcon = $('#cart_thumbnail');
        var imgtodrag = $(this).parent('.thumboverlay').siblings(".thumb_preview").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': cartIcon.offset().top + 10,
                    'left': cartIcon.offset().left + 10,
                    'width': 75,
                    'height': 75
                	},          1000
               );
            
            setTimeout(function () {
            	cartIcon.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        	$('#cart_preview').removeClass('unvisible');        	
        }
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
				$.each(data['results'], function(i, v) {	
					var id = v.restaurant_id;
					var cost = v.avg_cost;
					var review_score = v.review_score;
					var name = v.name;
					var restId = id;
					var thumbEle = "";
					var thumbDescEle = "";
					var distance = gpsDistance(v.lat,v.lng,data['lat'],data['lng'],'K');
					if(distance>40){
						distance = '-';
					}
					if(type=='food'){
						id = v.food_id;
						cost = v.price;
						review_score = v.rest_review;
						restId = v.restaurant_id;
						name = v.rest_name
						thumbEle = '<div class="thumb" id='+id+'><img class="thumb_preview" src="'+v.img_url+'" /><div class="thumboverlay" style="display: none;"><div class="thumb_add2cart" foodId='+id+' id="food_'+id+'_number" number="'+v.cart_number+'">+ 添加到餐车</div></div></div>';
						thumbDescEle = '<div class="thumb_desc"><div class="thumb_desc_foodname">'+v.name+'</div><a class="thumb_desc_restname" restId='+restId+' foodId='+id+' >餐馆 '+v.rest_name+'</a>' +
											'<div class="thumb_desc_restdist">距离 '+distance+'KM</div><div class="thumb_desc_productinfo"><div class="thumb_desc_productfav">'+v.review_score+'</div>' +
											'<div class="thumb_desc_productprice">C$ '+v.price+'</div></div></div>';
					}
					else{
						thumbEle = '<div class="thumb" id='+id+'><img class="thumb_preview" src="'+v.img_url+'" /><div class="thumboverlay" style="display: none;"><div class="thumb_view" restId='+restId+' >看看</div></div></div>';
						thumbDescEle = '<div class="thumb_desc"><div class="thumb_desc_restname">'+v.name+'</div>' +
											'<div class="thumb_desc_restdist">距离 '+distance+'KM</div><div class="thumb_desc_productinfo"><div class="thumb_desc_productfav">'+v.review_score+'</div>' +
											'<div class="thumb_desc_productprice">平均价格：C$ '+cost+'</div></div></div>';
					}
								      					
					
					var ele = '<div class="product">' +thumbEle+ thumbDescEle + '</div>';
					$('.product_area').append(ele);
				});					
				//$('span.stars').stars();
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
	
	function gpsDistance(lat1, lon1, lat2, lon2, unit) {
		if(lat2<=0){
			return 0 ;
		}
		var radlat1 = Math.PI * lat1/180;
		var radlat2 = Math.PI * lat2/180;
		var radlon1 = Math.PI * lon1/180;
		var radlon2 = Math.PI * lon2/180;
		var theta = lon1-lon2;
		var radtheta = Math.PI * theta/180;
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		dist = Math.acos(dist);
		dist = dist * 180/Math.PI;
		dist = dist * 60 * 1.1515;
		if (unit=="K") { dist = dist * 1.609344; }
		if (unit=="N") { dist = dist * 0.8684; }
		return dist.toFixed(2);
	}

});