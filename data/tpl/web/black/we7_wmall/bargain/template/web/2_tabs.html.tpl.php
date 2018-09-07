<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('bargain.index') || check_perm('bargain.cover')) { ?>
		<div class="menu-header">设置</div>
		<ul class="menu-item">
			<?php  if(check_perm('bargain.index')) { ?>
				<li <?php  if($_W['_action'] == 'index') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('bargain/index/index');?>">活动设置</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('bargain.cover')) { ?>
				<li <?php  if($_W['_action'] == 'cover') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('bargain/cover/index');?>">入口设置</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('bargain.goods')) { ?>
		<div class="menu-header">商品</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'goods') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('bargain/goods/index');?>">活动商品</a>
			</li>
		</ul>
	<?php  } ?>
</div>
