<?php defined('IN_IA') or exit('Access Denied');?><nav class="bar bar-tab footer-bar">
	<a class="tab-item <?php  if($_GPC['ac'] == 'home' && in_array($_GPC['op'], array('index'))) { ?>active<?php  } ?>" href="<?php  echo imurl('wmall/home/index');?>">
		<span class="icon icon-index"></span>
		<span class="tab-label">首页</span>
	</a>
	<?php  if($_W['we7_wmall']['config']['mall']['version'] == 1) { ?>
		<a class="tab-item <?php  if(in_array($_W['_op'], array('search'))) { ?>active<?php  } ?>" href="<?php  echo imurl('wmall/home/search', array('force' => 1));?>">
			<span class="icon icon-found"></span>
			<span class="tab-label">附近</span>
		</a>
		<?php  if(check_plugin_perm('errander') && get_plugin_config('errander.status')) { ?>
			<a class="tab-item <?php  if($_W['_plugin']['name'] == 'errander' && $_W['_action'] != 'order') { ?>active<?php  } ?>" href="<?php  echo imurl('errander/index');?>">
				<span class="icon icon-errander"></span>
				<span class="tab-label">跑腿</span>
			</a>
		<?php  } else { ?>
			<a class="tab-item <?php  if(in_array($_W['_op'], array('hunt'))) { ?>active<?php  } ?>" href="<?php  echo imurl('wmall/home/hunt');?>">
				<span class="icon icon-search"></span>
				<span class="tab-label">搜索</span>
			</a>
		<?php  } ?>
	<?php  } ?>
	<a class="tab-item  <?php  if($_GPC['ac'] == 'order') { ?>active<?php  } ?>" href="<?php  echo imurl('wmall/order/index');?>">
		<span class="icon icon-order"></span>
		<span class="tab-label">订单</span>
	</a>
	<a class="tab-item <?php  if($_GPC['ac'] == 'member') { ?>active<?php  } ?>" href="<?php  echo imurl('wmall/member/mine');?>">
		<span class="icon icon-mine"></span>
		<span class="tab-label">我的</span>
	</a>
</nav>
