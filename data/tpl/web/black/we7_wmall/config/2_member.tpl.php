<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>顾客等级升级条件</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-5 col-md-2 control-label">顾客等级升级依据</label>
			<div class="col-sm-5 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-order_money" value="order_money" <?php  if($group_update_mode == 'order_money') { ?>checked <?php  } ?>>
					<label for="group_update_mode-order_money">外卖订单消费总额(完成的订单)</label>
				</div>
				<br/>
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-order_count" value="order_count" <?php  if($group_update_mode == 'order_count') { ?>checked<?php  } ?>>
					<label for="group_update_mode-order_count">外卖订单消费次数(完成的订单)</label>
				</div>
				<br/>
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-delivery_money" value="delivery_money" <?php  if($group_update_mode == 'delivery_money') { ?>checked<?php  } ?>>
					<label for="group_update_mode-delivery_money">跑腿订单消费总额(完成的订单)</label>
				</div>
				<br/>
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-delivery_count" value="delivery_count" <?php  if($group_update_mode == 'delivery_count') { ?>checked<?php  } ?>>
					<label for="group_update_mode-delivery_count">跑腿订单消费次数(完成的订单)</label>
				</div>
				<br/>
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-count_money" value="count_money" <?php  if($group_update_mode == 'count_money') { ?>checked<?php  } ?>>
					<label for="group_update_mode-count_money">外卖订单和跑腿订单消费总额(完成的订单)</label>
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