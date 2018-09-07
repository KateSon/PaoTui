<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page footmark">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">我的足迹</h1>
		<?php  if(!empty($footmarks)) { ?>
			<span class="pull-right footmark-edit">编辑</span>
		<?php  } ?>
	</header>
	<nav class="bar hide">
		<label class="label-checkbox item-content pull-left select-alle checkbox-all" data-bind=".store-list">
			<input type="checkbox" name="my-radio">
			<div class="item-media">
				<i class="icon icon-form-checkbox"></i><span>全选</span>
			</div>
		</label>
		<div class="btn-del pull-right">删除</div>
	</nav>
	<div class="content">
		<div class="store-list store-empty lazyload-container list-block media-list" id="store-list">
			<?php  if(empty($footmarks)) { ?>
				<div class="common-no-con">
					<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
					<p>您还没有浏览记录</p>
				</div>
			<?php  } else { ?>
				<?php  if(is_array($footmarks)) { foreach($footmarks as $footmark) { ?>
					<div class="content-block-title">
						<label class="label-checkbox item-content checkbox-item-all all-store-<?php  echo $footmark['stat_day'];?>" data-bind=".store-<?php  echo $footmark['stat_day'];?>" data-bind-parent=".checkbox-all">
							<input type="checkbox" name="my-radio">
							<div class="item-media">
								<i class="icon icon-form-checkbox"></i>
							</div>
							<div class="item-inner"><span><?php  echo $footmark['date'];?></span></div>
						</label>
					</div>
					<div class="store-container store-<?php  echo $footmark['stat_day'];?>">
						<?php  if(is_array($footmark['marks'])) { foreach($footmark['marks'] as $mark) { ?>
							<label class="label-checkbox item-content checkbox-item js-url" data-bind-parent=".all-store-<?php  echo $footmark['stat_day'];?>" data-link="<?php  echo $stores[$mark['sid']]['url'];?>">
								<input type="checkbox" name="my-radio" value="<?php  echo $mark['id'];?>">
								<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
								<div class="no-dist item-inner list-item border-1px-b" data-lat="<?php  echo $stores[$mark['sid']]['location_x'];?>" data-lng="<?php  echo $stores[$mark['sid']]['location_y'];?>">
									<?php  if($stores[$mark['sid']]['label_cn']) { ?>
										<span class="store-label" style="background-color: <?php  echo $stores[$mark['sid']]['label_color'];?>"><?php  echo $stores[$mark['sid']]['label_cn'];?></span>
									<?php  } ?>
									<a href="javascript:;" class="external item-title-row">
										<div class="store-info row no-gutter">
											<div class="store-img col-25">
												<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" class="lazyload lazyload-store" data-original="<?php  echo $stores[$mark['sid']]['logo'];?>">
												<?php  if($stores[$mark['sid']]['is_rest'] == 1) { ?>
													<div class="order-status">
														<span>店铺休息中</span>
													</div>
												<?php  } ?>
											</div>
											<div class="col-75">
												<div class="row no-gutter">
													<div class="col-60 text-ellipsis"><?php  echo $stores[$mark['sid']]['title'];?></div>
													<div class="money-info text-right">
														<?php  if($stores[$mark['sid']]['token_status'] == 1) { ?>
															<span>券</span>
														<?php  } ?>
														<?php  if($stores[$mark['sid']]['invoice_status'] == 1) { ?>
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
																	<span class="star-rank-active" style="width: <?php  echo $stores[$mark['sid']]['score_cn'];?>%"></span>
																	<span class="star-rank-value"><?php  echo $stores[$mark['sid']]['score'];?></span>
																</span>
																<span class="sailed">
																	已售 <?php  echo $stores[$mark['sid']]['sailed'];?> 份
																</span>
															</div>
														</div>
														<?php  if($stores[$mark['sid']]['delivery_mode'] == 2) { ?>
															<div class="plateform-delivery"><span><?php  echo $_config_mall['delivery_title'];?></span></div>
														<?php  } ?>
													</div>
													<div class="delivery-conditions">
														起送<span class="color-danger">￥<?php  echo $stores[$mark['sid']]['send_price'];?></span><span class="pipe">|</span>配送<span class="color-danger">￥<?php  echo $stores[$mark['sid']]['delivery_price'];?></span><span class="pipe">|</span>约<span class="color-danger"><?php  echo $stores[$mark['sid']]['delivery_time'];?>分钟</span>
														<div class="distance <?php  if(empty($stores[$mark['sid']]['distance'])) { ?> hide <?php  } ?>" data-in-business-hours="<?php  echo $stores[$mark['sid']]['is_in_business_hours'];?>"><i class="icon icon-lbs"></i><?php  echo $stores[$mark['sid']]['distance'];?>km</div>
													</div>
												</div>
											</div>
										</div>
									</a>
									<div class="activity-containter">
										<?php  $num = 0?>
										<?php  if($stores[$mark['sid']]['activity']['num'] > 0) { ?>
											<div class="dashed-line"></div>
											<?php  if($stores[$mark['sid']]['activity']['num'] > 2) { ?>
												<div class="activity-num"><?php  echo $stores[$mark['sid']]['activity']['num'];?>个活动 <i class="icon icon-arrow-down"></i></div>
											<?php  } ?>
											<?php  if(is_array($stores[$mark['sid']]['activity']['items'])) { foreach($stores[$mark['sid']]['activity']['items'] as $item) { ?>
												<?php  $num++?>
												<div class="<?php  echo $item['type'];?> <?php  if($num > 2) { ?>activity-row hide<?php  } ?>"><?php  echo $item['title'];?></div>
											<?php  } } ?>
										<?php  } ?>
										<?php  if($stores[$mark['sid']]['delivery_free_price'] > 0) { ?>
											<?php  $num++?>
											<div class="activity-row free <?php  if($num > 2) { ?>hide<?php  } ?>">
												满<?php  echo $stores[$mark['sid']]['delivery_free_price'];?>元免配送费
											</div>
										<?php  } ?>
										<?php  if(!empty($stores[$mark['sid']]['hot_goods'])) { ?>
											<div class="dashed-line"></div>
											<div class="hot">
												热销:
												<?php  if(is_array($stores[$mark['sid']]['hot_goods'])) { foreach($stores[$mark['sid']]['hot_goods'] as $hot) { ?>
												<?php  echo $hot['title'];?>
												<?php  } } ?>
											</div>
										<?php  } ?>
									</div>
								</div>
							</label>
						<?php  } } ?>
					</div>
				<?php  } } ?>
			<?php  } ?>
		</div>
	</div>
</div>
<script>
$(function() {
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

	$(document).on('click', '.footmark-edit', function() {
		if($(this).hasClass('active')) {
			$(this).removeClass('active').html('编辑');
			$('#store-list').find('.item-media ').hide();
			$('nav.bar').removeClass('bar-tab').addClass('hide');
			$('.checkbox-item').addClass('js-url');
		} else {
			$(this).addClass('active').html('完成');
			$('#store-list').find('.item-media').show();
			$('nav.bar').removeClass('hide').addClass('bar-tab');
			$('.checkbox-item').removeClass('js-url');
		}
	});

	$(document).on('click', '.btn-del', function() {
		var length = 0;
		var ids = [];
		$('.content :checkbox').each(function () {
			var value = $(this).val();
			if($(this).prop('checked')) {
				length++;
				ids.push(value);
			}
		});
		if(length < 1) {
			$.toast('请选择要删除的记录');
		} else {
			$.confirm('确定删除足迹吗?', function(){
				$.post("<?php  echo imurl('wmall/home/footmark/del')?>", {ids : ids}, function(data) {
					var result = $.parseJSON(data);
					if(result.message.errno != 0) {
						$.toast(result.message.message);
						return false;
					} else {
						$.toast(result.message.message, location.href);
					}
				});
			});
		}
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
