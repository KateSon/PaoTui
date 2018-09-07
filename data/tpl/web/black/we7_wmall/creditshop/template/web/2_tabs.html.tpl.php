<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('creditshop.order')) { ?>
		<div class="menu-header">兑换</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'order') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('creditshop/order');?>">兑换记录</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('creditshop.config') || check_perm('creditshop.cover')) { ?>
		<div class="menu-header">设置</div>
		<ul class="menu-item">
			<?php  if(check_perm('creditshop.config')) { ?>
				<li <?php  if($_W['_action'] == 'config') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('creditshop/config/index');?>">系统设置</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('creditshop.cover')) { ?>
				<li <?php  if($_W['_action'] == 'cover') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('creditshop/cover/index');?>">入口设置</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
</div>
