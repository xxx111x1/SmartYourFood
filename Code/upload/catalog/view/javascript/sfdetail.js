$(document).ready(function () {
	var language =  $('html').attr('lang');
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
		$('.product_area').empty();	
		$('#page_number').val('0');
		addContents(sort,restId,0,tag);
	});
	
	$('.sort_field').click(function(){
		$('.sort_field').removeClass('sort_selected');
		$(this).addClass('sort_selected');
		var restId = $('#rest-id').val();
		var filters = $('#filters').attr('value');
		var sortId = $(this).attr('id');
		$('#sort').val(sortId);
		var sort = getSortString(sortId);
		var tag = $('.tagitemSelected').attr('value');
		$('.product_area').empty();	
		$('#page_number').val('0');
		addContents(sort,restId,0,tag);
	});
	
	function initialContent(){
		var restId = $('#rest-id').val();
		var sortId = $('#sort_default').attr('id');
		$('#sort').val(sortId);
		var sort = getSortString(sortId);				
		addContents(sort,restId,0);
	}
	
	$(window).scroll(function () { 
		   if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
			  var restId = $('#rest-id').val();
			  var sort = getSortString($('#sort').val());	
			  var tag = $('.tagitemSelected').attr('value');
			  var pageNumber = $('#page_number').val();
			  pageNumber = parseInt(pageNumber) + 1;
			  addContents(sort,restId,pageNumber,tag);
			  $('#page_number').val(pageNumber);
		   }
	});
		
	function addContents(sort,restId,pageNumber,tag){
		if(!tag){
			tag = 0 ;
		}
		$.ajax({
			url: 'index.php?route=api/food/getFoodByRestaurantAndTagIdWithPage',
			type: 'post',
			data: 'sort=' + sort+ '&restid=' + restId + '&page_number='+ pageNumber  + '&tagid=' + tag,
			dataType: 'json',	
			success: function(data) {					
				$.each(data['results'], function(i, v) {
					var stringAddCart = "";
					var stringDistance = "";
					var stringRest = "";
					var name = "";
					var restName = "";
					if(language.indexOf("en")>-1){
						stringAddCart = "Add to cart";
						stringDistance = "Distance";
						stringRest = "Restaurant";
						if(v.name_en != null && v.name_en != ''){
							name = v.name_en;
						}
						else{
							name = v.name;
						}
						
						if(v.rest_name_en != null && v.rest_name_en != ''){
							restName = v.rest_name_en;
						}
						else{
							restName = v.rest_name;
						}
						
					}
					else{
						stringAddCart = "添加到餐车";
						stringDistance = "距离";
						stringRest = "餐馆";
						name = v.name;
						restName = v.rest_name;
					}
					var id = v.restaurant_id;
					var cost = v.avg_cost;
					var review_score = v.review_score;					
					var restId = id;
					var thumbEle = "";
					var thumbDescEle = "";
					var distance = gpsDistance(v.lat,v.lng,data['lat'],data['lng'],'K');
					if(distance>40){
						distance = '-';
					}
						id = v.food_id;
						cost = v.price;
						review_score = v.rest_review;
						restId = v.restaurant_id;
						
						thumbEle = '<div class="thumb" id='+id+'><img class="thumb_preview" src="'+v.img_url+'" alt="Image not found" onerror="onDishImgError(this)" /><div class="thumboverlay" style="display: none;"><div class="thumb_add2cart" restId='+restId+' foodId='+id+' id="food_'+id+'_number" number="'+v.cart_number+'">+ '+stringAddCart+'</div></div></div>';
						thumbDescEle = '<div class="thumb_desc"><div class="thumb_desc_foodname">'+name+'</div><a class="thumb_desc_restname" restId='+restId+' foodId='+id+' >'+stringRest+': '+restName+'</a>' +
											'<div class="thumb_desc_restdist">'+stringDistance+' '+distance+'KM</div><div class="thumb_desc_productinfo"><div class="thumb_desc_productfav">'+v.review_score+'</div>' +
											'<div class="thumb_desc_productprice">$ '+v.price+'</div></div></div>';
					
					      					
					
					var ele = '<div class="product">' +thumbEle+ thumbDescEle + '</div>';
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