<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page getcash">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back hide"></a>
		<h1 class="title">申请提现</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="takeout-title border-1px-tb">账户可用余额：<span>¥<?php  echo $deliveryer['credit2'];?></span></div>
		<ul class="takeout-list border-1px-tb">
			<li>
				<div class="takeout-item-left">提现金额</div>
				<div class="takeout-item-right">
					<div class="takeout-item-input">
						<input type="text" placeholder="0" id="fee" value="">
					</div>
					<p class="takeout-rule">最低提现金额为<?php  echo $config_delivery['get_cash_fee_limit'];?>元</p>
					<p class="takeout-rule">提现费率为<?php  echo $config_delivery['get_cash_fee_rate'];?>%,最低收取<?php  echo $config_delivery['get_cash_fee_min'];?>元<?php  if($config_delivery['get_cash_fee_max'] > 0) { ?>,最高收取<?php  echo $config_delivery['get_cash_fee_max'];?>元<?php  } ?></p>
					<?php  if($deliveryer['credit2'] < $config_delivery['get_cash_fee_limit']) { ?>
						<a href="#" class="button button-big button-fill button-success disabled">不足<?php  echo $config_delivery['get_cash_fee_limit'];?>元</a>
					<?php  } else { ?>
						<a href="#" class="button button-big button-fill button-success">提现</a>
					<?php  } ?>
				</div>
			</li>
		</ul>
	</div>
</div>

<script>
$(function(){
	$('.button-success').click(function(){
		var deliveryer = <?php  echo json_encode($deliveryer);?>;
		var rule = <?php  echo json_encode($config_delivery);?>;
		var fee = parseFloat($.trim($('#fee').val()));
		if(isNaN(fee)) {
			$.toast('提现金额有误');
			return false;
		}
		if(fee > deliveryer.credit2) {
			$.toast('提现金额大于可用余额');
			return false;
		}
		if(fee < rule.get_cash_fee_limit) {
			$.toast('提现金额不能小于' + rule.get_cash_fee_limit + '元');
			return false;
		}
		var rule_fee = (fee * rule.get_cash_fee_rate/100).toFixed(2);
		rule_fee = Math.max(rule_fee, rule.get_cash_fee_min);
		if(rule.get_cash_fee_max > 0) {
			rule_fee = Math.min(rule_fee, rule.get_cash_fee_max);
		}
		rule_fee = parseFloat(rule_fee);
		var final_fee = (fee - rule_fee).toFixed(2);
		var tips = "提现金额" + fee + "元, 手续费" + rule_fee + "元,实际到账" + final_fee + "元, 确定提现吗";
		$.confirm(tips, function(){
			$.post("<?php  echo imurl('delivery/finance/getcash')?>", {fee: fee}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno == -1) {
					$.toast(result.message.message);
				} else {
					$.toast('申请提现成功, 平台会尽快处理', "<?php  echo imurl('delivery/member/mine')?>");
				}
				return false;
			});
		});
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>