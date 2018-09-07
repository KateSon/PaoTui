<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'index') { ?>
	<form action="" class="form-table">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('member/groups/post');?>" class="btn btn-primary btn-sm">添加顾客等级</a>
		</div>
		<div class="alert alert-info">顾客等级的升级条件请在设置中选择。 <a href="<?php  echo iurl('config/member')?>" target="_blank">立即设置</a></div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($groups)) { ?>
			<div class="no-result">
				<p>还没有相关数据</p>
			</div>
			<?php  } else { ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>名称</th>
						<th>升级条件</th>
						<th class="text-right">操作</th>
					</tr>
				</thead>
					<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
					<tr>
						<td><?php  echo $group['id'];?></td>
						<td><?php  echo $group['title'];?></td>
						<td>
							<?php  if($config == 'order_money') { ?>
								外卖订单消费总额满
							<?php  } else if($config == 'order_count') { ?>
								外卖订单消费次数满
							<?php  } else if($config == 'delivery_money') { ?>
								跑腿订单消费总额满
							<?php  } else if($config == 'delivery_count') { ?>
								跑腿订单消费次数满
							<?php  } else if($config == 'count_money') { ?>
								外卖订单和跑腿订单消费总额满
							<?php  } ?>
							<?php  echo $group['group_condition'];?>
							<?php  if($config == 'order_money' || $config == 'delivery_money' || $config == 'count_money') { ?>
								元
							<?php  } else { ?>
								次
							<?php  } ?>
						</td>
						<td class="text-right">
							<a href="<?php  echo iurl('member/groups/post', array('id' => $group['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" >编辑</a>
							<a href="<?php  echo iurl('member/groups/del', array('id' => $group['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该等级?">删除</a>
						</td>
					</tr>
					<?php  } } ?>
			</table>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div class="page clearfix">
	<h2>编辑顾客等级</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">等级名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $group['title'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">升级条件</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">
						<?php  if($config == 'order_money') { ?>
							外卖订单消费总额满
						<?php  } else if($config == 'order_count') { ?>
							外卖订单消费次数满
						<?php  } else if($config == 'delivery_money') { ?>
							跑腿订单消费总额满
						<?php  } else if($config == 'delivery_count') { ?>
							跑腿订单消费次数满
						<?php  } else if($config == 'count_money') { ?>
							外卖订单和跑腿订单消费总额满
						<?php  } ?>
					</span>
					<input type="text" class="form-control" name="group_condition" value="<?php  echo $group['group_condition'];?>">
					<span class="input-group-addon">
						<?php  if($config == 'order_money' || $config == 'delivery_money' || $config == 'count_money') { ?>
							元
						<?php  } else { ?>
							次
						<?php  } ?>
					</span>
				</div>
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
<?php  } ?>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>