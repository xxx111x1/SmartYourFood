$(document).ready(function () {
	var language =  $('html').attr('lang');
	
	$(document).on('click','.back_button', function(){
		window.history.back()
	});
		
	$(document).on('click', '.minus_product,.add_product', function(){
		var id = $(this).attr('foodid');
		var restId = $(this).attr('restid');
		var number = $('.product_'+id).first().text();
		var cartRestId = document.getElementById('purchaseRest').value;
		if(cartRestId!="0" && cartRestId != restId){
			if(language.indexOf("en")> -1){
				alert("Please order in one restaurant.");
			}
			else{
				alert("请在同一家餐厅选餐");
			}
			
		}else{
			if($(this).hasClass("minus_product")&&number>0){
				number--;
				if(number<=0){
					$('.minus_product_'+id).addClass('product_number_0');
					$('.product_'+id).addClass('product_number_0');
				}
				cart.add(id,number);
				$('.product_'+id).text(number);
				updateRestId();
			}
			else{
				number++;
				$('.minus_product_'+id).removeClass('product_number_0');
				$('.product_'+id).removeClass('product_number_0');
				cart.add(id,number);
				$('.product_'+id).text(number);
				updateRestId();
				$('#cart_thumbnail').load('index.php?route=common/cartthumbnail/info');
			}	
		}
	});		
	
	$.fn.stars = function() {
		return $(this).each(function() {
	        $(this).html($('<div />').width(Math.max(0, (Math.min(5, parseFloat($(this).attr('rate'))))) * 29));
		});
	}
	
	$('div.stars').stars();
	
	$('#food-tab').addClass('selected_type_tab');
	$('#sort_default').addClass('sort_field_selected');
	initialContent();
	
	$('#back-tab').click(function() {
		window.location.href =$('#back-tab').attr('url');  
	});
	
	$('#food-tab').click(function() {
		if(!$('#food-tab').hasClass('selected_type_tab')){
			$('#food-tab').addClass('selected_type_tab');
			$('#sepcial-tab').removeClass('selected_type_tab');
			initialContent();
		}		
	});
	
	$('#sepcial-tab').click(function() {
		if(!$('#sepcial-tab').hasClass('selected_type_tab')){
			$('#sepcial-tab').addClass('selected_type_tab');
			$('#food-tab').removeClass('selected_type_tab');
		}		
	});	
	
	$('.tagitem').click(function(){
		var restId = $('#rest-id').val();
		var sort = getSortString($('#sort').val());	
		var tag = $(this).attr('value');
		$('.tagitem').removeClass('tagitemSelected');
		$(this).addClass('tagitemSelected');
		addContents(sort,restId,tag);
	});
	
	$('.sort_field').click(function(){
		$('.sort_field').removeClass('sort_selected');
		$(this).addClass('sort_selected');
		var restId = $('#rest-id').val();
		var filters = $('#filters').attr('value');
		var sortId = $(this).attr('id');
		$('#sort').val(sortId);
		var sort = getSortString(sortId);				
		addContents(sort,restId);
	});
	
	function initialContent(){
		var restId = $('#rest-id').val();
		var sortId = $('#sort_default').attr('id');
		$('#sort').val(sortId);
		var sort = getSortString(sortId);				
		addContents(sort,restId);
	}
		
	function addContents(sort,restId,tag){
		if(!tag){
			tag = 0 ;
		}
		$.ajax({
			url: 'index.php?route=api/food/getFoodByRestaurantAndTagId',
			type: 'post',
			data: 'sort=' + sort+ '&restid=' + restId + '&tagid=' + tag,
			dataType: 'json',	
			success: function(data) {
				$('.product_area').empty();						
				$.each(data['results'], function(i, v) {
					var id = v.restaurant_id;
					var cost = v.avg_cost;
					var review_score = v.review_score;
					var name = "";
					var foodname = "";
					var restId = id;
					var thumbEle = "";
					var thumbDescEle = "";
					var distance = gpsDistance(v.lat,v.lng,data['lat'],data['lng'],'K');
					var is_open = v.is_open;
					if(distance>40){
						distance = '-';
					}
					var ele = '<div class="product';
						var stringAddCart = "";
						var stringDistance = "";
						var stringRest = "";
						if(language.indexOf("en")>-1){
							stringAddCart = "Add to cart";
							stringDistance = "Distance";
							stringRest = "Restaurant";
							if(v.name_en!='' &&v.name_en!=null ){
								foodName = v.name_en;
							}
							else{
								foodName = v.name;
							}
							if(v.rest_name_en!=''&&v.rest_name_en!=null ){
								name = v.rest_name_en;
							}
							else{
								name = v.rest_name;
							}		
						}
						else{
							stringAddCart = "添加到餐车";
							stringDistance = "距离";
							stringRest = "餐馆";
							foodName = v.name;
							name = v.rest_name;
						}
						id = v.food_id;
						cost = v.price;
						review_score = v.rest_review;
						restId = v.restaurant_id;
						
						if(is_open==1)
						{
							thumbEle = '<div class="img_frame product_frame" restid="'+restId+'"foodid="'+id+'"><span class="helper"></span><img class="preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /></div>';
						}
						else{
							thumbEle = '<div class="img_frame product_frame" restid="'+restId+'"foodid="'+id+'"><span class="helper"></span><img class="preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /><div class="thumb_closed"></div></div>';
						}
						thumbDescEle = '<div class="food_description"><div class="product_name" title="'+foodName+'"  restid="'+restId+'"foodid="'+id+'">'+foodName+'</div><div class="sf_product_stars stars" rate="'+v.review_score+'"><span /></div><div class="purchase_area"><img class="minus_product product_number_'+v.cart_number+' minus_product_'+id+'" src="../catalog/view/theme/default/image/mobile/mobileMinus.png" restid="'+restId+'" foodid="'+id+'" />' +
						'<div class="product_number product_number_'+v.cart_number+' product_'+id+'" foodId="'+id+'">'+v.cart_number+'</div><img class="add_product" src="../catalog/view/theme/default/image/mobile/mobileAdd.png" restid="'+restId+'" foodId="'+id+'"/></div><div class="product_price col-1-1">$ '+v.price+'</div>' +
						'</div>';
					

					if(is_open==0)
					{
						ele = ele +'" style="background-color: #DDDDDD">' +thumbEle+ thumbDescEle + '</div>';
					}
					else {
						ele = ele +'">' +thumbEle+ thumbDescEle + '</div>';
					}
					$('.product_area').append(ele);
				});			
				var url =window.location.href; 
				if(url.indexOf('#')>0){
					window.location.href=window.location.href;
				}
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

function onDishImgError(source){
	source.src = "./catalog/view/theme/default/image/foodImages/dish_default.jpg";
	source.onerror="";
}

function onRestImgError(source){
	source.src = "./catalog/view/theme/default/image/foodImages/restaurant_default.jpg";
	source.onerror="";
}