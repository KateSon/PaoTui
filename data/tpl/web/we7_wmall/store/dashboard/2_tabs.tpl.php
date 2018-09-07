<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	概况
</div>
<div class="nav slimscroll">
	<div class="menu-header">运营</div>
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'index') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('store/dashboard/index');?>">运营概括</a>
		</li>
<!--
		<li <?php  if($_W['_op'] == 'place') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/dashboard/place');?>">店员代客下单</a>
		</li>
-->
	</ul>
</div>
