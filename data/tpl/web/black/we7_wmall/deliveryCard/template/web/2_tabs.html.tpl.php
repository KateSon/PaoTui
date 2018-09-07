<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('deliveryCard.order')) { ?>
		<div class="menu-header">订单</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'order') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('deliveryCard/order/list');?>">购买记录</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('deliveryCard.setmeal')) { ?>
		<div class="menu-header">会员卡套餐</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'setmeal') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('deliveryCard/setmeal/list');?>">套餐列表</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('deliveryCard.config') || check_perm('deliveryCard.cover')) { ?>
		<div class="menu-header">设置</div>
		<ul class="menu-item">
			<?php  if(check_perm('deliveryCard.config')) { ?>
				<li <?php  if($_W['_action'] == 'config') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('deliveryCard/config/index');?>">会员卡设置</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('deliveryCard.cover')) { ?>
				<li <?php  if($_W['_action'] == 'cover') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('deliveryCard/cover/index');?>">入口设置</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
</div>
