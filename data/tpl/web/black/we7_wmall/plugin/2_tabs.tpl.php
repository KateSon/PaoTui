<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">应用</div>
<div class="nav slimscroll">
	<div class="menu-header">应用</div>
	<ul class="menu-item">
		<li class="active">
			<a href="<?php  echo iurl('plugin/index/index');?>">应用列表</a>
		</li>
	</ul>
	<?php  if(is_array($_W['plugin_types'])) { foreach($_W['plugin_types'] as $type) { ?>
		<?php  if(!empty($_W['plugins'][$type['name']])) { ?>
			<div class="menu-header"><?php  echo $type['title'];?></div>
			<ul class="menu-item">
				<?php  if(is_array($_W['plugins'][$type['name']])) { foreach($_W['plugins'][$type['name']] as $plugin) { ?>
					<?php  if(check_perm($plugin['name'])) { ?>
						<?php  $url = $plugin['name'] . '/index/index'?>
						<li>
							<a href="<?php  echo iurl($url);?>"><?php  echo $plugin['title'];?></a>
						</li>
					<?php  } ?>
				<?php  } } ?>
			</ul>
		<?php  } ?>
	<?php  } } ?>
	<?php  if(!empty($_W['isfounder'])) { ?>
		<div class="menu-header">更多应用</div>
		<ul class="menu-item">
			<li>
				<a href="<?php  echo cloud_store_url();?>" target="_blank" style="color: #ff2d4b">&#x5E94;&#x7528;&#x4E2D;&#x5FC3;</a>
				<a href="http://t.cn/RWI585e" target="_blank" style="color: #ff2d4b">&#x65B0;&#x777F;&#x793E;&#x533A;</a>
			</li>
		</ul>
	<?php  } ?>
</div>
