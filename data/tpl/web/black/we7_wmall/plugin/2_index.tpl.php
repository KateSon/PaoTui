<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="clearfix page-application">
	<?php  if(is_array($_W['plugin_types'])) { foreach($_W['plugin_types'] as $type) { ?>
		<?php  if(!empty($_W['plugins'][$type['name']])) { ?>
			<h2><?php  echo $type['title'];?></h2>
			<div class="application-list clearfix">
				<?php  if(is_array($_W['plugins'][$type['name']])) { foreach($_W['plugins'][$type['name']] as $plugin) { ?>
					<?php  if(check_perm($plugin['name'])) { ?>
						<?php  $url = $plugin['name'] . '/index/index'?>
						<div class="application-item clearfix">
							<a href="<?php  echo iurl($url);?>">
								<span class="application-image"><img src="<?php  echo $plugin['thumb'];?>" alt=""></span>
								<div class="application-info">
									<p class="application-name"><?php  echo $plugin['title'];?></p>
									<p class="application-description"><?php  echo $plugin['title'];?></p>
								</div>
							</a>
						</div>
					<?php  } ?>
				<?php  } } ?>
			</div>
		<?php  } ?>
	<?php  } } ?>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>