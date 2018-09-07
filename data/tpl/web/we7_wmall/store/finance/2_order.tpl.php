<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./wmerchant.php" class="form-horizontal form-log">
	<?php  echo tpl_form_filter_hidden('store/finance/order/log');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if(!$status) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">所有订单</a>
				<a href="<?php  echo ifilter_url('status:5');?>" class="btn <?php  if($status == 5) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已完成</a>
				<a href="<?php  echo ifilter_url('status:6');?>" class="btn <?php  if($status == 6) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已取消</a>
				<a href="<?php  echo ifilter_url('status:7');?>" class="btn <?php  if($status == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">进行中</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">创建时间</label>
		<div class="col-sm-9 col-xs-12">
			<div class="js-daterange" data-form=".form-log">
				<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
			</div>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover table-bordered">
				<thead class="navbar-inner">
				<tr>
					<th colspan="5"></th>
					<th colspan="3" class="text-center">应收金额</th>
					<th colspan="3" class="text-center">应付金额</th>
					<th colspan="2"></th>
				</tr>
				<tr>
					<th>订单序号</th>
					<th>订单编号</th>
					<th>下单时间</th>
					<th>订单状态</th>
					<th>订单类型</th>
					<th>订单总金额</th>
					<th>用户支付</th>
					<th>补贴(平台)</th>
					<th>补贴(商家)</th>
					<th>平台服务费</th>
					<th>平台配送费</th>
					<th>实际到账</th>
					<th style="width:150px; text-align:right;">详情</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($records)) { foreach($records as $record) { ?>
				<tr>
					<td><strong>#<?php  echo $record['serial_sn'];?></strong></td>
					<td><?php  echo $record['ordersn'];?></td>
					<td>
						<?php  echo date('Y-m-d', $record['addtime']);?>
						<br/>
						<?php  echo date('H:i:s', $record['addtime']);?>
					</td>
					<td>
						<span class="<?php  echo $order_status[$record['status']]['css'];?>">
							<?php  echo $order_status[$record['status']]['text'];?>
						</span>
					</td>
					<td>
						<span class="<?php  echo $order_type[$record['order_type']]['css'];?>">
							<?php  echo $order_type[$record['order_type']]['text'];?>
						</span>
					</td>
					<td>￥<?php  echo $record['total_fee'];?></td>
					<td><span class="text-success">+￥<?php  echo $record['final_fee'];?></span></td>
					<td><span class="text-success">+￥<?php  echo $record['plateform_discount_fee'];?></span></td>
					<td><span class="text-danger">-￥<?php  echo $record['store_discount_fee'];?></span></td>
					<td><span class="text-danger">-￥<?php  echo $record['plateform_serve_fee'];?></span></td>
					<td><span class="text-danger">-￥<?php  echo $record['plateform_delivery_fee'];?></span></td>
					<td>
						<?php  if($record['status'] == 5) { ?>
						<strong class="text-success" data-toggle="popover" data-placement="left" data-content="收益已到账">￥<?php  echo $record['store_final_fee'];?></strong>
						<?php  } else if($record['status'] == 6) { ?>
						<del class="text-danger" data-toggle="popover" data-placement="left" data-content="订单取消,实际收益为0">￥<?php  echo $record['store_final_fee'];?></del>
						<strong class="text-danger">/￥0</strong>
						<?php  } else { ?>
						<strong class="text-primary" data-toggle="popover" data-placement="left" data-content="订单正在进行中,完成后收益将打入您的账户">￥<?php  echo $record['store_final_fee'];?></strong>
						<?php  } ?>
					</td>
					<td style="text-align:right;">
						<a href="<?php  echo iurl('store/order/takeout/detail', array('id' => $record['id']))?>" class="btn btn-default btn-sm" title="查看订单" data-toggle="tooltip" data-placement="top" target="_blank">查看订单</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
	</div>
</form>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>