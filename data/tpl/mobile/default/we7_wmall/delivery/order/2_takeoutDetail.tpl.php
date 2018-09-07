<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page order-info" id="page-delivery-order">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon icon icon-arrow-left pull-left external" href="<?php  echo imurl('delivery/order/takeout')?>"></a>
		<h1 class="title"><?php  echo $store['title'];?></h1>
		<a class="icon tel pull-right external" href="tel:<?php  echo $store['telephone'];?>"></a>
	</header>
	<?php  if($order['delivery_status'] == 4) { ?>
		<nav class="bar bar-tab footer-bar">
			<a class="tab-item order-print" href="tel:<?php  echo $order['mobile'];?>">
				<span class="tab-label">呼叫顾客</span>
			</a>
			<a class="tab-item js-post" href="<?php  echo imurl('delivery/order/takeout/notice', array('id' => $order['id']));?>" data-confirm="确定通知下单人你已到达送餐地址吗?">
				<span class="tab-label">微信通知</span>
			</a>
			<?php  if($order['deliveryer_transfer_status'] == 1) { ?>
				<a class="tab-item js-modal" href="<?php  echo imurl('delivery/order/takeout/op', array('type' => 'transfer', 'id' => $order['id']));?>">
					<span class="tab-label">申请转单</span>
				</a>
			<?php  } ?>
			<a class="tab-item js-post" href="<?php  echo imurl('delivery/order/takeout/success', array('id' => $order['id']));?>" data-confirm="<?php  if($order['pay_type'] == 'delivery' && $order['delivery_type'] == 2) { ?>'本单属于货到付款单,请收取顾客<?php  echo $order['final_fee'];?>元<?php  } else { ?>确认已将该订单送达?<?php  } ?>">
				<span class="tab-label">确认送达</span>
			</a>
		</nav>
	<?php  } else if($order['delivery_status'] == 7) { ?>
		<nav class="bar bar-tab footer-bar">
			<a class="tab-item order-print" href="tel:<?php  echo $store['telephone'];?>">
				<span class="tab-label">呼叫商户</span>
			</a>
			<?php  if($order['deliveryer_transfer_status'] == 1) { ?>
				<a class="tab-item js-modal" href="<?php  echo imurl('delivery/order/takeout/op', array('type' => 'transfer', 'id' => $order['id']));?>">
					<span class="tab-label">申请转单</span>
				</a>
			<?php  } ?>
			<a class="tab-item js-post" href="<?php  echo imurl('delivery/order/takeout/instore', array('id' => $order['id']))?>" data-confirm="确定已到店?">
				<span class="tab-label">确认到店</span>
			</a>
		</nav>
	<?php  } ?>
	<div class="content">
		<div id="order-detail" class="tab active">
			<div class="order-state border-1px-tb">
				<div class="order-state-con">
					<div class="guide">
						<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service.png" alt="" />
					</div>
					<div class="order-state-detail">
						<div class="clearfix">订单<?php  echo $order_status[$order['status']]['text'];?><span class="pull-right date"><?php  echo date('H:i', $order['addtime']);?></span></div>
						<div class="tips clearfix"><?php  echo $log['note'];?></div>
					</div>
				</div>
			</div>
			<?php  if($_GPC['r'] == 'consume') { ?>
				<div class="content-block">
					<a href="<?php  echo imurl('delivery/order/takeout/success', array('id' => $order['id']));?>" class="button button-big button-fill button-success js-post">点我确定送达</a>
				</div>
			<?php  } else if($_GPC['r'] == 'collect') { ?>
				<div class="content-block">
					<a href="<?php  echo imurl('delivery/order/takeout/collect', array('id' => $order['id']))?>" class="button button-big button-fill button-danger js-post" data-confirm="<?php  if($order['delivery_type'] == 1) { ?>该订单是店内单, 确定接单吗?<?php  } else { ?>该订单是平台单, 配送完成后将获得<?php  echo $order['plateform_deliveryer_fee'];?>元配送费, 确定接单吗<?php  } ?>">我要接单</a>
				</div>
			<?php  } ?>
			<div class="content-block-title">门店信息</div>
			<div class="list-block other-info  border-1px-b" style="margin: 0">
				<ul class="border-1px-tb">
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">门店</div>
							<div class="item-after"><?php  echo $store['title'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">地址</div>
							<div class="item-after"><?php  echo $store['address'];?></div>
						</div>
					</li>
				</ul>
				<div class="table">
					<a href="tel:<?php  echo $store['telephone'];?>" class="table-cell external">呼叫商户</a>
					<a href="http://m.amap.com/?q=<?php  echo $store['location_x'];?>,<?php  echo $store['location_y'];?>&name=<?php  echo $store['address'];?>" class="table-cell external border-1px-l">导航</a>
				</div>
			</div>
			<div class="content-block-title">顾客信息</div>
			<div class="list-block other-info border-1px-b" style="margin: 0">
				<ul class="border-1px-tb">
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">姓名</div>
							<div class="item-after"><?php  echo $order['username'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">地址</div>
							<div class="item-after"><?php  echo $order['address'];?></div>
						</div>
					</li>
				</ul>
				<div class="table">
					<a href="tel:<?php  echo $order['mobile'];?>" class="table-cell external border-1px-r">呼叫顾客</a>
					<a href="<?php  echo imurl('delivery/order/takeout/notice', array('id' => $order['id']));?>" data-confirm="确定通知下单人你已到达送餐地址吗?" class="table-cell js-post  border-1px-r">微信通知</a>
					<a href="http://m.amap.com/?q=<?php  echo $order['location_x'];?>,<?php  echo $order['location_y'];?>&name=<?php  echo $order['address'];?>" class="table-cell btn-user-location" data-location-x="<?php  echo $order['location_x'];?>" data-location-y="<?php  echo $order['location_y'];?>">导航</a>
				</div>
			</div>
			<div class="content-block-title">订单明细</div>
			<div class="order-details">
				<div class="order-details-con border-1px-tb">
					<div class="store-info border-1px-b">
						<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $order['sid']));?>" class="external">
							<img src="<?php  echo tomedia($store['logo']);?>" alt="" />
							<span class="store-title"><?php  echo $store['title'];?></span>
							<span class="icon icon-arrow-right pull-right"></span>
						</a>
					</div>
					<div class="inner-con border-1px-b">
						<?php  if(is_array($goods)) { foreach($goods as $good) { ?>
							<div class="row no-gutter">
								<div class="col-55"><?php  echo $good['goods_title'];?></div>
								<div class="col-10 text-right color-muted">×<?php  echo $good['goods_num'];?></div>
								<div class="col-35 text-right color-black">
									<?php  if($good['bargain_id'] > 0) { ?>
										<span class="color-muted text-line-through">¥<?php  echo $good['goods_original_price'];?></span>
									<?php  } ?>
									￥<?php  echo $good['goods_price'];?>
								</div>
							</div>
						<?php  } } ?>
					</div>
					<div class="inner-con border-1px-b">
						<?php  if($order['box_price'] > 0) { ?>
							<div class="row no-gutter">
								<div class="col-80">餐盒费</div>
								<div class="col-20 text-right color-black">￥<?php  echo $order['box_price'];?></div>
							</div>
						<?php  } ?>
						<div class="row no-gutter">
							<div class="col-80">包装费</div>
							<div class="col-20 text-right color-black">￥<?php  echo $order['pack_fee'];?></div>
						</div>
						<div class="row no-gutter">
							<div class="col-80">配送费</div>
							<div class="col-20 text-right color-black">￥<?php  echo $order['delivery_fee'];?></div>
						</div>
						<?php  if($order['delivery_type'] == 2 && $order['pay_type'] == 'delivery') { ?>
						<div class="row no-gutter color-danger">
							<div class="col-80">本单需收取顾客</div>
							<div class="col-20 text-right color-black">￥<?php  echo $order['final_fee'];?></div>
						</div>
						<?php  } ?>
					</div>
					<?php  if(!empty($activityed)) { ?>
						<div class="inner-con border-1px-b">
							<?php  if(is_array($activityed)) { foreach($activityed as $row) { ?>
							<div class="row no-gutter">
								<div class="col-80 icon-before">
									<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/<?php  echo $row['icon'];?>" alt=""/>
									<?php  echo $row['name'];?>
								</div>
								<div class="col-20 text-right color-black"><?php  echo $row['note'];?></div>
							</div>
							<?php  } } ?>
						</div>
					<?php  } ?>
					<div class="inner-con">
						<div class="row no-gutter">
							<div class="col-60 color-muted">订单 <span class="color-black">￥<?php  echo $order['total_fee'];?></span> - 优惠<span class="color-black">￥<?php  echo $order['discount_fee'];?></span></div>
							<div class="col-20 text-right color-muted">总计</div>
							<div class="col-20 text-right color-black">￥<?php  echo $order['final_fee'];?></div>
						</div>
					</div>
				</div>
				<div class="order-pay-info <?php  echo $order['pay_type_class'];?>"></div>
			</div>
			<div class="content-block-title">其他信息</div>
			<div class="list-block other-info">
				<ul class="border-1px-tb">
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">配送方</div>
							<div class="item-after"><?php  echo $store['title'];?></div>
						</div>
					</li>
					<?php  if($order['deliveryer_id'] > 0) { ?>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">配送员</div>
							<div class="item-after"><?php  echo $_deliveryer['title'];?></div>
						</div>
					</li>
					<?php  } ?>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">订单号</div>
							<div class="item-after"><?php  echo $order['ordersn'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">配送方式</div>
							<div class="item-after"><?php  echo $order_types[$order['order_type']]['text'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">配送/自提时间</div>
							<div class="item-after"><?php  echo $order['delivery_day'];?>~<?php  echo $order['delivery_time'];?></div>
						</div>
					</li>
					<?php  if($order['order_type'] == 1) { ?>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">收货人</div>
								<div class="item-after"><?php  echo $order['username'];?><?php  echo $order['sex'];?></div>
							</div>
						</li>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">手机</div>
								<a class="item-after" href="tel:<?php  echo $order['mobile'];?>"><?php  echo $order['mobile'];?></a>
							</div>
						</li>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">配送地址</div>
								<div class="item-after"><?php  echo $order['address'];?></div>
							</div>
						</li>
					<?php  } ?>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">支付方式</div>
							<div class="item-after"><?php  echo $order['pay_type_cn'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">备注信息</div>
							<div class="item-after"><?php  if(empty($order['note'])) { ?>无<?php  } else { ?><?php  echo $order['note'];?><?php  } ?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">发票信息</div>
							<div class="item-after"><?php  if(empty($order['invoice'])) { ?>无<?php  } else { ?><?php  echo $order['invoice'];?><?php  } ?></div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$(document).on('click', '.btn-user-location', function(e){
		var location_x = $(this).data('location-x');
		var location_y = $(this).data('location-y');
		if(!location_x || !location_y) {
			$.toast('获取顾客位置失败');
			e.preventDefault();
			return false;
		}
	});
});
</script>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>