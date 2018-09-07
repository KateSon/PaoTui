<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('ordergrant.config') || check_perm('ordergrant.record')) { ?>
		<div class="menu-header">下单有礼</div>
		<ul class="menu-item">
			<?php  if(check_perm('ordergrant.config')) { ?>
				<li <?php  if($_GPC['ac'] == 'config') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('ordergrant/config')?>">活动设置</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('ordergrant.record')) { ?>
				<li <?php  if($_GPC['ac'] == 'record') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('ordergrant/record')?>">奖励记录</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('ordergrant.share')) { ?>
		<div class="menu-header">分享订单</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'share') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('ordergrant/share')?>">设置</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('ordergrant.cover')) { ?>
		<div class="menu-header">入口</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'cover' && $_GPC['op'] == 'index') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('ordergrant/cover/index')?>">下单有礼入口</a>
			</li>
			<li <?php  if($_GPC['ac'] == 'cover' && $_GPC['op'] == 'share') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('ordergrant/cover/share')?>">分享订单入口</a>
			</li>
		</ul>
	<?php  } ?>
</div>
