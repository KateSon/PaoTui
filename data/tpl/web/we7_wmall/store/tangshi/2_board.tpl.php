<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'board_list') { ?>
<form action="" class="form-table form form-validate" method="post">
<div class="board">
	<?php  if(empty($data)) { ?>
	<div class="no-result">
		<p>还没有队列</p>
	</div>
	<?php  } else { ?>
		<?php  if(is_array($data)) { foreach($data as $key => $da) { ?>
		<?php  $i = $key%5;?>
		<a class="list <?php  echo $colors[$i];?>" href="<?php  echo iurl('store/tangshi/assign/board_detail', array('id' => $da['id']));?>">
			<div class="name">当前排队人数：<?php  echo intval($wait[$da['id']]['num']);?></div>
			<div class="status"><?php  echo $da['title'];?></div>
		</a>
		<?php  } } ?>
	<?php  } ?>
</div>
</form>
<?php  } ?>

<?php  if($ta == 'board_detail') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('store/tangshi/assign/board_detail', array('id' => $queue_id, 'status' => -1));?>" class="btn btn-default btn-sm">所有</a>
			<a href="<?php  echo iurl('store/tangshi/assign/board_detail', array('id' => $queue_id, 'status' => 1));?>" class="btn btn-primary btn-sm">排队中</a>
			<a href="<?php  echo iurl('store/tangshi/assign/board_detail', array('id' => $queue_id, 'status' => 2));?>" class="btn btn-success btn-sm">已入号</a>
			<a href="<?php  echo iurl('store/tangshi/assign/board_detail', array('id' => $queue_id, 'status' => 3));?>" class="btn btn-danger btn-sm">已取消</a>
			<a href="<?php  echo iurl('store/tangshi/assign/board_detail', array('id' => $queue_id, 'status' => 4));?>" class="btn btn-warning btn-sm">已过号</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>号码</th>
					<th>状态</th>
					<th>是否通知</th>
					<th>电话</th>
					<th>客人数量</th>
					<th>排队时间</th>
					<th width="350" style="text-align: right">操作</th>
				</tr>
				</thead>
				<?php  if(is_array($data)) { foreach($data as $da) { ?>
				<tr>
					<td><?php  echo $da['number'];?></td>
					<td><span class="<?php  echo $colors[$da['status']]['css'];?>"><?php  echo $colors[$da['status']]['text'];?></span></td>
					<td>
						<?php  if($da['is_notify']) { ?>
						<span class="label label-success">已通知</span>
						<?php  } else { ?>
						<span class="label label-danger">未通知</span>
						<?php  } ?>
					</td>
					<td><?php  echo $da['mobile'];?></td>
					<td><?php  echo $da['guest_num'];?></td>
					<td><?php  echo date('Y-m-d H:i', $da['createtime']);?></td>
					<td style="overflow:visible;" align="right">
						<a href="<?php  echo iurl('store/tangshi/assign/board_status', array('id' => $da['id'], 'status' => 2))?>" class="js-post btn btn-success btn-sm" data-confirm="确定接受吗?">接受</a>
						<a href="<?php  echo iurl('store/tangshi/assign/board_status', array('id' => $da['id'], 'status' => 3))?>" class="js-post btn btn-warning btn-sm" data-confirm="确定过号吗?">过号</a>
						<a href="<?php  echo iurl('store/tangshi/assign/board_status', array('id' => $da['id'], 'status' => 4))?>" class="js-post btn btn-danger btn-sm" data-confirm="确定取消吗?">取消</a>
						<a href="<?php  echo iurl('store/tangshi/assign/board_post', array('id' => $da['id']))?>" class="btn btn-default">编辑</a>
						<a href="<?php  echo iurl('store/tangshi/assign/board_notity', array('id' => $da['id'], 'status' => $da['status']))?>" class="btn btn-default js-post" data-confirm="确定通知吗?">通知</a>
					</td>
				</tr>
				<?php  } } ?>
			</table>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($ta == 'board_post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>号码</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" class="form-control" name="number" placeholder="" value="<?php  echo $item['number'];?>">
				<span class="help-block"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>手机</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" class="form-control" name="mobile" placeholder="" value="<?php  echo $item['mobile'];?>" required="true">
				<span class="help-block"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>客人数量</label>
			<div class="col-sm-6 col-xs-6">
				<input type="number" class="form-control" name="guest_num" placeholder="" value="<?php  echo $item['guest_num'];?>" required="true">
				<span class="help-block"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
			<div class="col-sm-6 col-xs-6">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="更新客人队列" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>