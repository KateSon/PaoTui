<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	商户
</div>
<div class="nav slimscroll">
	<?php  if(check_perm('merchant.store') || check_perm('merchant.account')) { ?>
		<div class="menu-header">管理</div>
		<ul class="menu-item">
			<?php  if(check_perm('merchant.store')) { ?>
				<li <?php  if($_W['_action'] == 'store') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('merchant/store/list');?>">商户列表</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('merchant.account')) { ?>
				<li <?php  if($_W['_action'] == 'account') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('merchant/account/index');?>">商户账户</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('merchant.getcash') || check_perm('merchant.current')) { ?>
		<div class="menu-header">财务</div>
		<ul class="menu-item">
			<?php  if(check_perm('merchant.getcash')) { ?>
				<li <?php  if($_W['_action'] == 'getcash') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('merchant/getcash/list');?>">提现申请</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('merchant.current')) { ?>
				<li <?php  if($_W['_action'] == 'current') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('merchant/current/list');?>">账户明细</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('merchant.settle')) { ?>
		<div class="menu-header">入驻</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'settle') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('merchant/settle/list');?>">入驻列表</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('merchant.newsCategory') || check_perm('merchant.news')) { ?>
		<div class="menu-header">商户资讯</div>
		<ul class="menu-item">
			<?php  if(check_perm('merchant.newsCategory')) { ?>
				<li <?php  if($_W['_action'] == 'newsCategory') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('merchant/newsCategory/list');?>">资讯分类</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('merchant.news')) { ?>
				<li <?php  if($_W['_action'] == 'news') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('merchant/news/list');?>">资讯列表</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('merchant.ad')) { ?>
		<div class="menu-header">广告</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'ad') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('merchant/ad/list');?>">广告列表</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('merchant.notice') || check_perm('merchant.report')) { ?>
		<div class="menu-header">其他</div>
		<ul class="menu-item">
			<?php  if(check_perm('merchant.notice')) { ?>
				<li <?php  if($_W['_action'] == 'notice') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('merchant/notice/list');?>">公告列表</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('merchant.report')) { ?>
				<li <?php  if($_W['_action'] == 'report') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('merchant/report/list');?>">投诉列表</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
</div>
