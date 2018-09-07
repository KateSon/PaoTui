<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php?" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('deliveryCard/order/list');?>
	<input type="hidden" name="setmeal_id" value="<?php  echo $setmeal_id;?>"/>
	<input type="hidden" name="paytime" value="<?php  echo $paytime;?>"/>
	<input type="hidden" name="endtime" value="<?php  echo $endtime;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">套餐类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('setmeal_id:-1');?>" class="btn <?php  if($setmeal_id == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<?php  if(is_array($cards)) { foreach($cards as $card) { ?>
					<a href="<?php  echo ifilter_url('setmeal_id:' . $card['id']);?>" class="btn <?php  if($setmeal_id == $card['id']) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>"><?php  echo $card['title'];?></a>
				<?php  } } ?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">套餐购买时间</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('paytime:-1');?>" class="btn <?php  if($paytime == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('paytime:7');?>" class="btn <?php  if($paytime == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一周内</a>
				<a href="<?php  echo ifilter_url('paytime:15');?>" class="btn <?php  if($paytime == 15) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">半月内</a>
				<a href="<?php  echo ifilter_url('paytime:31');?>" class="btn <?php  if($paytime == 31) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一月内</a>
				<a href="<?php  echo ifilter_url('paytime:93');?>" class="btn <?php  if($paytime == 93) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三月内</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">套餐状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('status:-1');?>" class="btn <?php  if($status == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未到期</a>
				<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已到期</a>
			</div>
		</div>
	</div>
	<?php  if($status == 1) { ?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">套餐到期时间</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('endtime:-1');?>" class="btn <?php  if($endtime == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('endtime:7');?>" class="btn <?php  if($endtime == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一周内</a>
				<a href="<?php  echo ifilter_url('endtime:15');?>" class="btn <?php  if($endtime == 15) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">半月内</a>
				<a href="<?php  echo ifilter_url('endtime:31');?>" class="btn <?php  if($endtime == 31) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一月内</a>
				<a href="<?php  echo ifilter_url('endtime:93');?>" class="btn <?php  if($endtime == 93) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三月内</a>
			</div>
		</div>
	</div>
	<?php  } ?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">顾客信息</label>
		<div class="col-sm-9 col-xs-12">
			<input class="form-control" name="keyword" placeholder="输入用户名或手机号" type="text" value="<?php  echo $_GPC['keyword'];?>">
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
					<th>头像</th>
					<th>姓名</th>
					<th>购买套餐</th>
					<th>费用</th>
					<th>支付方式</th>
					<th>套餐开始时间</th>
					<th>套餐结束时间</th>
					<th>购买时间</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
				<tr>
					<td><img src="<?php  echo tomedia($users[$order['uid']]['avatar']);?>" alt="" width="50"/></td>
					<td><?php  echo $users[$order['uid']]['realname'];?></td>
					<td>
						<span class="label label-info">
							<?php  echo $cards[$order['card_id']]['title'];?>
						</span>
					</td>
					<td><?php  echo $order['final_fee'];?>元</td>
					<td>
						<span class="<?php  echo $pay_types[$order['pay_type']]['css'];?>"><?php  echo $pay_types[$order['pay_type']]['text'];?></span>
					</td>
					<td>
						<span class="label label-danger">
							<?php  echo date('Y-m-d', $order['starttime']);?>
						</span>
					</td>
					<td>
						<span class="label label-success">
							<?php  echo date('Y-m-d', $order['endtime']);?>
						</span>
						<?php  if($order['endtime'] <= time()) { ?>
							<br/>
							<span class="label label-warning label-br">已到期</span>
						<?php  } ?>
					</td>
					<td>
						<?php  echo date('Y-m-d', $order['paytime']);?>
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