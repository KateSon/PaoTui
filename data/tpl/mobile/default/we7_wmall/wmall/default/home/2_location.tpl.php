<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page sl-addr" id="page-app-location">
	<header class="bar bar-nav">
		<a class="pull-left" id="locate-back" data-href="<?php  echo imurl('wmall/home/index');?>"><i class="icon icon-arrow-left"></i></a>
		<a class="button button-link button-nav pull-right external" href="<?php  echo imurl('wmall/member/address');?>">新增地址</a>
		<h1 class="title">选择收货地址</h1>
	</header>
	<div class="bar bar-header-secondary">
		<div class="searchbar">
			<div class="search-input">
				<label class="icon search" for="search"></label>
				<input type="search" id='search' placeholder='请输入您的收货地址'/>
			</div>
		</div>
	</div>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="position-container">
			<div id="position"><span class="icon icon-focus"></span> <span class="position-status">定位到当前地址</span></div>
		</div>
		<?php  if(!empty($addresses)) { ?>
			<div class="sl-addr-block">
				<ul class="sl-addr-block-ls border-1px-tb">
					<li class="border-1px-b">我的收货地址</li>
					<?php  if(is_array($addresses)) { foreach($addresses as $address) { ?>
						<?php  if(!empty($address['location_x']) && !empty($address['location_y'])) { ?>
							<li class="js-location border-1px-b" data-lat="<?php  echo $address['location_x'];?>" data-lng="<?php  echo $address['location_y'];?>" data-address="<?php  echo $address['address'];?>" data-address-id="<?php  echo $address['id'];?>">
								<div class="sl-addr-people"><span><i><?php  echo $address['realname'];?></i><?php  echo $address['sex'];?></span><?php  echo $address['mobile'];?></div>
								<div class="sl-addr-info"><?php  echo $address['address'];?> <?php  echo $address['number'];?></div>
							</li>
						<?php  } ?>
					<?php  } } ?>
				</ul>
			</div>
		<?php  } ?>
		<div class="search-end"><!--添加 search-end-blk 显示搜索结果-->
			<ul class="search-end-ls" id="search-end-ls"></ul>
		</div>
	</div>
</div>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.3&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
$(function(){
	function getLocation() {
		var map, geolocation;
		map = new AMap.Map('allmap');
		map.plugin('AMap.Geolocation', function() {
			geolocation = new AMap.Geolocation({
				enableHighAccuracy: true,//是否使用高精度定位，默认:true
			});
			geolocation.getCurrentPosition();
			AMap.event.addListener(geolocation, 'complete', getPositionInfo);//返回定位信息
			AMap.event.addListener(geolocation, 'error', function(){
				alert('定位出错');
				$('.position-status').html('定位出错');
			});      //返回定位出错信息
		});
	}

	function getPositionInfo(data) {
		var point = data.position;
		$('#js-lat').html(point.lat);
		$('#js-lng').html(point.lng);
		var lnglatXY = [point.lng, point.lat]; //已知点坐标
		var map = new AMap.Map('allmap');
		map.plugin('AMap.Geocoder', function() {
			var geocoder = new AMap.Geocoder();
			geocoder.getAddress(lnglatXY, function(status, result) {
				if (status === 'complete' && result.info === 'OK') {
					var obj = result.regeocode.addressComponent;
					var position = result.regeocode.formattedAddress;
					position = position.replace(obj.province, '');
					position = position.replace(obj.district, '');
					position = position.replace(obj.city, '');
					$('#position').html(position);
					var params = '&lat='+lnglatXY[1]+'&lng='+lnglatXY[0]+'&address='+position;
					location.href = "<?php  echo imurl('wmall/home/index', array('d' => 1))?>"+params;
				}
			});
		});
		return ;
	}

	$(document).on('click', '#position', function() {
		$('.position-status').html('正在定位中...');
		getLocation();
	});

	$(document).on('click', '#locate-back', function() {
		var href = $(this).data('href');
		if($('.search-end').hasClass('search-end-blk')) {
			$('.search-end').removeClass('search-end-blk')
			$('.search-end-ls').html('');
			$('#search').val('');
		} else {
			location.href = href;
		}
	});

	$('#search').bind('input', function(){
		$('#search-end-ls').parent().addClass('search-end-blk');
		var key = $.trim($(this).val());
		if(!key) {
			return false;
		}
		$.post("<?php  echo imurl('wmall/home/location/suggestion');?>", {key: key}, function(data){
			var result = $.parseJSON(data);
			if(result.message.error != -1) {
				getAdress(result.message.message);
			}
		});
	});

	$('#search-end-ls, .sl-addr-block-ls').on('click', '.js-location', function(){
		var url = "<?php  echo imurl('wmall/home/index', array('d' => 1));?>";
		var lat = !$(this).data('lat') ? '' : $(this).data('lat');
		var lng = !$(this).data('lng') ? '' : $(this).data('lng');
		url += '&aid=' + $(this).data('address-id') + '&address=' + $(this).data('address') + '&lat=' + lat + '&lng=' + lng;
		location.href = url;
		return false;
	});

	function getAdress(re){
		var addressHtml = '';
		for(var i=0; i < re.length; i++){
			addressHtml += '<li class="js-location" data-lng="'+re[i]['lng']+'" data-lat="'+re[i]['lat']+'" data-name="'+re[i]['name']+'" data-address="'+re[i]['name']+'">';
			addressHtml += '<div class="search-end-name">'+re[i]['name']+'</div>';
			addressHtml += '<div class="search-end-quyu"> '+re[i]['address']+' </div>';
			addressHtml += '</li>';
		}
		$('#search-end-ls').html(addressHtml);
	}
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>