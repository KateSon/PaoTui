<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('freeLunch.activity')) { ?>
		<div class="menu-header">霸王餐</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'activity' && $_GPC['op'] == 'config') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('freeLunch/activity/config')?>">活动设置</a>
			</li>
			<li <?php  if($_GPC['ac'] == 'activity' && $_GPC['op'] == 'period') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('freeLunch/activity/period')?>">活动期数</a>
			</li>
			<li <?php  if($_GPC['ac'] == 'activity' && $_GPC['op'] == 'partaker') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('freeLunch/activity/partaker')?>">参与记录</a>
			</li>
			<li <?php  if($_GPC['ac'] == 'activity' && $_GPC['op'] == 'record') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('freeLunch/activity/record')?>">获奖记录</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('freeLunch.cover')) { ?>
		<div class="menu-header">入口</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'cover') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('freeLunch/cover/index');?>">入口设置</a>
			</li>
		</ul>
	<?php  } ?>
</div>
