<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'index') { ?>
<div class="page page-manager" id="page-manager">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back"></a>
		<h1 class="title">商户中心</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="list-block media-list">
			<ul>
				<li>
					<div class="item-link item-content">
						<div class="item-media"><img src="<?php  echo tomedia($_W['manager']['avatar'])?>" style='width: 2.2rem;'></div>
						<div class="item-inner border-1px-b">
							<div class="item-title-row">
								<div class="item-title"><?php  echo $_W['manager']['title'];?></div>
							</div>
							<div class="item-subtitle"><?php  echo $_W['manager']['mobile'];?></div>
						</div>
					</div>
				</li>
				<li>
					<a href="<?php  echo imurl('manage/home/index/store')?>" class="item-link item-content">
						<div class="item-inner">
							<div class="item-title-row">
								<div class="item-title"><?php  echo $store['title'];?></div>
								<div class="item-after">切换店铺</div>
							</div>
						</div>
					</a>
				</li>
			</ul>
		</div>
		<div class="list-block">
			<ul>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">微信模板消息提醒</div>
							<div class="item-after">
								<label class="label-switch switch-sm">
									<input type="checkbox" class="js-checkbox " data-href="<?php  echo imurl('manage/more/index', array('type' => 'accept_wechat_notice'));?>" name="wechat" value="1"<?php  if($_W['manager']['extra']['accept_wechat_notice'] == 1) { ?>checked<?php  } ?>>
									<div class="checkbox"></div>
								</label>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">语音电话提醒</div>
							<div class="item-after">
								<label class="label-switch switch-sm">
									<input type="checkbox" class="js-checkbox " data-href="<?php  echo imurl('manage/more/index', array('type' => 'accept_voice_notice'));?>" name="voice" value="1"<?php  if($_W['manager']['extra']['accept_voice_notice'] == 1) { ?>checked<?php  } ?>>
									<div class="checkbox"></div>
								</label>
							</div>
						</div>
					</div>
				</li>
				<?php  if(is_cloud() || 1) { ?>
					<li class="item-content item-link">
						<a href="<?php  echo imurl('manage/more/phonic')?>" class="item-inner border-1px-b">
							<div class="item-title">语音提醒</div>
						</a>
					</li>
				<?php  } ?>
				<li class="item-content item-link">
					<a href="<?php  echo imurl('manage/more/profile')?>" class="item-inner">
						<div class="item-title">修改管理员信息</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>