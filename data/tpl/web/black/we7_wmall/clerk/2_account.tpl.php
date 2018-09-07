<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('clerk/account/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="搜索的姓名、昵称、手机号">
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
			<a href="<?php  echo iurl('clerk/account/post');?>" class="btn btn-primary btn-sm">添加店员</a>
		</div>
		<div class="alert alert-warning">给某个门店新增店员时,请先添加一个店员手账户,然后通过手机号把他添加进来。后台登陆地址:<a href="<?php  echo iurl('store/oauth/login', array(), true);?>" target="_blank"><?php  echo iurl('store/oauth/login', array(), true);?></a></div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th width="40">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="ids[]" value="<?php  echo $item['id'];?>"/>
								<label></label>
							</div>
						</th>
						<th width="65"></th>
						<th>微信昵称</th>
						<th>店员名称</th>
						<th>手机号</th>
						<th>添加时间</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($data)) { foreach($data as $item) { ?>
					<tr>
						<td>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="ids[]" value="<?php  echo $item['id'];?>"/>
								<label></label>
							</div>
						</td>
						<td><img src="<?php  echo tomedia($item['avatar']);?>" width="48"></td>
						<td><?php  echo $item['nickname'];?></td>
						<td><?php  echo $item['title'];?></td>
						<td><?php  echo $item['mobile'];?></td>
						<td><?php  echo date('Y-m-d H:i', $item['addtime']);?></td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('clerk/account/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm">编辑</a>
							<a href="<?php  echo iurl('clerk/account/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
						</td>
					</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<a href="<?php  echo iurl('clerk/account/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div class="page clearfix">
	<h2>编辑店员</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">微信昵称</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_fans('wechat', array('openid' => $clerk['openid'], 'nickname' => $clerk['nickname'], 'avatar' => $clerk['avatar']), true);?>
				<div class="help-block">如果待添加的店员未关注公众号, 需要先关注公众号</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">店员姓名</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="title" value="<?php  echo $clerk['title'];?>" class="form-control" required="true">
				<div class="help-block">请填写店员姓名。<strong class="text-danger">请填写真实姓名, 否则会造成微信提现失败</strong></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">手机号</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="mobile" value="<?php  echo $clerk['mobile'];?>" class="form-control" placeholder="用于账号登陆" required="true">
				<div class="help-block">手机号用于店员账号登陆, 请认真填写</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">登陆密码</label>
			<div class="col-sm-9 col-xs-12">
				<input type="password" name="password" value="" class="form-control" placeholder="" <?php  if(!$id) { ?>required="true"<?php  } ?>>
				<div class="help-block">请填写密码，长度为 8-20 个字符.<?php  if($id > 0) { ?>如果不更改密码此处请留空<?php  } ?></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">确认登陆密码</label>
			<div class="col-sm-9 col-xs-12">
				<input type="password" name="repassword" value="" class="form-control" placeholder="" <?php  if(!$id) { ?>required="true"<?php  } ?>>
				<div class="help-block">重复输入密码，确认正确输入.<?php  if($id > 0) { ?>如果不更改密码此处请留空<?php  } ?></div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input type="submit" value="提交" class="btn btn-primary">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<script>
$(function() {
	$('#form1').submit(function(){
		var password = $.trim($('input[name="password"]').val());
		if(password) {
			var length = password.length;
			if(length < 8 || length > 20) {
				Notify.info('请输入8-20位密码');
				$('form').attr('stop', 1);
				return false;
			}
			var reg = /[0-9]+[a-zA-Z]+[0-9a-zA-Z]*|[a-zA-Z]+[0-9]+[0-9a-zA-Z]*/;
			if(!reg.test(password)) {
				Notify.info('密码必须由数字和字母组合');
				$('form').attr('stop', 1);
				return false;
			}
			var repassword = $.trim($('input[name="repassword"]').val());
			if(!repassword) {
				Notify.info('请重复输入密码');
				$('form').attr('stop', 1);
				return false;
			}
			if(password != repassword) {
				Notify.info('两次密码输入不一致');
				$('form').attr('stop', 1);
				return false;
			}
		}
 		$('form').attr('stop', 0);
		return false;
	});
});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>