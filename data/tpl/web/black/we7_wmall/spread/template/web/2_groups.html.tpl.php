<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>

<?php  if($op == 'post') { ?>
<!-- 添加页面 -->
<div class="page clearfix">
	<h2>编辑推广员等级</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">等级名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $ad['title'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">一级佣金比例</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="commission1" value="<?php  echo $ad['commission1'];?>">
					<span class="input-group-addon js-random">%</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">二级级佣金比例</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="commission2" value="<?php  echo $ad['commission2'];?>">
					<span class="input-group-addon js-random">%</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">升级条件</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">
						<?php  if($config['group_update_mode'] == 'order_money') { ?>
							推广订单总额满
						<?php  } else if($config['group_update_mode'] == 'order_money_1') { ?>
							一级推广订单金额满
						<?php  } else if($config['group_update_mode'] == 'order_count') { ?>
							推广订单总数满
						<?php  } else if($config['group_update_mode'] == 'order_count_1') { ?>
							一级推广订单总数满
						<?php  } else if($config['group_update_mode'] == 'self_order_money') { ?>
							自购订单金额满
						<?php  } else if($config['group_update_mode'] == 'self_order_count') { ?>
							自购订单数量满
						<?php  } else if($config['group_update_mode'] == 'down_count') { ?>
							下线总人数满
						<?php  } else if($config['group_update_mode'] == 'down_count_1') { ?>
							一级总人数满
						<?php  } ?>
					</span>
					<input type="number" class="form-control" name="group_condition" value="<?php  echo $ad['group_condition'];?>" digits="true">
					<span class="input-group-addon">
						<?php  if($config['group_update_mode'] == 'order_money' || $config['group_update_mode'] == 'order_money_1' || $config['group_update_mode'] == 'self_order_money') { ?>
							元
						<?php  } else if($config['group_update_mode'] == 'order_count' || $config['group_update_mode'] == 'order_count_1' || $config['group_update_mode'] == 'self_order_count') { ?>
							单
						<?php  } else if($config['group_update_mode'] == 'down_count' || $config['group_update_mode'] == 'down_count_1') { ?>
							人
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
<?php  } else { ?>
<!-- 首页 -->
<form action="" class="form-table">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('spread/groups/post');?>" class="btn btn-primary btn-sm">添加推广员等级</a>
		</div>
		<div class="alert alert-info">推广员等级的升级条件请在基本设置中选择。 <a href="<?php  echo iurl('spread/config')?>" target="_blank">立即设置</a></div>
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
						<th>一级佣金比例</th>
						<th>二级佣金比例</th>
						<th>升级条件</th>
						<th class="text-right">操作</th>
					</tr>
				</thead>
					<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
					<tr>
						<td><?php  echo $group['id'];?></td>
						<td><?php  echo $group['title'];?></td>
						<td><?php  echo $group['commission1'];?>%</td>
						<td><?php  echo $group['commission2'];?>%</td>	
						<td>
							<?php  if($config['group_update_mode'] == 'order_money') { ?>
								推广订单总额满
							<?php  } else if($config['group_update_mode'] == 'order_money_1') { ?>
								一级推广订单金额满
							<?php  } else if($config['group_update_mode'] == 'order_count') { ?>
								推广订单总数满
							<?php  } else if($config['group_update_mode'] == 'order_count_1') { ?>
								一级推广订单总数满
							<?php  } else if($config['group_update_mode'] == 'self_order_money') { ?>
								自购订单金额满
							<?php  } else if($config['group_update_mode'] == 'self_order_count') { ?>
								自购订单数量满
							<?php  } else if($config['group_update_mode'] == 'down_count') { ?>
								下线总人数满
							<?php  } else if($config['group_update_mode'] == 'down_count_1') { ?>
								一级总人数满
							<?php  } ?>
							<?php  echo $group['group_condition'];?>
							<?php  if($config['group_update_mode'] == 'order_money' || $config['group_update_mode'] == 'order_money_1' || $config['group_update_mode'] == 'self_order_money') { ?>
								元
							<?php  } else if($config['group_update_mode'] == 'order_count' || $config['group_update_mode'] == 'order_count_1' || $config['group_update_mode'] == 'self_order_count') { ?>
								单
							<?php  } else if($config['group_update_mode'] == 'down_count' || $config['group_update_mode'] == 'down_count_1') { ?>
								人
							<?php  } ?>
						</td>
						<td class="text-right">
							<a href="<?php  echo iurl('spread/groups/post', array('id' => $group['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" >编辑</a>
							<a href="<?php  echo iurl('spread/groups/del', array('id' => $group['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该推广员?">删除</a>
						</td>
					</tr>
					<?php  } } ?>
			</table>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
