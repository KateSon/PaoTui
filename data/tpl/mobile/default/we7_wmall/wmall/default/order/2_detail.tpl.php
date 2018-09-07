<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page order-info">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title"><?php  echo $store['title'];?>(<?php  echo $order['order_type_cn'];?>)</h1>
		<a class="icon tel pull-right external" href="tel:<?php  echo $store['telephone'];?>"></a>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="buttons-tab">
			<a href="#order-detail" class="tab-link active button">订单详情</a>
			<a href="#order-status" class="tab-link button">订单状态</a>
			<?php  if($order['refund_status'] > 0) { ?>
				<a href="#order-refund" class="tab-link button">退款详情</a>
			<?php  } ?>
		</div>
		<div class="tabs">
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
					<div class="table border-1px-t">
						<?php  if(!$order['is_pay'] && !in_array($order['status'], array(5, 6))) { ?>
							<a href="<?php  echo imurl('system/paycenter/pay', array('id' => $order['id'], 'order_type' => 'takeout', 'type' => 1));?>" class="table-cell border-1px-r">立即支付</a>
						<?php  } ?>
						<?php  if($order['status'] == 1) { ?>
							<a href="<?php  echo imurl('wmall/order/index/cancel', array('id' => $order['id']));?>" class="table-cell js-post" data-confirm="确定取消该订单吗">取消订单</a>
							<?php  if($order['is_pay'] == 1) { ?>
								<a href="<?php  echo imurl('wmall/order/index/remind', array('id' => $order['id']));?>" class="table-cell border-1px-l js-post">催单</a>
							<?php  } ?>
						<?php  } else if(in_array($order['status'], array(2, 3, 4))) { ?>
							<?php  if($order['order_type'] == 1) { ?>
								<?php  if($order['status'] == 4) { ?>
									<a href="<?php  echo imurl('wmall/order/index/end', array('id' => $order['id']));?>" class="table-cell border-1px-r js-post" data-confirm="你确定收到该商家的外卖?">确认送达</a>
								<?php  } ?>
								<a href="<?php  echo imurl('wmall/order/index/remind', array('id' => $order['id']));?>" class="table-cell border-1px-r js-post">催单</a>
								<a href="javascript:;" class="table-cell js-open-modal" data-modal=".deliveryer-qrcode">配送核销</a>
							<?php  } else if($order['order_type'] == 2) { ?>
								<a href="<?php  echo imurl('wmall/order/index/end', array('id' => $order['id']));?>" class="table-cell border-1px-r js-post" data-confirm="确认已到店自提?">我已取货</a>
								<a href="javascript:;" class="table-cell js-open-modal" data-modal=".clerk-qrcode">店员核销</a>
							<?php  } ?>
						<?php  } else if(in_array($order['status'], array(5))) { ?>
							<a href="<?php  echo imurl('wmall/store/goods', array('f' => '1', 'id' => $order['id'], 'sid' => $order['sid']));?>" class="table-cell border-1px-r" data-id="<?php  echo $order['id'];?>">再来一单</a>
							<?php  if(!$order['is_comment']) { ?>
								<a href="<?php  echo imurl('wmall/order/comment', array('id' => $order['id']));?>" class="table-cell"><?php  echo $order['comment_cn'];?></a>
							<?php  } else { ?>
								<a href="<?php  echo imurl('wmall/member/comment');?>" class="table-cell">查看评价</a>
							<?php  } ?>
						<?php  } else if(in_array($order['status'], array(6))) { ?>
							<a href="<?php  echo imurl('wmall/store/goods', array('f' => '1', 'id' => $order['id'], 'sid' => $order['sid']));?>" class="table-cell external" data-id="<?php  echo $order['id'];?>">再来一单</a>
						<?php  } ?>
					</div>
				</div>
				<div class="content-block-title">订单明细</div>
				<div class="order-details">
					<div class="order-details-con border-1px-t">
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
									<?php  if($good['bargain_id'] > 0) { ?>
										<div class="col-55 icon-before">
											<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/bargain_b.png">
											<?php  echo $good['goods_title'];?>
										</div>
									<?php  } else { ?>
										<div class="col-55">
											<?php  echo $good['goods_title'];?>
										</div>
									<?php  } ?>
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
							<?php  if($order['order_type'] == 3) { ?>
								<div class="row no-gutter">
									<div class="col-80">服务费</div>
									<div class="col-20 text-right color-black">￥<?php  echo $order['serve_fee'];?></div>
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
					<?php  if($order['order_type'] < 3) { ?>
						<div class="table border-1px-t">
							<div class="table-cell">
								<a href="<?php  echo imurl('wmall/store/goods', array('f' => '1', 'id' => $order['id'], 'sid' => $order['sid']));?>" class="color-danger external">再来一单</a>
							</div>
						</div>
					<?php  } ?>
				</div>
				<div class="content-block-title">其他信息</div>
				<div class="list-block other-info">
					<ul class="border-1px-tb">
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">订单号</div>
								<div class="item-after"><?php  echo $order['ordersn'];?></div>
							</div>
						</li>
						<?php  if($order['order_type'] <= 2) { ?>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">收货码</div>
									<div class="item-after"><?php  echo $order['code'];?></div>
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
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">下单人</div>
									<div class="item-after"><?php  echo $order['username'];?><?php  echo $order['sex'];?></div>
								</div>
							</li>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">手机</div>
									<a class="item-after" href="tel:<?php  echo $order['mobile'];?>"><?php  echo $order['mobile'];?></a>
								</div>
							</li>
							<?php  if($order['order_type'] == 1) { ?>
								<li class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title">配送地址</div>
										<div class="item-after"><?php  echo $order['address'];?></div>
									</div>
								</li>
							<?php  } else if($order['order_type'] == 2) { ?>
								<li class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title">自提地址</div>
										<div class="item-after">
											<a href="http://m.amap.com/?q=<?php  echo $store['location_x'];?>,<?php  echo $store['location_y'];?>&name=<?php  echo $store['address'];?>" class="item-link">
												<?php  echo $store['address'];?>
											</a>
										</div>
									</div>
								</li>
							<?php  } ?>
						<?php  } ?>
						<?php  if($order['order_type'] == 3) { ?>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">桌台号</div>
									<div class="item-after"><?php  echo $order['table']['title'];?>号桌</div>
								</div>
							</li>
						<?php  } ?>
						<?php  if($order['order_type'] == 4) { ?>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">预定时间</div>
									<div class="item-after"><?php  echo $order['reserve_time'];?></div>
								</div>
							</li>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">桌台</div>
									<div class="item-after"><?php  echo $order['table_cid_cn']['title'];?></div>
								</div>
							</li>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">预定类型</div>
									<div class="item-after"><?php  echo $order['reserve_type_cn'];?></div>
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
			<div id="order-status" class="tab">
				<?php  if(is_array($logs)) { foreach($logs as $key => $log) { ?>
					<div class="order-status-item">
						<div class="guide">
							<?php  if($maxid != $key) { ?>
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service_grey.png" alt="" />
							<?php  } else { ?>
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service.png" alt="" />
							<?php  } ?>
						</div>
						<div class="order-status-info">
							<div class="arrow-left"></div>
							<div class="clearfix"><?php  echo $log['title'];?> <span class="time pull-right"><?php  echo date('H:i', $log['addtime'])?></span></div>
							<div class="tips"><?php  echo $log['note'];?></div>
						</div>
						<?php  if($order['delivery_handle_type'] == 'app' && $log['type'] == 'delivery_instore') { ?>
							<div id="map" class="map-info border-1px" style="height: 160px; background: #FFF; margin-top: -1em; z-index: 10000"></div>
						<?php  } ?>
					</div>
				<?php  } } ?>
			</div>
			<div id="order-refund" class="tab">
				<div class="refund-detail">
					<div class="row no-gutter refund-de-title">
						<div class="col-60">退款金额<span class="color-danger">¥<?php  echo $refund['fee'];?></span></div>
						<div class="col-40"><span><?php  echo $refund['status_cn'];?></span></div>
					</div>
					<div class="refund-detail-con">
						<div class="row no-gutter">订单编号:<span><?php  echo $order['ordersn'];?></span></div>
						<div class="row no-gutter">退款周期:<span>1-15个工作日</span></div>
						<div class="row no-gutter">支付方式:<span><?php  echo $order['pay_type_cn'];?></span></div>
						<?php  if(!empty($refund['channel'])) { ?>
						<div class="row no-gutter">退款方式:<span><?php  echo $refund['channel_cn'];?></span></div>
						<?php  } ?>
						<?php  if(!empty($refund['account'])) { ?>
						<div class="row no-gutter">退款账户:<span><?php  echo $refund['account'];?></span></div>
						<?php  } ?>
					</div>
				</div>
				<div class="refund-plan">
					<?php  if(is_array($refund_logs)) { foreach($refund_logs as $key => $log) { ?>
						<div class="order-refund-item">
							<div class="guide">
								<?php  if($refundmaxid != $key) { ?>
									<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service_grey.png" alt="" />
								<?php  } else { ?>
									<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service.png" alt="" />
								<?php  } ?>
							</div>
							<div class="order-refund-info">
								<div class="arrow-left"></div>
								<div class="clearfix"><?php  echo $log['title'];?> <span class="time pull-right"><?php  echo date('H:i', $log['addtime'])?></span></div>
								<div class="tips"><?php  echo $log['note'];?></div>
							</div>
						</div>
					<?php  } } ?>
				</div>
			</div>
		</div>
		<?php  if($share_button > 0) { ?>
			<div class="share-button js-open-modal" data-modal=".modal-share">
				<div class="share-inner">
					<span class="icon icon-share"></span>
				</div>
			</div>
		<?php  } ?>
		<div class="zhezhao close-zhezhao" <?php  if($_GPC['f'] == 1) { ?>style="display: block"<?php  } ?>>
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/share-layer.png" alt="">
		</div>
		<?php  if($superRedpacket_share_status == 1) { ?>
			<div class="send-redpacket js-open-modal" data-modal=".modal-superRedpacket-share"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/send-redpacket.png" alt=""/></div>
		<?php  } ?>
	</div>
</div>
<div class="popup popup-order-map-info">
	<div class="page">
		<header>
			<a class="pull-left btn-close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<a class="pull-right btn-refresh"><i class="icon icon-refresh"></i></a>
		</header>
		<nav>
			<a class="pull-right btn-info" href="javascript:;"><i class="icon icon-question"></i></a>
		</nav>
		<div class="content">
			<div class="map-current" id="map-current" style="height: 100%">
			</div>
		</div>
	</div>
</div>
<div class="modal modal-no-buttons modal-qrcode deliveryer-qrcode">
	<div class="modal-inner">
		<div class="modal-title">
			<div>配送员核销二维码</div>
		</div>
		<div class="modal-text">
			<div class="qrcode">
				<img src="<?php  echo url('utility/wxcode/qrcode', array('text' => imurl('delivery/order/takeout/detail', array('id' => $order['id'], 'r' => 'consume', 'code' => $order['code']), true)));?>" alt=""/>
			</div>
			<div class="text-center color-danger">请将此二维码展示给配送员</div>
		</div>
	</div>
</div>
<div class="modal modal-no-buttons modal-qrcode clerk-qrcode">
	<div class="modal-inner">
		<div class="modal-title">
			<div>店员核销二维码</div>
		</div>
		<div class="modal-text">
			<div class="qrcode">
				<img src="<?php  echo url('utility/wxcode/qrcode', array('text' => imurl('manage/order/takeout/consume', array('id' => $order['id'], 'code' => $order['code']), true)));?>" alt=""/>
			</div>
			<div class="text-center color-danger">请将此二维码展示给店员</div>
		</div>
	</div>
</div>
<div class="modal modal-no-buttons modal-notice modal-share">
	<div class="modal-inner">
		<div class="modal-title">
			<div>分享规则</div>
		</div>
		<div class="modal-text">
			<div class="notice">
				1. 顾客在订单完成后<?php  echo $share['share_grant_days_limit'];?>天之内，对订单进行评价并分享到朋友圈即可获取<?php  echo $share['share_grant'];?><?php  echo $share['grantType_cn'];?><br>
				2. 每人通过分享订单最多可获取<?php  echo $share['share_grant_max'];?><?php  echo $share['grantType_cn'];?>，超出后将不再奖励
			</div>
			<?php  if($share_button == 1) { ?>
				<a href="<?php  echo imurl('wmall/order/comment', array('id' => $order['id']));?>" class="button button-big button-fill button-danger close-modal">现在去评价</a>
			<?php  } else if($share_button == 2) { ?>
				<a href="javascript:;" class="button button-big button-fill button-danger open-zhezhao js-close-modal" data-modal=".modal-share">您已评价,去分享</a>
			<?php  } ?>
		</div>
	</div>
</div>
<div class="modal modal-superRedpacket-share">
	<div class="modal-inner border-1px-b">
		<div class="modal-text">
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/wv.png" alt=""/>
			<div class="get_repackets_nums">恭喜获得<?php  echo $superRedpacket['packet_total'];?>个红包</div>
			<div class="go-to-share">分享给小伙伴，大家一起抢。</div>
		</div>
	</div>
	<div class="modal-buttons">
		<div class="modal-button border-1px-r js-close-modal" data-modal=".modal-superRedpacket-share">取消</div>
		<div class="modal-button grant js-close-modal open-zhezhao" data-modal=".modal-superRedpacket-share">发红包</div>
	</div>
</div>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.3&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
	require(['order'], function(order){
		order.initDetail({
			order: {
				id: "<?php  echo $order['id'];?>",
				status: "<?php  echo $order['status'];?>",
				delivery_handle_type: "<?php  echo $order['delivery_handle_type'];?>",
				deliveryer_id: "<?php  echo $order['deliveryer_id'];?>",
				location_x: "<?php  echo $order['location_x'];?>",
				location_y: "<?php  echo $order['location_y'];?>",
				delivery_success_location_y: "<?php  echo $order['delivery_success_location_y'];?>",
				delivery_success_location_x: "<?php  echo $order['delivery_success_location_x'];?>",
				orderGrant_share: "<?php  echo $share_button;?>"
			},
			store: {
				id: "<?php  echo $store['id'];?>",
				location_x: "<?php  echo $store['location_x'];?>",
				location_y: "<?php  echo $store['location_y'];?>",
				logo: "<?php  echo $store['logo'];?>",
			},
			deliveryer: {
				id: "<?php  echo $deliveryer['id'];?>",
				avatar: "<?php  echo $deliveryer['avatar'];?>",
				location_x: "<?php  echo $deliveryer['location_x'];?>",
				location_y: "<?php  echo $deliveryer['location_y'];?>",
			}
		});
	});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>