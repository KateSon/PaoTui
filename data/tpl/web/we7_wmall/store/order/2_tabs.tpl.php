<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">订单</div>
<div class="nav slimscroll">
	<div class="menu-header">外卖</div>
	<ul class="menu-item">
		<li <?php  if($_GPC['filter_type'] == 'process') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('store/order/takeout/list', array('filter_type' => 'process'));?>">
				未完成
				<?php  if(!empty($_W['_process'])) { ?>
					<span class="badge"><?php  echo $_W['_process'];?></span>
				<?php  } ?>
			</a>
		</li>
		<li <?php  if($_GPC['filter_type'] == 'is_remind') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('store/order/takeout/list', array('is_remind' => 1, 'filter_type' => 'is_remind'));?>">
				催单
				<?php  if(!empty($_W['_remind'])) { ?>
					<span class="badge"><?php  echo $_W['_remind'];?></span>
				<?php  } ?>
			</a>
		</li>
		<li <?php  if($_GPC['filter_type'] == 'refund_status') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('store/order/takeout/list', array('refund_status' => 1, 'filter_type' => 'refund_status'));?>">
				退款单
				<?php  if(!empty($_W['_refund'])) { ?>
					<span class="badge"><?php  echo $_W['_refund'];?></span>
				<?php  } ?>
			</a>
		</li>
		<li <?php  if($_GPC['filter_type'] == 'all') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('store/order/takeout/list', array('filter_type' => 'all'));?>">历史订单</a>
		</li>
	</ul>
</div>
