<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>基础设置</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($meituan['status'] == 1) { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="status" id="status-0" <?php  if($meituan['status'] == 0) { ?>checked<?php  } ?>>
					<label for="status-0">关闭</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">developerId</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="developerId" class="form-control" value="<?php  echo $meituan['developerId'];?>" placeholder="请输入developerId" required="true">
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">SignKey</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="signKey" class="form-control" value="<?php  echo $meituan['signKey'];?>" placeholder="请输入signKey" required="true">
			</div>
		</div>
		<?php  if(is_array($urls)) { foreach($urls as $url) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $url['title'];?></label>
				<div class="col-sm-9 col-xs-12">
					<p class="form-control-static js-clip" data-text="<?php  echo $url['url'];?>" title="点击复制">
						<a href="javascript:;"><?php  echo $url['url'];?></a>
					</p>
					<div class="help-block">复制此链接到美团开发者中心-回调接口设置-<?php  echo $url['title'];?></div>
				</div>
			</div>
		<?php  } } ?>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提 交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>