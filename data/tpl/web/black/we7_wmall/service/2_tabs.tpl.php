<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">售后</div>
<div class="nav slimscroll">
	<div class="menu-header">顾客反馈</div>
	<ul class="menu-item">
		<?php  if(check_perm('service.comment')) { ?>
			<li <?php  if($_W['_action'] == 'comment') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('service/comment');?>">用户评价</a>
			</li>
		<?php  } ?>
	</ul>
</div>