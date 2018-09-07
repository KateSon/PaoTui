<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form class="form-table form form-validate" action="" method="post">
	<div class="panel panel-table">
		<div class="panel-heading clearfix">
			<a href="<?php  echo iurl('merchant/newsCategory/post');?>" class="btn btn-primary btn-sm">添加资讯分类</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead>
				<tr>
					<th width="200">排序</th>
					<th width="200">分类名称</th>
					<th style="text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
					<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
					<tr>
						<td>
							<input type="text" name="displayorder[]" value="<?php  echo $item['displayorder'];?>" class="form-control" digits="true">
						</td>
						<td>
							<input type="text" name="title[]" value="<?php  echo $item['title'];?>" class="form-control" required="true">
						</td>
						<td style="text-align:right; overflow: inherit">
							<a href="<?php  echo iurl('merchant/newsCategory/del', array('id' => $item['id']))?>" class="js-remove btn btn-default btn-sm" data-confirm="确定删除资讯分类吗?">删除</a>
						</td>
					</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<?php  if(!empty($lists)) { ?>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交" />
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
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>" digits="true">
				<div class="help-block">数字越大，越靠前</div>
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