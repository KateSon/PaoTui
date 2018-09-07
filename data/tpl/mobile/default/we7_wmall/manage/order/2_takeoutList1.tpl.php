<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page page-order" id="page-manage-order">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back"></a>
		<div class="js-date" data-href="<?php  echo imurl('manage/order/takeout1/list', array('status' => $status))?>" data-maxDate="<?php  echo date('Y-m-d')?>">
			<div class="date"><?php  echo date('m-d', strtotime($stat_day))?> <i class="icon icon-arrow-down"></i></div>
			<div class="calendar hide"></div>
		</div>
		<h1 class="title">订单管理</h1>
		<a class="icon pull-right icon icon-refresh refresh"></a>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('manage/order/takeout1/more', array('status' => $status, 'date' => $stat_day))?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".order-list" data-tpl="tpl-order">
		<div class="buttons-tab">
			<a href="<?php  echo imurl('manage/order/takeout1/list', array('date' => $stat_day, 'status' => 1));?>" class="button <?php  if($status == 1) { ?>active<?php  } ?>">待确认</a>
			<a href="<?php  echo imurl('manage/order/takeout1/list', array('date' => $stat_day, 'status' => 2));?>" class="button <?php  if($status == 2) { ?>active<?php  } ?>">处理中</a>
			<a href="<?php  echo imurl('manage/order/takeout1/list', array('date' => $stat_day, 'status' => 3));?>" class="button <?php  if($status == 3) { ?>active<?php  } ?>">待配送</a>
			<a href="<?php  echo imurl('manage/order/takeout1/list', array('date' => $stat_day, 'status' => 4));?>" class="button <?php  if($status == 4) { ?>active<?php  } ?>">配送中</a>
			<a href="javascript:;" class="button <?php  if(in_array($status, array(5, 6, 0))) { ?>active<?php  } ?> open-popover" data-popover=".popover-order-status"><?php  if(in_array($status, array(5, 6, 0))) { ?><?php  echo $order_status[$status]['text'];?><?php  } else { ?>更多<?php  } ?> <i class="icon icon-arrow-down"></i></a>
		</div>
		<?php  if(empty($orders)) { ?>
			<div class="no-data">
				<div class="bg"></div>
				<p>没有任何订单哦～</p>
			</div>
		<?php  } else { ?>
		<div class="order-list" id="order-list">
			<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
			<div class="order-list-item <?php  echo $order['order_plateform'];?>">
				<div class="order-info">
					<div class="order-title">
						<strong class="med">#</strong>
						<strong class="largest"><?php  echo $order['serial_sn'];?></strong>
						<span class="order-time">
							<span class="med orange"><?php  if(!empty($order['delivery_time'])) { ?><?php  echo $order['delivery_time'];?><?php  } else { ?>立即送达<?php  } ?></span>
						</span>
						<div class="order-status"><?php  echo $order_status[$order['status']]['text'];?></div>
					</div>
					<?php  if($order['status'] == 6) { ?>
						<div class="order-reason">
							<i class="icon icon-time"></i>
							取消原因:<?php  echo $order['cancel_reason'];?>
						</div>
					<?php  } ?>
				</div>
				<div class="user-info border-1px-b js-url" data-link="<?php  echo imurl('manage/order/takeout1/detail', array('id' => $order['id']));?>">
					<div class="user-name">
						<strong class="med"><?php  echo $order['username'];?> <?php  echo $order['sex'];?></strong>
						<span class="user-status">
							<span class="small grayest hide">#门店新客</span>
							<?php  if($order['favorite_store']) { ?>
								<span class="small grayest">#收藏店铺</span>
							<?php  } ?>
						</span>
					</div>
					<div class="user-phone">
						<i class="icon icon-telephone"></i>
						<a href="tel:<?php  echo $order['mobile'];?>"><?php  echo $order['mobile'];?></a>
					</div>
					<div class="user-address">
						<span class="search-address">
							<?php  echo $order['address'];?>
						</span>
						<span class="distance"><?php  echo $order['distance'];?>km</span>
					</div>
					<a href="http://m.amap.com/?q=<?php  echo $order['location_x'];?>,<?php  echo $order['location_y'];?>&name=<?php  echo $order['address'];?>" class="loc">
						<i class="icon icon-locationfill"></i>
					</a>
				</div>
				<?php  if(0 && $order['deliveryer_id'] != 0) { ?>
					<div class="delivery-section border-1px-b">
						<strong class="delivery-name">骑手: 张中雷</strong>
						<div class="delivery-status">
							<span class="time">11:20</span>
							取消配送
						</div>
						<a href="javascript:;" class="more">
							查看更多配送信息<i class="icon icon-right"></i>
						</a>
						<span class="operate-box">
							<a href="<?php  echo $order['mobile'];?>" class="loc">
								<i class="icon icon-locationfill"></i>
							</a>
							<a href="<?php  echo $order['mobile'];?>" class="tel">
								<i class="icon icon-telephone"></i>
							</a>
							<a href="javascript:;" class="msg">
								<i class="icon icon-messagefill"></i>
							</a>
						</span>
					</div>
				<?php  } ?>
				<div class="goods-info border-1px-b clearfix">
					<div class="left">
						<i class="icon icon-viewgallery"></i>
					</div>
					<div class="right">
						<div class="goods-title">
							<strong>商品(<?php  echo $order['num'];?>)</strong>
							<a href="javascript:;" class="pull-right">
								<i class="icon icon-unfold"></i>
							</a>
						</div>
						<div class="order-details">
							<?php  if($order['note']) { ?>
								<div class="note">
									<span>备注：</span><?php  echo $order['note'];?>
								</div>
							<?php  } ?>
							<div class="goods-list border-1px-b">
								<ul>
									<?php  if(is_array($order['goods'])) { foreach($order['goods'] as $good) { ?>
										<li class="clearfix">
											<span class="good-name"><?php  echo $good['goods_title'];?></span>
											<span class="good-num <?php  if($good['goods_num'] > 1) { ?>many<?php  } ?>">x<?php  echo $good['goods_num'];?></span>
											<span class="good-price">¥<?php  echo $good['goods_price'];?></span>
										</li>
									<?php  } } ?>
								</ul>
							</div>
							<div class="box-fee border-1px-b">
								餐盒费<span>¥<?php  echo $order['box_price'];?></span>
							</div>
							<?php  if($order['pack_fee'] > 0) { ?>
								<div class="box-fee border-1px-b">
									包装费<span>¥<?php  echo $order['pack_fee'];?></span>
								</div>
							<?php  } ?>
							<div class="box-fee border-1px-b">
								配送费<span>¥<?php  echo $order['delivery_fee'];?></span>
							</div>
							<div class="subtotal border-1px-b">
								<div class="subtotal-box">
									小计<span>¥<?php  echo $order['total_fee'];?></span>
								</div>
								<div class="platform-fee hide">
									平台抽取佣金
									<a href="javascript:;"><i class="icon icon-question1"></i></a>
									<span>-¥<?php  echo $order['plateform_serve_fee'];?></span>
								</div>
							</div>
						</div>
						<div class="total">
							<div class="clearfix">
								<span class="left">本单预计收入</span>
								<span class="price">¥ <?php  echo $order['store_final_fee'];?></span>
							</div>
							<div class="grayest">
								本单顾客实际支付：¥<?php  echo $order['final_fee'];?>
								<?php  if($order['is_pay'] == 1) { ?>
								<span class="green">
									(已支付)
								</span>
								<?php  } else { ?>
								<span class="color-danger">
									(未支付)
								</span>
								<?php  } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="operate-box clearfix">
				<?php  if($order['status'] < 5) { ?>
					<?php  if($order['status'] == 1) { ?>
						<a href="<?php  echo imurl('manage/order/takeout1/status', array('id' => $order['id'], 'type' => 'handle'))?>" data-confirm="<?php  if($order['is_pay'] == 1) { ?>确定接单吗?<?php  } else { ?>该订单尚未支付，确定接单吗?<?php  } ?>" class="js-post border-1px-r">确认接单</a>
						<a href="<?php  echo imurl('manage/order/takeout1/cancel', array('id' => $order['id']))?>" class="js-modal">取消订单</a>
					<?php  } else if($order['status'] == 2 || $order['status'] == 3) { ?>
						<?php  if($order['order_type'] == 1) { ?>
							<a href="<?php  echo imurl('manage/order/takeout1/status', array('id' => $order['id'], 'type' => 'notify_deliveryer_collect'))?>" data-confirm="确定通知配送员配送吗?" class="js-post border-1px-r">通知配送员配送</a>
							<?php  if($store['delivery_mode'] == 1) { ?>
								<a href="javascript:;" class="order-delivery border-1px-r" data-id="<?php  echo $order['id'];?>">指定配送员配送</a>
								<a href="<?php  echo imurl('manage/order/takeout1/status', array('id' => $order['id'], 'type' => 'delivery_ing'))?>" class="js-post" data-confirm="确定设置为配送中吗?">设为配送中</a>
							<?php  } ?>
						<?php  } else if($order['order_type'] == 2) { ?>
							<a href="<?php  echo imurl('manage/order/takeout1/status', array('id' => $order['id'], 'type' => 'end'))?>" class="js-post" data-confirm="顾客已自提?">顾客已自提</a>
						<?php  } else if($order['order_type'] >= 3) { ?>
							<a href="<?php  echo imurl('manage/order/takeout1/status', array('id' => $order['id'], 'type' => 'end'))?>" class="js-post" data-confirm="确定该订单已完成?">订单完成</a>
						<?php  } ?>
					<?php  } else if($order['status'] == 4) { ?>
						<a href="<?php  echo imurl('manage/order/takeout1/status', array('id' => $order['id'], 'type' => 'end'))?>" class="js-post" data-confirm="确定该订单已完成?">订单完成</a>
					<?php  } ?>
				<?php  } ?>
				</div>
				<div class="bottom clearfix">
					<div class="operate clearfix">
						<a href="tel:<?php  echo $_W['we7_wmall']['config']['mall']['mobile'];?>" class="custom">
							<i class="icon icon-service1"></i>
							<div>客服</div>
						</a>
						<a href="<?php  echo imurl('manage/order/takeout/print', array('id' => $order['id']))?>" class="stamp js-post">
							<i class="icon icon-print"></i>
							<div>打印<?php  if($order['print_nums'] > 0) { ?>(<?php  echo $order['print_nums'];?>)<?php  } ?></div>
						</a>
					</div>
					<div class="about-order">
						<div class="order-time">
							<?php  echo date('m-d H:i:s', $order['addtime']);?>下单
						</div>
						<div class="order-number">
							订单编号:<?php  echo $order['ordersn'];?>
						</div>
					</div>
				</div>
			</div>
			<?php  } } ?>
			</div>
		<?php  } ?>
	</div>
</div>
<div class="popover popover-manage popover-order-status">
	<div class="popover-angle"></div>
	<div class="popover-inner">
		<div class="list-block">
			<ul>
				<li><a href="<?php  echo imurl('manage/order/takeout1/list', array('date' => $stat_day, 'status' => 5));?>" class="list-button item-link">已完成</a></li>
				<li><a href="<?php  echo imurl('manage/order/takeout1/list', array('date' => $stat_day, 'status' => 6));?>" class="list-button item-link">已取消</a></li>
				<li><a href="<?php  echo imurl('manage/order/takeout1/list', array('date' => $stat_day, 'status' => 0));?>" class="list-button item-link">所有</a></li>
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
		<div class="order-list-item <{d[i].order_plateform}>">
			<div class="order-info">
				<div class="order-title">
					<strong class="med">#</strong>
					<strong class="largest"><{d[i].serial_sn}></strong>
					<span class="order-time">
						<span class="med orange">立即送达</span>
					</span>
					<div class="order-status"><{d[i].status_cn}></div>
				</div>
				<{# if(d[i].status == 6) { }>
					<div class="order-reason">
						<i class="icon icon-time"></i>
						取消原因：<{d[i].cancel_reason}>
					</div>
				<{# } }>
			</div>
			<div class="user-info border-1px-b js-url" data-link="<?php  echo imurl('manage/order/takeout1/detail');?>&id=<{d[i].id}>">
				<div class="user-name">
					<strong class="med"><{d[i].username}></strong>
					<span class="user-status">
						<span class="small grayest hide">#门店新客</span>
						<{# if(d[i].favorite_store) { }>
							<span class="small grayest">#收藏店铺</span>
						<{# }}>
					</span>
				</div>
				<div class="user-phone">
					<i class="icon icon-telephone"></i>
					<a href="tel:<{d[i].mobile}>"><{d[i].mobile}></a>
				</div>
				<div class="user-address">
					<span class="search-address">
						<{d[i].address}>
					</span>
					<span class="distance"><{d[i].distance}>km</span>
				</div>
				<a href="http://m.amap.com/?q=<{d[i].location_x}>,<{d[i].location_y}>&name=<{d[i].address}>" class="loc">
					<i class="icon icon-locationfill"></i>
				</a>
			</div>
			<{# if(d[i].deliveryer_id != 0) {}>
				<div class="delivery-section border-1px-b">
					<strong class="delivery-name">骑手: 张中雷</strong>
					<div class="delivery-status">
						<span class="time">11:20</span>
						取消配送
					</div>
					<a href="javascript:;" class="more">
						查看更多配送信息<i class="icon icon-right"></i>
					</a>
					<span class="operate-box">
						<a href="javascript:;" class="loc">
							<i class="icon icon-locationfill"></i>
						</a>
						<a href="javascript:;" class="tel">
							<i class="icon icon-telephone"></i>
						</a>
						<a href="javascript:;" class="msg">
							<i class="icon icon-messagefill"></i>
						</a>
					</span>
				</div>
			<{# } }>
			<div class="goods-info border-1px-b clearfix">
				<div class="left">
					<i class="icon icon-viewgallery"></i>
				</div>
				<div class="right">
					<div class="goods-title">
						<strong>商品</strong>
						<a href="javascript:;" class="pull-right">
							<i class="icon icon-unfold"></i>
						</a>
					</div>
					<div class="order-details">
						<div class="goods-list border-1px-b">
							<ul>
								<{# for(var j = 0, lenj = d[i].goods.length; j < lenj; j++){ }>
									<li class="clearfix">
										<span class="good-name"><{d[i].goods[j].goods_title}></span>
										<span class="good-num <{# if(d[i].goods[j].goods_num > 1) { }>many<{# } }>">x<{d[i].goods[j].goods_num}></span>
										<span class="good-price">¥<{d[i].goods[j].goods_price}></span>
									</li>
								<{# }}>
							</ul>
						</div>
						<div class="box-fee border-1px-b">
							餐盒费<span>¥<{d[i].box_price}></span>
						</div>
						<{# if(d[i].pack_fee > 0) {}>
							<div class="box-fee border-1px-b">
								包装费<span>¥<{d[i].pack_fee}></span>
							</div>
						<{# } }>
						<div class="box-fee border-1px-b">
							配送费<span>¥<{d[i].delivery_fee}></span>
						</div>
						<div class="subtotal border-1px-b">
							<div class="subtotal-box">
								小计<span>¥<{d[i].total_fee}></span>
							</div>
							<div class="platform-fee hide">
								平台抽取佣金
								<a href="javascript:;"><i class="icon icon-question1"></i></a>
								<span>-¥<{d[i].plateform_serve_fee}></span>
							</div>
						</div>
					</div>
					<div class="total">
						<div class="clearfix">
							<span class="left">本单预计收入</span>
							<span class="price">¥ <{d[i].store_final_fee}></span>
						</div>
						<div class="grayest">
							本单顾客实际支付：¥<{d[i].final_fee}>
							<span class="green">(已支付)</span>
						</div>
					</div>
				</div>
			</div>
			<div class="operate-box clearfix">
			<{# if(d[i].status < 5){ }>
				<{# if(d[i].status == 1){ }>
					<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'handle'))?>&id=<{d[i].id}>" data-confirm="<{# if(d[i].is_pay == 1){ }>确定接单吗?<{# } else { }>该订单尚未支付，确定接单吗?<{# } }>" class="js-post border-1px-r"><i class="icon icon-selected"></i> 确认接单</a>
					<a href="<?php  echo imurl('manage/order/takeout1/cancel')?>&id=<{d[i].id}>" class="js-modal">取消订单</a>
				<{# } else if(d[i].status == 2 || d[i].status == 3) { }>
					<{# if(d[i].order_type == 1){ }>
						<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'notify_deliveryer_collect'))?>&id=<{d[i].id}>" class="js-post border-1px-r" data-confirm="确定通知配送员配送吗?" ><i class="icon icon-selected"></i> 通知配送员配送</a>
						<{# if(d[i].delivery_mode == 1){ }>
							<a href="javascript:;" data-id="<{d[i].id}>" class="order-delivery border-1px-r"><i class="icon icon-selected"></i> 指定配送员配送</a>
							<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'delivery_ing'))?>&id=<{d[i].id}>" class="js-post" data-confirm="确定设置为配送中吗?" ><i class="icon icon-selected"></i> 设为配送中</a>
						<{# } }>
					<{# } else if(d[i].order_type == 2){ }>
						<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'end'))?>&id=<{d[i].id}>" data-confirm="顾客已自提?" class="js-post"><i class="icon icon-selected"></i> 顾客已自提</a>
					<{# } else if(d[i].status >= 3){ }>
						<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'end'))?>&id=<{d[i].id}>" data-confirm="确定该订单已完成?" class="js-post"><i class="icon icon-selected"></i> 订单完成</a>
					<{# } }>
				<{# } else if(d[i].status == 4){ }>
					<a href="<?php  echo imurl('manage/order/takeout/status', array('type' => 'end'))?>&id=<{d[i].id}>" data-confirm="确定该订单已完成?" class="js-post"><i class="icon icon-selected"></i> 订单完成</a>
				<{# } }>
			<{# } }>
			</div>
			<div class="bottom clearfix">
				<div class="operate clearfix">
					<a href="tel:<?php  echo $_W['we7_wmall']['config']['mall']['mobile'];?>" class="custom">
						<i class="icon icon-service1"></i>
						<div>客服</div>
					</a>
					<a href="<?php  echo imurl('manage/order/takeout/print');?>&id=<{d[i].id}>" class="stamp js-post">
						<i class="icon icon-print"></i>
						<div>打印<{# if(d[i].print_nums > 0){ }>(<{d[i].print_nums}>)<{# } }></div>
					</a>
				</div>
				<div class="about-order">
					<div class="order-time">
						<{d[i].addtime_cn}>下单
					</div>
					<div class="order-number">
						订单编号:<{d[i].ordersn}>
					</div>
				</div>
			</div>
		</div>
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
				$.post("<?php  echo imurl('manage/order/takeout1/deliveryer')?>", {id: id, deliveryer_id: deliveryer_id}, function(data){
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
		$(document).on('click', '.goods-title .pull-right', function(){
			$(this).parents('.right').find('.order-details').toggleClass('active');
			return false;
		});
	})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>