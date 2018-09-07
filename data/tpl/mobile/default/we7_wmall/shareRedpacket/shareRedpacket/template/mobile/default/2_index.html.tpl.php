<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page share-page" id="page-app-share">
	<header class="bar bar-nav">
		<h1 class="title"><a href="javascript:;" class="back"><i class="icon icon-arrow-left"></i></a><span><?php  echo $redPacket['title'];?></span></h1>
	</header>
	<div class="content infinite-scroll js-infinite"  data-distance="50" data-min="<?php  echo $min;?>" data-container=".invite-list" data-tpl="tpl-invite" <?php  if($op == 'invite') { ?>data-href="<?php  echo imurl('shareRedpacket/index/invite')?>"<?php  } ?> <?php  if($op == 'ranking') { ?>data-href="<?php  echo imurl('shareRedpacket/index/ranking')?>"<?php  } ?>>
		<div class="init-area">
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/init_pic.png" alt="">
		</div>
		<div class="init-info">
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/init_bg.png" alt="">
			<div class="init-con">
				<div class="init-text">送好友最高<span><?php  echo $redPacket['follow_redpacket_max'];?>元</span>红包，TA首次下单您也得</div>
				<div class="init-money"><i>¥</i><?php  echo $redPacket['share_redpacket_max'];?></div>
				<div class="init-btn open-zhezhao"><a href="javascript:;">发红包</a></div>
			</div>
		</div>
		<div class="init-status">
			<div class="buttons-tab select-tab">
				<a href="<?php  echo imurl('shareRedpacket/index/invite')?>" class="button <?php  if($op == 'invite') { ?>active<?php  } ?>"><span>邀请奖励</span></a>
				<a href="<?php  echo imurl('shareRedpacket/index/ranking')?>" class="button <?php  if($op == 'ranking') { ?>active<?php  } ?>"><span>排行榜</span></a>
				<a href="<?php  echo imurl('shareRedpacket/index/agreement')?>" class="button <?php  if($op == 'agreement') { ?>active<?php  } ?>"><span>活动规则</span></a>
			</div>
			<?php  if($op == 'agreement') { ?>
			<div class="agreement">
				<?php  echo $redPacket['agreement'];?>
			</div>
			<?php  } ?>
			<?php  if($op == 'invite') { ?>
				<div class="init-title">
					<div class="init-tab">
						<p class="init-tab-h"><i class="icon icon-selection"></i>成功邀请</p>
						<p class="init-tab-c"><?php  echo intval($total);?><span>人</span></p>
					</div>
					<div class="init-tab">
						<p class="init-tab-h"><i class="icon icon-sponsorfill"></i>赚取红包</p>
						<p class="init-tab-c"><?php  echo floatval($redPacket_num);?><span>元</span></p>
					</div>
				</div>
				<!-- 有人领取 start-->
				<div class="init-friend">
					共有<span><?php  echo intval($total);?></span>人接受了我的邀请
				</div>
				<div class="list-block media-list">
					<ul class="invite-list">
						<?php  if(is_array($invited_info)) { foreach($invited_info as $info) { ?>
						<li>
							<div class="item-content">
								<div class="item-media">
									<?php  if(!empty($info['avatar'])) { ?>
										<img src="<?php  echo tomedia($info['avatar'])?>" alt="">
									<?php  } else { ?>
										<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/head.png">
									<?php  } ?>
								</div>
								<div class="item-inner">
									<div class="item-title-row">
										<div class="item-title"><?php  echo $info['nickname'];?></div>
									</div>
									<div class="item-subtitle">领取了您的红包</div>
									<?php  if($info['status'] == 1) { ?>
										<div class="has-ordered">
											<p>已经下单了</p>
											<span>您获得</span><?php  echo $info['share_redpacket_discount'];?><span>元红包</span>
										</div>
									<?php  } else { ?>
										<div class="init-wait">等待下单</div>
									<?php  } ?>
								</div>
							</div>
						</li>
						<?php  } } ?>
					</ul>
				</div>
				<div class="infinite-scroll-preloader hide">
					<div class="preloader"></div>
				</div>
				<!-- 有人领取 end-->
			<?php  } ?>
			<?php  if($op == 'ranking') { ?>
				<div class="list-block media-list">
					<ul class="invite-list">
						<?php  if(is_array($rankings)) { foreach($rankings as $ranking) { ?>
						<li>
							<div class="item-content">
								<div class="item-media">
									<?php  if(!empty($ranking['avatar'])) { ?>
									<img src="<?php  echo tomedia($ranking['avatar'])?>" alt="">
									<?php  } else { ?>
									<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/head.png">
									<?php  } ?>
								</div>
								<div class="item-inner">
									<div class="item-title-row ranking-info">
										<div class="item-title"><?php  echo $ranking['nickname'];?></div>
										<div class="item-after">邀请<?php  echo $ranking['total'];?>人</div>
									</div>
								</div>
							</div>
						</li>
						<?php  } } ?>
					</ul>
				</div>
				<div class="infinite-scroll-preloader hide">
					<div class="preloader"></div>
				</div>
			<?php  } ?>
		</div>
		<div class="zhezhao close-zhezhao">
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/share-layer.png" alt="">
		</div>
	</div>
</div>

<?php  if($op == 'invite') { ?>
<script id="tpl-invite" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li>
		<div class="item-content">
			<div class="item-media">
				<{# if(d[i].avatar){ }>
				<img src="<{d[i].avatar}>" alt="">
				<{# } else { }>
				<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/head.png">
				<{# } }>
			</div>
			<div class="item-inner">
				<div class="item-title-row">
					<div class="item-title"><{d[i].nickname}></div>
				</div>
				<div class="item-subtitle">领取了您的红包</div>
				<div class="init-wait">等待下单</div>
			</div>
		</div>
	</li>
	<{# } }>
</script>
<?php  } ?>

<?php  if($op == 'ranking') { ?>
<script id="tpl-invite" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li>
		<div class="item-content">
			<div class="item-media">
				<{# if(d[i].avatar){ }>
				<img src="<{d[i].avatar}>" alt="">
				<{# } else { }>
				<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/head.png">
				<{# } }>
			</div>
			<div class="item-inner">
				<div class="item-title-row ranking-info">
					<div class="item-title"><{d[i].nickname}></div>
					<div class="item-after">邀请<{d[i].total}>人</div>
				</div>
			</div>
		</div>
	</li>
	<{# } }>
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
