<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('merchant/getcash/list');?>
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
			<?php  if($_W['is_agent']) { ?>
				<select name="agentid" class="select2 js-select2 form-control width-130">
					<option value="0">选择代理区域</option>
					<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
					<?php  } } ?>
				</select>
			<?php  } ?>
			<select name="sid" class="form-control select2" >
				<option value="0" <?php  if(!$sid) { ?>selected<?php  } ?>>==选择门店==</option>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<option value="<?php  echo $store['id'];?>" <?php  if($sid == $store['id']) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th>申请时间|订单号</th>
						<th>门店</th>
						<?php  if($_W['is_agent']) { ?>
							<th>所属城市</th>
						<?php  } ?>
						<th>账户</th>
						<th>提现金额</th>
						<th>手续费</th>
						<th>到账金额</th>
						<th>处理状态</th>
						<th style="width: 300px; text-align: right;">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($records)) { foreach($records as $record) { ?>
						<tr>
							<td>
								<?php  echo date('Y-m-d H:i', $record['addtime']);?>
								<br>
								<?php  echo $record['trade_no'];?>
							</td>
							<td><?php  echo $stores[$record['sid']]['title'];?></td>
							<?php  if($_W['is_agent']) { ?>
								<td><?php  echo toagent($record['agentid'])?></td>
							<?php  } ?>
							<td>
								<img src="<?php  echo $record['account']['avatar'];?>" width="50" alt=""/>
								<br>
								<span class="label label-info label-br">昵称:<?php  echo $record['account']['nickname'];?></span>
								<br>
								<span class="label label-info label-br">姓名:<?php  echo $record['account']['realname'];?></span>
							</td>
							<td><?php  echo $record['get_fee'];?>元</td>
							<td><?php  echo $record['take_fee'];?>元</td>
							<td><?php  echo $record['final_fee'];?>元</td>
							<td>
								<?php  if($record['status'] == 2) { ?>
									<span class="label label-danger">申请中</span>
								<?php  } else if($record['status'] == 1) { ?>
									<span class="label label-success">提现成功</span>
									<br>
									<span class="label label-info label-br">处理完成时间: <?php  echo date('Y-m-d H:i', $record['endtime'])?></span>
								<?php  } else if($record['status'] == 3) { ?>
									<span class="label label-warning">已撤销</span>
									<br>
									<span class="label label-info label-br">处理完成时间: <?php  echo date('Y-m-d H:i', $record['endtime'])?></span>
								<?php  } ?>
							</td>
							<td align="right">
								<?php  if($record['status'] == 2) { ?>
									<a href="<?php  echo iurl('merchant/getcash/transfers', array('id' => $record['id']));?>" data-confirm="确定微信打款吗" class="btn btn-primary btn-sm js-post">微信打款</a>
									<a href="<?php  echo iurl('merchant/getcash/status', array('id' => $record['id'], 'status' => 1));?>" data-confirm="确定变更提现状态吗" class="btn btn-default btn-sm js-post">设为已处理</a>
									<a href="<?php  echo iurl('merchant/getcash/cancel', array('id' => $record['id']));?>" class="btn btn-danger btn-sm js-modal">撤销</a>
								<?php  } ?>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
