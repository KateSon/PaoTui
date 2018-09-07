<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('shareRedpacket.activity')) { ?>
		<div class="menu-header">红包活动</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'activity' && $_GPC['op'] == 'config') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('shareRedpacket/activity/config')?>">活动设置</a>
			</li>
			<li <?php  if($_GPC['ac'] == 'activity' && $_GPC['op'] == 'invite') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('shareRedpacket/activity/invite')?>">邀请记录</a>
			</li>
			<li <?php  if($_GPC['ac'] == 'activity' && $_GPC['op'] == 'ranking') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('shareRedpacket/activity/ranking')?>">分享排行</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('shareRedpacket.cover')) { ?>
		<div class="menu-header">设置</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'cover') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('shareRedpacket/cover')?>">入口设置</a>
			</li>
		</ul>
	<?php  } ?>
</div>
