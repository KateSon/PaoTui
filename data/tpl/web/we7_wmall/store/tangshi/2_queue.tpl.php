<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'queue_list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<a href="<?php  echo iurl('store/tangshi/assign/queue_post');?>" class="btn btn-primary btn-sm">新建队列</a>
	<div class="queue">
	<?php  if(empty($data)) { ?>
		<div class="no-result">
			<p>还没有队列</p>
		</div>
	<?php  } else { ?>
		<?php  if(is_array($data)) { foreach($data as $key => $da) { ?>
		<?php  $i = $key%5;?>
		<a class="list <?php  echo $colors[$i];?>" href="<?php  echo iurl('store/tangshi/assign/queue_post', array('id' => $da['id']));?>">
			<div class="name"><?php  echo $da['title'];?></div>
			<div class="status"><?php  if($da['status'] == 1) { ?>开放中<?php  } else { ?>已关闭<?php  } ?></div>
			<div data-href="<?php  echo iurl('store/tangshi/assign/queue_del', array('id' => $da['id']));?>" class="button js-post" data-confirm="确定删除队列吗?"><i class="fa fa-times"></i></div>
		</a>
		<?php  } } ?>
	<?php  } ?>
</div>
</form>
<?php  } ?>

<?php  if($ta == 'queue_post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>队列名称</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" class="form-control" name="title" placeholder="例如:1-2人桌" value="<?php  echo $item['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>客人数量少于等于多少人排入此队列</label>
			<div class="col-sm-6 col-xs-6">
				<input type="number" class="form-control" name="guest_num" placeholder="例如:2" value="<?php  echo $item['guest_num'];?>" digits="true">
				<span class="help-block">设置为自动排号时，当排号客户的用餐人数少于等于此人数时，系统将自动为排号客户分配此队列,</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>开放排队时间</label>
			<div class="col-sm-3">
				<div class="input-group clockpicker">
					<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
					<input type="text" class="form-control" name="starttime" readonly placeholder="" value="<?php  echo $item['starttime'];?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>关闭排队时间</label>
			<div class="col-sm-3">
				<div class="input-group clockpicker">
					<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
					<input type="text" class="form-control" name="endtime" readonly placeholder="" value="<?php  echo $item['endtime'];?>">
				</div>
				<span class="help-block">排队关闭时间必须大于开始时间</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">队列编号前缀</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" class="form-control" name="prefix" placeholder="例如:C-" value="<?php  echo $item['prefix'];?>">
				<span class="help-block">方便区分不同的队列</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>提前通知人数</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" class="form-control" name="notify_num" placeholder="例如:10" value="<?php  echo $item['notify_num'];?>" digits="true">
				<span class="help-block">队列有状态变更时, 提前通知的人数</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
			<div class="col-sm-6 col-xs-6">
				<div class="checkbox checkbox-inline">
					<input type="checkbox" name="status" value="1" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
					<label>开放中</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
			<div class="col-sm-6 col-xs-6">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交队列设置" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>

<?php  if($ta == 'set') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排号模式</label>
			<div class="col-sm-6 col-xs-6">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="assign_mode" id="assign-mode-1" <?php  if($store['assign_mode'] == 1) { ?>checked<?php  } ?> aria-required="true">
					<label for="assign-mode-1">系统自动分配</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="assign_mode" id="assign-mode-2" <?php  if($store['assign_mode'] == 2) { ?>checked<?php  } ?> aria-required="true">
					<label for="assign-mode-2">用户自主选择</label>
				</div>
				<span class="help-block">
					系统自动分配: 根据用户输入的人数自动分配队列. 队列可在队列设置中设置<br>
					用户自主选择: 用户可以自由选择不同的队列.
				</span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-6 col-xs-6">
				<input type="submit" value="更新排号模式" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php  if($ta == 'cover') { ?>
<div class="page clearfix">
	<form class="form-horizontal form" id="form1" action="" method="post">
		<h3 class="margin-t-0">系统链接</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['sys'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['sys'];?></a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="qrcode-block js-qrcode" data-text="<?php  echo $urls['sys'];?>"></div>
			</div>
		</div>
		<?php  if(!empty($urls['wx'])) { ?>
			<h3 class="margin-t-0">微信链接</h3>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
				<div class="col-sm-9 col-xs-12">
					<p class="form-control-static js-clip" data-text="<?php  echo $urls['wx'];?>" title="点击复制">
						<a href="javascript:;"><?php  echo $urls['wx'];?></a>
					</p>
					<span class="help-block">温馨提示: 您可以使用以上链接,在第三方网址自己生成二维码.</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
				<div class="col-sm-9 col-xs-12">
					<div class="qrcode-block js-qrcode" data-text="<?php  echo $urls['wx'];?>"></div>
				</div>
			</div>
		<?php  } else { ?>
			<h3 class="margin-t-0">微信链接</h3>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
				<div class="col-sm-9 col-xs-12">
					<a href="<?php  echo iurl('store/common/qrcode/build', array('store_id' => $sid, 'type' => 'assign'));?>" class="btn btn-success">生成微信二维码</a>
				</div>
			</div>
		<?php  } ?>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>