	function swapImages(){
		if($('#ads .active:hover').length <= 0){
			var $active = $('#ads .active');
			var $next = ($('#ads .active').next().length > 0) ? $('#ads .active').next() : $('#ads img:first');
			$active.fadeOut(function(){
			 $active.removeClass('active');
			  $next.fadeIn().addClass('active');
			});
		}
	}
	
$(document).ready(function () {
	setInterval('swapImages()', 5000);
    var language =  $('html').attr('lang');
	$(document).on('click','#showRestaurant',function(){
		window.location.href="/index.php?route=sfrest/detail&restaurant_id=8&returnUrl=/index.php?route=common/list";
	});
	
	var type=$('#searchType').val();	
	if(window.location.search.indexOf('restaurant') >= 0){
		type='rest';
		$('#restaurant_tab').addClass('selected_type_tab');
		$('#food_tab').removeClass('selected_type_tab');
		$('#send_time').show();
	
	}
	else{		
		type = 'food';
		$('#food_tab').addClass('selected_type_tab');
		$('#restaurant_tab').removeClass('selected_type_tab');
		$('#send_time').hide();
	}
	$('#searchType').val(type);
	var isRefreshType = true;
	$(document).on('click','#food_tab',function() {
		$('#send_time').hide();
		if(!$('#food_tab').hasClass('selected_type_tab')){			
			type = 'food';
			$('#searchType').val(type);
			isRefreshType = true;
			$('#food_tab').addClass('selected_type_tab');
			$('#restaurant_tab').removeClass('selected_type_tab');
			$('.filteritem').removeClass('filter_field_selected');	
			addContents('0',getSortString('sort_default'),0,1,isRefreshType);
			$('#filter_0').addClass('filter_field_selected');
			$('#filters').val('0');
			isRefreshType = false;
		}		
	});
	
	$('#restaurant_tab').click(function() {
		$('#send_time').show();
		if(!$('#restaurant_tab').hasClass('selected_type_tab')){
			type='rest';
			$('#searchType').val(type);
			isRefreshType = true;
			$('#restaurant_tab').addClass('selected_type_tab');
			$('#food_tab').removeClass('selected_type_tab');
			$('.filteritem').removeClass('filter_field_selected');
			addContents('0',getSortString('sort_default'),0,1,isRefreshType);
			$('#filter_0').addClass('filter_field_selected');
			$('#filters').val('0');
			isRefreshType = false;
		}		
	});	
			
	$('#filter_0').addClass('filter_field_selected');
	$('#sort_default').addClass('sort_field_selected');
	
	addContents('0',getSortString('sort_default'),0,1,isRefreshType);
	isRefreshType = false;
	
	$(document).on('click', '.filteritem', function(){
		$('.filteritem').removeClass('filter_field_selected');
		$(this).addClass('filter_field_selected');				
		var filters = $(this).attr('value');
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
	
	$(document).on('click', '.thumb_view,.thumb_desc_restname,.thumb_rest_img', function(){
		var restId = $(this).attr('restid');
		var url = '/index.php?route=sfrest/detail&restaurant_id=' + restId;
		if (type=='food'){			
			var foodId = $(this).attr('foodid');
			url = url+ '&food_id=' + foodId;
			url = url + "&returnUrl=/index.php?route=common/list";
		}
		else{
			url = url + "&returnUrl=/index.php?route=common/list&restaurant=1";
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
		var restId = $(this).attr('restid');
		var number = $(this).attr('number');
		number++;
		var cartRestId = document.getElementById('purchaseRest').value;
		if(cartRestId!="0" && cartRestId != restId){
			if(language.indexOf("en")> -1){
				alert("Please order in one restaurant.");
			}
			else{
				alert("请在同一家餐厅选餐");
			}
			
		}else{
			cart.addone(id,restId);
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
	
	$.fn.stars = function() {
		return $(this).each(function() {
	        $(this).html($('<div />').width(Math.max(0, (Math.min(5, parseFloat($(this).attr('rate'))))) * 23));
		});
	}
	
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
					var is_open = v.is_open;
					if(distance>40){
						distance = '-';
					}
					if(type=='food'){
						var stringAddCart = "";
						var stringDistance = "";
						var stringRest = "";
						if(language.indexOf("en")>-1){
							stringAddCart = "Add to cart";
							stringDistance = "Distance";
							stringRest = "Restaurant";
						}
						else{
							stringAddCart = "添加到餐车";
							stringDistance = "距离";
							stringRest = "餐馆";
						}
						id = v.food_id;
						cost = v.price;
						review_score = v.rest_review;
						restId = v.restaurant_id;
						name = v.rest_name
						if(is_open==1)
						{
							thumbEle = '<div class="thumb" id='+id+'><img class="thumb_preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /><div class="thumboverlay" style="display: none;"><div class="thumb_add2cart" restId='+restId+' foodId='+id+' id="food_'+id+'_number" number="'+v.cart_number+'">+ '+ stringAddCart +'</div></div></div>';
						}
						else{
							thumbEle = '<div class="thumb" id='+id+'><img class="thumb_preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /><div class="thumb_closed"></div></div>';
						}
						thumbDescEle = '<div class="thumb_desc"><div class="thumb_desc_foodname" title="'+v.name+'" >'+v.name+'</div><a class="thumb_desc_restname" restId='+restId+' foodId='+id+' >'+stringRest+': '+v.rest_name+'</a>' +
							'<div class="thumb_desc_restdist">'+stringDistance+' '+distance+'KM</div><div class="thumb_desc_productinfo"><div class="sf_product_stars stars" rate="'+v.review_score+'" ></div>' +
							'<div class="thumb_desc_productprice">$ '+v.price+'</div></div></div>';

					}
					else{
						var stringCost = "";
						var stringDistance = "";
						if(language.indexOf("en")>-1){
							stringCost = "Average cost:";
							stringDistance = "Distance";
						}
						else{
							stringCost = "平均价格：";
							stringDistance = "距离";
						}
						
						if(is_open==1)
						{
							thumbEle = '<div class="thumb" id='+id+'><img class="thumb_preview thumb_rest_img" src="'+v.img_url+'"  alt="Image not found" onerror="onRestImgError(this)"  restId='+restId+' /></div>';
						}
						else{
							thumbEle = '<div class="thumb" id='+id+'><img class="thumb_preview thumb_rest_img" src="'+v.img_url+'"  alt="Image not found" onerror="onRestImgError(this)"  restId='+restId+' /><div class="thumb_closed"></div></div>';
						}
						thumbDescEle = '<div class="thumb_desc"><div class="thumb_desc_restname" restId='+restId+'>'+v.name+'</div>' +
											'<div class="thumb_desc_restdist">'+stringDistance+' '+distance+'KM</div><div class="thumb_desc_productinfo"><div class="sf_product_stars stars" rate="'+v.review_score+'" ></div>' +
											'<!--<div class="thumb_desc_productprice">'+stringCost+'$ '+cost+'</div>--></div></div>';
					}     					
					
					var ele = '<div class="product">' +thumbEle+ thumbDescEle + '</div>';
					$('.product_area').append(ele);
				});		
				$('div.stars').stars();		
			}
		});		
	}
	
	function getSortString(sortId){
		if(sortId=="sell_number"){
			return " sell_number desc, review_score desc";
		}else if(sortId=="review_score"){
			return " review_score desc,sell_number desc";
		}else if(sortId=="send_time"){
			return " sell_number desc, review_score desc&isDistance=1";
		}
		else{
			return " sell_number desc, review_score desc";	
		}
	}
	
	function gpsDistance(lat1, lon1, lat2, lon2, unit) {
		if(lat2==0){
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

function onDishImgError(source){
	source.src = "./catalog/view/theme/default/image/foodImages/dish_default.jpg";
	source.onerror="";
}

function onRestImgError(source){
	source.src = "./catalog/view/theme/default/image/foodImages/restaurant_default.jpg";
	source.onerror="";
}