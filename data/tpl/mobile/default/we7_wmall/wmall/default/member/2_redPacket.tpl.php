<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'list') { ?>
<div class="page redPacket-my">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">我的红包</h1>
	</header>
	<?php  get_mall_menu();?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('wmall/member/redPacket/list', array('status' => $status));?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".redPacket-list" data-tpl="tpl-redPacket">
		<?php  if(empty($redPackets)) { ?>
			<div class="common-no-con">
				<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/coupon_no_con.png" alt="" />
				<p>您没有红包记录</p>
			</div>
		<?php  } else { ?>
			<div class="redPacket-list content-padded">
				<?php  if(is_array($redPackets)) { foreach($redPackets as $redPacket) { ?>
					<div class="redPacket-list-item border-1px <?php  if($status == 3) { ?>expire<?php  } ?> <?php  if($status == 2) { ?>is-use<?php  } ?>">
						<div class="redPacket-info row">
							<div class="col-50">
								<span class="redPacket-title"><?php  echo $redPacket['title'];?></span>
							</div>
							<div class="col-50 text-right">
								<div class="price">￥<span class="price-num"><?php  echo $redPacket['discount'];?></span></div>
							</div>
						</div>
						<div class="redPacket-use-limit row">
							<div class="col-60">限<?php  echo $redPacket['starttime'];?>-<?php  echo $redPacket['endtime'];?>使用</div>
							<div class="col-40 text-right">
								<?php  if($redPacket['condition'] > 0) { ?>
									<p class="use-condition">满<?php  echo $redPacket['condition'];?>元可用</p>
								<?php  } else { ?>
									<p class="use-condition">满任意金额元可用</p>
								<?php  } ?>
							</div>
						</div>
						<?php  if(!empty($redPacket['time_cn']) || !empty($redPacketp['category_cn'])) { ?>
							<div class="other-limit">
								<?php  echo $redPacket['category_cn'];?> <?php  echo $redPacket['time_cn'];?>
							</div>
						<?php  } ?>
						<span class="border-1px-r circle circle-left"></span>
						<span class="border-1px-l circle circle-right"></span>
						<span class="overdue"></span>
						<span class="use"></span>
					</div>
				<?php  } } ?>
			</div>
			<div class="infinite-scroll-preloader hide">
				<div class="preloader"></div>
			</div>
			<?php  if($status != 3) { ?>
				<div class="no-more">
					<a href="javascript:;">没有更多红包了</a><span>|</span><a href="<?php  echo imurl('wmall/member/redPacket/list', array('status' => 3))?>">查看无效券</a>
				</div>
			<?php  } ?>
		<?php  } ?>
	</div>
</div>
<script id="tpl-redPacket" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<div class="redPacket-list-item border-1px <{# if(d[i].status == 2){ }>is-use<{# }}> <{# if(d[i].status == 3){ }>expire<{# } }>">
		<div class="redPacket-info row">
			<div class="col-50">
				<span class="redPacket-title"><{d[i].title}></span>
			</div>
			<div class="col-50 text-right">
				<div class="price">￥<span class="price-num"><{d[i].discount}></span></div>
			</div>
		</div>
		<div class="redPacket-use-limit row">
			<div class="col-60">限<{d[i].starttime}>-<{d[i].endtime}>使用</div>
			<div class="col-40 text-right">
				<{# if(d[i].condition > 0){ }>
					<p class="use-condition">满<{d[i].condition}>元可用</p>
				<{# } else { }>
					<p class="use-condition">满任意金额元可用</p>
				<{# } }>
			</div>
		</div>
		<{# if(d[i].time_cn || d[i].category_cn){ }>
			<div class="other-limit">
				<{d[i].category_cn}> <{d[i].time_cn}>
			</div>
		<{# } }>
		<span class="border-1px-r circle circle-left"></span>
		<span class="border-1px-l circle circle-right"></span>
		<span class="overdue"></span>
		<span class="use"></span>
	</div>
	<{# } }>
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
