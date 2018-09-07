<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" method="get" class="form-horizontal form-filter" role="form">
	<input type="hidden" name="c" value="site">
	<input type="hidden" name="a" value="entry">
	<input type="hidden" name="m" value="we7_wmall">
	<input type="hidden" name="do" value="web"/>
	<input type="hidden" name="ctrl" value="store"/>
	<input type="hidden" name="ac" value="report"/>
	<input type="hidden" name="op" value="list"/>
	<input type="hidden" name="status" value="<?php  echo $status;?>"/>
	<input type="hidden" name="addtime" value="<?php  echo $addtime;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('status:-1');?>" class="btn <?php  if($status == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已处理</a>
				<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未处理</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('addtime:-1');?>" class="btn <?php  if($addtime == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('addtime:7');?>" class="btn <?php  if($addtime == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一周内</a>
				<a href="<?php  echo ifilter_url('addtime:15');?>" class="btn <?php  if($addtime == 15) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">半月内</a>
				<a href="<?php  echo ifilter_url('addtime:31');?>" class="btn <?php  if($addtime == 31) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一月内</a>
				<a href="<?php  echo ifilter_url('addtime:93');?>" class="btn <?php  if($addtime == 93) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三月内</a>
			</div>
		</div>
	</div>
</form>

<form class="form-table " action="" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>投诉商家</th>
					<th>投诉人手机号</th>
					<th width="400">投诉内容</th>
					<th>处理状态</th>
					<th>投诉时间</th>
					<th class="text-right">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($reports)) { foreach($reports as $report) { ?>
				<tr>
					<td>
						<?php  if(!empty($stores[$report['sid']]['title'])) { ?>
							<?php  echo $stores[$report['sid']]['title'];?>
						<?php  } else { ?>
							商家不存在或已删除
						<?php  } ?>
					</td>
					<td><?php  echo $report['mobile'];?></td>
					<td>
						<span class="label label-danger" style="cursor: pointer" data-toggle="popover" title="投诉详情" data-content="<?php  echo $report['note'];?>">
							<?php  echo $report['title'];?>
						</span>
						<?php  if(!empty($report['thumbs'])) { ?>
						<div style="margin-top: 10px;">
							<?php  if(is_array($report['thumbs'])) { foreach($report['thumbs'] as $thumb) { ?>
							<img src="<?php  echo tomedia($thumb);?>" data-toggle="popover" data-html="true" data-placement="bottom" data-content='<img src="<?php  echo tomedia($thumb);?>">' alt="" width="80" height="80"/>
							<?php  } } ?>
						</div>
						<?php  } ?>
					</td>
					<td>
						<?php  if($report['status'] == 1) { ?>
							<span class="label label-success">
								已处理
							</span>
						<?php  } else { ?>
							<span class="label label-danger">
								未处理
							</span>
						<?php  } ?>
					</td>
					<td>
						<span class="label label-info">
							<?php  echo date('Y-m-d H:i', $report['addtime']);?>
						</span>
					</td>
					<td class="text-right">
						<a href="<?php  echo iurl('merchant/report/status', array('status' => 1, 'id' => $report['id']));?>" class="btn btn-default js-post" data-confirm="确定设为已处理吗?">设为已处理</a>
						<a href="<?php  echo iurl('merchant/report/status', array('status' => 0, 'id' => $report['id']));?>" class="btn btn-default js-post" data-confirm="确定设为未处理吗?">设为未处理</a>
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