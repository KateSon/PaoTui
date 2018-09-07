<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<div class="menu-header">推广员</div>
	<ul class="menu-item">
		<li class="<?php  if($_W['_action'] == 'members') { ?>active<?php  } ?>">
		<a href="<?php  echo iurl('spread/members/index');?>">推广员</a>
		</li>
		<li class="<?php  if($_W['_action'] == 'user') { ?> active <?php  } ?>">
			<a href="<?php  echo iurl('spread/user');?>">推广关系</a>
		</li>
		<li class="<?php  if($_W['_action'] == 'groups') { ?> active <?php  } ?>">
			<a href="<?php  echo iurl('spread/groups/index');?>">推广员等级</a>
		</li>
	</ul>
	<div class="menu-header">财务</div>
	<ul class="menu-item">
		<li class="<?php  if($_W['_action'] == 'getcash') { ?>active<?php  } ?>">
		<a href="<?php  echo iurl('spread/getcash/index')?>">提现记录</a>
		</li>
		<li class="<?php  if($_W['_action'] == 'current') { ?>active<?php  } ?>">
		<a href="<?php  echo iurl('spread/current/index')?>">账户明细</a>
		</li>
	</ul>
	<div class="menu-header">设置</div>
	<ul class="menu-item">
		<li class="<?php  if($_GPC['op'] == 'basic') { ?>active<?php  } ?>">
			<a href="<?php  echo iurl('spread/config/basic');?>">基本设置</a>
		</li>
		<li class="<?php  if($_W['_action'] == 'postera') { ?>active<?php  } ?>">
			<a href="<?php  echo iurl('spread/postera');?>">推广海报</a>
		</li>
		<li class="<?php  if($_W['_action'] == 'rank') { ?>active<?php  } ?>">
		<a href="<?php  echo iurl('spread/rank');?>">排行榜设置</a>
		</li>
		<li class="<?php  if($_GPC['op'] == 'cover') { ?>active<?php  } ?>">
			<a href="<?php  echo iurl('spread/cover');?>">入口设置</a>
		</li>
	</ul>
</div>
