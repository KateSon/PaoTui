<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('system/account/list');?>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">关键字</label>
		<div class="col-sm-9 col-xs-12">
			<input class="form-control" name="keyword" placeholder="公众号名称" type="text" value="<?php  echo $_GPC['keyword'];?>">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<div class="panel-heading">
				<a href="<?php  echo iurl('system/account/post');?>" class="btn btn-primary btn-sm">添加新权限</a>
			</div>
			<div class="alert alert-warning">如果没有设置公众号权限,默认拥有全部插件权限</div>
			<?php  if(empty($plugins)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
			<table class="table table-hover">
				<thead>
				<tr>
					<th>公众号</th>
					<th>应用权限</th>
					<th class="text-right">操作</th>
				</tr>
				</thead>
				<?php  if(is_array($accounts)) { foreach($accounts as $account) { ?>
					<tr>
						<td><?php  echo $account['name'];?></td>
						<td>
							<?php  if(is_array($account['plugins'])) { foreach($account['plugins'] as $plugin) { ?>
								<?php  echo $plugins[$plugin]['title'];?>;
							<?php  } } ?>
						</td>
						<td class="text-right">
							<a href="<?php  echo iurl('system/account/post', array('uniacid' => $account['uniacid']))?>" class="btn btn-default btn-sm">编辑</a>
							<a href="<?php  echo iurl('system/account/del', array('id' => $account['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="删除后,公众号将获得全部插件权限,确定删除吗?">删除</a>
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
	<h2>编辑公众号权限</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_tiny_account('uniacid', $perm['uniacid'], true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">允许入驻商户数量</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="max_store" value="<?php  echo $perm['max_store'];?>" required="true">
				<span class="help-block">默认为空或者默认0都为不限制</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">开放插件</label>
			<div class="col-sm-9 col-xs-12">
				<?php  if(is_array($plugins)) { foreach($plugins as $plugin) { ?>
					<div class="checkbox checkbox-inline">
						<input type="checkbox" name="plugins[]" value="<?php  echo $plugin['name'];?>" id="plugin-<?php  echo $plugin['name'];?>" <?php  if(in_array($plugin['name'], $perm['plugins'])) { ?>checked<?php  } ?>/>
						<label for="plugin-<?php  echo $plugin['name'];?>"><?php  echo $plugin['title'];?></label>
					</div>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>