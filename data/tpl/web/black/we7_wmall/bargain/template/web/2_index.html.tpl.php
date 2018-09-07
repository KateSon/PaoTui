<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<h3>基本设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($config_bargain['status'] == '1' || empty($config_bargain['status'])) { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="status" id="status-0" <?php  if($config_bargain['status'] == '0') { ?>checked<?php  } ?>>
					<label for="status-0">关闭</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否在首页显示</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="is_home_display" id="is-home-display-1" <?php  if($config_bargain['is_home_display'] == '1' || empty($config_bargain['is_home_display'])) { ?>checked<?php  } ?>>
					<label for="is-home-display-1">显示</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="is_home_display" id="is-home-display-0" <?php  if($config_bargain['is_home_display'] == '0') { ?>checked<?php  } ?>>
					<label for="is-home-display-0">隐藏</label>
				</div>
				<span class="help-block">首页会按照商品排序选择4个显示</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">模板选择</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="template" id="template-1" <?php  if($config_bargain['template'] == '1' || empty($config_bargain['template'])) { ?>checked<?php  } ?>>
					<label for="template-1">单列样式</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="template" id="template-2" <?php  if($config_bargain['template'] == '2') { ?>checked<?php  } ?>>
					<label for="template-2">双列样式</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动宣传图</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $config_bargain['thumb']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动规则</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo itpl_ueditor('agreement', $config_bargain['agreement']);?>
			</div>
		</div>
		<h3>分享设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享标题</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="title" value="<?php  echo $config_bargain['share']['title'];?>" class="form-control" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享描述</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="desc" value="<?php  echo $config_bargain['share']['desc'];?>" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享图片</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('imgUrl', $config_bargain['share']['imgUrl'])?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享链接</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_tiny_link('link', $config_bargain['share']['link']);?>
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
