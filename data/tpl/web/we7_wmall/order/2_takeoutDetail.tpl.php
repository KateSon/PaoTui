<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="clearfix order-detail">
	<div class="col-md-4 padding-0">
		<div class="panel panel-display">
			<div class="panel-heading"><h3>订单信息</h3></div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td width="130">下单平台：</td>
						<td><?php  echo toplateform($order['order_plateform']);?></td>
					</tr>
					<tr>
						<td width="130">购买人UID：</td>
						<td><?php  echo $order['uid'];?></td>
					</tr>
					<tr>
						<td width="130">订单编号：</td>
						<td><?php  echo $order['ordersn'];?></td>
					</tr>
					<tr>
						<td width="130">本平台支付单号：</td>
						<td><?php  echo $order['out_trade_no'];?></td>
					</tr>
					<tr>
						<td width="130">第三方支付单号：</td>
						<td><?php  echo $order['transaction_id'];?></td>
					</tr>
					<tr>
						<td>下单时间：</td>
						<td><?php  echo date('Y-m-d H:i', $order['addtime']);?></td>
					</tr>
					<tr>
						<td>订单状态：</td>
						<td><span class="<?php  echo $order_status[$order['status']]['css'];?>"><?php  echo $order_status[$order['status']]['text'];?></span></td>
					</tr>
					<tr>
						<td>配送方式：</td>
						<td><span class="<?php  echo $order_types[$order['order_type']]['css'];?>"><?php  echo $order_types[$order['order_type']]['text'];?></span></td>
					</tr>
					<tr>
						<td>配送/自提时间：</td>
						<td><?php  echo $order['delivery_day'];?>~<?php  echo $order['delivery_time'];?></td>
					</tr>
					<tr>
						<td>付款方式：</td>
						<td>
							<?php  if(!$order['is_pay']) { ?>
								<span class="label label-danger">未支付</span>
							<?php  } else { ?>
								<span class="<?php  echo $pay_types[$order['pay_type']]['css'];?>"><?php  echo $pay_types[$order['pay_type']]['text'];?></span>
							<?php  } ?>
						</td>
					</tr>
					<tr>
						<td>下单人信息：</td>
						<td><?php  echo $order['username'];?> <?php  echo $order['mobile'];?></td>
					</tr>
					<tr>
						<td>配送地址：</td>
						<td><?php  echo $order['address'];?></td>
					</tr>
					<tr>
						<td>备注：</td>
						<td><?php  if(!empty($order['note'])) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?></td>
					</tr>
					<tr>
						<td>发票：</td>
						<td><?php  if(!empty($order['invoice'])) { ?><?php  echo $order['invoice'];?><?php  } else { ?>无<?php  } ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel panel-display">
			<div class="panel-heading"><h3>订单日志</h3></div>
			<div class="panel-body">
				<table class="table">
					<?php  if(is_array($logs)) { foreach($logs as $log) { ?>
					<tr>
						<td>
							<p><i class="fa fa-info-circle"></i> <strong><?php  echo date('Y-m-d H:i', $log['addtime']);?> <?php  echo $log['title'];?></strong></p>
							<p style="padding-left:15px; "><?php  echo $log['note'];?></p>
						</td>
					</tr>
					<?php  } } ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-8 padding-r-0">
		<div class="panel panel-display">
			<div class="panel-heading"><h3>订单费用</h3></div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td width="130">商品价格：</td>
						<td>+￥ <?php  echo $order['price'];?></td>
					</tr>
					<tr>
						<td width="130">餐盒费：</td>
						<td>+￥ <?php  echo $order['box_price'];?></td>
					</tr>
					<tr>
						<td width="130">包装费：</td>
						<td>+￥ <?php  echo $order['pack_fee'];?></td>
					</tr>
					<tr>
						<td width="130">配送费：</td>
						<td>+￥ <?php  echo $order['delivery_fee'];?></td>
					</tr>
					<tr>
						<td width="130">代理商抽取佣金：</td>
						<td>
							-￥ <?php  echo $order['plateform_serve_fee'];?> =
							<?php  if(!empty($order['plateform_serve'])) { ?>
								<?php  echo $order['plateform_serve']['note'];?>
							<?php  } else { ?>
								(商品小计￥<?php  echo $order['price'];?> + 餐盒费￥<?php  echo $order['box_price'];?> + 包装费￥<?php  echo $order['pack_fee'];?><?php  if($order['delivery_type'] == 1) { ?> + 配送费￥<?php  echo $order['delivery_fee'];?><?php  } ?> - 商户优惠活动补贴￥<?php  echo $order['store_discount_fee'];?>)X<?php  echo $order['plateform_serve_rate'];?>%
							<?php  } ?>
						</td>
					</tr>
					<tr>
						<td width="130">平台配送费：</td>
						<td>
							-￥ <?php  echo $order['plateform_delivery_fee'];?>
						</td>
					</tr>
					<?php  if($order['discount_fee'] > 0) { ?>
						<?php  if(is_array($discount)) { foreach($discount as $row) { ?>
							<tr>
								<td width="130"><?php  echo $row['name'];?>：</td>
								<td>
									- ￥ <?php  echo $row['fee'];?> (注：商户承担：￥<?php  echo $row['store_discount_fee'];?>， 代理商承担：￥<?php  echo $row['agent_discount_fee'];?>， 平台承担￥<?php  echo $row['plateform_discount_fee'];?>)
								</td>
							</tr>
						<?php  } } ?>
					<?php  } ?>
					<tr>
						<td width="130">本单平台共补贴：</td>
						<td>
							+￥ <?php  echo $order['plateform_discount_fee'];?>
						</td>
					</tr>
					<tr>
						<td width="130">本单代理商共补贴：</td>
						<td>
							+￥ <?php  echo $order['agent_discount_fee'];?>
						</td>
					</tr>
					<tr>
						<td width="130">商户实际收入：</td>
						<td>
							￥ <?php  echo $order['store_final_fee'];?> (本单顾客实际支付:￥ <?php  echo $order['final_fee'];?>)
						</td>
					</tr>
					<?php  if($order['order_plateform'] == 'eleme') { ?>
						<tr>
							<td width="130">饿了么店铺收入：</td>
							<td>
								￥ <?php  echo $order['eleme_store_final_fee'];?>
							</td>
						</tr>
					<?php  } else if($order['order_plateform'] == 'meituan') { ?>
						<tr>
							<td width="130">美团店铺收入：</td>
							<td>
								￥ <?php  echo $order['meituan_store_final_fee'];?>
							</td>
						</tr>
					<?php  } ?>
					<?php  if($_W['is_agent']) { ?>
						<tr>
							<td width="130">平台服务佣金(平台收取代理商)：</td>
							<td>
								￥ <?php  echo $order['agent_serve_fee'];?> = <?php  echo $order['agent_serve']['note'];?>
							</td>
						</tr>
						<tr>
							<td width="130">代理商实际收入：</td>
							<td>
								￥ <?php  echo $order['agent_final_fee'];?> = <?php  echo $order['agent_serve']['final'];?>
							</td>
						</tr>
					<?php  } ?>
				</table>
			</div>
		</div>
		<div class="panel panel-display">
			<div class="panel-heading"><h3>商品信息</h3></div>
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>商品</th>
							<th>份数</th>
							<th>小计(元)</th>
							<th></th>
						</tr>
					</thead>
					<?php  if(!empty($order['goods'])) { ?>
						<?php  if(is_array($order['goods'])) { foreach($order['goods'] as $or) { ?>
							<tr>
								<td><?php  echo $or['goods_title'];?></td>
								<td><?php  echo $or['goods_num'];?> 份</td>
								<td><?php  echo $or['goods_price'];?> 元</td>
								<td class="text-right">
									<a class="btn btn-primary btn-sm" target="_blank" href="<?php  echo iurl('store/goods/index/post', array('id' => $or['goods_id'], '_sid' => $order['sid']));?>">商品信息</a>
								</td>
							</tr>
						<?php  } } ?>
					<?php  } ?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>