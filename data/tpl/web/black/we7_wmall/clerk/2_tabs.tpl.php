<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	店员
</div>
<div class="nav">
	<?php  if(check_perm('clerk.account')) { ?>
		<div class="menu-header">账户</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'account') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('clerk/account/list');?>">店员列表</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('clerk.cover')) { ?>
		<div class="menu-header">入口</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'cover') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('clerk/cover');?>">登陆&注册</a>
			</li>
		</ul>
	<?php  } ?>
</div>
