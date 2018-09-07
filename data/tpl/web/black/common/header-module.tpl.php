<?php defined('IN_IA') or exit('Access Denied');?><div class="account-info-name">
	<a href="<?php  echo url('home/welcome/account')?>"><i class="wi wi-back-circle"></i></a>
	<span class="account-name"><a href="<?php  echo url('home/welcome/account')?>"><?php  echo $_W['account']['name'];?></a></span>
</div>
<div class="module-info-name">
	<?php  if(file_exists(IA_ROOT. "/addons/". $_W['current_module']['name']. "/icon-custom.jpg")) { ?>
		<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon-custom.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
	<?php  } else { ?>
		<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
	<?php  } ?>
	<span class="name"><?php  echo $_W['current_module']['title'];?></span>
</div>

<div class="related-info hidden">
	<div class="drop-menu-right">
		切换版本
		<span class="wi wi-right-sign-s pull-right"></span>
	</div>
	<div class="top-view">
		<a href="#" target="_blank">
			<i class="wi wi-wechat"></i>这是app
		</a>
		<a href="#" target="_blank">
			<i class="wi wi-wechat"></i>公众号公众号
		</a>
		<a href="#" target="_blank">
			<i class="wi wi-wxapp"></i>小程序小程序
		</a>
	</div>
</div>

<!-- 兼容历史性问题：模块内获取不到模块信息$module的问题-start -->
<?php  if(CRUMBS_NAV == 1) { ?>
<?php  global $module;?>
<?php  } ?>
<!-- end -->