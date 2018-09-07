<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page store shopping shopcategory" id="page-app-goods">
	<nav class="bar bar-tab no-gutter shop-cart-bar">
		<div class="" id="cartEmpty">
			<div class="left empty">
				<span class="cart">
					<span class="icon icon-cart"></span>
				</span>
				购物车是空的
			</div>
			<div class="right text-center bg-grey"><?php  echo $store['send_price'];?>元起送</div>
		</div>
		<div class="hide" id="cartNotEmpty">
			<div class="left">
				<span class="cart">
					<span class="icon icon-cart"></span>
					<span class="badge bg-danger" id="cartNum">0</span>
				</span>
				共<span class="sum">￥<span id="totalPrice">0</span>元</span>
			</div>
			<div class="right text-center bg-grey" id="categoryCondition">还差￥0元起送</div>
			<div class="right text-center bg-grey">还差￥<span id="sendCondition"><?php  echo $store['send_price'];?></span>元起送</div>
			<?php  if(!$store['is_in_business_hours']) { ?>
				<div class="right text-center bg-grey hide" id="btnSubmit">休息中</div>
			<?php  } else { ?>
				<div class="right text-center bg-danger hide" id="btnSubmit">选好了</div>
			<?php  } ?>
		</div>
	</nav>
	<?php  if(!empty($activity['items']['discount'])) { ?>
		<div class="store-discount-notice">
			<div class="inner"><?php  echo $activity['items']['discount']['title'];?></div>
		</div>
	<?php  } else if(!empty($activity['items']['grant'])) { ?>
		<div class="store-discount-notice">
			<div class="inner"><?php  echo $activity['items']['grant']['title'];?></div>
		</div>
	<?php  } ?>
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title open-popup" data-popup=".popup-privilege"><?php  echo $store['title'];?></h1>
		<a class="pull-right" href="javascript:;" style="margin-left: 5px"><i class="icon icon-search"></i></a>
		<a class="pull-right" href="javascript:;" id="btn-favorite" data-id="<?php  echo $store['id'];?>" data-uid="<?php  echo $_W['member']['uid'];?>">
			<i class="fa <?php  if(!empty($is_favorite)) { ?>icon icon-favorfill<?php  } else { ?>icon icon-favor<?php  } ?>"></i>
		</a>
	</header>
	<div class="store-notice open-popup" data-popup=".popup-privilege">
		<span class="js-scroll-notice">
			<span class="icon icon-voice"></span>
			<?php  if(!empty($store['notice'])) { ?>
				<?php  echo $store['notice'];?>
			<?php  } else { ?>
				营业时间: <?php  echo $store['business_hours_cn'];?>
			<?php  } ?>
		</span>
	</div>
	<div class="buttons-tab">
		<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $store['id']));?>" class="button active">商品</a>
		<a href="<?php  echo imurl('wmall/store/comment', array('sid' => $store['id']));?>" class="button">评价</a>
		<a href="<?php  echo imurl('wmall/store/index', array('sid' => $store['id']));?>" class="button">商家</a>
		<?php  if(!empty($store['sns']['qq'])) { ?>
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $store['sns']['qq'];?>&site=qq&menu=yes" class="button">客服</a>
		<?php  } ?>
	</div>
	<div class="content lazyload-container" style="z-index: 10199">
		<?php  if(!empty($tokens)) { ?>
			<div class="coupon-show-container">
				<div class="coupon-show">
					<div class="coupon-sum">
						<span>￥</span><?php  echo $token_price;?>
					</div>
					<div class="division">
						<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/division.png" alt="" />
					</div>
					<div class="coupon-info">
						<div class="coupon-title">商家代金券</div>
						<?php  if($token_nums > 1) { ?>
							<div class="condition">内含<?php  echo $token_nums;?>张券</div>
						<?php  } else { ?>
							<div class="condition">满<?php  echo $token['condition'];?>元可用</div>
						<?php  } ?>
					</div>
					<div class="get">
						<span class="btn-get" id="get-coupon">领券</span>
					</div>
				</div>
			</div>
		<?php  } ?>
		<div class="goods-category">
			<div class="goods-category-title">商品分类</div>
			<div class="goods-category-con row no-gutter">
				<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<?php  $i++?>
					<a href="javascript:;" data-id="<?php  echo $category['id'];?>" class="col-33 category-row <?php  if($i >= 6) { ?>hide<?php  } ?>"><?php  echo $category['title'];?></a>
				<?php  } } ?>
				<?php  if($i > 5) { ?>
					<a href="javascript:;" class="col-33" id="category-toggle">更多 <i class="icon icon-arrow-down"></i></a>
				<?php  } ?>
			</div>
		</div>
		<div class="selection-goods" id="category-container">
			<form action="<?php  echo imurl('wmall/order/create/goods', array('sid' => $sid));?>" method="post" id="goods-form">
			<input type="hidden" name="goods" value=""/>
			<?php  if(is_array($categorys)) { foreach($categorys as $cate_row) { ?>
				<?php  if(!empty($cate_goods[$cate_row['id']])) { ?>
					<div class="selection-goods-title"><?php  echo $cate_row['title'];?></div>
					<div class="selection-goods-con row no-gutter">
						<?php  if(is_array($cate_goods[$cate_row['id']])) { foreach($cate_goods[$cate_row['id']] as $ds) { ?>
							<div class="col-33 goods-item" id="goods-<?php  echo $ds['id'];?>">
								<a href="javascript:;" class="goods-popup" data-id="<?php  echo $ds['id'];?>">
									<div class="goods-img">
										<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" class="lazyload" data-original="<?php  echo tomedia($ds['thumb']);?>" alt="" />
										<span class="badge hide">0</span>
										<?php  if(!empty($ds['label'])) { ?>
											<span class="sale-badge bg-danger"><?php  echo $ds['label'];?></span>
										<?php  } ?>
									</div>
									<div class="goods-title"><?php  echo $ds['title'];?></div>
									<div class="sales">月售<?php  echo $ds['sailed'];?><?php  echo $ds['unitname'];?></div>
									<div class="price">
										<span class="fee"><span>￥</span><?php  echo $ds['discount_price'];?></span>
										<?php  if(!empty($ds['bargain_id'])) { ?>
											<span class="original-fee">￥<?php  echo $ds['price'];?></span>
										<?php  } ?>
									</div>
								</a>
								<?php  if($store['is_in_business_hours']) { ?>
									<?php  if(!$ds['is_options'] && !$ds['is_attrs']) { ?>
										<?php  if(!$ds['total']) { ?>
											<div class="goods-tips">已售完</div>
										<?php  } else { ?>
											<div class="operate-num operate-goods">
												<span class="hide minus">
													<span class="icon icon-minus" data-goods-id="<?php  echo $ds['id'];?>" data-option-id="0"></span>
													<span class="num">0</span>
												</span>
												<span class="icon icon-plus" data-goods-id="<?php  echo $ds['id'];?>" data-option-id="0"></span>
											</div>
										<?php  } ?>
									<?php  } else if($ds['is_options'] == 1 || $ds['is_attrs'] == 1) { ?>
										<div class="operate-goods">
											<span class="select-spec goods-option" data-id="<?php  echo $ds['id'];?>">可选规格</span>
										</div>
									<?php  } ?>
								<?php  } ?>
							</div>
						<?php  } } ?>
					</div>
				<?php  } ?>
			<?php  } } ?>
			<div class="all-goods "><a href="javascript:;">已加载全部商品</a></div>
			</form>
		</div>
	</div>
</div>
<?php  include itemplate('store/goodsCommon', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>