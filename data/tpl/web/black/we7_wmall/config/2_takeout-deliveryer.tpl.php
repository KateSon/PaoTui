<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix page-config-store-delivery">
	<h2>配送员提成</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>平台给配送员每单支付金额(外卖单)</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_fee_type" value="1" <?php  if($order['deliveryer_fee_type'] == 1 || !$order['deliveryer_fee_type']) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单固定</span>
					<input type="text" class="form-control" name="deliveryer_fee_1" <?php  if($order['deliveryer_fee_type'] == 1) { ?>value="<?php  echo $order['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_fee_type" value="2" <?php  if($order['deliveryer_fee_type'] == 2) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单按照订单配送费提成</span>
					<input type="text" class="form-control" name="deliveryer_fee_2" <?php  if($order['deliveryer_fee_type'] == 2) { ?>value="<?php  echo $order['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">%</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_fee_type" value="3" <?php  if($order['deliveryer_fee_type'] == 3) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单基础配送费</span>
					<input type="text" class="form-control" name="deliveryer_fee_3[start_fee]" <?php  if($order['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $order['deliveryer_fee']['start_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元,超过</span>
					<input type="text" class="form-control" name="deliveryer_fee_3[start_km]" <?php  if($order['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $order['deliveryer_fee']['start_km'];?>"<?php  } ?>>
					<span class="input-group-addon">公里,超过部分每公里增加</span>
					<input type="text" class="form-control" name="deliveryer_fee_3[pre_km]" <?php  if($order['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $order['deliveryer_fee']['pre_km'];?>"<?php  } ?>>
					<span class="input-group-addon">元,最高</span>
					<input type="text" class="form-control" name="deliveryer_fee_3[max_fee]" <?php  if($order['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $order['deliveryer_fee']['max_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block text-danger">第三种提成模式仅适用于开启按照距离收取配送费的计费模式。</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary col-lg-1">
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
