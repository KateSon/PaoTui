<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>平台状态</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>平台状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline radio-primary">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($close['status'] == 1 || !$close['status']) { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline radio-primary">
					<input type="radio" value="2" name="status" id="status-2" <?php  if($close['status'] == 2) { ?>checked<?php  } ?>>
					<label for="status-2">关闭</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台关闭跳转链接</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="url" value="<?php  echo $close['url'];?>" class="form-control">
				<div class="help-block">如果您不采用系统页面，则可以设置关闭提醒链接，当商城关闭时跳转到此链接（非任何平台的链接）</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台关闭提示语</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="tips" value="<?php  echo $close['tips'];?>" class="form-control">
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
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>