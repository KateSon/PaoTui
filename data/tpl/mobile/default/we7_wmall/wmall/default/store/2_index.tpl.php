<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page store-detail" id="page-app-store">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">商户详情</h1>
		<a class="pull-right" href="javascript:;" id="btn-favorite" data-id="<?php  echo $store['id'];?>" data-uid="<?php  echo $_W['member']['uid'];?>">
			<i class="fa <?php  if(!empty($is_favorite)) { ?>icon icon-favorfill<?php  } else { ?>icon icon-favor<?php  } ?>"></i>
		</a>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<?php  if(!empty($store['thumbs'])) { ?>
		<div class="swiper-container swiper-container-horizontal" data-space-between='30' data-pagination='.swiper-pagination' data-autoplay="2000">
			<div class="swiper-wrapper">
				<?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $thumb) { ?>
				<div class="swiper-slide js-url" data-link="<?php  echo $thumb['url'];?>">
					<img src="<?php  echo tomedia($thumb['image']);?>"alt="">
				</div>
				<?php  } } ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<?php  } ?>
		<div class="row no-gutter banner border-1px-b">
			<div class="col-33 text-center">
				<img src="<?php  echo tomedia($store['logo']);?>" alt="" class="logo"/>
			</div>
			<div class="col-67">
				<div class="goods-title"><?php  echo $store['title'];?></div>
				<div class="star-rank">
					<span class="star-rank-outline">
						<span class="star-rank-active" style="width:<?php  echo $store['score_cn'];?>%"></span>
						<span class="star-rank-value"><?php  echo $store['score'];?></span>
					</span>
				</div>
				<div class="sell-info">已售:<?php  echo $store['sailed'];?>份</div>
			</div>
		</div>
		<div class="row no-gutter delivery-info">
			<div class="col-33 border-1px-r">起送价￥<?php  echo $store['send_price'];?></div>
			<div class="col-33 border-1px-r">配送￥<?php  echo $store['delivery_price'];?></div>
			<div class="col-33">送达时长<?php  echo $store['delivery_time'];?>分钟</div>
		</div>
		<div class="grid-nav grid-money border-1px-tb">
			<div class="grid-money-title border-1px-b">
				商家服务
			</div>
			<div class="row no-gutter">
				<div class="col-20">
					<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $sid));?>" class="external">
						<i class="icon icon-takeout"></i>
						<span>点外卖</span>
					</a>
				</div>
				<?php  if($store['is_meal'] == 1) { ?>
					<div class="col-20">
						<a href="javascript:;" id="scanqrcode">
							<i class="icon icon-meal"></i>
							<span>堂食</span>
						</a>
					</div>
				<?php  } ?>
				<?php  if($store['is_reserve'] == 1) { ?>
					<div class="col-20">
						<a href="<?php  echo imurl('wmall/store/reserve', array('sid' => $sid));?>" class="external">
							<i class="icon icon-reserve"></i>
							<span>预定</span>
						</a>
					</div>
				<?php  } ?>
				<?php  if($store['is_assign'] == 1) { ?>
					<div class="col-20">
						<a href="<?php  echo imurl('wmall/store/assign', array('sid' => $sid));?>" class="external">
							<i class="icon icon-assign"></i>
							<span>排号</span>
						</a>
					</div>
				<?php  } ?>
				<?php  if($store['is_paybill'] == 1) { ?>
					<div class="col-20">
						<a href="<?php  echo imurl('wmall/store/paybill', array('sid' => $sid));?>" class="external">
							<i class="icon icon-signboard"></i>
							<span>买单</span>
						</a>
					</div>
				<?php  } ?>
			</div>
		</div>
		<?php  if(!empty($store['custom_url'])) { ?>
		<div class="list-block">
			<ul class="border-1px-tb">
				<?php  if(is_array($store['custom_url'])) { foreach($store['custom_url'] as $row) { ?>
				<li>
					<a href="<?php  echo $row['url'];?>" class="item-content item-link">
						<div class="item-inner border-1px-b">
							<div class="item-title">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/goods.png" alt="" />
								<?php  echo $row['title'];?>
							</div>
						</div>
					</a>
				</li>
				<?php  } } ?>
			</ul>
		</div>
		<?php  } ?>
		<div class="list-block">
			<ul class="border-1px-tb">
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/clock-grey.png" alt="" />
								<?php  echo $store['business_hours_cn'];?>
							</div>
						</div>
					</div>
				</li>
				<li>
					<a href="http://m.amap.com/?q=<?php  echo $store['location_x'];?>,<?php  echo $store['location_y'];?>&name=<?php  echo $store['address'];?>" class="item-content item-link">
						<div class="item-inner border-1px-b">
							<div class="item-title">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/location-grey.png" alt="" />
								<?php  echo $store['address'];?>
							</div>
						</div>
					</a>
				</li>
				<li>
					<a href="tel:<?php  echo $store['telephone'];?>" class="item-content item-link">
						<div class="item-inner border-1px-b">
							<div class="item-title">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/tel-grey.png" alt="" />
								<?php  echo $store['telephone'];?>
							</div>
						</div>
					</a>
				</li>
				<?php  if(!empty($store['sns']['qq'])) { ?>
				<li>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $store['sns']['qq'];?>&site=qq&menu=yes" class="item-content item-link">
						<div class="item-inner border-1px-b">
							<div class="item-title">
								<span><i class="icon icon-qq"></i></span>
								<?php  echo $store['sns']['qq'];?>
							</div>
						</div>
					</a>
				</li>
				<?php  } ?>
				<?php  if(!empty($store['sns']['weixin'])) { ?>
				<li>
					<a href="javascript:;" class="item-content item-link">
						<div class="item-inner border-1px-b">
							<div class="item-title">
								<span><i class="icon icon-weixin"></i></span>
								<?php  echo $store['sns']['weixin'];?>
							</div>
						</div>
					</a>
				</li>
				<?php  } ?>
				<?php  if(!empty($store['notice'])) { ?>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title text">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/voice-grey.png" alt="" />
								<?php  echo $store['notice'];?>
							</div>
						</div>
					</div>
				</li>
				<?php  } ?>
				<?php  if(!empty($store['description'])) { ?>
				<li>
					<a href="javascript:;" class="item-content item-link open-popup" data-popup=".popup-store-description">
						<div class="item-inner border-1px-b">
							<div class="item-title">
								<span><i class="icon icon-weixin"></i></span>
								门店特色
							</div>
						</div>
					</a>
				</li>
				<?php  } ?>
			</ul>
		</div>
		<div class="list-block">
			<ul class="border-1px-tb">
				<?php  if(is_array($activity['items'])) { foreach($activity['items'] as $row) { ?>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/<?php  echo $row['type'];?>_b.png" alt="" />
								<?php  echo $row['title'];?>
							</div>
						</div>
					</div>
				</li>
				<?php  } } ?>
				<?php  if($store['delivery_free_price'] > 0) { ?>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/mian_b.png" alt="" />
								下单满<?php  echo $store['delivery_free_price'];?>元免配送费
							</div>
						</div>
					</div>
				</li>
				<?php  } ?>
			</ul>
		</div>
		<div class="list-block">
			<ul class="border-1px-tb">
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/pay_b.png" alt="" />
								支持在线支付
							</div>
						</div>
					</div>
				</li>
				<?php  if($store['invoice_status'] == 1) { ?>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-t">
							<div class="item-title">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/invoice_b.png" alt="" />
								支持使用代金券抵付现金
							</div>
						</div>
					</div>
				</li>
				<?php  } ?>
			</ul>
		</div>
		<?php  if(!empty($store['qualification']) && !empty($store['qualification']['business']) || !empty($store['qualification']['service'])) { ?>
			<div class="list-block store-qualification">
				<div class="card border-1px-tb">
					<div class="card-header border-1px-b">资质证照</div>
					<div class="card-content">
						<div class="row">
							<?php  if(!empty($store['qualification']['business']['thumb'])) { ?>
								<div class="col-25 photoBrowser-image-item"><img src="<?php  echo tomedia($store['qualification']['business']['thumb']);?>" alt=""></div>
							<?php  } ?>
							<?php  if(!empty($store['qualification']['service']['thumb'])) { ?>
								<div class="col-25 photoBrowser-image-item"><img src="<?php  echo tomedia($store['qualification']['service']['thumb']);?>" alt=""></div>
							<?php  } ?>
						</div>
					</div>
				</div>
			</div>
		<?php  } ?>
		<div class="report border-1px-tb">
			<a href="<?php  echo imurl('wmall/store/report', array('sid' => $sid));?>">举报商家</a>
		</div>
	</div>
</div>

<div class="popup popup-store-description">
	<div class="page">
		<header class="bar bar-nav common-bar-nav">
			<h1 class="title">门店特色</h1>
			<button class="button button-link button-nav pull-right close-popup">关闭</button>
		</header>
		<div class="content" style="background: #FFF">
			<div class="content-padded">
				<?php  echo $store['description'];?>
			</div>
		</div>
	</div>
</div>
<script>
require(['store', 'member'], function(store, member){
	store.initIndex();
	member.initFavorite();
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>