define(["tiny"],function(a){
	var b={};
	return b.initDetail=function(b){
		function c(){
			if($.showIndicator(),5==b.order.status)
				return void $.hideIndicator();
			var c=[];
			$.post(a.getUrl("system/common/deliveryer/location"),{id:b.order.deliveryer_id},function(a){
				$.hideIndicator();
				var b=$.parseJSON(a);
				if(-1!=b.message.errno){
					var f=b.message.message,
					g=new AMap.Marker({position:[f.location_y,f.location_x],
					offset:new AMap.Pixel(-26,-80),
					content:'<div class="marker-deliveyer-route"><img src="'+f.avatar+'" alt=""/></div>'}),
					h=new AMap.Marker({position:[f.location_y,f.location_x],
					offset:new AMap.Pixel(-26,-80),
					content:'<div class="marker-deliveyer-route"><img src="'+f.avatar+'" alt=""/></div>'});
					d.panTo([f.location_y,f.location_x]),
					d.remove(c),
					g.setMap(d),
					e.panTo([f.location_y,f.location_x]),
					e.remove(c),
					h.setMap(e),
					e.setFitView(),
					c.push(g),
					c.push(h)
				}
			})
		}
		if(b.order.orderGrant_share>0&&(window.sharedata.success=function(){
			$.showIndicator();
			var c=a.getUrl("ordergrant/share/grant",{id:b.order.id},!0);
			$.post(c,function(a){
				var b=$.parseJSON(a);
				$.hideIndicator(),
				$.toast(b.message.message,location.href)
			})
		}),"app"!=b.order.delivery_handle_type)
		return!1;
		var d=new AMap.Map("map",{resizeEnable:!0,center:[116.397428,39.90923],zoom:13}),
		    e=new AMap.Map("map-current",{resizeEnable:!0,center:[116.397428,39.90923],zoom:15});
			if(b.order.location_y&&b.order.location_x){
				var f=new AMap.Marker({
				position:[b.order.location_y,b.order.location_x],
				offset:new AMap.Pixel(-35,-35),
				content:'<div class="marker-mine-route"></div>'
				});
				f.setMap(e)
			}
			if(b.store.location_y&&b.store.location_x){
				var f=new AMap.Marker({
					position:[b.store.location_y,b.store.location_x],
					offset:new AMap.Pixel(-33,-70),
					content:'<div class="marker-start-head-route"><img src="'+b.store.logo+'" alt=""/></div>'});
				f.setMap(e)
			}
			if(5==b.order.status){
				d.panTo([b.order.delivery_success_location_y,b.order.delivery_success_location_x]),
				e.panTo([b.order.delivery_success_location_y,b.order.delivery_success_location_x]);
				var f=new AMap.Marker({
					position:[b.order.delivery_success_location_y,b.order.delivery_success_location_x],
					offset:new AMap.Pixel(-26,-80),
					content:'<div class="marker-deliveyer-route"><img src='+b.deliveryer.avatar+' alt=""/></div>'
					});
				f.setMap(d);
				var f=new AMap.Marker({
					position:[b.order.delivery_success_location_y,b.order.delivery_success_location_x],
					offset:new AMap.Pixel(-26,-80),
					content:'<div class="marker-deliveyer-route"><img src='+b.deliveryer.avatar+' alt=""/></div>'
					});
				f.setMap(e)
			}else{
				d.panTo([b.deliveryer.location_y,b.deliveryer.location_x]);
				var f=new AMap.Marker({position:[b.deliveryer.location_y,b.deliveryer.location_x],
				offset:new AMap.Pixel(-26,-80),
				content:'<div class="marker-deliveyer-route"><img src='+b.deliveryer.avatar+' alt=""/></div>'
				});
				f.setMap(d)
			}
			var g="";
			d.on("click",function(){
				setTimeout(function(){e.setFitView()},500),
				c(),
				g=setInterval(c,6e4),
				$.popup(".popup-order-map-info")}),
				$(".btn-close-popup").click(function(){
					clearInterval(g),
					$.closeModal(".popup-order-map-info")
					}),
					$(".btn-refresh").click(function(){c()
					}),
					$(".btn-info").click(function(){
						alert("配送员位置一分钟更新一次，如果配送员远离您，那可能是正在为更早下单的用户配送，请耐心等待~")
						})
    },
	b.initComment=function(){
		$(document).on("click",".star-outline label",function(){
			$(this).parent().find(".radio").removeClass("checked").prop("checked",!1),
			$(this).prevAll().find(".radio").prop("checked",!0),
			$(this).find(".radio").addClass("checked").prop("checked",!0)
		}),
		$(document).on("click",".submit-com",function(){
			var b=$(this),c=b.data("id");
			if(b.hasClass("disabled"))return!1;
			b.addClass("disabled");
			var d={id:c,goods:{},thumbs:[]};
			if($(".star-outline").each(function(){
				var a=$(this).data("name"),b=$(this).find(".radio.checked").val();
				d[a]=b}),!d.delivery_service)
				return b.removeClass("disabled"),$.toast("请评价配送服务"),!1;
			if(!d.goods_quality)
				return b.removeClass("disabled"),$.toast("请评价商品质量"),!1;
			var e=$.trim($(".note").val());
			d.note=e,$(".goods-list").each(function(){
				var a=$(this).data("id");
				d.goods[a]=$(this).find(".radio:checked").val()
			}),
			$('.tpl-image .image-item input[type!="file"]').each(function(){
				var a=$.trim($(this).val());a&&d.thumbs.push(a)
				}),
				$.post(a.getUrl("wmall/order/comment"),d,function(d){
					var e=$.parseJSON(d);
					return 0!=e.message.errno?(b.removeClass("disabled"),$.toast(e.message.message)):$.toast("评价成功",a.getUrl("wmall/order/index/detail",{id:c})),
					!1})
		})
    },b
});