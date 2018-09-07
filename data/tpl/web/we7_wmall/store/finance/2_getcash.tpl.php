<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'index') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"></span>可提现金额</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static"><strong class="money greenest" style="font-size: 20px"><?php  echo $account['amount'];?> </strong> 元</p>
				<?php  if($account['amount'] < $account['fee_limit']) { ?>
					<div class="help-block">
						<strong class="text-danger">当前账户余额小于最低提现金额(<?php  echo $account['fee_limit'];?>元)限制,不能提现</strong>
					</div>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">提现账户</label>
			<div class="col-sm-12 col-lg-6">
				<?php  if(empty($account['wechat'])) { ?>
					<p class="form-control-static">
						<a href="<?php  echo iurl('store/finance/getcash/account');?>">完善提现账户</a>
					</p>
				<?php  } else { ?>
					<p class="form-control-static account" style="font-size: 20px" id="wechat-account">
						微信账号: <img src="<?php  echo $account['wechat']['avatar'];?>" width="50" alt=""/> 真实姓名: <strong><?php  echo $account['wechat']['realname'];?></strong> | 昵称: <strong><?php  echo $account['wechat']['nickname'];?></strong>
						<br>
						<a href="<?php  echo iurl('store/finance/getcash/account');?>">更改提现账户</a>
					</p>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"></span>提现金额</label>
			<div class="col-sm-12 col-lg-6">
				<div class="input-group">
					<input type="number" name="get_fee" value="<?php  echo $config['get_fee'];?>" class="form-control" id="get-fee"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block" id="get-fee-info" style="color: #FF5A5A"></div>
				<div class="help-block">
					<strong>提现金额必须是整数</strong>
					<br>
					<strong>最低提现金额: <?php  echo $account['fee_limit'];?>元</strong>
					<br>
					<strong>服务费收费标准: <?php  echo $account['fee_rate'];?>%每笔，最低收取:<?php  echo $account['fee_min'];?>元 <?php  if($account['fee_max'] > 0) { ?>，最高收取:<?php  echo $account['fee_max'];?>元<?php  } ?></strong>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"></span>手续费</label>
			<div class="col-sm-12 col-lg-6">
				<div class="input-group">
					<input type="number" readonly name="take_fee" value="0" class="form-control" id="take-fee"/>
					<span class="input-group-addon">元</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"></span>实际到账金额</label>
			<div class="col-sm-12 col-lg-6">
				<div class="input-group">
					<input type="text" readonly name="final_fee" value="0" class="form-control" id="final-fee"/>
					<span class="input-group-addon">元</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary" disabled="disabled">
			</div>
		</div>
	</form>
</div>
<script>
$(function(){
	$('#get-fee').keyup(function(){
		$('#get-fee-info').html('');
		$('#final-fee').val(0);
		var take_fee = 0;
		var amount = "<?php  echo $account['amount'];?>";
		var fee_rate = "<?php  echo $account['fee_rate'];?>";
		var fee_limit = "<?php  echo $account['fee_limit'];?>";
		var fee_max = "<?php  echo $account['fee_max'];?>";
		var fee_min = "<?php  echo $account['fee_min'];?>";
		var reg = /^[1-9]\d*$/;
		if(!reg.test($(this).val())) {
			$('form').attr('stop',1);
			$('#get-fee-info').html('提现金额必须是整数');
			return false;
		}
		var get_fee = parseInt($(this).val());
		if(get_fee > 0) {
			if(get_fee > amount) {
				$('form').attr('stop',1);
				$('#get-fee-info').html('超出账户可用余额');
				return false;
			}
			if(get_fee < fee_limit) {
				$('form').attr('stop',1);
				$('#get-fee-info').html('提现金额低于最低提现金额');
				return false;
			}
			take_fee = (get_fee * (fee_rate / 100)).toFixed(2);
			take_fee = Math.max(take_fee, fee_min);
			if(fee_max > 0) {
				take_fee = Math.min(take_fee, fee_max);
			}
			$('#take-fee').val(take_fee);
			var final_fee = get_fee - take_fee;
			if(final_fee < 0 ) {
				final_fee = 0;
			}
			$('#final-fee').val(final_fee);
			$('input[type="submit"]').removeAttr('disabled');
		}
	});

	$('#form1').submit(function(){
		var get_fee = parseInt($('#get-fee').val());
		if(!get_fee) {
			$('form').attr('stop',1);
			Notify.info('请输入提现金额');
			return false;
		}
		$('form').attr('stop',0);
	});
});
</script>
<?php  } ?>

<?php  if($ta == 'account') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">微信昵称</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_fans('wechat', array('openid' => $account['wechat']['openid'], 'nickname' => $account['wechat']['nickname'], 'avatar' => $account['wechat']['avatar']), true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="wechat[realname]" value="<?php  echo $account['wechat']['realname'];?>" class="form-control" placeholder="微信实名认证姓名" required="true"/>
				<div class="help-block">请仔细填写账户信息，如果由于您填写错误导致资金流失，平台概不负责</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<script>
$(function(){
	$('#form-account').submit(function(){
		if(!$.trim($('input[name="wechat[openid]"]').val())) {
			util.message('微信昵称不能为空');
			return false;
		}
		if(!$.trim($(':text[name="wechat[realname]"]').val())) {
			util.message('微信实名认证姓名不能为空');
			return false;
		}
		return true;
	});
});
</script>
<?php  } ?>

<?php  if($ta == 'log') { ?>
<form action="./wmerchant.php" class="form-horizontal form-log">
	<?php  echo tpl_form_filter_hidden('store/finance/getcash/log');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">提现状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">申请中</a>
				<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">提现成功</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
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
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>申请时间|订单号</th>
					<th>账户</th>
					<th>提现金额</th>
					<th>手续费</th>
					<th>到账金额</th>
					<th>交易状态</th>
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
							<span class="label label-info label-br">完成时间: <?php  echo date('Y-m-d H:i', $record['endtime'])?></span>
						<?php  } else if($record['status'] == 3) { ?>
							<span class="label label-warning">已取消</span>
							<br>
							<span class="label label-info label-br">取消时间: <?php  echo date('Y-m-d H:i', $record['endtime'])?></span>
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