<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('deliveryer/current/list');?>
	<input type="hidden" name="days" value="<?php  echo $days;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('trade_type:0');?>" class="btn <?php  if($trade_type == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">全部</a>
				<a href="<?php  echo ifilter_url('trade_type:1');?>" class="btn <?php  if($trade_type == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">订单入账</a>
				<a href="<?php  echo ifilter_url('trade_type:2');?>" class="btn <?php  if($trade_type == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">申请提现</a>
				<a href="<?php  echo ifilter_url('trade_type:3');?>" class="btn <?php  if($trade_type == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">其他变动</a>
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
			<select name="deliveryer_id" class="form-control select2" >
				<option value="0" <?php  if(!$sid) { ?>selected<?php  } ?>>==选择配送员==</option>
				<?php  if(is_array($deliveryers)) { foreach($deliveryers as $deliveryer) { ?>
					<option value="<?php  echo $deliveryer['id'];?>" <?php  if($deliveryer_id == $deliveryer['id']) { ?>selected<?php  } ?>><?php  echo $deliveryer['title'];?></option>
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
						<th>时间</th>
						<?php  if($_W['is_agent']) { ?>
							<th>所属城市</th>
						<?php  } ?>
						<th>配送员</th>
						<th>微信昵称</th>
						<th>类型</th>
						<th>收入|支出(元)</th>
						<th>账户余额</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($records)) { foreach($records as $record) { ?>
					<tr>
						<td><?php  echo date('Y-m-d H:i', $record['addtime']);?></td>
						<?php  if($_W['is_agent']) { ?>
							<td><?php  echo toagent($record['agentid'])?></td>
						<?php  } ?>
						<td>
							<img src="<?php  echo $deliveryers[$record['deliveryer_id']]['avatar'];?>" alt="" width="50" height="50" style="border-radius: 100%"/>
							<?php  echo $deliveryers[$record['deliveryer_id']]['title'];?>
						</td>
						<td><?php  echo $deliveryers[$record['deliveryer_id']]['nickname'];?></td>
						<td>
							<span class="<?php  echo $order_trade_type[$record['trade_type']]['css'];?>"><?php  echo $order_trade_type[$record['trade_type']]['text'];?></span>
						</td>
						<td>
							<span <?php  if(!empty($record['remark'])) { ?>data-toggle="popover" title="交易备注" data-content="<?php  echo $record['remark'];?>"<?php  } ?>>
							<?php  if($record['fee'] > 0) { ?>
								<strong class="text-success">+<?php  echo $record['fee'];?>元</strong>
							<?php  } else { ?>
								<strong class="text-danger"><?php  echo $record['fee'];?>元</strong>
							<?php  } ?>
							<?php  if(!empty($record['remark'])) { ?>
								<i class="fa fa-question-circle"></i>
							<?php  } ?>
							</span>
						</td>
						<td>
							<strong><?php  echo $record['amount'];?>元</strong>
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
