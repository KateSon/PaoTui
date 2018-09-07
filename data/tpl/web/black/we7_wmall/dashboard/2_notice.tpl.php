<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<?php  if($_W['is_agent']) { ?>
<form action="" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('dashboard/notice/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择代理区域</label>
		<div class="col-sm-4 col-xs-4">
			<select name="agentid" class="select2 js-select2 form-control width-130">
				<option value="0">选择代理区域</option>
				<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
					<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
</form>
<?php  } ?>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('dashboard/notice/post');?>" class="btn btn-primary btn-sm">添加引导页</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($notices)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead>
					<tr>
						<th>排序</th>
						<?php  if($_W['is_agent']) { ?>
							<th>所属城市</th>
						<?php  } ?>
						<th>公告名称</th>
						<th>跳转链接</th>
						<th>状态</th>
						<th class="text-right">操作</th>
					</tr>
					</thead>
					<?php  if(is_array($notices)) { foreach($notices as $notice) { ?>
					<tr>
						<input type="hidden" name="ids[]" value="<?php  echo $notice['id'];?>">
						<td>
							<input type="text" name="displayorders[]" class="form-control width-100" value="<?php  echo $notice['displayorder'];?>">
						</td>
						<?php  if($_W['is_agent']) { ?>
							<td><?php  echo toagent($notice['agentid'])?></td>
						<?php  } ?>
						<td>
							<input type="text" name="titles[]" class="form-control width-130" value="<?php  echo $notice['title'];?>">
						</td>
						<td><?php  echo $notice['link'];?></td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('dashboard/notice/status', array('id' => $notice['id']));?>" data-name="status" value="1" <?php  if($notice['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td class="text-right">
							<a href="<?php  echo iurl('dashboard/notice/post', array('id' => $notice['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" ><i class="fa fa-edit"> </i> 编辑</a>
							<a href="<?php  echo iurl('dashboard/notice/del', array('id' => $notice['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该公告?"><i class="fa fa-times"> </i> 删除</a>
						</td>
					</tr>
					<?php  } } ?>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交修改" />
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
<div class="page clearfix">
	<h2>编辑公告</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">公告排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="displayorder" value="<?php  echo $notice['displayorder'];?>">
				<span class="help-block">数字越大越靠前</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">公告名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $notice['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">公告图片</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $notice['thumb'])?>
				<span class="help-block">此图片仅在分享时调用</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">公告描述</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="description" value="<?php  echo $notice['description'];?>" class="form-control">
				<span class="help-block">此处内容选填,分享时调用</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跳转链接</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_tiny_link('link', $notice['link']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">公告内容</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('content', $notice['content']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="status" value="1" id="status-1" <?php  if($notice['status'] == 1) { ?>checked<?php  } ?>>
					<label for="status-1">启用</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="status" value="0" id="status-0" <?php  if(!$notice['status']) { ?>checked<?php  } ?>>
					<label for="status-0">不启用</label>
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
