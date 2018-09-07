<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'post') { ?>
<div class="page address">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">新增地址</h1>
		<button class="button button-link button-nav pull-right" id="btnSubmit">保存</button>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<div id="allmap" style="display: none"></div>
		<div class="list-block">
			<ul class="border-1px-tb">
				<?php  if($store['auto_get_address'] == 1) { ?>
					<li class="item-addr">
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">小区/大厦/学校</div>
								<div class="item-input">
									<label></label>
									<input type="hidden" name="lat" id="lat" value="<?php  echo $address['location_x'];?>"/>
									<input type="hidden" name="lng" id="lng" value="<?php  echo $address['location_y'];?>"/>
									<input type="hidden" name="address" id="address" value="<?php  echo $address['address'];?>"/>
									<a id="location" href="<?php  echo imurl('wmall/member/address/location', array('id' => $id, 'sid' => $_GPC['sid'], 'recordid' => $_GPC['recordid'], 'redirect_type' => $_GPC['redirect_type'], 'redirect_input' => $_GPC['redirect_input']));?>"><?php  if(!empty($address['address'])) { ?><?php  echo $address['address'];?><?php  } else { ?><span>点击添加地址(必填)</span><?php  } ?> <i class="icon icon icon-arrow-right pull-right"></i></a>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">楼号-门牌号</div>
								<div class="item-input">
									<input type="text" placeholder="详细地址,例：1号楼一单元102室" name="number" class="number" value="<?php  echo $address['number'];?>">
								</div>
							</div>
						</div>
					</li>
				<?php  } else { ?>
					<li class="item-addr">
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">收货地址</div>
								<div class="item-input" style="padding-left: 0">
									<input type="text" placeholder="请输入详细收货地址" name="address" id="address" value="<?php  echo $address['address'];?>"/>
								</div>
							</div>
						</div>
					</li>
				<?php  } ?>
				<li class="item-li-one">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">联系人</div>
							<div class="item-input">
								<div class="meitem-input border-1px-b"><input type="text" name="realname" class="realname" placeholder="您的姓名" value="<?php  echo $address['realname'];?>"></div>
								<div class="item-sex border-1px-b">
									<label class="label-checkbox item-content">
										<input type="radio" name="sex" value="先生" class="sex" <?php  if($address['sex'] == '先生' || !$address['sex']) { ?>checked<?php  } ?>>
										<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
										<div class="item-inner">
											<div class="item-title">先生</div>
										</div>
									</label>
									<label class="label-checkbox item-content">
										<input type="radio" name="sex" value="女士" class="sex" <?php  if($address['sex'] == '女士') { ?>checked<?php  } ?>>
										<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
										<div class="item-inner">
											<div class="item-title">女士</div>
										</div>
									</label>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">手机号</div>
							<div class="item-input">
								<input type="text" name="mobile" class="mobile" placeholder="配送人员联系您的电话" value="<?php  echo $address['mobile'];?>">
							</div>
						</div>
					</div>
				</li>
			</ul>
			<?php  if(!empty($address['id'])) { ?>
				<div class="del-address border-1px-tb">
					<a href="javascript:;" data-id="<?php  echo $address['id'];?>" class="btnDel">删除该地址</a>
				</div>
			<?php  } ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.3&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
<?php  if(empty($address['id']) && empty($_GPC['d'])) { ?>
	function getLocation() {
		var map, geolocation;
		map = new AMap.Map('allmap');
		map.plugin('AMap.Geolocation', function() {
			geolocation = new AMap.Geolocation({
				enableHighAccuracy: true //是否使用高精度定位，默认:true
			});
			geolocation.getCurrentPosition();
			AMap.event.addListener(geolocation, 'complete', function(point){
				var lnglatXY = [point.position.lng, point.position.lat]; //已知点坐标
				map.plugin('AMap.Geocoder', function() {
					var geocoder = new AMap.Geocoder();
					geocoder.getAddress(lnglatXY, function(status, result) {
						if (status === 'complete' && result.info === 'OK') {
							var address = result.regeocode.formattedAddress;
							var obj = result.regeocode.addressComponent;
							address = address.replace(obj.province, '');
							address = address.replace(obj.district, '');
							address = address.replace(obj.city, '');
							$('#address').val(address);
							$('#lng').val(point.position.lng);
							$('#lat').val(point.position.lat);
							$('#location').html(address + ' <i class="icon icon icon-arrow-right pull-right"></i>');
						}
					});
				});
			});
		});
	}
	getLocation();
<?php  } ?>

var redirect_url = "<?php  echo $redirect_url;?>";
$(function(){
	$('#btnSubmit').click(function(){
		var auto_get_address = <?php  echo $store['auto_get_address'];?>;
		var $this = $(this);
		if($(this).hasClass('disabled')) {
			return false;
		}
		var realname = $.trim($('.realname').val());
		if(!realname) {
			$.toast("联系人不能为空");
			return false;
		}
		var mobile = $.trim($('.mobile').val());
		var reg = /^[01][345678][0-9]{9}$/;
		if(!reg.test(mobile)) {
			$.toast("手机号格式错误");
			return false;
		}
		var sex = $.trim($('.sex:checked').val());
		if(!sex) {
			$.toast("请选择性别");
			return false;
		}
		var address = $.trim($('#address').val());
		if(!address) {
			$.toast("地址不能为空");
			return false;
		}
		var lat = $('#lat').val();
		var lng = $('#lng').val();
		if((!lat || !lng) && auto_get_address == 1) {
			$.toast("地址信息有误");
			return false;
		}
		var number = $('.number').val();
		var params = {
			realname: realname,
			mobile: mobile,
			sex: sex,
			address: address,
			number: number,
			location_x: lat,
			location_y: lng,
			redirect_type: "<?php  echo $redirect_type;?>"
		};
		$(this).addClass('disabled');
		$.post("<?php  echo imurl('wmall/member/address/post', array('id' => $id))?>", params, function(data) {
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$this.removeClass('disabled');
				$.toast(result.message.message);
			} else {
				if(redirect_url != '') {
					location.href = redirect_url + result.message.message;
				} else {
					$.toast('修改成功,跳转中...');
					location.href = "<?php  echo imurl('wmall/member/address/list')?>";
				}
			}
			return false;
		});
	});

	$('.btnDel').click(function(){
		var id = $(this).data('id');
		if(!id) return false;
		$.confirm('确定删除该地址吗?', function () {
			$.post("<?php  echo imurl('wmall/member/address/del', array('id' => $id))?>", {id: id}, function(data) {
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					$.toast(result.message.message);
				} else {
					$.toast('删除成功', "<?php  echo imurl('wmall/member/address/list')?>", 1000);
				}
				return false;
			});
		});
	});
});
</script>
<?php  } ?>

<?php  if($ta == 'list') { ?>
<div class="page address-list">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">我的地址</h1>
		<a class="button button-link button-nav pull-right external" href="<?php  echo imurl('wmall/member/address/post', array('sid' => $_GPC['sid'], 'redirect_type' => $_GPC['redirect_type'], 'redirect_input' => $_GPC['redirect_input'], 'recordid' => $_GPC['recordid']));?>">新增</a>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<?php  if(empty($addresses)) { ?>
			<div class="common-no-con">
				<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/address_no_con.png" alt="" />
				<p>您还没有送货地址，快去添加吧！</p>
			</div>
		<?php  } else { ?>
			<?php  if($store['order_address_limit'] == 1) { ?>
				<div class="list-block">
					<div class="address-list-title">我的收货地址</div>
					<ul class="border-1px-tb">
						<?php  if(is_array($addresses)) { foreach($addresses as $address) { ?>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="row no-gutter">
									<div class="col-80 addressChecked" data-id="<?php  echo $address['id'];?>">
										<div><span class="name"><?php  echo $address['realname'];?></span><span class="sex"><?php  echo $address['sex'];?></span><span class="tel"><?php  echo $address['mobile'];?></span></div>
										<div class="detail-address"><?php  echo $address['address'];?></div>
									</div>
									<div class="col-20 address-edit">
										<a class="external" href="<?php  echo imurl('wmall/member/address/post', array('id' => $address['id'], 'sid' => $_GPC['sid'], 'redirect_type' => $_GPC['redirect_type'], 'redirect_input' => $_GPC['redirect_input'], 'recordid' => $_GPC['recordid']));?>"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/address_edit.png" alt="" /></a>
									</div>
								</div>
							</div>
						</li>
						<?php  } } ?>
					</ul>
				</div>
			<?php  } else { ?>
				<?php  if(!empty($available)) { ?>
					<div class="list-block">
						<div class="address-list-title">可选收货地址</div>
						<ul class="border-1px-tb">
							<?php  if(is_array($available)) { foreach($available as $address) { ?>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="row no-gutter">
										<div class="col-80 addressChecked" data-id="<?php  echo $address['id'];?>">
											<div><span class="name"><?php  echo $address['realname'];?></span><span class="sex"><?php  echo $address['sex'];?></span><span class="tel"><?php  echo $address['mobile'];?></span></div>
											<div class="detail-address"><?php  echo $address['address'];?></div>
										</div>
										<div class="col-20 address-edit">
											<a class="external" href="<?php  echo imurl('wmall/member/address/post', array('id' => $address['id'], 'sid' => $_GPC['sid'], 'redirect_type' => $_GPC['redirect_type'], 'redirect_input' => $_GPC['redirect_input'], 'recordid' => $_GPC['recordid']));?>"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/address_edit.png" alt="" /></a>
										</div>
									</div>
								</div>
							</li>
							<?php  } } ?>
						</ul>
					</div>
				<?php  } ?>
				<?php  if(!empty($dis_available)) { ?>
					<div class="list-block">
						<div class="address-list-title">不在配送范围内或地址不完善</div>
						<ul class="disabled border-1px-tb">
							<?php  if(is_array($dis_available)) { foreach($dis_available as $address) { ?>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="row no-gutter">
										<div class="col-80 addressNotChecked" data-id="<?php  echo $address['id'];?>">
											<div><span class="name"><?php  echo $address['realname'];?></span><span class="sex"><?php  echo $address['sex'];?></span><span class="tel"><?php  echo $address['mobile'];?></span></div>
											<div class="detail-address"><?php  echo $address['address'];?></div>
										</div>
										<div class="col-20 address-edit">
											<a class="external" href="<?php  echo imurl('wmall/member/address/post', array('id' => $address['id'], 'sid' => $_GPC['sid'], 'redirect_type' => $_GPC['redirect_type'], 'redirect_input' => $_GPC['redirect_input'],  'recordid' => $_GPC['recordid']));?>"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/address_edit.png" alt="" /></a>
										</div>
									</div>
								</div>
							</li>
							<?php  } } ?>
						</ul>
					</div>
				<?php  } ?>
			<?php  } ?>
		<?php  } ?>
	</div>
</div>
<script>
$(function(){
	var redirect_url = "<?php  echo $redirect_url;?>";
	if(redirect_url != '') {
		$('.addressChecked').click(function(){
			var address_id = $(this).data('id');
			if(address_id) {
				$.post("<?php  echo imurl('wmall/member/address/default', array('sid' => $_GPC['sid'], 'recordid' => $_GPC['recordid']))?>", {'id':address_id},function(){
					location.href = redirect_url + address_id;
				});
			}
			return false;
		});
		$('.addressNotChecked').click(function(){
			$.toast('该地址不在商家配送范围内');
			return false;
		});
	}
});
</script>
<?php  } ?>

<?php  if($ta == 'location') { ?>
<div class="page locate" id="page-app-locate">
	<header class="bar bar-nav">
		<a class="pull-left" id="locate-back" href="javascript:;" data-href="<?php  echo imurl('wmall/member/address/post', array('id' => $_GPC['id']));?>"><i class="icon icon-arrow-left"></i></a>
		<div class="search-input">
			<label class="icon locateicon" for="search"></label>
			<input type="search" id='search' placeholder='请输入小区/大厦/学校等'/>
		</div>
	</header>
	<div class="content">
		<div class="map">
			<div id="allmap"></div>
			<div class="dot" style="display:block;"></div>
			<input name="lat" id="lat" type="hidden"/>
			<input name="lng" id="lng" type="hidden"/>
		</div>
		<div class="buttons-tab select-tab border-1px-t">
			<a href="javascript:;" class="button active" data-keywords=" ">全部</a>
			<a href="javascript:;" class="button" data-keywords="小区">小区</a>
			<a href="javascript:;" class="button" data-keywords="写字楼">写字楼</a>
			<a href="javascript:;" class="button" data-keywords="学校">学校</a>
		</div>
		<ul class="locate-ls border-1px-tb" id="locate-ls"></ul>
		<ul class="search-list hide" id="search-list"></ul>
	</div>
</div>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.3&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
	$(function(){
		var redirect_type = "<?php  echo $redirect_type;?>";
		var order_address_limit = <?php  echo $order_address_limit;?>;
		var serve_radius = <?php  echo $store['serve_radius'];?>;
		var map_config = <?php  echo json_encode($map);?>;
		var polygons = {};
		var map = new AMap.Map('allmap', {
			resizeEnable: true,
			center: [map_config.center.location_y, map_config.center.location_x],
			zoom: 13
		});
		if(order_address_limit == 1) {
			map.plugin('AMap.Geolocation', function() {
				var geolocation = new AMap.Geolocation({
					enableHighAccuracy: true
				});
				geolocation.getCurrentPosition();
				AMap.event.addListener(geolocation, 'complete', function(data){
					var position = data.position;
					map.panTo([position.lng, position.lat]);
					getPositionInfo(position.lat, position.lng);
					$('#lat').val(position.lat);
					$('#lng').val(position.lng);
				});
				AMap.event.addListener(geolocation, 'error', function(data){
					$.toast('请拖动地图搜索');
				});
			});
		} else {
			map.panTo(["<?php  echo $store['location_y'];?>", "<?php  echo $store['location_x'];?>"]);
			if(order_address_limit == 2 || order_address_limit == 3) {
				var circle = new AMap.Circle({
					center: new AMap.LngLat("<?php  echo $store['location_y'];?>", "<?php  echo $store['location_x'];?>"),// 圆心位置
					radius: serve_radius * 1000, //半径
					strokeColor: "#F33", //线颜色
					strokeOpacity: 0.7, //线透明度
					strokeWeight: 2, //线粗细度
					fillColor: "#1791fc", //填充颜色
					fillOpacity: 0.5//填充透明度
				});
				circle.setMap(map);
			} else {
				var delivery_areas = <?php  echo json_encode($store['delivery_areas'])?>;
				$.each(delivery_areas, function(k, v){
					var polygon = new AMap.Polygon({
						map: map,
						path: v.path,
						strokeColor: v.strokeColor, //线颜色
						strokeOpacity: 0.2, //线透明度
						strokeWeight: 3,    //线宽
						fillColor: v.fillColor, //填充色
						fillOpacity: 0.35//填充透明度
					});
					polygons[k] = polygon;
				});
			}
			getPositionInfo("<?php  echo $store['location_x'];?>", "<?php  echo $store['location_y'];?>");
			$('#lat').val(<?php  echo $store['location_x'];?>);
			$('#lng').val(<?php  echo $store['location_y'];?>);
		}
		AMap.event.addListener(map, "dragend", function(){
			var center = map.getCenter();
			$('#lat').val(center.lat);
			$('#lng').val(center.lng);
			getPositionInfo(center.lat, center.lng);
		});

		$('#search').bind('input', function(){
			var key = $.trim($(this).val());
			if(!key) {
				return false;
			}
			$('#search-list').removeClass('hide');
			$.post("<?php  echo imurl('wmall/home/location/suggestion');?>", {key: key, type: redirect_type}, function(data){
				var result = $.parseJSON(data);
				if(result.message.error != -1) {
					getAdress(result.message.message, '#search-list');
				}
			});
		});

		$(document).on('click', '#locate-back', function() {
			var href = $(this).data('href');
			if(!$('#search-list').hasClass('hide')) {
				$('#search-list').html('').addClass('hide');
				$('#search').val('');
			} else {
				location.href = href;
			}
		});

		$(document).on('click', '.buttons-tab .button', function() {
			$(this).addClass('active').siblings().removeClass('active');
			var lat = $('#lat').val();
			var lng = $('#lng').val();
			getPositionInfo(lat, lng);
		});

		$(document).on('click', '.select-locate', function(){
			var lng = $(this).data('lng');
			var lat = $(this).data('lat');
			var wait = 0;
			if(order_address_limit > 1) {
				var lnglat = new AMap.LngLat("<?php  echo $store['location_y'];?>", "<?php  echo $store['location_x'];?>");
				var dist = ((lnglat.distance([lng, lat])) / 1000).toFixed(2);
/*				if(map_config.serve_radius > 0 && dist > map_config.serve_radius) {
					$.toast('平台服务范围' + map_config.serve_radius + '公里, 当前地址不在服务范围内');
					return false;
				}*/
				if(order_address_limit == 2) {
					if(dist > serve_radius) {
						$.toast('商户配送范围' + serve_radius + '公里, 当前地址不在商户配送范围内');
						return false;
					}
				}
				<?php  if($store['delivery_fee_mode'] == 2) { ?>
					var delivery_price_extra = <?php  echo json_encode($store['delivery_price_extra'])?>;
					var delivery_price = parseFloat(delivery_price_extra.start_fee);
					var start_km = parseFloat(delivery_price_extra.start_km);
					if(dist > start_km) {
						delivery_price = (parseFloat(delivery_price) + ((dist - start_km) * parseFloat(delivery_price_extra.pre_km_fee))).toFixed(2);
					}
					$.toast('配送距离' + dist + '公里, 预计配送费' + delivery_price + '元');
					wait = 1500;
				<?php  } else if($store['delivery_fee_mode'] == 3) { ?>
					var in_radius = 0;
					var area_index = 0;
					$.each(polygons, function(k, v){
						if(!in_radius) {
							in_radius = v.contains([lng, lat]);
							if(in_radius) {
								area_index = k;
							}
						}
					});
					if(!in_radius) {
						$.toast('您选择的地址超出了商家的配送范围了');
						return false;
					} else {
						var area = delivery_areas[area_index];
						$.toast('该区域的起送价:' + area.send_price + '元,配送费:' + area.delivery_price + '元');
						wait = 1500;
					}
				<?php  } ?>
			}
			var url = "<?php  echo imurl('wmall/member/address/post', array('id' => $_GPC['id'], 'sid' => $_GPC['sid'], 'd' => 1, 'r' => $_GPC['r'], 'redirect_type' => $_GPC['redirect_type'], 'redirect_input' => $_GPC['redirect_input'],  'recordid' => $_GPC['recordid']));?>";
			url += '&address=' + $(this).data('name') + '&lng=' + $(this).data('lng') + '&lat=' + $(this).data('lat');
			setTimeout(function(){
				location.href = url;
			}, wait);
			return false;
		});
	});

	function getPositionAdress(result){
		if(result.info == "OK"){
			var re = [];
			for(var i in result.pois){
				var location = result.pois[i].location.split(',');
				re.push({'name':result.pois[i].name, 'address':result.pois[i].address, 'lng':location[0],'lat':location[1]});
			}
			getAdress(re, '#locate-ls');
		} else {
			alert('获取位置失败！');
		}
	}

	function getPositionInfo(lat, lng){
		var keywords = $.trim($('.buttons-tab .button.active').data('keywords'));
		$.getJSON('https://restapi.amap.com/v3/place/around?key=37bb6a3b1656ba7d7dc8946e7e26f39b&location='+lng+','+lat+'&radius=50000&sortrule=distance&extensions=all&output=json&keywords='+keywords+'&callback=getPositionAdress&json=?');
	}

	function getAdress(re, container){
		var addressHtml = '';
		for(var i=0; i < re.length; i++){
			addressHtml += '<li class="border-1px-b select-locate '+ (i == 0 ? 'locate-ls-active' : '') +'" data-lng="'+re[i]['lng']+'" data-lat="'+re[i]['lat']+'" data-name="'+re[i]['name']+'" data-address="'+re[i]['address']+'">';
			addressHtml += '<div class="locate-ls-info">'+(i == 0 ? '[推荐位置]' : '')+'   '+re[i]['name']+' </span></div>';
			addressHtml += '<span> '+re[i]['address']+' </span>';
			addressHtml += '</li>';
		}
		$(container).html(addressHtml);
	}
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>