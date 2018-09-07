<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page coupon" id="page-app-coupon">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">我的代金券</h1>
		<a class="pull-right" href="<?php  echo imurl('wmall/channel/coupon');?>"><i class="icon icon-coupon"></i></a>
	</header>
	<?php  get_mall_menu();?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('wmall/member/coupon/more');?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".content-padded" data-tpl="tpl-coupon">
		<div class="coupon-list">
			<?php  if(empty($coupons)) { ?>
				<div class="common-no-con">
					<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/coupon_no_con.png" alt="" />
					<p>您没有代金券</p>
					<div class="btn">
						<a href="<?php  echo imurl('wmall/channel/coupon');?>">去领券中心看看</a>
					</div>
				</div>
			<?php  } else { ?>
				<div class="content-padded">
					<?php  if(is_array($coupons)) { foreach($coupons as $coupon) { ?>
					<div class="coupon-item <?php  if($status != 1) { ?>disabled<?php  } ?> <?php  if($status == 3) { ?> expire <?php  } ?> <?php  if($status == 2) { ?> is-use <?php  } ?>">
						<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $coupon['sid']));?>">
							<div class="clearfix">
								<span class="circle border-1px-r circle-left"></span>
								<span class="circle border-1px-l circle-right"></span>
								<span class="overdue"></span>
								<span class="use"></span>
								<div class="left">
									<div class="store-logo">
										<img src="<?php  echo tomedia($coupon['logo'])?>" alt="">
									</div>
									<div class="coupon-detail">
										<div class="coupon-title">
											<?php  echo $coupon['title'];?>
										</div>
										<div class="use-time">有效期至:<?php  echo $coupon['endtime'];?></div>
									</div>
								</div>
								<div class="right">
									<div class="price">
										<span>¥</span><?php  echo $coupon['discount'];?>
									</div>
									<div class="condition">满<?php  echo $coupon['condition'];?>元可用</div>
								</div>
							</div>
						</a>
					</div>
					<?php  } } ?>
				</div>
				<div class="infinite-scroll-preloader hide">
					<div class="preloader"></div>
				</div>
				<div class="no-more">
					<a href="<?php  echo imurl('wmall/member/coupon', array('status' => 2));?>">查看已使用券</a><span>|</span><a href="<?php  echo imurl('wmall/member/coupon', array('status' => 3));?>">查看无效券</a>
				</div>
			<?php  } ?>
		</div>
		<?php  if(!empty($coupons)) { ?>
			<div class="coupon-more">
				<a href="<?php  echo imurl('wmall/channel/coupon');?>">更多好券,去领券中心看看</a>
			</div>
		<?php  } ?>
	</div>
</div>

<script id="tpl-coupon" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<div class="coupon-item <{# if(d[i].status != 1){ }>disabled<{# } }><{# if(d[i].status == 2){ }>is-use<{# }}><{# if(d[i].status == 3){ }>expire<{# } }>">
		<a href="<?php  echo imurl('wmall/store/goods');?>&sid=<{d[i].sid}>">
			<div class="clearfix">
				<span class="circle border-1px-r circle-left"></span>
				<span class="circle border-1px-l circle-right"></span>
				<span class="overdue"></span>
				<span class="use"></span>
				<div class="left">
					<div class="store-logo">
						<img src="<{d[i].logo}>" alt="">
					</div>
					<div class="coupon-detail">
						<div class="coupon-title">
							<{d[i].title}>
						</div>
						<div class="use-time">有效期至:<{d[i].endtime}></div>
					</div>
				</div>
				<div class="right">
					<div class="price">
						<span>¥</span><{d[i].discount}>
					</div>
					<div class="condition">满<{d[i].condition}>元可用</div>
				</div>
			</div>
		</a>
	</div>
	<{# } }>
</script>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>