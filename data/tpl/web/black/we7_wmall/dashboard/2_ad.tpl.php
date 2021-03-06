<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<?php  if($_W['is_agent']) { ?>
<form action="" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('dashboard/ad/list');?>
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
<form action="" class="form-table">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('dashboard/ad/post');?>" class="btn btn-primary btn-sm">添加引导页</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($slides)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>图片</th>
						<th>排序</th>
						<?php  if($_W['is_agent']) { ?>
							<th>所属城市</th>
						<?php  } ?>
						<th>标题</th>
						<th>链接</th>
						<th>状态</th>
						<th class="text-right">操作</th>
					</tr>
				</thead>
				<?php  if(is_array($slides)) { foreach($slides as $slide) { ?>
					<tr>
						<td><img src="<?php  echo tomedia($slide['thumb']);?>" width="50"></td>
						<td>
							<input value="<?php  echo $slide['displayorder'];?>" class="form-control input-sm width-100 js-edit" required="true" data-name="displayorder" data-href="<?php  echo iurl('dashboard/ad/displayorder', array('id' => $slide['id']))?>">
						</td>
						<?php  if($_W['is_agent']) { ?>
							<td><?php  echo toagent($slide['agentid'])?></td>
						<?php  } ?>
						<td><?php  echo $slide['title'];?></td>
						<td><?php  echo $slide['link'];?></td>
						<td>
							<input type="checkbox" class="js-checkbox" data-on-text="开启" data-off-text="关闭" data-href="<?php  echo iurl('dashboard/ad/status', array('id' => $slide['id']));?>" data-name="status" value="1" <?php  if($slide['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td class="text-right">
							<a href="<?php  echo iurl('dashboard/ad/post', array('id' => $slide['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" ><i class="fa fa-edit"> </i> 编辑</a>
							<a href="<?php  echo iurl('dashboard/ad/del', array('id' => $slide['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该引导页?"><i class="fa fa-times"> </i> 删除</a>
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
	<h2>编辑引导页</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="displayorder" value="<?php  echo $slide['displayorder'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $slide['title'];?>" required="true">
				<span class="help-block">仅用于区分,不在前台显示</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">图片</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $slide['thumb']);?>
				<span class="help-block">图片推荐尺寸: 640*1008</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跳转链接</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="link" value="<?php  echo $slide['link'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="status" value="1" id="status-1" <?php  if($slide['status'] == 1) { ?>checked<?php  } ?>>
					<label for="status-1">启用</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="status" value="0" id="status-0" <?php  if(!$slide['status']) { ?>checked<?php  } ?>>
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
