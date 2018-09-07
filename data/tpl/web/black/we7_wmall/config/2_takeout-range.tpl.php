<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix page-config-store-delivery">
	<h2>服务范围</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖服务中心点</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_tiny_coordinate('map', $range['map'], true);?>
				<div class="help-block">设置外卖服务中心点</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖服务半径</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" class="form-control" name="serve_radius" value="<?php  echo $range['serve_radius'];?>">
					<span class="input-group-addon">KM</span>
				</div>
				<div class="help-block">设置服务半径.0为不限制服务半径</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖服务城市(省/市)</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="city" value="<?php  echo $range['city'];?>">
				<div class="help-block">填写外卖服务所属的"市"或"省". 比如:你在县城里做外卖, 需要填写该县城所属的"市"或"省".</div>
				<div class="help-block">该项的作用是:用户在搜索地址的时候, 只返回该"省"或"市"内的相关地址</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
