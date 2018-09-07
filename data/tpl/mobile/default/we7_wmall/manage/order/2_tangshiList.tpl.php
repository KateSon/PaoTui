<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page" id="page-manage-order">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back"></a>
		<h1 class="title">订单管理</h1>
		<a class="icon pull-right icon icon-refresh refresh"></a>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('manage/order/tangshi/more', array('status' => $status))?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".order-list-container" data-tpl="tpl-order">
		<div class="buttons-tab">
			<a href="<?php  echo imurl('manage/order/tangshi/list', array('status' => 1));?>" class="button <?php  if($status == 1) { ?>active<?php  } ?>">待结单</a>
			<a href="<?php  echo imurl('manage/order/tangshi/list', array('status' => 2));?>" class="button <?php  if($status == 2) { ?>active<?php  } ?>">已确认</a>
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
						<a class="order-ls-info" href="<?php  echo imurl('manage/order/tangshi/detail', array('id' => $order['id']));?>">
							<div class="order-ls-tl">编号: <b class="order-serial-sn">#<?php  echo $order['serial_sn'];?></b><span class="<?php  echo $order_status[$order['status']]['color'];?>"><?php  echo $order_status[$order['status']]['text'];?></span></div>
							<div class="order-ls-date"><?php  echo date('Y-m-d H:i:s', $order['addtime']);?><span>下单人:<?php  echo $order['username'];?></span></div>
							<?php  if(!empty($order['goods'])) { ?>
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
							<?php  } ?>
							<div class="order-ls-sum">
								<?php  if($order['order_type'] == 3) { ?>
									<?php  echo $order['table_sn'];?>号桌,<?php  echo $order['person_num'];?>人就餐<br>
									共<?php  echo $order['num'];?>件,最终入账:¥<?php  echo $order['store_final_fee'];?>
								<?php  } else { ?>
									<?php  echo $table_categorys[$order['table_cid']]['title'];?>,<?php  echo $order['reserve_time'];?>就餐,<?php  echo $order_reserve_types[$order['reserve_type']]['text'];?>
								<?php  } ?>
								<span class="color-danger">(顾客实际支付¥<?php  echo $order['final_fee'];?>)</span>
								<span><?php  echo $pay_types[$order['pay_type']]['text'];?></span>
							</div>
						</a>
						<div class="order-pay-info <?php  echo $order['pay_type_class'];?>"></div>
						<div class="order-ls-btn border-1px-t">
							<?php  if($order['status'] < 5) { ?>
								<?php  if($order['status'] == 1) { ?>
									<a href="<?php  echo imurl('manage/order/tangshi/status', array('id' => $order['id'], 'type' => 'handle'))?>" data-confirm="确定接单吗?" class="js-post border-1px-r"><i class="icon icon-selected"></i> 确认接单</a>
								<?php  } else if($order['status'] == 2) { ?>
									<a href="<?php  echo imurl('manage/order/takeout/status', array('id' => $order['id'], 'type' => 'end'))?>" class="js-post" data-confirm="确定完成订单?"><i class="icon icon-selected"></i> 完成订单</a>
								<?php  } ?>
								<?php  if($order['is_pay'] == 1 && $order['pay_type'] != 'delivery') { ?>
									<a href="<?php  echo imurl('manage/order/tangshi/cancel', array('id' => $order['id']));?>" class="border-1px-l js-post" data-confirm="确定取消订单并退款?"><i class="icon icon-selected"></i> 取消订单并退款</a>
								<?php  } else { ?>
									<a href="<?php  echo imurl('manage/order/tangshi/cancel', array('id' => $order['id']));?>" class="border-1px-l js-post" data-confirm="确定取消订单?"><i class="icon icon-selected"></i> 取消订单</a>
								<?php  } ?>
								<?php  if(!$order['is_pay']) { ?>
									<a href="<?php  echo imurl('manage/order/tangshi/pay_status', array('id' => $order['id']));?>" class="border-1px-l js-post" data-confirm="确定修改支付状态?"><i class="icon icon-selected"></i> 设为已支付</a>
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
				<li><a href="<?php  echo imurl('manage/order/tangshi/list', array('status' => 5));?>" class="list-button item-link">已完成</a></li>
				<li><a href="<?php  echo imurl('manage/order/tangshi/list', array('status' => 6));?>" class="list-button item-link">已取消</a></li>
				<li><a href="<?php  echo imurl('manage/order/tangshi/list', array('status' => 0));?>" class="list-button item-link">所有</a></li>
				<li><a href="javascript:;" class="list-button item-link close-popover">关闭</a></li>
			</ul>
		</div>
	</div>
</div>

<script id="tpl-order" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li class="border-1px-tb">
		<a class="order-ls-info" href="<?php  echo imurl('manage/order/tangshi/detail');?>&id=<{d[i].id}>">
			<div class="order-ls-tl">编号: <b class="order-serial-sn">#<{d[i].serial_sn}></b><span class="<{d[i].status_color}>"><{d[i].status_cn}></span></div>
			<div class="order-ls-date"><{d[i].addtime_cn}><span>下单人:<{d[i].username}></span></div>
			<{# if(d[i].order_type == 3){ }>
			<div class="order-ls-dl border-1px-tb">
				<{# if(d[i].note){ }>
					<div class="row order-note">
						<span class="color-danger">备注:</span><{d[i].note}>
					</div>
				<{# } }>
				<{# for(var j = 0, lenj = d[i].goods.length; j < lenj; j++){ }>
					<div class="row">
						<div class="col-60"><{d[i].goods[j]['goods_title']}></div>
						<div class="col-20 align-right <{# if(d[i].goods[j]['goods_num'] > 0){ }>color-danger<{# } }>">X <{d[i].goods[j]['goods_num']}></div>
						<{# if(d[i].goods[j]['bargain_id'] == 3){ }>
						<span class="color-muted text-line-through">¥<{d[i].goods[j]['goods_original_price']}></span>
						<{# } }>
						<div class="col-20 align-right">¥<{d[i].goods[j]['goods_price']}></div>
					</div>
				<{# } }>
			</div>
			<{# } }>
			<div class="order-ls-sum">
			<{# if(d[i].order_type == 3){ }>
				<{d[i].table_sn}>号桌,<{d[i].person_num}>人就餐<br>
				共<{d[i].num}>件,最终入账:¥<{d[i].store_final_fee}>
			<{# } else { }>
				<{d[i].category_cn}>,<{d[i].reserve_time}>就餐,<{d[i].reserve_types_cn}>
			<{# } }>
				<span class="color-danger">(顾客实际支付¥{<{d[i].final_fee}>)</span>
				<span><{d[i].pay_types_cn}></span>
			</div>
		</a>
		<div class="order-pay-info <{d[i].pay_type_class}>"></div>
		<div class="order-ls-btn border-1px-t">
			<{# if(d[i].status < 5){ }>
				<{# if(d[i].status == 1){ }>
					<a href="<?php  echo imurl('manage/order/tangshi/status', array('type' => 'handle'))?>&id=<{d[i].id}>" data-confirm="确定接单吗?" class="js-post border-1px-r"><i class="icon icon-selected"></i> 确认接单</a>
				<{# } else if(d[i].status == 2){ }>
					<a href="<?php  echo imurl('manage/order/tangshi/status', array('type' => 'end'))?>&id=<{d[i].id}>" class="js-post" data-confirm="确定完成订单?"><i class="icon icon-selected"></i> 完成订单</a>
				<{# } }>
				<{# if(d[i].is_pay == 1 && d[i].pay_type != 'delivery'){ }>
					<a href="<?php  echo imurl('manage/order/tangshi/cancel', array('id' => $order['id']));?>" class="border-1px-l js-post" data-confirm="确定取消订单并退款?"><i class="icon icon-selected"></i> 取消订单并退款</a>
				<{# } else { }>
					<a href="<?php  echo imurl('manage/order/tangshi/cancel', array('id' => $order['id']));?>" class="border-1px-l js-post" data-confirm="确定取消订单?"><i class="icon icon-selected"></i> 取消订单</a>
				<{# } }>
				<{# if(!d[i].is_pay){ }>
					<a href="<?php  echo imurl('manage/order/tangshi/pay_status');?>&id=<{d[i].id}>" class="border-1px-l js-post" data-confirm="确定修改支付状态?">设为已支付</a>
				<{# } }>
			<{# } }>
		</div>
	</li>
	<{# } }>
</script>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>