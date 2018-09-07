<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page page-activity-list">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">店铺活动</h1>
	</header>
	<div class="buttons-tab activity_status">
		<a href="<?php  echo ifilter_url('status:2');?>" class="button <?php  if($status == 2) { ?> active <?php  } ?>">待生效</a>
		<a href="<?php  echo ifilter_url('status:1');?>" class="button <?php  if($status == 1) { ?> active <?php  } ?>">进行中</a>
		<a href="<?php  echo ifilter_url('status:0');?>" class="button <?php  if($status == 0) { ?> active <?php  } ?>">已结束</a>
	</div>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<?php  if(is_array($activity)) { foreach($activity as $item) { ?>
	 		<div class="card">
				<div class="card-header border-1px-b">
					<div class="activity-title">
						<?php  echo $item['title'];?>
					</div>
					<span class="pull-right">
						<?php  if($status == 1) { ?>
							进行中 剩余<i><?php  echo $item['until'];?>天</i>
						<?php  } else if($status == 2) { ?>
							未开始
						<?php  } else if($status == 0) { ?>
							已结束
						<?php  } ?>
					</span>
				</div>
	    		<div class="card-content">
	      			<div class="card-content-inner">
	      				<?php  if($item['type'] == couponCollect || $item['type'] == couponGrant) { ?>
		      				<div class="row border-1px-b">
								<div class="col-33">
									<div class="col-title">券总张数</div>
									<div class="col-item">
										<i>
											<?php  if($item['type'] == couponCollect) { ?>
												<?php  echo $item['coupon_detail']['total'] * $item['coupon_detail']['amount']?>
											<?php  } else { ?>
												<?php  echo $item['coupon_detail']['amount'];?>
											<?php  } ?>
										</i>张
									</div>
								</div>
								<div class="col-33">
									<div class="col-title">发放数量</div>
									<div class="col-item text-red">
										<i>
											<?php  if($item['type'] == couponCollect) { ?>
												<?php  echo $item['coupon_detail']['dosage_total'];?>
											<?php  } else { ?>
												<?php  echo $item['coupon_detail']['dosage'];?>
											<?php  } ?>
										</i>张
									</div>
								</div>
								<div class="col-33">
									<div class="col-title">使用数量</div>
									<div class="col-item text-red">
										<i><?php  echo $item['coupon_detail']['is_use_total'];?></i>张
									</div>
								</div>
			  				</div>
		  				<?php  } ?>
	      				<div class="discription">
							<div class="one-list clearfix">
								<div class="left">活动类型:</div>
								<div class="right">
									<?php  if($item['type'] == bargain) { ?>
										天天特价
									<?php  } else if($item['type'] == discount) { ?>
										店铺满减
									<?php  } else if($item['type'] == grant) { ?>
										满赠活动
									<?php  } else if($item['type'] == newMember) { ?>
										门店新用户
									<?php  } else if($item['type'] == selfDelivery) { ?>
										自提优惠
									<?php  } else if($item['type'] == couponCollect) { ?>
										进店领券
									<?php  } else if($item['type'] == couponGrant) { ?>
										满返优惠
									<?php  } ?>
								</div>
							</div>
							<?php  if($item['type'] == couponCollect) { ?>
								<div class="one-list clearfix">
									<div class="left">券的金额:</div>
									<div class="right">
										<?php  if(is_array($item['data'])) { foreach($item['data'] as $coupon) { ?>
											<?php  echo $coupon['discount'];?>元|满<?php  echo $coupon['condition'];?>可用 
										<?php  } } ?>
									</div>
								</div>
								<div class="one-list clearfix">
									<div class="left">券有效期:</div>
									<div class="right">
										<?php  if(is_array($item['data'])) { foreach($item['data'] as $times) { ?>
											领券后<?php  echo $times['use_days_limit'];?>天内 
										<?php  } } ?>
									</div>
								</div>
							<?php  } else if($item['type'] == couponGrant) { ?>
								<div class="one-list clearfix">
									<div class="left">返券条件:</div>
									<div class="right">订单满<?php  echo $item['coupon_detail']['condition'];?>元</div>
								</div>
								<div class="one-list clearfix">
									<div class="left">券的金额:</div>
									<div class="right">
										<?php  echo $item['data']['discount'];?>元|满<?php  echo $item['data']['condition'];?>可用
									</div>
								</div>
								<div class="one-list clearfix">
									<div class="left">券有效期:</div>
									<div class="right">
										领券后<?php  echo $item['data']['use_days_limit'];?>天内
									</div>
								</div>
							<?php  } else if($item['type'] == newMember) { ?>
								<div class="one-list clearfix">
									<div class="left">活动规则:</div>
									<div class="right">
										门店新客立减<?php  echo $item['data']['back'];?>元
									</div>
								</div>
							<?php  } else if($item['type'] == grant) { ?>
								<div class="one-list clearfix">
									<div class="left">活动规则:</div>
									<div class="right">
										<?php  if(is_array($item['data'])) { foreach($item['data'] as $row) { ?>
											满<?php  echo $row['condition'];?>赠送<?php  echo $row['back'];?> 
										<?php  } } ?>
									</div>
								</div>
							<?php  } else if($item['type'] == discount) { ?>
								<div class="one-list clearfix">
									<div class="left">活动规则:</div>
									<div class="right">
										<?php  if(is_array($item['data'])) { foreach($item['data'] as $row) { ?>
											满<?php  echo $row['condition'];?>减<?php  echo $row['back'];?>元
										<?php  } } ?>
									</div>
								</div>
							<?php  } ?>
							<div class="one-list clearfix">
								<div class="left">开始时间:</div>
								<div class="right"><?php  echo date('Y-m-d', $item['starttime'])?></div>
							</div>
							<div class="one-list clearfix">
								<div class="left">结束时间:</div>
								<div class="right"><?php  echo date('Y-m-d', $item['endtime'])?></div>
							</div>
							<div class="one-list clearfix">
								<div class="left">创建日期:</div>
								<div class="right"><?php  echo date('Y-m-d', $item['addtime'])?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a href="<?php  echo imurl('manage/activity/list/del', array('type' => $item['type']));?>" class="js-post" data-confirm="确定撤销活动么">
						撤销活动
					</a>
	    		</div>
	 		</div>
 		<?php  } } ?>
 		<?php  if(empty($activity)) { ?>
			<div class="no-data">
				<div class="bg"></div>
				<p>没有任何活动哦~</p>
			</div>
 		<?php  } ?>
	</div>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>