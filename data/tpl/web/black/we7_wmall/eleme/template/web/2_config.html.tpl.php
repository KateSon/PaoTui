<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>基础设置</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($eleme['status'] == 1) { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="status" id="status-0" <?php  if($eleme['status'] == 0) { ?>checked<?php  } ?>>
					<label for="status-0">关闭</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">AppId</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="key" class="form-control" value="<?php  echo $eleme['key'];?>" placeholder="请输入key" required="true">
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="secret" class="form-control" value="<?php  echo $eleme['secret'];?>" placeholder="请输入Secret" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">推送URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['subscribe'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['subscribe'];?></a>
				</p>
				<div class="help-block">饿了么开放平台创建应用时候需要用,复制此链接到饿了么即可</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">回调地址URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['callback'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['callback'];?></a>
				</p>
				<div class="help-block">饿了么开放平台创建应用时候需要用,复制此链接到饿了么即可。<span>此项用于设置商家在饿了么服务市场打开应用后,显示的页面。您可以配合"应用说明"来设置此页面的显示内容</span></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">应用说明</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('description', $eleme['description']);?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提 交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>