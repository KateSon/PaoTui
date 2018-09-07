<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	店内点餐
</div>
<div class="nav slimscroll">
	<div class="menu-header">订单</div>
	<ul class="menu-item">
		<li <?php  if($_GPC['filter_type'] == 'process') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/order/list', array('filter_type' => 'process'));?>">未完成</a>
		</li>
		<li <?php  if($_GPC['filter_type'] == 'is_remind') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/order/list', array('is_remind' => 1, 'filter_type' => 'is_remind'));?>">催单</a>
		</li>
		<li <?php  if($_GPC['filter_type'] == 'refund_status') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/order/list', array('refund_status' => 1, 'filter_type' => 'refund_status'));?>">退款单</a>
		</li>
		<li <?php  if($_GPC['filter_type'] == 'all') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/order/list', array('filter_type' => 'all'));?>">历史订单</a>
		</li>
	</ul>
	<div class="menu-header">桌台管理</div>
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'table' &&  in_array($_W['_ta'], array('category_list', 'category_post'))) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/table/category_list');?>">桌台类型</a>
		</li>
		<li <?php  if($_W['_op'] == 'table' && in_array($_W['_ta'], array('table_post', 'list'))) { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/table/list');?>">桌台列表</a>
		</li>
	</ul>
	<div class="menu-header">预定管理</div>
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'reserve' && $_W['_ta'] == 'list') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/reserve/list');?>">预定时间段</a>
		</li>
	</ul>
	<div class="menu-header">排号管理</div>
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'assign' && $_W['_ta'] == 'board_list') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/assign/board_list');?>">客人队列</a>
		</li>
		<li <?php  if($_W['_op'] == 'assign' && $_W['_ta'] == 'queue_list') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/assign/queue_list');?>">队列列表</a>
		</li>
		<li <?php  if($_W['_op'] == 'assign' && $_W['_ta'] == 'set') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/assign/set');?>">排号设置</a>
		</li>
		<li <?php  if($_W['_op'] == 'assign' && $_W['_ta'] == 'cover') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/tangshi/assign/cover');?>">排号入口</a>
		</li>
	</ul>
</div>
