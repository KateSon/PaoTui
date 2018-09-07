<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('perm/user/list');?>
	<input name="status" type="hidden" value="<?php  echo $status;?>">
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
		<div class="col-sm-4 col-xs-4">
			<div class="btn-group">
				<a href="<?php  echo iurl('perm/user/list', array('status' => -1))?>" class="btn <?php  if($status == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo iurl('perm/user/list', array('status' => 1))?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">启用</a>
				<a href="<?php  echo iurl('perm/user/list', array('status' => 0))?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">禁用</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="请输入操作员名称">
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
			<a href="<?php  echo iurl('perm/user/post');?>" class="btn btn-primary btn-sm">添加新的操作员</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($users)) { ?>
				<div class="no-result">还没有相关数据</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="navbar-inner">
					<tr>
						<th width="40">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="ids[]" />
								<label></label>
							</div>
						</th>
						<th>登陆ID</th>
						<th>角色</th>
						<th>姓名</th>
						<th>手机号</th>
						<th>状态</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
						<?php  if(is_array($users)) { foreach($users as $user) { ?>
							<tr>
								<td>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="uids[]" value="<?php  echo $user['uid'];?>"/>
										<label></label>
									</div>
								</td>
								<td><?php  echo $user['username'];?></td>
								<td><?php  echo $roles[$user['roleid']]['rolename'];?></td>
								<td><?php  echo $user['realname'];?></td>
								<td><?php  echo $user['mobile'];?></td>
								<td>
									<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('perm/user/status', array('id' => $user['id']));?>" data-name="status" value="1" <?php  if($user['status'] == 1) { ?>checked<?php  } ?>>
								</td>
								<td style="text-align:right;">
									<a href="<?php  echo iurl('perm/user/post', array('id' => $user['id']))?>" class="btn btn-default btn-sm">编辑</a>
									<a href="<?php  echo iurl('perm/user/del', array('uid' => $user['uid']))?>" class="btn btn-default btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('perm/user/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="删除后将不可恢复，确定删除吗?">删除</a>
					</div>
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div class="page clearfix system-perm">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">操作员用户名</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="username" value="<?php  echo $user['username'];?>" <?php  if($id > 0) { ?>readonly<?php  } ?> class="form-control" required="true"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">操作员密码</label>
			<div class="col-sm-9 col-xs-12">
				<input type="password" name="password" value="" class="form-control" <?php  if(empty($_GPC['id'])) { ?>required="true"<?php  } ?>/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">所属角色</label>
			<div class="col-sm-9 col-xs-12">
				<select name="roleid" id="roleid" class="form-control">
					<option value="0">选择角色</option>
					<?php  if(is_array($roles)) { foreach($roles as $role) { ?>
						<option value="<?php  echo $role['id'];?>" <?php  if($role['id'] == $user['roleid']) { ?>selected<?php  } ?>><?php  echo $role['rolename'];?></option>
					<?php  } } ?>
				</select>
				<div class="help-block">如果您选择了角色，则此用户本身就继承了此角色的所有权限</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="realname" value="<?php  echo $user['realname'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="mobile" value="<?php  echo $user['mobile'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" value="1" name="status" id="status-1" <?php  if($user['status'] == 1) { ?>checked<?php  } ?>>
							<label for="status-1">启用</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="0" name="status" id="status-0" <?php  if($user['status'] == 0) { ?>checked<?php  } ?>>
							<label for="status-0">禁用</label>
						</div>
						<div class="help-block">用户可以在此角色权限的基础上附加其他权限</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">权限</label>
			<div class="col-sm-9 col-xs-12 perm-container">
				<?php  if(is_array($all_perms)) { foreach($all_perms as $group => $all) { ?>
					<div class="category-perm">
						<div class="heading">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="perms[]" value="<?php  echo $group;?>" id="<?php  echo $group;?>" class="perm-all-item" data-group="<?php  echo $group;?>" <?php  if(in_array($group, $roles[$user['roleid']]['perms']) || in_array($group, $user['perms'])) { ?>checked<?php  } ?> <?php  if(in_array($group, $roles[$user['roleid']]['perms'])) { ?>disabled<?php  } ?>>
								<label for="<?php  echo $group;?>"><?php  echo $all['title'];?></label>
							</div>
						</div>
						<div class="perm-list">
							<?php  if(is_array($all['perms'])) { foreach($all['perms'] as $key => $perm) { ?>
								<div class="checkbox checkbox-inline">
									<input type="checkbox" name="perms[]" value="<?php  echo $key;?>" id="<?php  echo $key;?>" class="perm-item" data-group="<?php  echo $group;?>" <?php  if(in_array($key, $roles[$user['roleid']]['perms']) || in_array($key, $user['perms'])) { ?>checked<?php  } ?> <?php  if(in_array($key, $roles[$user['roleid']]['perms'])) { ?>disabled<?php  } ?>>
									<label for="<?php  echo $key;?>"><?php  echo $perm;?></label>
								</div>
							<?php  } } ?>
						</div>
					</div>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<script>
	$(function() {
		var roles = <?php  echo json_encode($roles)?>;
		$('#roleid').change(function() {
			var id = $(this).val();
			var perm = '';
			if(id > 0) {
				perm = roles[id]['perms'];
			}
			$(':checkbox').removeAttr('disabled').removeAttr('checked').each(function() {
				var key = $(this).val();
				if(perm != '' && perm.indexOf(key) != -1) {
					$(this).attr('disabled',true);
					$(this).prop('checked', 'checked');
				}
			});
		});

		$(document).on('click', '.perm-all-item', function() {
			var group = $(this).data('group');
			if($(this).prop('checked')) {
				$(".perm-item[data-group='" + group + "'],.perm-all-item[data-group='" + group + "']").prop('checked', 'checked');
			} else {
				$(".perm-item[data-group='" + group + "'],.perm-all-item[data-group='" + group + "']").removeProp('checked');
			}
		});

		$(document).on('click', '.perm-item', function() {
			var group = $(this).data('group');
			var length = $(".perm-item[data-group='" + group + "']:checked").size();
			if(length > 0) {
				$(".perm-all-item[data-group='" + group + "']").prop('checked', 'checked');
			} else {
				$(".perm-all-item[data-group='" + group + "']").removeProp('checked');
			}
		});
	})
</script>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>