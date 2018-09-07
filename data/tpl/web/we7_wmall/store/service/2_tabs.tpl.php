<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">售后</div>
<div class="nav slimscroll">
	<div class="menu-header">顾客反馈</div>
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'comment') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('store/service/comment/list');?>">用户评价</a>
		</li>
	</ul>
</div>
