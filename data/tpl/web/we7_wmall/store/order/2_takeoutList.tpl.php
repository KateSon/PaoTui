<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form-takeout">
	<?php  echo tpl_form_filter_hidden('store/order/takeout');?>
	<input type="hidden" name="ta" value="list"/>
	<input type="hidden" name="filter_type" value="<?php  echo $filter_type;?>"/>
	<?php  if($filter_type == 'process' || $filter_type == 'all') { ?>
		<input type="hidden" name="status" value="<?php  echo $status;?>"/>
		<input type="hidden" name="pay_type" value="<?php  echo $pay_type;?>"/>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待接单</a>
						<a href="<?php  echo ifilter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已确认</a>
						<a href="<?php  echo ifilter_url('status:3');?>" class="btn <?php  if($status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待配送</a>
						<a href="<?php  echo ifilter_url('status:4');?>" class="btn <?php  if($status == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">配送中</a>
						<a href="<?php  echo ifilter_url('status:5');?>" class="btn <?php  if($status == 5) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已完成</a>
						<a href="<?php  echo ifilter_url('status:6');?>" class="btn <?php  if($status == 6) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已取消</a>
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="checkbox checkbox-inline btn-refresh" data-type="status_store_order_refresh"><input type="checkbox" value="1" <?php  if($_GPC['_status_store_order_refresh'] == 1) { ?>checked<?php  } ?>><label><span id="time-count"><span>30</span>秒</span>自动刷新</label></div>
				<div class="checkbox checkbox-inline btn-notice" data-type="status_store_order_notice"><input type="checkbox" value="1" <?php  if($_GPC['_status_store_order_notice'] == 1) { ?>checked<?php  } ?>><label>语音提示</label></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('is_pay:-1');?>" class="btn <?php  if($is_pay == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo ifilter_url('is_pay:0');?>" class="btn <?php  if($is_pay == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未支付</a>
						<a href="<?php  echo ifilter_url('is_pay:1');?>" class="btn <?php  if($is_pay == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已支付</a>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('pay_type:');?>" class="btn <?php  if($pay_type == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo ifilter_url('pay_type:wechat');?>" class="btn <?php  if($pay_type == 'wechat') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">微信支付</a>
						<a href="<?php  echo ifilter_url('pay_type:alipay');?>" class="btn <?php  if($pay_type == 'alipay') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">支付宝</a>
						<a href="<?php  echo ifilter_url('pay_type:credit');?>" class="btn <?php  if($pay_type == 'credit') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">余额支付</a>
						<a href="<?php  echo ifilter_url('pay_type:delivery');?>" class="btn <?php  if($pay_type == 'delivery') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">货到付款</a>
						<a href="<?php  echo ifilter_url('pay_type:peerpay');?>" class="btn <?php  if($pay_type == 'peerpay') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">找人代付</a>
					</div>
				</div>
			</div>
		</div>
		<?php  if(check_plugin_perm('eleme')) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单渠道</label>
				<div class="col-sm-9 col-xs-12">
					<div class="btn-group">
						<div class="btn-group">
							<a href="<?php  echo ifilter_url('order_plateform:');?>" class="btn <?php  if($order_plateform == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo ifilter_url('order_plateform:we7_wmall');?>" class="btn <?php  if($order_plateform == 'we7_wmall') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">本平台</a>
							<a href="<?php  echo ifilter_url('order_plateform:eleme');?>" class="btn <?php  if($order_plateform == 'eleme') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">饿了么</a>
							<a href="<?php  echo ifilter_url('order_plateform:meituan');?>" class="btn <?php  if($order_plateform == 'meituan') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">美团</a>
						</div>
					</div>
				</div>
			</div>
		<?php  } ?>
	<?php  } else if($filter_type == 'is_remind') { ?>
		<input type="hidden" name="is_remind" value="<?php  echo $is_remind;?>"/>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">处理状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('is_remind:1');?>" class="btn <?php  if($is_remind == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未处理</a>
						<a href="<?php  echo ifilter_url('is_remind:2');?>" class="btn <?php  if($is_remind == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已处理</a>
					</div>
				</div>
			</div>
		</div>
	<?php  } else if($filter_type == 'refund_status') { ?>
		<input type="hidden" name="refund_status" value="<?php  echo $re_status;?>"/>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">处理状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('refund_status:1');?>" class="btn <?php  if($re_status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未处理</a>
						<a href="<?php  echo ifilter_url('refund_status:2');?>" class="btn <?php  if($re_status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">退款中</a>
						<a href="<?php  echo ifilter_url('refund_status:3');?>" class="btn <?php  if($re_status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">退款成功</a>
					</div>
				</div>
			</div>
		</div>
	<?php  } ?>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-9 col-xs-12">
			<div style="display: inline-block">
				<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
			</div>
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="输入用户名/手机号/订单编号">
			<input type="text" name="uid" value="<?php  if(!empty($uid)) { ?><?php  echo $uid;?><?php  } ?>" class="form-control" placeholder="用户UID">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<div class="clearfix order-list">
	<?php  if(!empty($orders)) { ?>
	<div class="col-md-8">
		<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
		<div class="panel-order <?php  echo $order['order_plateform'];?>">
			<div class="pay-info <?php  echo $order['pay_type_class'];?>"></div>
			<div class="panel-heading clearfix">
				<div class="order-info pull-left">
					<span class="serial-sn">
						#<strong><?php  echo $order['serial_sn'];?></strong>
					</span>
					<span class="send-time">
						<strong><?php  echo $order['delivery_time'];?></strong>
						<span class="grayest">（<?php  echo date('Y-m-d H:i', $order['addtime'])?> 下单）</span>
						<?php  if($order['is_pay'] == 1) { ?>
							<span><?php  echo $pay_types[$order['pay_type']]['text'];?></span>
						<?php  } ?>
					</span>
				</div>
				<div class="order-status pull-right"><strong class="<?php  echo $order_status[$order['status']]['color'];?>"><?php  echo $order_status[$order['status']]['text'];?></strong></div>
			</div>
			<?php  if($order['status'] == 6) { ?>
				<div class="order-reason">
					<i class="icon icon-time"></i>
					取消原因:<?php  echo $order['cancel_reason'];?>
				</div>
			<?php  } ?>
			<div class="user-info">
				<span class="highlight"><?php  echo $order['username'];?>(<?php  echo $order['sex'];?>)</span>
				<span class="user-phone"><?php  echo $order['mobile'];?></span>
				<a href="<?php  echo ifilter_url('filter_type:all,uid:' . $order['uid']);?>" class="greenest pull-right">查看用户历史订单</a>
				<div class="user-location clearfix">
					<span><?php  echo $order['address'];?></span>
					<a href="javascript:;" class="greenest pull-right hide"><i class="fa fa-map-marker"></i>5.0km</a>
				</div>
			</div>
			<?php  if($order['deliveryer_id'] > 0) { ?>
			<div class="delivery-info clearfix">
				<div class="highlight">配送:</div>
				<div class="deliveryer-info">
					<strong><?php  echo $deliveryers[$order['deliveryer_id']]['title'];?></strong> &nbsp; &nbsp;<?php  echo $deliveryers[$order['deliveryer_id']]['mobile'];?>
					<div class="status-info">
						<?php  if($order['delivery_status'] == 7) { ?>
							骑士已接单（接单时间：<?php  echo date('Y-m-d H:i', $order['delivery_assign_time'])?>）
						<?php  } else if($order['delivery_status'] == 4) { ?>
							骑士已到店（到店时间：<?php  echo date('Y-m-d H:i', $order['delivery_instore_time'])?>）
						<?php  } else if($order['delivery_status'] == 5) { ?>
							骑手已送达（送达时间：<?php  echo date('Y-m-d H:i', $order['delivery_success_time'])?>）
						<?php  } ?>
					</div>
				</div>
			</div>
			<?php  } ?>
			<div class="product-info">
				<p class="product-title">
					<span class="highlight">商品信息</span>
					<span class="pull-right greenest toggle-product">展开 <i class="fa fa-angle-up"></i></span>
				</p>
				<div class="product-display hide">
					<div class="remark"><span class="orange">备注：</span><?php  if(!empty($order['note'])) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?></div>
					<div class="table-order">
						<table class="table">
							<tbody>
							<?php  if(is_array($goods_all[$order['id']])) { foreach($goods_all[$order['id']] as $goods) { ?>
								<tr>
									<td class="goods-name"><?php  echo $goods['goods_title'];?></td>
									<td class="goods-price">¥<?php  echo $goods['goods_unit_price'];?></td>
									<td class="goods-num">x<?php  echo $goods['goods_num'];?></td>
									<td class="total-price">¥<?php  echo $goods['goods_price'];?></td>
								</tr>
							<?php  } } ?>
							</tbody>
						</table>
					</div>
					<?php  if($order['box_price'] > 0) { ?>
					<div class="list-item clearfix">
						<span class="pull-left">餐盒费</span>
						<span class="pull-right">¥<?php  echo $order['box_price'];?></span>
					</div>
					<?php  } ?>
					<?php  if($order['pack_fee'] > 0) { ?>
					<div class="list-item clearfix">
						<span class="pull-left">包装费</span>
						<span class="pull-right">¥<?php  echo $order['pack_fee'];?></span>
					</div>
					<?php  } ?>
					<?php  if($order['delivery_fee'] > 0) { ?>
					<div class="list-item clearfix">
						<span class="pull-left">配送费</span>
						<span class="pull-right">¥<?php  echo $order['delivery_fee'];?></span>
					</div>
					<?php  } ?>
					<div class="charge-info">
						<div class="charge-title clearfix">
							<div class="pull-left"><strong>小计</strong></div>
							<div class="pull-right">¥<?php  echo $order['total_fee'];?></div>
						</div>
						<div class="charge-title clearfix">
							<div class="pull-left"><strong>顾客实际支付</strong></div>
							<div class="pull-right">¥<?php  echo $order['final_fee'];?></div>
						</div>
						<div class="total clearfix">
							<div class="pull-left"><span class="highlight">商户预计收入</span></div>
							<div class="pull-right"><span class="highlight">¥<?php  echo $order['store_final_fee'];?></span></div>
						</div>
						<?php  if($order['order_plateform'] == 'eleme') { ?>
							<div class="total clearfix">
								<div class="pull-left"><span class="highlight">饿了么店铺收入</span></div>
								<div class="pull-right"><span class="highlight">¥<?php  echo $order['eleme_store_final_fee'];?></span></div>
							</div>
						<?php  } else if($order['order_plateform'] == 'meituan') { ?>
							<div class="total clearfix">
								<div class="pull-left"><span class="highlight">美团店铺收入</span></div>
								<div class="pull-right"><span class="highlight">¥<?php  echo $order['meituan_store_final_fee'];?></span></div>
							</div>
						<?php  } ?>
					</div>
				</div>
			</div>
			<div class="btn-area">
				<?php  if($order['status'] < 5) { ?>
					<?php  if($order['status'] == 1) { ?>
						<a href="<?php  echo iurl('store/order/takeout/status', array('type' => 'handle', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定接单吗">接受订单</a>
					<?php  } ?>

					<?php  if($order['order_type'] == 1) { ?>
						<?php  if($order['status'] == 2 || $order['status'] == 3) { ?>
							<a href="<?php  echo iurl('store/order/takeout/status', array('type' => 'notify_deliveryer_collect', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定通知配送员抢单吗？">通知配送员抢单</a>
							<?php  if($store['delivery_mode'] == 1) { ?>
								<a href="<?php  echo iurl('store/order/takeout/status', array('id' => $order['id'], 'type' => 'delivery_ing'));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定修改订单状态?">设为配送中</a>
								<a href="<?php  echo iurl('store/order/takeout/select_deliveryer', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-modal">指定配送员配送</a>
							<?php  } ?>
						<?php  } ?>
						<?php  if($order['status'] == 4) { ?>
							<a href="<?php  echo iurl('store/order/takeout/status', array('type' => 'end', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定完成订单吗?">完成订单</a>
						<?php  } ?>
					<?php  } else if($order['order_type'] == 2) { ?>
						<a href="<?php  echo iurl('store/order/takeout/status', array('type' => 'end', 'id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定完成订单吗?">完成订单</a>
					<?php  } ?>

					<?php  if($order['is_pay'] == 1 && $order['pay_type'] != 'delivery') { ?>
						<a href="<?php  echo iurl('store/order/takeout/cancel', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-modal" data-batch="modal">取消订单并退款</a>
					<?php  } else { ?>
						<a href="<?php  echo iurl('store/order/takeout/cancel', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-modal" data-batch="modal">取消订单</a>
					<?php  } ?>

					<?php  if($order['is_remind'] == 1) { ?>
						<a href="<?php  echo iurl('store/order/takeout/remind', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-modal">回复催单</a>
					<?php  } ?>
				<?php  } ?>
				<a href="<?php  echo iurl('store/order/takeout/print', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定打印订单吗?"><i class="fa fa-print"></i> ( <?php  echo $order['print_nums'];?> )</a>
				<a href="<?php  echo iurl('store/order/takeout/detail', array('id' => $order['id']));?>" target="_blank" class="btn btn-primary btn-sm">详情</a>
			</div>
		</div>
		<?php  } } ?>
	</div>
	<div class="col-md-4">
		<div class="panel panel-stat">
			<div class="panel-heading">
				<h3>当日订单概况</h3>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<div class="title">已接订单(笔)</div>
					<div class="num-wrapper">
						<a class="num" href="javascript:;"><?php  echo intval($stat['total_num']);?></a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="title">预计收入(元)</div>
					<div class="num-wrapper">
						<a class="num" href="javascript:;"><?php  echo round($stat['store_final_fee'], 2);?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php  } else { ?>
		<div class="no-result">
			<p>还没有相关数据</p>
		</div>
	<?php  } ?>
	<div class="col-md-12">
		<?php  echo $pager;?>
	</div>
</div>

<script>
$(function(){
	$('.btn-refresh, .btn-notice').click(function(){
		var type = $(this).data('type');
		var value = $(this).find(':checkbox').prop('checked') ? 0 : 1;
		var time = 0;
		var proc = function(){
			$.post(location.href, {type: type, value: value}, function(){
				location.reload();
			});
		};
		if(type == 'status_store_order_notice' && value == 1) {
			Notify.alert("以下情况下有订单提示音:<br>1.订单已支付 <br>2.商家未接单(即:订单为待接单,其他状态不提示)<br>3.浏览器已打开订单处理中心页面", proc);
			return false;
		} else {
			proc();
		}
		return false;
	});

	<?php  if($_GPC['_status_store_order_refresh'] == 1) { ?>
		var sync = setInterval(function(){
			var time = parseInt($('#time-count span').html());
			if(time > 1) {
				time--;
				var html = '<span>' + time + '</span>'  + '秒后';
				$('#time-count').html(html);
			} else {
				location.reload();
			}
		}, 1000);
		if(!$('#time-count span').size()) {
			clearInterval(sync);
		}
	<?php  } ?>

	$(document).on('click', '.product-title .toggle-product', function(){
		var $parent = $(this).parents('.panel-order');
		var is_hide = $('.product-display', $parent).hasClass('hide');
		if(is_hide) {
			$('.product-display', $parent).removeClass('hide');
			$(this).html('收起 <i class="fa fa-angle-up"></i>');
		} else {
			$('.product-display', $parent).addClass('hide');
			$(this).html('展开 <i class="fa fa-angle-down"></i>');
		}
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>