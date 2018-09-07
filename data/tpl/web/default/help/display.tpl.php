<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'system') { ?>
<div style="height: 902px; z-index: 1;">
	<iframe src="//s.we7.cc/index.php?c=wiki&a=view&id=2&list=29&simple=1<?php  if($_W['isfounder'] && !user_is_vice_founder()) { ?>&role=admin<?php  } ?>" marginheight="0" marginwidth="0" frameborder="0" width="100%" height="100%" allowTransparency="true"></iframe>
</div>
<?php  } ?>
<?php  if($do == 'custom') { ?>
<div style="height: 902px; z-index: 1;">
	<?php  if(!empty($wiki_id)) { ?>
	<iframe src="//s.we7.cc/index.php?c=wiki&a=view&id=<?php  echo $wiki_id;?>&simple=1" marginheight="0" marginwidth="0" frameborder="0" width="100%" height="100%" allowTransparency="true"></iframe>
	<?php  } else { ?>
	<div class="we7-margin-vertical text-center font-lg">ÔİÎŞÄÚÈİ</div>
	<?php  } ?>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>