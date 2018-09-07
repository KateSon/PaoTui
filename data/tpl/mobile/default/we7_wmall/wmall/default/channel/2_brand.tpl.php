<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page brand">
	<header class="bar bar-nav bar-new border-1px-b">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">为您优选</h1>
	</header>
	<div class="content">
		<?php  if($ta == 'list') { ?>
			<div class="banner">
				<a href=""><img src="http://xs01.meituan.net/waimai_i/img/activity/brand/banner.30c77576.jpg" alt=""></a>
			</div>
			<div class="brand-wall border-1px-tb row clearfix">
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<?php  $j++;?>
					<?php  if($j <= 7) { ?>
						<div class="brand-item col-25 border-1px-r">
							<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $store['id']));?>" <?php  if(count($stores) > 4 && $j <= 4) { ?>class="border-1px-b"<?php  } ?>><img src="<?php  echo tomedia($store['logo'])?>" alt=""></a>
						</div>
					<?php  } else if($j == 8) { ?>
						<div class="brand-item col-25">
							<a href="<?php  echo imurl('wmall/channel/brand/more');?>"><span class="more">查看更多<br><?php  echo count($stores);?></span></a>
						</div>
					<?php  } ?>
				<?php  } } ?>
			</div>
			<div class="brand-near">
				<div class="brand-title">
					附近品牌商家
				</div>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
				<div class="store-list">
					<div class="store-info border-1px-tb">
						<div class="store-info-left pull-left">
							<a href="<?php  echo imurl('wmall/store/goods', array('op'=> 'index', 'sid' => $store['id']));?>"><img src="<?php  echo tomedia($store['logo']);?>" alt=""></a>
						</div>
						<div class="store-info-right pull-left">
							<div class="item-name">
								<span><?php  echo $store['title'];?></span>
							</div>
							<div class="item-min-delivery">
								<span>起送价<span class="item-min-price">￥<?php  echo $store['send_price'];?></span></span>
								<span class="devide-span">|</span>
								<span>配送费<span class="item-min-price">￥<?php  echo $store['delivery_price'];?></span></span>
								<button class="item-btn"><a href="<?php  echo imurl('wmall/store/goods', array('op'=> 'index', 'sid' => $store['id']));?>">进店</a></button>
							</div>
							<?php  if(!empty($store['activity']['items']['discount'])) { ?>
								<div class="item-discount discount">
									<?php  echo $store['activity']['items']['discount']['title'];?>
								</div>
							<?php  } ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php  if(!empty($store['goods'])) { ?>
						<div class="goods">
							<div class="goods-list border-1px-b">
								<?php  if(is_array($store['goods'])) { foreach($store['goods'] as $good) { ?>
									<?php  $i++;?>
									<div class="goods-item <?php  if($i > 1) { ?>border-1px-l<?php  } ?> pull-left">
										<div class="goods-pic">
											<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $store['id'], 'goods_id' => $good['id']));?>"><img src="<?php  echo tomedia($good['thumb']);?>" alt=""></a>
										</div>
										<div class="goods-name"><?php  echo $good['title'];?></div>
										<div class="goods-price"><span>¥<?php  echo $good['price'];?></span></div>
									</div>
								<?php  } } ?>
								<div class="clearfix"></div>
							</div>
						</div>
					<?php  } ?>
				</div>
				<?php  } } ?>
			</div>
		<?php  } else if($ta == 'more') { ?>
			<div class="brand-warp border-1px-b row">
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<?php  $m++;?>
					<div class="more-item col-33 <?php  if($m % 3 != 0) { ?>border-1px-r<?php  } ?>">
						<div class="border-1px-b ">
							<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $store['id']));?>"><img src="<?php  echo tomedia($store['logo'])?>" alt=""></a>
						</div>
					</div>
				<?php  } } ?>
				<div class="clearfix"></div>
				<p class="no-more">没有更多了~</p>
			</div>
		<?php  } ?>
	</div>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>