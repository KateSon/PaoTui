<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	数据
</div>
<div class="nav slimscroll">
	<?php  if(check_perm('statcenter.takeout')) { ?>
	<div class="menu-header">外卖</div>
	<ul class="menu-item">
		<li <?php  if($_W['_action'] == 'takeout') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('statcenter/takeout');?>">外卖统计</a>
		</li>
		<li <?php  if($_W['_action'] == 'box') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('statcenter/box');?>">餐盒费统计</a>
		</li>
	</ul>
	<?php  } ?>
	<?php  if(check_perm('statcenter.delivery')) { ?>
		<div class="menu-header">配送</div>
		<ul class="menu-item">
			<li <?php  if($_W['_op'] == 'index') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('statcenter/delivery/index');?>">配送统计</a>
			</li>
		</ul>
		<ul class="menu-item">
			<li <?php  if($_W['_op'] == 'day') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('statcenter/delivery/day');?>">配送详情</a>
			</li>
		</ul>
	<?php  } ?>
</div>
