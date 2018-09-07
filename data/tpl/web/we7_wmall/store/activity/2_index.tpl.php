<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="clearfix">
	<div class="activity-shop-card">
		<div class="icon">
			<img src="<?php echo MODULE_URL;?>/static/img/activity-self-jian.png" alt=""/>
		</div>
		<span class="title">门店新用户活动</span>
		<span class="sub-title">新用户下单满足条件后可享受减免优惠</span>
		<span class="count">已有 <span class="num"><?php  echo intval($stats['newMember']['num']);?></span> 商户创建</span>
		<?php  if(!empty($activitys['newMember'])) { ?>
			<a href="<?php  echo iurl('store/activity/newMember');?>" class="btn btn-danger">查看</a>
		<?php  } else { ?>
			<a href="<?php  echo iurl('store/activity/newMember');?>" class="btn btn-primary">创建</a>
		<?php  } ?>
	</div>
	<div class="activity-shop-card">
		<div class="icon">
			<img src="<?php echo MODULE_URL;?>/static/img/activity-self-jian.png" alt=""/>
		</div>
		<span class="title">满减活动</span>
		<span class="sub-title">下单满足条件后可享受减免优惠</span>
		<span class="count">已有 <span class="num"><?php  echo intval($stats['discount']['num']);?></span> 商户创建</span>
		<?php  if(!empty($activitys['discount'])) { ?>
			<a href="<?php  echo iurl('store/activity/discount');?>" class="btn btn-danger">查看</a>
		<?php  } else { ?>
			<a href="<?php  echo iurl('store/activity/discount');?>" class="btn btn-primary">创建</a>
		<?php  } ?>
	</div>
	<div class="activity-shop-card">
		<div class="icon">
			<img src="<?php echo MODULE_URL;?>/static/img/activity-self-zeng.png" alt=""/>
		</div>
		<span class="title">满赠活动</span>
		<span class="sub-title">下单满足条件后可获得赠品</span>
		<span class="count">已有 <span class="num"><?php  echo intval($stats['grant']['num']);?></span> 商户创建</span>
		<?php  if(!empty($activitys['grant'])) { ?>
			<a href="<?php  echo iurl('store/activity/grant');?>" class="btn btn-danger">查看</a>
		<?php  } else { ?>
			<a href="<?php  echo iurl('store/activity/grant');?>" class="btn btn-primary">创建</a>
		<?php  } ?>
	</div>
	<div class="activity-shop-card">
		<div class="icon">
			<img src="<?php echo MODULE_URL;?>/static/img/activity-self-te.png" alt=""/>
		</div>
		<span class="title">天天特价</span>
		<span class="sub-title">指定商品特价或折扣优惠</span>
		<span class="count">已有 <span class="num"><?php  echo intval($stats['bargain']['num']);?></span> 商户创建</span>
		<?php  if(!empty($activitys['bargain'])) { ?>
			<a href="<?php  echo iurl('store/activity/bargain');?>" class="btn btn-danger">查看</a>
		<?php  } else { ?>
			<a href="<?php  echo iurl('store/activity/bargain');?>" class="btn btn-primary">创建</a>
		<?php  } ?>
	</div>
	<div class="activity-shop-card">
		<div class="icon">
			<img src="<?php echo MODULE_URL;?>/static/img/activity-self-coupon-jindian.png" alt=""/>
		</div>
		<span class="title">进店领券</span>
		<span class="sub-title">顾客进店可领取代金券</span>
		<span class="count">已有 <span class="num"><?php  echo intval($stats['couponCollect']['num']);?></span> 商户创建</span>
		<?php  if(!empty($activitys['couponCollect'])) { ?>
			<a href="<?php  echo iurl('store/activity/couponCollect');?>" class="btn btn-danger">查看</a>
		<?php  } else { ?>
			<a href="<?php  echo iurl('store/activity/couponCollect');?>" class="btn btn-primary">创建</a>
		<?php  } ?>
	</div>
	<div class="activity-shop-card">
		<div class="icon">
			<img src="<?php echo MODULE_URL;?>/static/img/activity-self-coupon-jindian.png" alt=""/>
		</div>
		<span class="title">满返优惠</span>
		<span class="sub-title">下单满足条件后可返代金券</span>
		<span class="count">已有 <span class="num"><?php  echo intval($stats['couponGrant']['num']);?></span> 商户创建</span>
		<?php  if(!empty($activitys['couponGrant'])) { ?>
		<a href="<?php  echo iurl('store/activity/couponGrant');?>" class="btn btn-danger">查看</a>
		<?php  } else { ?>
		<a href="<?php  echo iurl('store/activity/couponGrant');?>" class="btn btn-primary">创建</a>
		<?php  } ?>
	</div>
	<div class="activity-shop-card">
		<div class="icon">
			<img src="<?php echo MODULE_URL;?>/static/img/activity-self-coupon-jindian.png" alt=""/>
		</div>
		<span class="title">返现优惠</span>
		<span class="sub-title">下单满足条件后可返现金</span>
		<span class="count">已有 <span class="num"><?php  echo intval($stats['cashGrant']['num']);?></span> 商户创建</span>
		<?php  if(!empty($activitys['cashGrant'])) { ?>
		<a href="<?php  echo iurl('store/activity/cashGrant');?>" class="btn btn-danger">查看</a>
		<?php  } else { ?>
		<a href="<?php  echo iurl('store/activity/cashGrant');?>" class="btn btn-primary">创建</a>
		<?php  } ?>
	</div>
	<div class="activity-shop-card">
		<div class="icon">
			<img src="<?php echo MODULE_URL;?>/static/img/activity-self-coupon-jindian.png" alt=""/>
		</div>
		<span class="title">自提优惠</span>
		<span class="sub-title">自提满足条件后可享受减优惠</span>
		<span class="count">已有 <span class="num"><?php  echo intval($stats['selfDelivery']['num']);?></span> 商户创建</span>
		<?php  if(!empty($activitys['selfDelivery'])) { ?>
			<a href="<?php  echo iurl('store/activity/selfDelivery');?>" class="btn btn-danger">查看</a>
		<?php  } else { ?>
			<a href="<?php  echo iurl('store/activity/selfDelivery');?>" class="btn btn-primary">创建</a>
		<?php  } ?>
	</div>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>