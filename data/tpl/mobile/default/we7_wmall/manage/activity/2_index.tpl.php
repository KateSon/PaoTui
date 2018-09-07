<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page page-activity">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">店铺活动</h1>
	</header>
	<div class="buttons-tab">
		<a href="javascript:;" class="button active" id="create-new">新建活动</a>
		<a href="<?php  echo imurl('manage/activity/list')?>" class="button" id="activityList">已创建活动</a>
	</div>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="main">
			<ul>
				<li class="activity-col clearfix">
					<div class="col-left">
						<span class="text-red">减</span>
					</div>
					<div class="col-right border-1px-b">
						<div class="right-content">
							<h3>店铺满减</h3>
							<p>配置店铺满减活动,吸引更多用户下单</p>
							<?php  if(!empty($activity['discount'])) { ?>
							<a href="<?php  echo imurl('manage/activity/list', array('status' => $activity['discount']['status']));?>" class="activity-link add">
								已创建
							</a>
							<?php  } else { ?>
							<a href="<?php  echo imurl('manage/activity/discount');?>" class="activity-link">立即创建</a>
							<?php  } ?>
						</div>
					</div>
				</li>
				<li class="activity-col clearfix">
					<div class="col-left">
						<span class="text-red">返</span>
					</div>
					<div class="col-right border-1px-b">
						<div class="right-content">
							<h3>返现优惠</h3>
							<p>配置店铺返现优惠活动,吸引更多用户下单</p>
							<?php  if(!empty($activity['cashGrant'])) { ?>
							<a href="<?php  echo imurl('manage/activity/list', array('status' => $activity['cashGrant']['status']));?>" class="activity-link add">
								已创建
							</a>
							<?php  } else { ?>
							<a href="<?php  echo imurl('manage/activity/cashGrant');?>" class="activity-link">立即创建</a>
							<?php  } ?>
						</div>
					</div>
				</li>
				<li class="activity-col clearfix">
					<div class="col-left">
						<span class="text-green">新</span>
					</div>
					<div class="col-right border-1px-b">
						<div class="right-content">
							<h3>门店新用户</h3>
							<p>新用户下单满足条件后可享受减免优惠</p>
							<?php  if(!empty($activity['newMember'])) { ?>
								<a href="<?php  echo imurl('manage/activity/list', array('status' => $activity['newMember']['status']));?>" class="activity-link add">
									已创建
								</a>
							<?php  } else { ?>
								<a href="<?php  echo imurl('manage/activity/newMember');?>" class="activity-link">立即创建</a>
							<?php  } ?>
						</div>
					</div>
				</li>
				<li class="activity-col clearfix">
					<div class="col-left">
						<span class="text-red">赠</span>
					</div>
					<div class="col-right border-1px-b">
						<div class="right-content">
							<h3>满赠活动</h3>
							<p>下单满足条件后可获得赠品</p>
							<?php  if(!empty($activity['grant'])) { ?>
								<a href="<?php  echo imurl('manage/activity/list', array('status' => $activity['grant']['status']));?>" class="activity-link add">
									已创建
								</a>
							<?php  } else { ?>
								<a href="<?php  echo imurl('manage/activity/grant');?>" class="activity-link">立即创建</a>
							<?php  } ?>
						</div>
					</div>
				</li>
				<li class="activity-col clearfix">
					<div class="col-left">
						<span class="text-yellow">自</span>
					</div>
					<div class="col-right border-1px-b">
						<div class="right-content">
							<h3>自提优惠</h3>
							<p>自提满足条件后可享受减优惠</p>
							<?php  if(!empty($activity['selfDelivery'])) { ?>
								<a href="<?php  echo imurl('manage/activity/list', array('status' => $activity['selfDelivery']['status']));?>" class="activity-link add">
									已创建
								</a>
							<?php  } else { ?>
								<a href="<?php  echo imurl('manage/activity/selfDelivery');?>" class="activity-link">立即创建</a>
							<?php  } ?>
						</div>
					</div>
				</li>
				<li class="activity-col clearfix">
					<div class="col-left">
						<span class="text-red">券</span>
					</div>
					<div class="col-right border-1px-b">
						<div class="right-content">
							<h3>进店领券</h3>
							<p>顾客进店可领取代金券</p>
							<?php  if(!empty($activity['couponCollect'])) { ?>
								<a href="<?php  echo imurl('manage/activity/list', array('status' => $activity['couponCollect']['status']));?>" class="activity-link add">
									已创建
								</a>
							<?php  } else { ?>
								<a href="<?php  echo imurl('manage/activity/couponCollect');?>" class="activity-link">立即创建</a>
							<?php  } ?>
						</div>
					</div>
				</li>
				<li class="activity-col clearfix">
					<div class="col-left">
						<span class="text-red">满</span>
					</div>
					<div class="col-right border-1px-b">
						<div class="right-content">
							<h3>满返优惠</h3>
							<p>下单满足条件后可返代金券</p>
							<?php  if(!empty($activity['couponGrant'])) { ?>
								<a href="<?php  echo imurl('manage/activity/list', array('status' => $activity['couponGrant']['status']));?>" class="activity-link add">
									已创建
								</a>
							<?php  } else { ?>
								<a href="<?php  echo imurl('manage/activity/couponGrant');?>" class="activity-link">立即创建</a>
							<?php  } ?>
						</div>
					</div>
				</li>
				<li class="activity-col clearfix">
					<div class="col-left">
						<span class="text-yellow">特</span>
					</div>
					<div class="col-right border-1px-b">
						<div class="right-content">
							<h3>天天特价</h3>
							<p>指定商品特价或折扣优惠</p>
							<?php  if(!empty($activity['bargain'])) { ?>
								<a href="javascript:;" class="activity-link add" id="bargain">
									已创建
								</a>
							<?php  } else { ?>
								<a href="javascript:;" class="activity-link" id="bargain">立即创建</a>
							<?php  } ?>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<script>
$(function(){
	var collectStatus = "<?php  echo $activity['couponCollect']['status'];?>";
	var grantStatus = "<?php  echo $activity['couponGrant']['status'];?>";
	$(document).on('click', '#bargain', function(){
		$.toast('天天特价活动只能在电脑端创建');
	});
})
</script>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>