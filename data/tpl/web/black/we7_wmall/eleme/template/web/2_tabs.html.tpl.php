<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<div class="menu-header">设置</div>
	<ul class="menu-item">
		<?php  if(check_perm('eleme.config')) { ?>
			<li <?php  if($_W['_action'] == 'config') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('eleme/config');?>">基本设置</a>
			</li>
		<?php  } ?>
	</ul>
</div>
