<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page errander-index">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">随意购</h1>
		<a class="pull-right" href="<?php  echo imurl('errander/order/list');?>">订单</a>
	</header>
	<?php  get_mall_menu()?>
	<div class="content">
		<div class="border-1px-t">
			<div class="comindex-main">
				<div class="com-map" id="com-map"></div>
				<?php  if(!empty($orders)) { ?>
					<div class="com-status">
						<div class="swiper-container" data-direction="vertical" data-space-between="100" data-autoplay="2000">
							<div class="swiper-wrapper">
								<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
									<div class="swiper-slide">
										<a href="<?php  echo imurl('errander/category/index', array('id' => $order['order_cid']));?>">
											<img src="<?php  echo tomedia($order['thumb']);?>">
											<?php  echo $order['anonymous_username'];?>购买了<?php  echo $order['goods_name'];?>
											<i class="icon icon-arrow-right"></i>
										</a>
									</div>
								<?php  } } ?>
							</div>
						</div>
					</div>
				<?php  } ?>
				<div class="com-cate">
					<p class="com-cate-title">平台共有<span class="color-danger"><?php  echo $delivery_num;?></span>位骑士为您服务</p>
					<ul class="com-cate-list">
						<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
							<li>
								<a href="<?php  echo imurl('errander/category/index', array('id' => $category['id']));?>">
									<div class="com-pic"><img src="<?php  echo tomedia($category['thumb']);?>" alt=""></div>
									<p><?php  echo $category['title'];?></p>
								</a>
							</li>
						<?php  } } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
require([we7_wmall.pluginStaticRoot + 'index.js'], function(index){
	index.init({
		map: {
			location_y: "<?php  echo $_config_plugin['map']['location_y'];?>",
			location_x: "<?php  echo $_config_plugin['map']['location_x'];?>"
		}
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>