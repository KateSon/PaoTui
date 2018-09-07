<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page my-page" id="page-app-mine">
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="banner">
			<div class="avatar">
				<?php  if(!empty($deliveryer['avatar'])) { ?>
					<img src="<?php  echo tomedia($deliveryer['avatar']);?>" alt="">
				<?php  } else { ?>
					<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/head.png" alt="">
				<?php  } ?>
			</div>
			<div class="name"><?php  echo $deliveryer['nickname'];?></div>
			<?php  if($deliveryer_type != 2) { ?>
			<div class="table activity-nav">
				<div class="table-cell">
					<a href="javascript:;">
						<div class="count"><?php  echo $deliveryer['credit2'];?></div>
						<div class="">账户余额</div>
					</a>
				</div>
				<div class="table-cell">
					<a href="javascript:;">
						<div class="count"><?php  echo $pft_stat['today_num'];?></div>
						<div class="">今日累计</div>
					</a>
				</div>
				<div class="table-cell">
					<a href="javascript:;">
						<div class="count"><?php  echo $pft_stat['month_num'];?></div>
						<div class="">本月累计</div>
					</a>
				</div>
				<div class="table-cell">
					<a href="javascript:;">
						<div class="count"><?php  echo $pft_stat['total_num'];?></div>
						<div class="">总累计</div>
					</a>
				</div>
			</div>
			<?php  } ?>
		</div>
		<?php  if($deliveryer_type != 2) { ?>
			<div class="list-block border-1px-tb">
				<ul>
					<li class="item-content">
						<a class="item-inner border-1px-b" href="javascript:;">
							<div class="item-title text-left">微信模板消息提醒</div>
							<label class="label-switch switch-sm">
								<input type="checkbox" class="js-checkbox" data-href="<?php  echo imurl('delivery/member/mine/changes', array('type' => 'accept_wechat_notice'))?>" name="wechat" value="1"<?php  if($_W['deliveryer']['extra']['accept_wechat_notice'] == 1) { ?>checked<?php  } ?>>
								<div class="checkbox"></div>
							</label>
						</a>
					</li>
					<li class="item-content">
						<a class="item-inner border-1px-b" href="javascript:;">
							<div class="item-title text-left">语音电话提醒</div>
							<label class="label-switch switch-sm">
								<input type="checkbox" class="js-checkbox" data-href="<?php  echo imurl('delivery/member/mine/changes', array('type' => 'accept_voice_notice'))?>" name="voice" value="1"<?php  if($_W['deliveryer']['extra']['accept_voice_notice'] == 1) { ?>checked<?php  } ?>>
								<div class="checkbox"></div>
							</label>
						</a>
					</li>
					<li class="item-content">
						<div class="item-media"><i class="icon icon-me"></i></div>
						<a class="item-inner border-1px-b" href="javascript:;">
							<div class="item-title text-left">接单中</div>
							<label class="label-switch switch-sm">
								<input type="checkbox" class="js-checkbox" data-href="<?php  echo imurl('delivery/member/mine/work_status')?>" name="work_status" value="1" <?php  if($deliveryer['work_status'] == 1) { ?>checked<?php  } ?>>
								<div class="checkbox"></div>
							</label>
						</a>
					</li>
					<li class="item-content item-link">
						<div class="item-media"><i class="icon icon-account"></i></div>
						<a class="item-inner border-1px-b" href="<?php  echo imurl('delivery/finance/current')?>">
							<div class="item-title text-left">账户明细</div>
						</a>
					</li>
					<li class="item-content item-link">
						<div class="item-media"><i class="icon icon-refund"></i></div>
						<a class="item-inner" href="<?php  echo imurl('delivery/finance/getcash')?>">
							<div class="item-title text-left">申请提现</div>
						</a>
					</li>
				</ul>
			</div>
		<?php  } ?>
	</div>
</div>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>