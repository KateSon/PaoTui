<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">订单</div>
<div class="nav slimscroll">
	<?php  if(check_perm('order.takeout')) { ?>
		<div class="menu-header">外卖</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'takeout' && $_GPC['filter_type'] == 'process') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/takeout/list', array('filter_type' => 'process'));?>">
					未完成
					<?php  if(!empty($_W['_process'])) { ?>
						<span class="badge"><?php  echo $_W['_process'];?></span>
					<?php  } ?>
				</a>
			</li>
			<li <?php  if($_W['_action'] == 'takeout' && $_GPC['filter_type'] == 'is_remind') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/takeout/list', array('is_remind' => 1, 'filter_type' => 'is_remind'));?>">
					催单
					<?php  if(!empty($_W['_remind'])) { ?>
						<span class="badge"><?php  echo $_W['_remind'];?></span>
					<?php  } ?>
				</a>
			</li>
			<li <?php  if($_W['_action'] == 'takeout' && $_GPC['filter_type'] == 'refund_status') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/takeout/list', array('refund_status' => 1, 'filter_type' => 'refund_status'));?>">
					退款单
					<?php  if(!empty($_W['_refund'])) { ?>
						<span class="badge"><?php  echo $_W['_refund'];?></span>
					<?php  } ?>
				</a>
			</li>
			<li <?php  if($_W['_action'] == 'takeout' && $_GPC['filter_type'] == 'all') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/takeout/list', array('filter_type' => 'all'));?>">所有订单</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('order.dispatch')) { ?>
		<div class="menu-header">调度中心</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'dispatch') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/dispatch/map');?>">待指派</a>
			</li>
			<li <?php  if($_W['_action'] == 'records' && $_W['_op'] == 'stat') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/records/stat');?>">接单统计</a>
			</li>
			<li <?php  if($_W['_action'] == 'records' && $_W['_op'] == 'list') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/records/list');?>">接单记录</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('order.tangshi')) { ?>
		<div class="menu-header">店内</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'tangshi' && $_GPC['filter_type'] == 'process') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/tangshi/list', array('filter_type' => 'process'));?>">未完成</a>
			</li>
			<li <?php  if($_W['_action'] == 'tangshi' && $_GPC['filter_type'] == 'is_remind') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/tangshi/list', array('is_remind' => 1, 'filter_type' => 'is_remind'));?>">催单</a>
			</li>
			<li <?php  if($_W['_action'] == 'tangshi' && $_GPC['filter_type'] == 'refund_status') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/tangshi/list', array('refund_status' => 1, 'filter_type' => 'refund_status'));?>">退款单</a>
			</li>
			<li <?php  if($_W['_action'] == 'tangshi' && $_GPC['filter_type'] == 'all') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('order/tangshi/list', array('filter_type' => 'all'));?>">所有订单</a>
			</li>
		</ul>
	<?php  } ?>
</div>
