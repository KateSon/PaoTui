<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('superRedpacket/share/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="请输入超级红包标题或关键字进行搜索">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('superRedpacket/share/post');?>" class="btn btn-primary btn-sm">新建分享红包</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($activitys)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="navbar-inner">
					<tr>
						<th>红包名称</th>
						<th>分享条件</th>
						<th>活动状态</th>
						<th>活动时间</th>
						<th style="width:350px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
						<?php  if(is_array($activitys)) { foreach($activitys as $activity) { ?>
							<tr>
								<td><?php  echo $activity['name'];?></td>
								<td>满<?php  echo floatval($activity['condition'])?>元</td>
								<td>
									<?php  if(empty($activity['status'])) { ?>
										活动未开始或已结束
									<?php  } else if($activity['status'] == 1) { ?>
										活动已生效
									<?php  } else if($activity['status'] == 2) { ?>
										活动已撤销
									<?php  } else { ?>
										活动未开始或已结束
									<?php  } ?>
								</td>
								<td><?php  echo date('Y-m-d', $activity['starttime'])?>~<?php  echo date('Y-m-d', $activity['endtime'])?></td>
								<td style="text-align:right;">
									<a href="<?php  echo iurl('superRedpacket/share/records', array('activity_id' => $activity['id']))?>" class="btn btn-info btn-sm">分享记录</a>
									<a href="<?php  echo iurl('superRedpacket/share/redpackets', array('activity_id' => $activity['id']))?>" class="btn btn-warning btn-sm">红包列表</a>
									<?php  if($activity['status'] == 1) { ?>
										<a href="<?php  echo iurl('superRedpacket/share/cancel', array('id' => $activity['id']))?>" class="btn btn-default btn-sm js-post" data-confirm="确定要撤销吗？">撤销</a>
									<?php  } ?>
									<a href="<?php  echo iurl('superRedpacket/share/post', array('id' => $activity['id']))?>" class="btn btn-default btn-sm">查看</a>
									<a href="<?php  echo iurl('superRedpacket/share/del', array('id' => $activity['id']))?>" class="btn btn-default btn-sm js-post" data-confirm="删除后不可恢复，确定删除吗？">删除</a>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
