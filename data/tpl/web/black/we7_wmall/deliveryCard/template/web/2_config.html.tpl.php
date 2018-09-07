<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>基础设置</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启会员卡申请</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="card_apply_status" id="card-apply-status-1" value="1" <?php  if($_config_plugin['card_apply_status'] == 1) { ?>checked<?php  } ?> require="true">
					<label for="card-apply-status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="card_apply_status" id="card-apply-status-0" value="0" <?php  if(!$_config_plugin['card_apply_status']) { ?>checked<?php  } ?> require="true">
					<label for="card-apply-status-0">关闭</label>
				</div>
				<div class="help-block">开启此选项后, 需要配置会员卡套餐.<a href="<?php  echo iurl('deliveryCard/setmeal/list');?>" target="_blank">现在去配置</a></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡规则</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('agreement_card', $agreement_card);?>
				<div class="help-block">设置会员卡规则</div>
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