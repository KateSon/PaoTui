<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>

<?php  if($op == 'index') { ?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('spread/getcash/index');?>
	<input type="hidden" name="days" value="<?php  echo $days;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">提现状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">全部</a>
				<a href="<?php  echo ifilter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">申请中</a>
				<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">提现成功</a>
				<a href="<?php  echo ifilter_url('status:3');?>" class="btn <?php  if($status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已撤销</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">申请时间</label>
		<div class="col-sm-9 col-xs-12 js-daterange" data-form="#form1">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('days:-2');?>" class="btn <?php  if($days == -2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('days:7');?>" class="btn <?php  if($days == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近一周</a>
				<a href="<?php  echo ifilter_url('days:30');?>" class="btn <?php  if($days == 30) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近一月</a>
				<a href="<?php  echo ifilter_url('days:90');?>" class="btn <?php  if($days == 90) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近三月</a>
				<a href="javascript:;" class="btn js-btn-custom <?php  if($days == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">自定义</a>
			</div>
			<span class="js-btn-daterange <?php  if($days != -1) { ?>hide<?php  } ?>">
				<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
			</span>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-9 col-xs-12">
			<input type="text" name="keywords" value="<?php  echo $_GPC['keywords'];?>" class="form-control" placeholder="姓名/手机号"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-3 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<?php  if(empty($records)) { ?>
			<div class="no-result">
				<p>还没有相关数据</p>
			</div>
		<?php  } else { ?>
			<div class="panel-body table-responsive js-table">
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th>申请时间|订单号</th>
							<th>会员</th>
							<th>提现路径</th>
							<th>提现金额</th>
							<th>手续费</th>
							<th>实际到账</th>
							<th>交易状态</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($records)) { foreach($records as $item) { ?>
						<tr>
							<td>
								<?php  echo date('Y-m-d H:i:s', $item['addtime'])?>
								<br>
								<?php  echo $item['trade_no'];?>
							</td>
							<td>
								<img src="<?php  echo tomedia($item['avatar'])?>" alt="" width="50px" hegiht="50px" style="border-radius: 100%;">
								<?php  echo $item['realname'];?>
							</td>
							<td>
								<span class="<?php  echo spread_getcash_type($item['channel'], css)?>"><?php  echo spread_getcash_type($item['channel'], text)?></span>
							</td>
							<td><?php  echo $item['get_fee'];?>元</td>
							<td><?php  echo $item['take_fee'];?>元</td>
							<td><?php  echo $item['final_fee'];?>元</td>
							<td>
								<?php  if($item['status'] == 2) { ?>
									<span class="label label-danger">申请中</span>
								<?php  } else if($item['status'] == 1) { ?>
									<span class="label label-success">提现成功</span>
									<br>
									<span class="label label-info label-br">处理完成时间: <?php  echo date('Y-m-d H:i', $item['endtime'])?></span>
								<?php  } else if($item['status'] == 3) { ?>
									<span class="label label-warning">已撤销</span>
									<br>
									<span class="label label-info label-br">处理完成时间: <?php  echo date('Y-m-d H:i', $item['endtime'])?></span>
								<?php  } ?>
							</td>
							<td align="right">
								<?php  if($item['status'] == 2) { ?>
									<?php  if($item['channel'] == 'wechat') { ?>
									<a href="<?php  echo iurl('spread/getcash/transfers', array('id' => $item['id']));?>" data-confirm="确定微信打款吗?" class="btn btn-primary btn-sm js-post">微信打款</a>
									<?php  } else if($item['channel'] == 'credit') { ?>
									<a href="<?php  echo iurl('spread/getcash/balance', array('id' => $item['id']));?>" data-confirm="确定转到余额吗?" class="btn btn-primary btn-sm js-post">转到余额</a>
									<?php  } ?>
									<a href="<?php  echo iurl('spread/getcash/status', array('id' => $item['id'] , 'status' => 1))?>" data-confirm="确定变更提现状态吗?" class="btn btn-default btn-sm js-post">设为已处理</a>
									<a href="<?php  echo iurl('spread/getcash/cancel', array('id' => $item['id']));?>" class="btn btn-danger btn-sm js-modal">撤销</a>
								<?php  } ?>
							</td>
						</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<?php  echo $pager;?>
			</div>
		<?php  } ?>
	</div>
</form>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>