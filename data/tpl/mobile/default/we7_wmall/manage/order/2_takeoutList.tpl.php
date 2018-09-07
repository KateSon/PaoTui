<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page" id="page-manage-order">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back"></a>
		<h1 class="title">订单管理</h1>
		<a class="icon pull-right icon icon-refresh refresh"></a>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('manage/order/takeout/more', array('status' => $status))?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".order-list-container" data-tpl="tpl-order">
		<div class="buttons-tab">
			<a href="<?php  echo imurl('manage/order/takeout/list', array('status' => 1));?>" class="button <?php  if($status == 1) { ?>active<?php  } ?>">待确认</a>
			<a href="<?php  echo imurl('manage/order/takeout/list', array('status' => 2));?>" class="button <?php  if($status == 2) { ?>active<?php  } ?>">处理中</a>
			<a href="<?php  echo imurl('manage/order/takeout/list', array('status' => 3));?>" class="button <?php  if($status == 3) { ?>active<?php  } ?>">待配送</a>
			<a href="<?php  echo imurl('manage/order/takeout/list', array('status' => 4));?>" class="button <?php  if($status == 4) { ?>active<?php  } ?>">配送中</a>
			<a href="javascript:;" class="button <?php  if(in_array($status, array(5, 6, 0))) { ?>active<?php  } ?> open-popover" data-popover=".popover-order-status"><?php  if(in_array($status, array(5, 6, 0))) { ?><?php  echo $order_status[$status]['text'];?><?php  } else { ?>更多<?php  } ?> <i class="icon icon-arrow-down"></i></a>
		</div>
		<?php  if(empty($orders)) { ?>
			<div class="no-data">
				<div class="bg"></div>
				<p>没有任何订单哦～</p>
			</div>
		<?php  } else { ?>
		<div class="order-list">
			<ul class="order-list-container">
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
					<li class="border-1px-tb">
						<a class="order-ls-info" href="<?php  echo imurl('manage/order/takeout/detail', array('id' => $order['id']));?>">
							<div class="order-ls-tl">编号: <b class="order-serial-sn">#<?php  echo $order['serial_sn'];?></b><span class="<?php  echo $order_status[$order['status']]['color'];?>"><?php  echo $order_status[$order['status']]['text'];?></span></div>
							<div class="order-ls-date"><?php  echo date('Y-m-d H:i:s', $order['addtime']);?><span>下单人:<?php  echo $order['username'];?></span></div>
							<div class="order-ls-dl border-1px-tb">
								<?php  if(!empty($order['note'])) { ?>
								<div class="row order-note">
									<span class="color-danger">备注:</span><?php  echo $order['note'];?>
								</div>
								<?php  } ?>
								<?php  if(is_array($order['goods'])) { foreach($order['goods'] as $good) { ?>
									<div class="row">
										<div class="col-60"><?php  echo $good['goods_title'];?></div>
										<div class="col-10 align-right <?php  if($good['goods_num'] > 1) { ?>color-danger<?php  } ?>">X <?php  echo $good['goods_num'];?></div>
										<div class="col-30 align-right">
											<?php  if($good['bargain_id'] > 0) { ?>
												<span class="color-muted text-line-through">¥<?php  echo $good['goods_original_price'];?></span>
											<?php  } ?>
											¥<?php  echo $good['goods_price'];?>
										</div>
									</div>
								<?php  } } ?>
							</div>
							<div class="order-ls-sum">
								共<?php  echo $order['num'];?>件,最终入账:¥<?php  echo $order['store_final_fee'];?>
								<?php  if($order['order_plateform'] == 'eleme') { ?>
									<span class="color-danger">(饿了么入账¥<?php  echo $order['eleme_store_final_fee'];?>)</span>
								<?php  } ?>
								<span class="color-danger">(顾客支付¥<?php  echo $order['final_fee'];?>)</span>
							</div>
						</a>
						<div class="order-pay-info <?php  echo $order['pay_type_class'];?>"></div>
						<div class="order-ls-btn border-1px-t">
							<?php  if($order['status'] < 5) { ?>
								<?php  if($order['status'] == 1) { ?>
									<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'handle'))?>" data-confirm="<?php  if($order['is_pay'] == 1) { ?>确定接单吗?<?php  } else { ?>该订单尚未支付，确定接单吗?<?php  } ?>" class="js-post border-1px-r"><i class="icon icon-selected"></i> 确认接单</a>
									<a href="<?php  echo imurl('manage/order/takeout/cancel', array('id' => $order['id']))?>" class="js-modal">取消订单</a>
								<?php  } else if($order['status'] == 2 || $order['status'] == 3) { ?>
									<?php  if($order['order_type'] == 1) { ?>
										<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'notify_deliveryer_collect'))?>" data-confirm="确定通知配送员配送吗?" class="js-post border-1px-r"><i class="icon icon-selected"></i> 通知配送员配送</a>
										<?php  if($store['delivery_mode'] == 1) { ?>
											<a href="javascript:;" class="order-delivery border-1px-r" data-id="<?php  echo $order['id'];?>"><i class="icon icon-selected"></i> 指定配送员配送</a>
											<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'delivery_ing'))?>" class="js-post" data-confirm="确定设置为配送中吗?"><i class="icon icon-selected"></i> 设为配送中</a>
										<?php  } ?>
									<?php  } else if($order['order_type'] == 2) { ?>
										<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'end'))?>" class="js-post" data-confirm="顾客已自提?"><i class="icon icon-selected"></i> 顾客已自提</a>
									<?php  } else if($order['order_type'] >= 3) { ?>
										<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'end'))?>" class="js-post" data-confirm="确定该订单已完成?"><i class="icon icon-selected"></i> 订单完成</a>
									<?php  } ?>
								<?php  } else if($order['status'] == 4) { ?>
									<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'end'))?>" class="js-post" data-confirm="确定该订单已完成?"><i class="icon icon-selected"></i> 订单完成</a>
								<?php  } ?>
							<?php  } ?>
						</div>
					</li>
				<?php  } } ?>
			</ul>
			<div class="infinite-scroll-preloader hide">
				<div class="preloader"></div>
			</div>
		</div>
		<?php  } ?>
	</div>
</div>
<div class="popover popover-manage popover-order-status">
	<div class="popover-angle"></div>
	<div class="popover-inner">
		<div class="list-block">
			<ul>
				<li><a href="<?php  echo imurl('manage/order/takeout/list', array('status' => 5));?>" class="list-button item-link">已完成</a></li>
				<li><a href="<?php  echo imurl('manage/order/takeout/list', array('status' => 6));?>" class="list-button item-link">已取消</a></li>
				<li><a href="<?php  echo imurl('manage/order/takeout/list', array('status' => 0));?>" class="list-button item-link">所有</a></li>
				<li><a href="javascript:;" class="list-button item-link close-popover">关闭</a></li>
			</ul>
		</div>
	</div>
</div>
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
				<ul class="border-1px-tb">
					<?php  if(is_array($deliveryers)) { foreach($deliveryers as $deliveryer) { ?>
					<li>
						<label class="label-checkbox item-content border-1px-b">
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
			<div class="content-block">
				<a href="javascript:;" class="button button-big button-fill button-danger">确定</a>
			</div>
			<?php  } else { ?>
				<h3 class="align-center">您还没有添加配送员</h3>
			<?php  } ?>
		</div>
	</div>
</div>

<script id="tpl-order" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li class="border-1px-tb">
		<a class="order-ls-info" href="<?php  echo imurl('manage/order/takeout/detail');?>&id=<{d[i].id}>">
			<div class="order-ls-tl">编号: <b class="order-serial-sn">#<{d[i].serial_sn}></b><span class="<{d[i].status_color}>"><{d[i].status_cn}></span></div>
			<div class="order-ls-date"><{d[i].addtime_cn}><span>下单人:<{d[i].username}></span></div>
			<div class="order-ls-dl border-1px-tb">
				<{# if(d[i].note){ }>
					<div class="row order-note">
						<span class="color-danger">备注:</span><{d[i].note}>
					</div>
				<{# } }>
				<{# for(var j = 0, lenj = d[i].goods.length; j < lenj; j++){ }>
					<div class="row">
						<div class="col-60"><{d[i].goods[j].goods_title}></div>
						<div class="col-20 align-right <{# if(d[i].goods[j].goods_num > 0){ }>color-danger<{# } }>">X <{d[i].goods[j].goods_num}></div>
						<div class="col-20 align-right">¥<{d[i].goods[j].goods_price}></div>
					</div>
				<{# } }>
			</div>
			<div class="order-ls-sum">
				共<{d[i].num}>件，实际入账：¥<{d[i].store_final_fee}>
				<span class="color-danger">(顾客实际支付<{d[i].final_fee}>)</span>
				<span class="pull-right color-primary order-ls-dist hide" data-lat="<{d[i].location_x}>" data-lng="<{d[i].location_y}>"></span>
			</div>
		</a>
		<div class="order-pay-info <{d[i].pay_type_class}>"></div>
		<div class="order-ls-btn border-1px-t">
			<{# if(d[i].status < 5){ }>
				<{# if(d[i].status == 1){ }>
					<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'handle'))?>&id=<{d[i].id}>}" data-confirm="<{# if(d[i].is_pay == 1){ }>确定接单吗?<{# } else { }>该订单尚未支付，确定接单吗?<{# } }>" class="js-post border-1px-r"><i class="icon icon-selected"></i> 确认接单</a>
					<a href="<?php  echo imurl('manage/order/takeout1/cancel')?>&id=<{d[i].id}>" class="js-modal">取消订单</a>
				<{# } else if(d[i].status == 2 || d[i].status == 3) { }>
					<{# if(d[i].order_type == 1){ }>
						<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'notify_deliveryer_collect'))?>&id=<{d[i].id}>}" class="js-post border-1px-r" data-confirm="确定通知配送员配送吗?" ><i class="icon icon-selected"></i> 通知配送员配送</a>
						<{# if(d[i].delivery_mode == 1){ }>
							<a href="javascript:;" data-id="<{d[i].id}>" class="order-delivery border-1px-r"><i class="icon icon-selected"></i> 指定配送员配送</a>
							<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'delivery_ing'))?>&id=<{d[i].id}>}" class="js-post" data-confirm="确定设置为配送中吗?" ><i class="icon icon-selected"></i> 设为配送中</a>
						<{# } }>
					<{# } else if(d[i].order_type == 2){ }>
						<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'end'))?>&id=<{d[i].id}>}" data-confirm="顾客已自提?" class="js-post"><i class="icon icon-selected"></i> 顾客已自提</a>
					<{# } else if(d[i].status >= 3){ }>
						<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'end'))?>&id=<{d[i].id}>}" data-confirm="确定该订单已完成?" class="js-post"><i class="icon icon-selected"></i> 订单完成</a>
					<{# } }>
				<{# } else if(d[i].status == 4){ }>
					<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'end'))?>&id=<{d[i].id}>}" data-confirm="确定该订单已完成?" class="js-post"><i class="icon icon-selected"></i> 订单完成</a>
				<{# } }>
			<{# } }>
		</div>
	</li>
	<{# } }>
</script>
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
	})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>