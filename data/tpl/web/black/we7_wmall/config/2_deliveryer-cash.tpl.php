<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix page-config-store-delivery">
	<h2>配送员申请</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>最低提现金额</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="get_cash_fee_limit" digits="true" value="<?php  echo $cash['get_cash_fee_limit'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">只能填写整数，不填写为不限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费率</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="get_cash_fee_rate" required="true" value="<?php  echo $cash['get_cash_fee_rate'];?>" class="form-control"/>
					<span class="input-group-addon">%</span>
				</div>
				<div class="help-block">
					配送员申请提现时，每笔申请提现扣除的费用，默认为空，即提现不扣费，支持填写小数
					<br>
					<strong clas="text-danger">配送员入驻时的默认提现费率</strong>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">最低</span>
					<input type="text" name="get_cash_fee_min" required="true" value="<?php  echo $cash['get_cash_fee_min'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">最高</span>
					<input type="text" name="get_cash_fee_max" required="true" value="<?php  echo $cash['get_cash_fee_max'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">
					<strong class="text-danger">最高金额设置为0， 表示不限制最高提现费用。</strong>
					<br>
					配送员提现时，提现费用的上下限，最高为空时，表示不限制扣除的提现费用
					<br>
					例如：提现100元，费率5%，最低1元，最高2元，配送员最终提现金额=100-2=98
					<br>
					例如：提现100元，费率5%，最低1元，最高10元，配送员最终提现金额=100-100*5%=95
				</div>
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
