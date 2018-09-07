<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page my-page" id="page-app-mine">
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="banner">
			<div class="avatar">
				<?php  if(!empty($user['avatar'])) { ?>
					<img src="<?php  echo tomedia($user['avatar']);?>" alt="">
				<?php  } else { ?>
					<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/head.png" alt="">
				<?php  } ?>
				<?php  if($_W['member']['groupid'] > 0) { ?>
					<span><?php  echo $_W['member']['groupname'];?></span>
				<?php  } ?>
			</div>
			<a href="<?php  echo imurl('wmall/member/profile/info')?>"><span class="icon icon-settings"></span></a>
			<div class="name">
				<a href="<?php  if(!empty($deliveryCard_status)) { ?><?php  echo imurl('deliveryCard/index');?><?php  } else { ?>javascript:;<?php  } ?>">
					<?php  echo $user['nickname'];?>
					<?php  if(!empty($deliveryCard_status)) { ?>
						<?php  if($user['setmeal_id'] > 0 && $user['setmeal_endtime'] > TIMESTAMP) { ?>
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/vip_effective.png" alt="">
						<?php  } else { ?>
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/vip_deprecated.png" alt="">
						<?php  } ?>
					<?php  } ?>
				</a>
			</div>
			<div class="table activity-nav">
				<div class="table-cell">
					<a href="<?php  echo imurl('wmall/member/coupon');?>">
						<div class="count"><?php  echo $coupon_nums;?></div>
						<div class="">代金券</div>
					</a>
				</div>
				<?php  if(!empty($redpacket_status)) { ?>
					<div class="table-cell">
						<a href="<?php  echo imurl('wmall/member/redPacket');?>">
							<div class="count"><?php  echo $redpacket_nums;?></div>
							<div class="">红包</div>
						</a>
					</div>
				<?php  } else { ?>
					<div class="table-cell">
						<a href="<?php  echo imurl('wmall/member/favorite');?>">
							<div class="count"><?php  echo $favorite;?></div>
							<div class="">我的收藏</div>
						</a>
					</div>
				<?php  } ?>
				<div class="table-cell" style="display: none">
					<a href="<?php  echo imurl('wmall/member/favorite');?>">
						<div class="count"><?php  echo $favorite;?></div>
						<div class="">收藏店铺</div>
					</a>
				</div>
				<div class="table-cell">
					<a href="<?php  echo imurl('wmall/member/recharge');?>">
						<div class="count"><?php  echo floatval($user['credit2'])?></div>
						<div class="">余额</div>
					</a>
				</div>
				<div class="table-cell">
					<a href="javascript:;">
						<div class="count"><?php  echo floatval($user['credit1'])?></div>
						<div class="">积分</div>
					</a>
				</div>
			</div>
		</div>
		<?php  if(empty($_W['member']['mobile_audit'])) { ?>
			<div class="list-block">
				<ul>
					<li class="item-content item-link">
						<div class="item-media"><i class="icon icon-phone"></i></div>
						<a href="<?php  echo imurl('wmall/member/profile/bind')?>" class="item-inner">
							<div class="item-title bind-mobile">绑定手机号</div>
						</a>
					</li>
					<div class="notice">
						如果您用手机号注册过会员或您想通过微信外购物请绑定您的手机号码
					</div>
				</ul>
			</div>
		<?php  } ?>
		<?php  if(!is_h5app()) { ?>
			<div class="grid-nav grid-money border-1px-tb">
				<div class="grid-money-title border-1px-b">
					商家管理
					<?php  if($config_mall['version'] == 1 && $config_settle['status'] == 1) { ?>
						<a href="<?php  echo imurl('wmall/store/settle');?>">商家入驻,轻松提现</a> <i class="icon icon-arrow-right"></i>
					<?php  } ?>
				</div>
				<div class="row no-gutter">
					<div class="col-33">
						<a href="<?php  echo imurl('manage/home/index');?>" class="external">
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/mypage_messages.png" alt="" />
							<span>店员入口</span>
						</a>
					</div>
					<div class="col-33">
						<a href="<?php  echo imurl('delivery/home/index');?>">
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/mypage_messages.png" alt="" />
							<span>配送员入口</span>
						</a>
					</div>
					<?php  if($config_mall['version'] == 1 && $config_settle['status'] == 1) { ?>
					<div class="col-33">
							<a href="<?php  echo imurl('wmall/store/settle');?>">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/mypage_settle.png" alt="" />
								<span>商户入驻</span>
							</a>
						</div>
					<?php  } ?>
				</div>
			</div>
		<?php  } ?>
		<div class="grid-nav">
			<?php  if(is_array($urls)) { foreach($urls as $chunk) { ?>
				<?php  $i++;?>
				<div class="row no-gutter border-1px-b">
					<?php  if(is_array($chunk)) { foreach($chunk as $item) { ?>
						<?php  $j++;?>
						<div class="col-25 <?php  if($i == 1) { ?>border-1px-t<?php  } ?>">
							<a href="<?php  echo $item['url'];?>" class="<?php  if($j % 4 != 0) { ?>border-1px-r<?php  } ?> <?php  echo $item['css'];?>">
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/<?php  echo $item['icon'];?>" alt="" />
								<span><?php  echo $item['title'];?></span>
							</a>
						</div>
					<?php  } } ?>
				</div>
			<?php  } } ?>
		</div>
		<div class="service-tel">
			<a href="tel:<?php  echo $config_mall['mobile'];?>" class="color-danger border-1px-tb">客服热线: <?php  echo $config_mall['mobile'];?></a>
		</div>
		<?php  include itemplate('public/copyright', TEMPLATE_INCLUDEPATH);?>
	</div>
</div>
<script>
<?php  if(!is_error($spread)) { ?>
	$.toptip("<?php  echo $spread['nickname'];?>向您推荐了<?php  echo $config_mall['title'];?>,快去下单吧!", 10000, 'success')
<?php  } ?>
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>