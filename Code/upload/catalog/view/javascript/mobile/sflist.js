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
	
	$(document).on('click','.back_button', function(){
		$('.search_result').empty();
		$('.search_title').css('display','none');
		$('.search_keywords').css('display','none');
		$('.search_bar').css('display','none');
		$('.search_background').css('display','none');
	});
	
	var type=$('#searchType').val();	
	if(window.location.search.indexOf('restaurant') >= 0){
		type='rest';
		$('#restaurant_tab').addClass('selected');
		$('#food_tab').removeClass('selected');
	
	}
	else{		
		type = 'food';
		$('#food_tab').addClass('selected');
		$('#restaurant_tab').removeClass('selected');
	}
	$('#searchType').val(type);
	var isRefreshType = true;
	
	$('#food_tab').click(function() {
		if(!$('#food_tab').hasClass('selected')){			
			type = 'food';
			$('#searchType').val(type);
			isRefreshType = true;
			$('#food_tab').addClass('selected');
			$('#restaurant_tab').removeClass('selected');
			addContents('0',getSortString('sort_default'),0,1,isRefreshType);
			isRefreshType = false;
		}		
	});
	
	$('#restaurant_tab').click(function() {
		if(!$('#restaurant_tab').hasClass('selected')){
			type='rest';
			$('#searchType').val(type);
			isRefreshType = true;
			$('#restaurant_tab').addClass('selected');
			$('#food_tab').removeClass('selected');
			addContents('0',getSortString('sort_default'),0,1,isRefreshType);
			isRefreshType = false;
		}		
	});	
	
	$('#search-button').on('click', function () {	
		$('.search_title').css('display','none');
		$('.search_keywords').css('display','none');
        var searchKeyWords = $('#serach-input').val();
        searchResult(searchKeyWords)
    });
	
	$('.keywords').on('click', function () {	
		$('.search_title').css('display','none');
		$('.search_keywords').css('display','none');
        var searchKeyWords = $(this).text();
        $('#serach-input').val(searchKeyWords);
        searchResult(searchKeyWords)
    });
	
	$('#filter_0').addClass('filter_field_selected');
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
		$('.filterarea').css('display','none');
		$('.cart_background').css('display','none');
		$('.filterarea').css('z-index','0');
		$('.header').css('z-index','0');
	});
	
	$(document).on('click', '#search', function(){		
		$('.search_bar').css('display','block');
		$('.search_title').css('display','block');
		$('.search_keywords').css('display','block');
		$('.search_background').css('display','block');
	});
		
	$(document).on('click', '.resturantName,.productFrame', function(){
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
				cart.addshow(id,number);
				$('.product_'+id).text(number);
				updateRestId();
			}
			else{
				number++;
				$('.minus_product_'+id).removeClass('product_number_0');
				$('.product_'+id).removeClass('product_number_0');
				cart.addshow(id,number);
				$('.product_'+id).text(number);
				updateRestId();
				
			}
			
		}
	});		
	
	$(document).on('click', '.claer_all', function(){
		cart.clear();
		$('.product_number').text('0');
		$('.product_number').addClass('product_number_0');
		$('.minus_product').addClass('product_number_0');		
		updateRestId();
		if($('#cart_dropdown').css('display') == 'block'){
			$('#cart_preview').load('index.php?route=common/cartthumbnail/showinfo');
		}
		else{
			$('#cart_preview').load('index.php?route=common/cartthumbnail/info');
		}
	});
	
	
	$(document).on('click', '.product_rest,.resturant_name,.go_to_rest,.product_frame,.product_name', function(){
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
	
	$(window).scroll(function () { 
		   if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
			  var pageNumber = $('#page_number').val();
			  //var filters = $('#filters').attr('value');
			  //var sortId = $('#sort').attr('value');
			  pageNumber = parseInt(pageNumber) + 1;
			  //var sort = getSortString(sortId);
			  addContents("0"," sell_number desc, review_score desc",pageNumber,0);
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
					if(type=='food'){
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
						thumbDescEle = '<div class="food_description"><div class="product_name product_name_overflow" title="'+foodName+'"  restid="'+restId+'"foodid="'+id+'">'+foodName+'</div><div class="sf_product_stars stars" rate="'+v.review_score+'"><span /></div><div class="purchase_area"><img class="minus_product product_number_'+v.cart_number+' minus_product_'+id+'" src="../catalog/view/theme/default/image/mobile/mobileMinus.png" restid="'+restId+'" foodid="'+id+'" />' +
						'<div class="product_number product_number_'+v.cart_number+' product_'+id+'" foodId="'+id+'">'+v.cart_number+'</div><img class="add_product" src="../catalog/view/theme/default/image/mobile/mobileAdd.png" restid="'+restId+'" foodId="'+id+'"/></div><div class="product_price col-1-1">$ '+v.price+'</div><a class="resturant_name" restid="'+restId+'" foodid="'+id+'">'+name+'</a>' +
						'<div class="dilevery_time">|'+stringDistance+' '+distance+'KM</div></div>';
					}
					else{
						ele = ele + ' product_rest" restid="' + id ;
						var stringCost = "";
						var stringDistance = "";
						var name = "";
						if(language.indexOf("en")>-1){
							stringCost = "Average cost:";
							stringDistance = "Distance";
							if(v.name_en!=''&&v.name_en!=null){
								name = v.name_en;
							}
							else{
								name = v.name;
							}						
							
						}
						else{
							stringCost = "平均价格：";
							stringDistance = "距离";
							name = v.name;
						}
						
						if(is_open==1)
						{
							thumbEle = '<div class="img_frame product_frame" ><span class="helper"></span><img class="preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /></div>';
						}
						else{
							thumbEle = '<div class="img_frame product_frame" ><span class="helper"></span><img class="preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /><div class="thumb_closed"></div></div>';
						}
						thumbDescEle = '<div class="rest_description"><div class="product_name" title="'+v.name+'">'+v.name+'</div><div class="sf_product_stars stars" rate="'+v.review_score+'"><span /></div><div class="product_price col-1-1">'+stringCost+'$ '+cost+'</div><div class="extra_info">'+stringDistance+' '+distance+'KM</div></div>' +
											'<div class="go_to_rest img_frame col-1-12" restid="' + id +'"><span class="helper"></span><img class="preview" src="../catalog/view/theme/default/image/mobile/mobileGotoGrey.png"/></div>'
					}     					
					
					
					
					if(is_open==0)
					{
						ele = ele +'" style="background-color: #DDDDDD">' +thumbEle+ thumbDescEle + '</div>';
					}
					else {
						ele = ele +'">' +thumbEle+ thumbDescEle + '</div>';
					}
					$('.product_area').append(ele);
				});		
				$('div.stars').stars();		
			}
		});		
	}
	
	function searchResult(keyword){
		$.ajax({
			url: 'index.php?route=api/food/searchFood',
			type: 'post',
			data: 'search=' + keyword,
			dataType: 'json',
			/*
			 * beforeSend: function() { $('#cart >
			 * button').button('loading'); }, complete: function() {
			 * $('#cart > button').button('reset'); },
			 */			
			success: function(data) {
				$('.search_title').css('display', 'none');
				$('.search_keywords').css('display', 'none');
				$.each(data['foods'], function(i, v) {
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
					var ele = '<div class="product';
						var stringAddCart = "";
						var stringDistance = "";
						var stringRest = "";
						foodName = v.food_name;
						name = v.rest_name;		
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
						
						if(is_open==1)
						{
							thumbEle = '<div class="img_frame product_frame" restid="'+restId+'"foodid="'+id+'"><span class="helper"></span><img class="preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /></div>';
						}
						else{
							thumbEle = '<div class="img_frame product_frame" restid="'+restId+'"foodid="'+id+'"><span class="helper"></span><img class="preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /><div class="thumb_closed"></div></div>';
						}
						thumbDescEle = '<div class="food_description"><div class="product_name product_name_overflow" title="'+foodName+'"  restid="'+restId+'"foodid="'+id+'">'+foodName+'</div><div class="sf_product_stars stars" rate="'+v.review_score+'"><span /></div><div class="purchase_area"><img class="minus_product product_number_'+v.cart_number+' minus_product_'+id+'" src="../catalog/view/theme/default/image/mobile/mobileMinus.png" restid="'+restId+'" foodid="'+id+'" />' +
						'<div class="product_number product_number_'+v.cart_number+' product_'+id+'" foodId="'+id+'">'+v.cart_number+'</div><img class="add_product" src="../catalog/view/theme/default/image/mobile/mobileAdd.png" restid="'+restId+'" foodId="'+id+'"/></div><div class="product_price col-1-1">$ '+v.price+'</div><a class="resturant_name" restid="'+restId+'" foodid="'+id+'">'+name+'</a>' +
						'<div class="dilevery_time">|'+stringDistance+' '+distance+'KM</div></div>';
					if(is_open==0)
					{
						ele = ele +'" style="background-color: #DDDDDD">' +thumbEle+ thumbDescEle + '</div>';
					}
					else {
						ele = ele +'">' +thumbEle+ thumbDescEle + '</div>';
					}
					$('.search_result').append(ele);
					

				});		
				
				
				$.each(data['rests'], function(i, v) {
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
					ele = ele + ' product_rest" restid="' + id ;
					var stringCost = "";
					var stringDistance = "";
					var name = "";
					if(language.indexOf("en")>-1){
						stringCost = "Average cost:";
						stringDistance = "Distance";
						if(v.name_en!=''&&v.name_en!=null){
							name = v.name_en;
						}
						else{
							name = v.name;
						}						
						
					}
					else{
						stringCost = "平均价格：";
						stringDistance = "距离";
						name = v.name;
					}
					
					if(is_open==1)
					{
						thumbEle = '<div class="img_frame product_frame" ><span class="helper"></span><img class="preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /></div>';
					}
					else{
						thumbEle = '<div class="img_frame product_frame" ><span class="helper"></span><img class="preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /><div class="thumb_closed"></div></div>';
					}
					thumbDescEle = '<div class="rest_description"><div class="product_name" title="'+v.name+'">'+v.name+'</div><div class="sf_product_stars stars" rate="'+v.review_score+'"><span /></div><div class="product_price col-1-1">'+stringCost+'$ '+cost+'</div><div class="extra_info">'+stringDistance+' '+distance+'KM</div></div>' +
										'<div class="go_to_rest img_frame col-1-12" restid="' + id +'"><span class="helper"></span><img class="preview" src="../catalog/view/theme/default/image/mobile/mobileGotoGrey.png"/></div>';
					
					if(is_open==0)
					{
						ele = ele +'" style="background-color: #DDDDDD">' +thumbEle+ thumbDescEle + '</div>';
					}
					else {
						ele = ele +'">' +thumbEle+ thumbDescEle + '</div>';
					}
					$('.search_result').append(ele);
					
	
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