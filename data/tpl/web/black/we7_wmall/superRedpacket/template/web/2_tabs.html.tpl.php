<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<div class="menu-header">超级红包</div>
	<ul class="menu-item">
		<?php  if(check_perm('superRedpacket.grant')) { ?>
			<li <?php  if($_W['_action'] == 'grant') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('superRedpacket/grant')?>">发放红包</a>
			</li>
		<?php  } ?>
		<?php  if(check_perm('superRedpacket.share')) { ?>
			<li <?php  if($_W['_action'] == 'share') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('superRedpacket/share')?>">分享红包</a>
			</li>
		<?php  } ?>
	</ul>
</div>
