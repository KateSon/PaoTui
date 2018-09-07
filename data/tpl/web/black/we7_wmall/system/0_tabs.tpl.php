<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">系统</div>
<div class="nav slimscroll">
	<div class="menu-header">应用管理</div>
	<ul class="menu-item">
		<li <?php  if($_W['_router'] == 'system/plugin/index') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('system/plugin/index');?>">应用信息</a>
		</li>
		<li <?php  if($_W['_action'] == 'account') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('system/account/list');?>">公众号权限</a>
		</li>
	</ul>
	<?php  if(!empty($_W['isfounder'])) { ?>
		<div class="menu-header">更多应用</div>
		<ul class="menu-item">
			<li>
				<a href="<?php  echo cloud_store_url();?>" target="_blank" style="color: #ff2d4b">应用中心</a>
			</li>
		</ul>
	<?php  } ?>
	<div class="menu-header">系统设置</div>
	<ul class="menu-item">
		<li <?php  if($_W['_router'] == 'system/task/') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('system/task');?>">计划任务</a>
		</li>
	</ul>
	<div class="menu-header">授权</div>
	<ul class="menu-item">
		<li <?php  if($_W['_router'] == 'system/cloud/auth') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('system/cloud/auth');?>">授权管理</a>
		</li>
		<li <?php  if($_W['_router'] == 'system/cloud/upgrade') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('system/cloud/upgrade');?>">系统更新</a>
		</li>
		<li class="hide" <?php  if($_W['_router'] == 'system/cloud/log') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('system/cloud/log');?>">更新日志</a>
		</li>
	</ul>
	<?php  if(!empty($_GPC['s'])) { ?>
		<div class="menu-header">错误日志</div>
		<ul class="menu-item">
			<li <?php  if($_W['_router'] == 'system/slog/config') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('system/slog/config', array('s' => 1));?>">日志设置</a>
			</li>
		</ul>
	<?php  } ?>
</div>