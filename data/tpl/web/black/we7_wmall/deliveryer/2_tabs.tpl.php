<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">配送员</div>
<div class="nav slimscroll">
	<?php  if(check_perm('deliveryer.account')) { ?>
		<div class="menu-header">入驻</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'account') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('deliveryer/account/list');?>">入驻列表</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('deliveryer.plateform') || check_perm('deliveryer.getcash' || 'deliveryer.current')) { ?>
		<div class="menu-header">平台</div>
		<ul class="menu-item">
			<?php  if(check_perm('deliveryer.plateform')) { ?>
				<li <?php  if($_W['_action'] == 'plateform') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('deliveryer/plateform/list');?>">平台配送员</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('deliveryer.getcash')) { ?>
				<li <?php  if($_W['_action'] == 'getcash') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('deliveryer/getcash/list');?>">提现申请</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('deliveryer.current')) { ?>
				<li <?php  if($_W['_action'] == 'current') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('deliveryer/current/list');?>">账户明细</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('deliveryer.cover')) { ?>
		<div class="menu-header">入口</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'cover') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('deliveryer/cover/list');?>">注册&登陆</a>
			</li>
		</ul>
	<?php  } ?>
</div>
