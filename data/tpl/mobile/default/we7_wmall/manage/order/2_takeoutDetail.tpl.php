<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'detail' || $ta == 'consume') { ?>
<div class="page order-info">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon icon icon-arrow-left pull-left external" href="<?php  echo imurl('manage/order/takeout/list');?>"></a>
		<h1 class="title"><?php  echo $store['title'];?>(<?php  echo $order['order_type_cn'];?>)</h1>
		<a class="pull-right refresh" href="javascript:;">刷新</a>
	</header>
	<?php  if($order['status'] < 5) { ?>
		<nav class="bar bar-tab footer-bar">
			<?php  if($order['status'] == 1) { ?>
				<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'handle'))?>" class="tab-item js-post"  data-confirm="<?php  if($order['is_pay'] == 1) { ?>确定接单吗?<?php  } else { ?>该订单尚未支付，确定接单吗?<?php  } ?>"> 确认接单</a>
			<?php  } else if($order['status'] == 2 || $order['status'] == 3) { ?>
				<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'notify_deliveryer_collect'))?>" class="tab-item js-post"  data-confirm="确定通知配送员配送吗?"> 通知配送</a>
				<?php  if($store['delivery_mode'] == 1) { ?>
					<a href="javascript:;" class="tab-item order-delivery" data-id="<?php  echo $order['id'];?>"> 指定配送</a>
					<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'delivery_ing'))?>" class="tab-item js-post" data-confirm="确定设置为配送中吗?"> 设为配送中</a>
				<?php  } ?>
			<?php  } ?>
			<?php  if($order['is_remind'] == 1) { ?>
				<a href="javascript:;" class="tab-item order-remind" data-id="<?php  echo $order['id'];?>"> 回复</a>
			<?php  } ?>
			<a href="<?php  echo imurl('manage/order/takeout/cancel', array('id' => $order['id']))?>" class="tab-item js-modal"> 取消订单</a>
		</nav>
	<?php  } ?>
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
				</div>
				<?php  if($ta == 'consume') { ?>
					<div class="content-block">
						<a href="<?php  echo imurl('manage/order/takeout/consume_post', array('id' => $order['id']))?>" class="button button-big button-fill button-danger js-post">确定核销</a>
					</div>
				<?php  } ?>
				<div class="content-block-title">订单明细</div>
				<div class="order-details">
					<div class="order-details-con border-1px-tb">
						<div class="store-info border-1px-b">
							<a href="<?php  echo imurl('manage/goods/index',array('sid' => $order['sid']));?>" class="external">
								<img src="<?php  echo tomedia($store['logo']);?>" alt="" />
								<span class="store-title"><?php  echo $store['title'];?></span>
								<span class="icon icon-arrow-right pull-right"></span>
							</a>
						</div>
						<div class="inner-con border-1px-b">
							<?php  if(!empty($order['note'])) { ?>
								<div class="row order-note">
									<span class="color-danger">备注: </span><?php  echo $order['note'];?>
								</div>
							<?php  } ?>
							<?php  if(is_array($goods)) { foreach($goods as $good) { ?>
								<div class="row no-gutter">
									<?php  if($good['bargain_id'] > 0) { ?>
										<div class="col-55 icon-before">
											<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/zhe_b.png">
											<?php  echo $good['goods_title'];?>
										</div>
									<?php  } else { ?>
										<div class="col-55">
											<?php  echo $good['goods_title'];?>
										</div>
									<?php  } ?>
									<div class="col-10 text-right color-muted <?php  if($good['goods_num'] > 1) { ?>color-danger<?php  } ?>">×<?php  echo $good['goods_num'];?></div>
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
							<div class="row no-gutter">
								<div class="col-80">平台抽取佣金</div>
								<div class="col-20 text-right color-black">-￥<?php  echo $order['plateform_serve_fee'];?></div>
							</div>
							<div class="row no-gutter">
								<div class="col-80">平台配送费</div>
								<div class="col-20 text-right color-black">-￥<?php  echo $order['plateform_delivery_fee'];?></div>
							</div>
							<div class="row no-gutter">
								<div class="col-80">商户优惠活动</div>
								<div class="col-20 text-right color-black">-￥<?php  echo $order['store_discount_fee'];?></div>
							</div>
							<div class="row no-gutter">
								<div class="col-80">平台补贴</div>
								<div class="col-20 text-right color-black">+￥<?php  echo $order['plateform_discount_fee'];?></div>
							</div>
						</div>
						<div class="inner-con border-1px-b">
							<div class="row no-gutter">
								<div class="col-60 color-muted">顾客实际支付 <span class="color-black">￥<?php  echo $order['final_fee'];?></span></div>
								<div class="col-20 text-right color-muted">实际入账</div>
								<div class="col-20 text-right color-black">￥<?php  echo $order['store_final_fee'];?></div>
							</div>
						</div>
					</div>
					<?php  if(!empty($activityed)) { ?>
						<div class="content-block-title">优惠详情</div>
						<div class="list-block order-details-con">
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
						</div>
					<?php  } ?>
					<div class="order-pay-info <?php  echo $order['pay_type_class'];?>"></div>
				</div>
				<div class="content-block-title">其他信息</div>
				<div class="list-block other-info">
					<ul class="border-1px-tb">
						<?php  if($order['order_type'] <= 2) { ?>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">商户订单号</div>
									<div class="item-after"><?php  echo $order['serial_sn'];?></div>
								</div>
							</li>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">平台订单号</div>
									<div class="item-after"><?php  echo $order['ordersn'];?></div>
								</div>
							</li>
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
				</div>
				<?php  } } ?>
			</div>
			<div id="order-refund" class="tab">
				<div class="refund-detail">
					<div class="row no-gutter refund-de-title">
						<div class="col-60">退款金额<span class="color-danger">¥<?php  echo $refund['fee'];?></span></div>
						<div class="col-40"><span><?php  echo $refund['refund_status_cn'];?></span></div>
					</div>
					<div class="refund-detail-con">
						<div class="row no-gutter">订单编号:<span><?php  echo $order['ordersn'];?></span></div>
						<div class="row no-gutter">退款周期:<span>1-15个工作日</span></div>
						<div class="row no-gutter">支付方式:<span><?php  echo $order['pay_type_cn'];?></span></div>
						<?php  if(!empty($refund['refund_channel'])) { ?>
						<div class="row no-gutter">退款方式:<span><?php  echo $refund['refund_channel_cn'];?></span></div>
						<?php  } ?>
						<?php  if(!empty($refund['refund_account'])) { ?>
						<div class="row no-gutter">退款账户:<span><?php  echo $refund['refund_account'];?></span></div>
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
	</div>
</div>
<?php  } ?>
<!-- 选择配送员 -->
<div class="popup popup-delivery" id="popup-delivery">
	<div class="page">
		<header class="bar bar-nav common-bar-nav">
			<h1 class="title">分配配送员</h1>
			<a class="pull-right close-popup" href="javascript:;">关闭</a>
		</header>
		<div class="content">
			<?php  if(!empty($deliveryers)) { ?>
			<div class="list-block">
				<ul>
					<?php  if(is_array($deliveryers)) { foreach($deliveryers as $deliveryer) { ?>
					<li>
						<label class="label-checkbox item-content">
							<input type="radio" name="deliveryer_id" value="<?php  echo $deliveryer['deliveryer']['id'];?>" checked>
							<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
							<div class="item-inner">
								<div class="item-title"><?php  echo $deliveryer['deliveryer']['title'];?></div>
								<div class="item-after"><?php  echo $deliveryer['deliveryer']['mobile'];?></div>
							</div>
						</label>
					</li>
					<?php  } } ?>
				</ul>
			</div>
			<div class="content-padded">
				<a href="javascript:;" class="button button-big button-fill button-danger">确定</a>
			</div>
			<?php  } else { ?>
				<h3 class="align-center">您还没有添加配送员</h3>
			<?php  } ?>
		</div>
	</div>
</div>
<!-- 回复催单 -->
<div class="popup popup-order-remind" id="popup-order-remind">
	<div class="page">
		<header class="bar bar-nav common-bar-nav">
			<h1 class="title">回复催单</h1>
			<a class="pull-right close-popup" href="javascript:;">关闭</a>
		</header>
		<div class="content">
			<div class="content-block-title">选择回复</div>
			<div class="list-block media-list">
				<ul>
					<?php  if(is_array($store['remind_reply'])) { foreach($store['remind_reply'] as $reply) { ?>
						<li>
							<label class="label-checkbox item-content">
								<input type="radio" name="" value="">
								<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
								<div class="item-inner">
									<div class="item-text"><?php  echo $reply;?></div>
								</div>
							</label>
						</li>
					<?php  } } ?>
				</ul>
			</div>
			<div class="content-block-title">自定义回复</div>
			<div class="list-block">
				<ul>
					<li class="align-top">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-input">
									<textarea name="reply" id="reply" placeholder="输入回复内容"></textarea>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="content-padded">
				<a href="javascript:;" class="button button-big button-fill button-danger">确定</a>
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		$(document).on("click", ".order-delivery", function() {
			var id = $(this).data('id');
			if(!id) {
				return false;
			}
			$.popup('.popup-delivery');
			$('#popup-delivery .button-danger').unbind().click(function(){
				var $this = $(this);
				if($this.hasClass('disabled')) {
					return false;
				}
				var deliveryer_id = $('#popup-delivery :radio[name="deliveryer_id"]:checked').val();
				$this.html('处理中...');
				$this.addClass('disabled');
				$.post("<?php  echo imurl('manage/order/takeout/deliveryer')?>", {id: id, deliveryer_id: deliveryer_id}, function(data){
					var result = $.parseJSON(data);
					if(result.message.errno != 0) {
						$.toast(result.message.message);
					} else {
						$.toast('分配配送员成功');
					}
					$this.html('确定');
					$this.removeClass('disabled');
				});
			});
		});

		$(document).on("click", ".order-remind", function() {
			var id = $(this).data('id');
			if(!id) {
				return false;
			}
			$('#popup-order-remind .label-checkbox').unbind().click(function(){
				var reply = $(this).find('.item-text').html();
				$('#popup-order-remind :radio').prop('checked', false);
				$(this).find(':radio').prop('checked', true);
				$('#reply').val(reply);
			});
			$.popup('.popup-order-remind');

			$('#popup-order-remind .button-danger').unbind().click(function(){
				var $this = $(this);
				if($this.hasClass('disabled')) {
					return false;
				}
				var reply = $('#reply').val();
				if(!reply) {
					$.toast('没有设置回复内容');
					return false;
				}
				$this.addClass('disabled');
				$.post("<?php  echo imurl('manage/order/takeout/reply')?>", {id: id, reply: reply}, function(data){
					var result = $.parseJSON(data);
					if(result.message.errno != 0) {
						$this.removeClass('disabled');
						$.toast(result.message.message);
						return false;
					}
					$.toast('回复催单成功', location.href, 1500);
				});
			});
		});
	})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>