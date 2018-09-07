<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page store-share">
	<nav class="bar bar-tab"><a href="<?php  echo imurl('wmall/store/goods', array('sid' => $sid))?>">进店购买</a></nav>
	<div class="content">
		<div class="container">
			<div class="store-wrapper">
				<div class="store-logo-wrapper">
					<div class="store-logo">
						<img src="<?php  echo tomedia($store['logo'])?>" alt="">
					</div>
				</div>
				<div class="store-comment-info">
					<h3 class="store-title"><?php  echo $store['title'];?></h3>
					<div class="store-comment">
						<span class="star-rank-outline">
							<span class="star-rank-active" style="width: <?php  echo $store['score_cn'];?>%"></span>
						</span>
						<span class="customer-score">&nbsp;<?php  echo $store['score'];?></span>
					</div>
					<div class="delivery-info">
						起送价￥<?php  echo $store['send_price'];?>
						&nbsp;&nbsp;|&nbsp;&nbsp;配送费￥<?php  echo $store['delivery_price'];?>
						&nbsp;&nbsp;|&nbsp;&nbsp;<?php  echo $store['delivery_time'];?>分钟
					</div>
				</div>
                <?php  if($activity['num'] > 2) { ?>
                    <div class="activity-container">
                        <?php  if($activity['num'] > 1) { ?>
                            <?php  $num = 0?>
                            <div class="activity-num pull-right"> <i class="icon icon-arrow-down"></i></div>
                        <?php  } ?>
                        <?php  if(is_array($activity['items'])) { foreach($activity['items'] as $item) { ?>
                            <?php  $num++?>
                            <div class="tags tags-<?php  echo $item['type'];?> <?php  if($num > 1) { ?>activity-row hide<?php  } ?>"><?php  echo $item['title'];?></div>
                        <?php  } } ?>
                        <?php  if($store['delivery_free_price'] > 0) { ?>
                            <div class="activity-row free <?php  if($num > 1) { ?>hide<?php  } ?>">
                                满<?php  echo $store['delivery_free_price'];?>元免配送费
                            </div>
                        <?php  } ?>
                        <?php  if(!empty($store['hot_goods'])) { ?>
                            <div class="dashed-line"></div>
                            <div class="hot">
                                热销:
                                <?php  if(is_array($store['hot_goods'])) { foreach($store['hot_goods'] as $hot) { ?>
                                    <?php  echo $hot['goods'];?>
                                <?php  } } ?>
                            </div>
                        <?php  } ?>
                    </div>
                <?php  } ?>
			</div>
			<div class="dotted-area">
				<span class="circle circle-left"></span>
				<span class="circle circle-right"></span>
				<span class="dotted-line"></span>
			</div>
			<?php  if(!empty($hot_goods)) { ?>
				<div class="goods">
					<div class="best-seller">
						<h3 class="best-seller-title">热销商品</h3>
						<ul class="best-seller-list row">
							<?php  if(is_array($hot_goods)) { foreach($hot_goods as $hot) { ?>
								<li class="col-33">
									<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $store['id'], 'goods_id' => $hot['id']))?>">
										<div class="best-seller-img">
											<img src="<?php  echo tomedia($hot['thumb'])?>" alt="">
										</div>
										<span class="seller-item-name"><?php  echo $hot['title'];?></span>
										<span class="seller-item-sale">已售<?php  echo $hot['sailed'];?></span>
										<div class="seller-item-price">¥<span class="price"><?php  echo $hot['price'];?></span></div>
									</a>
								</li>
							<?php  } } ?>
						</ul>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</div>
<script>
$(function() {
	$(document).on('click', '.activity-container', function(){
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
