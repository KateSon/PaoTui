<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>商户入驻</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户入驻</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="status" value="1" id="status-1" <?php  if($settle['status'] == 1 || !$settle['status']) { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="status" value="2" id="status-2" <?php  if($settle['status'] == 2) { ?>checked<?php  } ?>>
					<label for="status-2">关闭</label>
				</div>
				<div class="help-block">开启商户入驻后，手机端个人中心页面将开启入口，否则不显示</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户入驻</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="audit_status" value="1" id="audit-status-1" <?php  if($settle['audit_status'] == 1) { ?>checked<?php  } ?>>
					<label for="audit-status-1">直接审核通过</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="audit_status" value="2" id="audit-status-2" <?php  if($settle['audit_status'] == 2 || !$settle['audit_status']) { ?>checked<?php  } ?>>
					<label for="audit-status-2">审核中</label>
				</div>
				<div class="help-block">商家提交入驻申请后,设置是否直接审核通过.</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否短信验证手机号</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="mobile_verify_status" value="1" id="mobile-verify-status-1" <?php  if($settle['mobile_verify_status'] == 1) { ?>checked<?php  } ?>>
					<label for="mobile-verify-status-1">验证</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="mobile_verify_status" value="2" id="mobile-verify-status-2" <?php  if($settle['mobile_verify_status'] == 2 || !$settle['mobile_verify_status']) { ?>checked<?php  } ?>>
					<label for="mobile-verify-status-2">不验证</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">入驻协议</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('agreement_settle', $settle['agreement_settle']);?>
				<div class="help-block">不填写时，商户入驻申请页面将不显示：我已阅读并同意 《商户入驻协议》</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">显示新店标签</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="store_label_new" value="<?php  echo $settle['store_label_new'];?>" class="form-control"/>
					<span class="input-group-addon">天</span>
				</div>
				<div class="help-block">添加商户或商户入驻后, 几天内显示"新店标签". <a href="<?php  echo iurl('config/label/TY_store_label');?>" target="_blank">创建店铺便签</a></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>是否允许商家自己设置商品已售份数</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="custom_goods_sailed_status" id="custom-goods-sailed-status-1" <?php  if($settle['custom_goods_sailed_status'] == 1) { ?>checked<?php  } ?>>
					<label for="custom-goods-sailed-status-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="custom_goods_sailed_status" id="custom-goods-sailed-status-0" <?php  if(!$settle['custom_goods_sailed_status']) { ?>checked<?php  } ?>>
					<label for="custom-goods-sailed-status-0">不允许</label>
				</div>
				<div class="help-block text-danger">当设置为不允许时, 商品的销量会按照销量就行递增</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>是否允许商家审核顾客评价</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="self_audit_comment" id="self_audit_comment-1" <?php  if($settle['self_audit_comment'] == 1) { ?>checked<?php  } ?>>
					<label for="self_audit_comment-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="self_audit_comment" id="self_audit_comment-0" <?php  if(!$settle['self_audit_comment']) { ?>checked<?php  } ?>>
					<label for="self_audit_comment-0">不允许</label>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input type="submit" value="提交" class="btn btn-primary col-lg-1">
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>