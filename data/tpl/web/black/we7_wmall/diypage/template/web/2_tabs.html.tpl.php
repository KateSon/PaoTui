<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('diypage.menu')) { ?>
		<div class="menu-header">自定义菜单</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'menu') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('diypage/menu/list')?>">菜单列表</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('diypage.mall')) { ?>
		<div class="menu-header">商城设置</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'mall' && $_GPC['op'] == 'menu') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('diypage/mall/menu')?>">菜单设置</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('diypage.danmu')) { ?>
		<div class="menu-header">订单弹幕</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'danmu') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('diypage/danmu')?>">弹幕设置</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('diypage.diy')) { ?>
		<div class="menu-header">页面管理</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'diy') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('diypage/diy')?>">页面列表</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('diypage.template')) { ?>
		<div class="menu-header">模板管理</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['ac'] == 'template') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('diypage/template')?>">全部模板</a>
			</li>
		</ul>
	<?php  } ?>
</div>
