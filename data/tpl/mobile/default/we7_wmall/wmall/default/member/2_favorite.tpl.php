<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page home" id="page-app-my-favotite">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">我的收藏</h1>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="store-list" <?php  if(empty($stores)) { ?>style="position:relative;"<?php  } ?>>
		<?php  if(empty($stores)) { ?>
			<div class="common-no-con">
				<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
				<p>您还没有收藏过店铺呢！</p>
			</div>
		<?php  } else { ?>
			<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
				<div class="list-item sborder">
					<?php  if(!empty($store['label'])) { ?>
						<span class="store-label" style="background-color: <?php  echo $store['label_color'];?>"><?php  echo $store['label_cn'];?></span>
					<?php  } ?>
					<a href="<?php  echo $store['url'];?>" class="external">
						<div class="store-info row no-gutter">
							<div class="store-img col-25">
								<img src="<?php  echo tomedia($store['logo']);?>" alt="<?php  echo $store['title'];?>">
								<?php  if(!$store['is_in_business_hours']) { ?>
									<span>店铺休息中</span>
								<?php  } ?>
							</div>
							<div class="col-75">
								<div class="row no-gutter">
									<div class="col-60 text-ellipsis"><?php  echo $store['title'];?></div>
									<div class="col-40 money-info text-right">
										<?php  if($store['token_status'] == 1) { ?>
											<span>券</span>
										<?php  } ?>
										<?php  if($store['invoice_status'] == 1) { ?>
											<span>票</span>
										<?php  } ?>
										<span>付</span>
									</div>
								</div>
								<div class="rel-info">
									<div class="row no-gutter">
										<div class="col-60">
											<div class="star-rank">
												<span class="star-rank-outline">
													<span class="star-rank-active" style="width:<?php  echo $store['score_cn'];?>%"></span>
													<span class="star-rank-value"><?php  echo $store['score'];?></span>
												</span>
												<span class="sailed">已售 <?php  echo $store['sailed'];?> 份</span>
											</div>
										</div>
										<?php  if($store['delivery_mode'] == 2) { ?>
											<div class="plateform-delivery"><span><?php  echo $_config_mall['delivery_title'];?></span></div>
										<?php  } ?>
									</div>
									<div class="delivery-conditions">
										起送￥<?php  echo $store['send_price'];?><span class="pipe">|</span>配送￥<?php  echo $store['delivery_price'];?><span class="pipe">|</span>约<?php  echo $store['delivery_time'];?>分钟
									</div>
								</div>
							</div>
						</div>
					</a>
					<div class="activity-containter">
						<?php  if($store['activity']['num'] > 0) { ?>
							<div class="dashed-line"></div>
						<?php  } ?>
						<?php  if($store['activity']['num'] > 2) { ?>
							<div class="activity-num"><?php  echo $store['activity']['num'];?>个活动 <i class="icon icon-arrow-down"></i></div>
						<?php  } ?>
						<?php  if(is_array($store['activity']['items'])) { foreach($store['activity']['items'] as $item) { ?>
							<?php  $num++;?>
							<div class="<?php  echo $item['type'];?> <?php  if($num > 2) { ?>activity-row hide<?php  } ?>">
								<?php  echo $item['title'];?>
							</div>
						<?php  } } ?>
						<?php  if($store['delivery_free_price'] > 0) { ?>
							<?php  $num++;?>
							<div class="activity-row free <?php  if($num > 2) { ?>hide<?php  } ?>">
								满<?php  echo $store['delivery_free_price'];?>元免配送费
							</div>
						<?php  } ?>
						<?php  if(!empty($store['hot_goods'])) { ?>
							<div class="dashed-line"></div>
							<div class="hot">
								热销:
								<?php  if(is_array($store['hot_goods'])) { foreach($store['hot_goods'] as $good) { ?>
								<?php  echo $good['title'];?>
								<?php  } } ?>
							</div>
						<?php  } ?>
					</div>
				</div>
			<?php  } } ?>
		<?php  } ?>
		</div>
	</div>
</div>
<script>
$(function(){
	$(document).on('click', '.activity-containter', function(){
		if($(this).hasClass('active')) {
			$(this).find('.activity-row').addClass('hide');
			$(this).find('.activity-num i').addClass('fa-arrow-down').removeClass('fa-arrow-up');
		} else {
			$(this).find('.activity-row').removeClass('hide');
			$(this).find('.activity-num i').addClass('fa-arrow-up').removeClass('fa-arrow-down');
		}
		$(this).toggleClass('active');
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>