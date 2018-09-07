<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page home" id="page-app-index">
	<span id="js-lat" class="hide"><?php  if(!empty($_GPC['lat'])) { ?><?php  echo $_GPC['lat'];?><?php  } else { ?><?php  echo $_GPC['__lat'];?><?php  } ?></span>
	<span id="js-lng" class="hide"><?php  if(!empty($_GPC['lng'])) { ?><?php  echo $_GPC['lng'];?><?php  } else { ?><?php  echo $_GPC['__lng'];?><?php  } ?></span>
	<div class="fiexd-searchbar">
		<form action="<?php  echo imurl('wmall/home/hunt/search');?>" method="post" enctype="multipart/form-data">
			<input type="text" class="searchbar" name="key" placeholder="搜索商家、商品">
		</form>
	</div>
	<?php  get_mall_menu();?>
	<div class="content lazyload-container">
		<div class="search">
			<span class="search-inner">
				<i class="icon icon-lbs"></i>
				<a id="position" class="external" href="<?php  echo $location_url;?>"><?php  if(!empty($_GPC['address'])) { ?><?php  echo $_GPC['address'];?><?php  } else { ?><?php  echo $_GPC['__address'];?><?php  } ?></a><i class="icon icon-arrow-down-fill"></i>
			</span>
			<a class="search-block" href="<?php  echo imurl('wmall/home/hunt');?>">
				<i class="icon icon-search"></i>
			</a>
		</div>
		<?php  if(!empty($slides)) { ?>
		<div class="swiper-container slide" data-space-between='0' data-pagination='.swiper-slide-pagination' data-autoplay="5000">
			<div class="swiper-wrapper">
				<?php  if(is_array($slides)) { foreach($slides as $slide) { ?>
				<div class="swiper-slide" data-link="<?php  echo $slide['link'];?>">
					<img src="<?php  echo tomedia($slide['thumb']);?>" alt="">
				</div>
				<?php  } } ?>
			</div>
			<div class="swiper-pagination swiper-slide-pagination"></div>
		</div>
		<?php  } ?>

		<?php  if(!empty($categorys_chunk)) { ?>
		<div class="swiper-container category" data-space-between='0' data-pagination='.swiper-category-pagination' data-autoplay="0">
			<div class="swiper-wrapper">
				<?php  if(is_array($categorys_chunk)) { foreach($categorys_chunk as $row) { ?>
				<div class="swiper-slide">
					<div class="row no-gutter nav">
						<?php  if(is_array($row)) { foreach($row as $category) { ?>
						<div class="col-25">
							<a href="<?php  echo $category['link'];?>">
								<img src="<?php  echo tomedia($category['thumb']);?>" alt="<?php  echo $category['title'];?>" />
								<div class="text-center"><?php  echo $category['title'];?></div>
							</a>
						</div>
						<?php  } } ?>
					</div>
				</div>
				<?php  } } ?>
			</div>
			<?php  if(count($categorys_chunk) > 1) { ?>
			<div class="swiper-pagination swiper-category-pagination"></div>
			<?php  } ?>
		</div>
		<?php  } ?>

		<?php  if(!empty($notices)) { ?>
		<div class="headlines swiper-container border-1px-t" data-direction="vertical" data-pagination="" data-space-between="8" data-autoplay="2000">
			<div class="headline-logo pull-left"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/head_line.png" alt=""></div>
			<div class="headline-news pull-left swiper-wrapper">
				<?php  if(is_array($notices)) { foreach($notices as $notice) { ?>
				<div class="swiper-slide">
					<?php  if(!empty($notice['link'])) { ?>
					<a href="<?php  echo $notice['link'];?>"><?php  echo $notice['title'];?></a>
					<?php  } else { ?>
					<a href="<?php  echo imurl('wmall/home/notice', array('id' => $notice['id']))?>"><?php  echo $notice['title'];?></a>
					<?php  } ?>
				</div>
				<?php  } } ?>
			</div>
			<i class="icon icon-arrow-right pull-left"></i>
		</div>
		<?php  } ?>

		<?php  if(!empty($cubes)) { ?>
		<div class="row no-gutter sborder activity" style="z-index: 1000">
			<?php  if(is_array($cubes)) { foreach($cubes as $i => $nav) { ?>
			<div class="col-50 sborder">
				<a href="<?php  echo $nav['link'];?>">
					<div class="row no-gutter">
						<?php  if($i % 2 == 0) { ?>
						<div class="col-60">
							<div class="heading"><?php  echo $nav['title'];?></div>
							<div class="sub-heading"><?php  echo $nav['tips'];?></div>
						</div>
						<div class="col-40 text-center">
							<img src="<?php  echo tomedia($nav['thumb']);?>" alt="" />
						</div>
						<?php  } else { ?>
						<div class="col-40 text-center">
							<img src="<?php  echo tomedia($nav['thumb']);?>" alt="" />
						</div>
						<div class="col-60">
							<div class="heading"><?php  echo $nav['title'];?></div>
							<div class="sub-heading"><?php  echo $nav['tips'];?></div>
						</div>
						<?php  } ?>
					</div>
				</a>
			</div>
			<?php  $i++?>
			<?php  } } ?>
		</div>
		<?php  } ?>

		<?php  if(!empty($bargains)) { ?>
		<div class="bargain-activity">
			<div class="activity-header text-center">
				天天特价
				<a class="more" href="<?php  echo imurl('bargain/index')?>">更多 <i class="icon icon-arrow-right"></i></a>
			</div>
			<div class="goods-list row">
				<?php  if(is_array($bargains)) { foreach($bargains as $bargain) { ?>
				<div class="goods-item col-25">
					<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $bargain['sid'], 'goods_id' => $bargain['goods_id']))?>">
						<div class="goods-image">
							<div class="label"><?php  echo $bargain['discount'];?>折</div>
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" alt="" class="lazyload" data-original="<?php  echo tomedia($bargain['thumb'])?>">
						</div>
						<div class="goods-title"><?php  echo $bargain['title'];?></div>
						<div class="price">
							<i>￥</i><span class="now-price"><?php  echo $bargain['discount_price'];?></span>&nbsp;<span class="original-price">￥<?php  echo $bargain['price'];?></span>
						</div>
					</a>
				</div>
				<?php  } } ?>
			</div>
		</div>
		<?php  } ?>

		<?php  if(!empty($recommends)) { ?>
		<div class="selective">
			<div class="selective-tab">
				为您优选
				<a class="more" href="<?php  echo imurl('wmall/channel/brand')?>">更多<i class="icon icon-arrow-right"></i></a>
			</div>
			<div class="selective-info row">
				<?php  if(is_array($recommends)) { foreach($recommends as $recommend) { ?>
				<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $recommend['id']))?>" class="col-33 selective-item">
					<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" data-original="<?php  echo tomedia($recommend['logo']);?>" class="lazyload lazyload-store" alt="">
					<p class="selective-title"><?php  echo $recommend['title'];?></p>
				</a>
				<?php  } } ?>
				<div class="clearfix"></div>
			</div>
		</div>
		<?php  } ?>

		<div class="buttons-tab select-tab">
			<a href="javascript:;" class="button">商家分类 <span class="icon"></span></a>
			<div class="drop-menu-list">
				<div class="list-block">
					<ul>
						<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('wmall/home/search', array('cid' => 0));?>">全部</a></li>
						<?php  if(is_array($categorys)) { foreach($categorys as $row) { ?>
						<li><a class="list-button item-link border-1px-b" href="<?php  echo $row['link'];?>"><?php  echo $row['title'];?></a></li>
						<?php  } } ?>
					</ul>
				</div>
			</div>
			<a href="javascript:;" class="button">智能排序 <span class="icon"></span></a>
			<div class="drop-menu-list">
				<div class="list-block">
					<ul>
						<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('wmall/home/search', array('order' => ''));?>"><span class="icon"></span>全部</a></li>
						<?php  if(is_array($orderbys)) { foreach($orderbys as $row) { ?>
						<li><a class="list-button item-link border-1px-b"  href="<?php  echo imurl('wmall/home/search', array('order' => $row['key']));?>"><span class="<?php  echo $row['css'];?>"></span><?php  echo $row['title'];?></a></li>
						<?php  } } ?>
					</ul>
				</div>
			</div>
			<a href="javascript:;" class="button">优惠活动 <span class="icon"></span></a>
			<div class="drop-menu-list">
				<div class="list-block">
					<ul>
						<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('wmall/home/search', array('dis' => ''));?>"><span class="icon"></span>全部</a></li>
						<?php  if(is_array($discounts)) { foreach($discounts as $row) { ?>
						<li><a class="list-button item-link border-1px-b" href="<?php  echo imurl('wmall/home/search', array('dis' => $row['key']));?>"><span class="<?php  echo $row['css'];?>"></span><?php  echo $row['title'];?></a></li>
						<?php  } } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="store-list store-empty lazyload-container" id="store-list">
			<div class="common-no-con">
				<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
				<p>努力加载中...</p>
			</div>
		</div>
		<?php  include itemplate('public/copyright', TEMPLATE_INCLUDEPATH);?>
	</div>
	<div class="footmark-warpper">
		<a href="javascript:;" id="go-top" class="icon icon-up"></a>
		<a href="<?php  echo imurl('wmall/home/footmark')?>" class="footmark"><i class="icon icon-footprint"></i></a>
	</div>
	<?php  get_mall_danmu();?>
</div>
<?php  include itemplate('home/tpl-store', TEMPLATE_INCLUDEPATH);?>
<?php  get_mall_superRedpacket();?>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.3&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
	require(['tiny'], function(tiny){
		$('.content').on("scroll", function(){
			$('.content').scrollTop() >= 132 ? $('.fiexd-searchbar').show() : $('.fiexd-searchbar').hide();
		});

		$(document).on('click', '.slide .swiper-slide', function(){
			var url = $(this).data('link');
			location.href = url;
			return;
		});

		function getLocation() {
			var map, geolocation;
			map = new AMap.Map('allmap');
			map.plugin('AMap.Geolocation', function() {
				geolocation = new AMap.Geolocation({
					enableHighAccuracy: true //是否使用高精度定位，默认:true
				});
				geolocation.getCurrentPosition();
				AMap.event.addListener(geolocation, 'complete', getPositionInfo);//返回定位信息
				AMap.event.addListener(geolocation, 'error', function(){
					if(!tiny.cookie.get('__getPosition')) {
						location.reload();
						tiny.cookie.set('__getPosition', 1, 300);
					} else {
						getPositionInfo();
					}
				});
			});
		}

		function getPositionInfo(data) {
			if(typeof data != 'undefined') {
				tiny.cookie.set('__getPosition', 0, -1000);
				var point = data.position;
				$('#js-lat').html(point.lat);
				$('#js-lng').html(point.lng);

				tiny.cookie.set('__lat', point.lat, 3600);
				tiny.cookie.set('__lng', point.lng, 3600);

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
							tiny.cookie.set('__address', encodeURI(position), 3600);
						}
					});
				});
			}
			getStoreList();
			return ;
		}

		function getStoreList() {
			var params = {
				lat: $('#js-lat').html(),
				lng: $('#js-lng').html(),
				position: $('#position').html()
			}
			$.post("<?php  echo imurl('wmall/home/index/list')?>", params, function(data){
				var result = $.parseJSON(data);
				if(result.message.error != 0) {
					$.toast(result.message.message);
					return false;
				}
				if(result.message.message.length == 0) {
					$('#store-list').addClass('store-empty');
					$('#store-list .common-no-con').find('p').html('附近没有符合条件的商户');
					$('#store-list .common-no-con').removeClass('hide');
				} else {
					var gettpl = $('#tpl-store-list').html();
					require(['laytpl', 'jquery.lazyload'], function(laytpl){
						laytpl(gettpl).render(result.message.message, function(html){
							$('#store-list').removeClass('store-empty');
							$('#store-list .common-no-con').addClass('hide');
							$('#store-list').append(html);
							var memoryHeight = sessionStorage.getItem(pageId);
							$pageId.find('.content').scrollTop(parseInt(memoryHeight));
							$('#store-list').find("img.lazyload").lazyload({
								container: $('.lazyload-container'),
								effect : 'fadeIn',
								threshold : 200
							});
							return;
						});
					});
				}
			});
		}
		<?php  if(!$_GPC['d'] && !$_GPC['__lng']) { ?>
			getLocation();
			<?php  } else { ?>
			getStoreList();
			<?php  } ?>
			});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>

