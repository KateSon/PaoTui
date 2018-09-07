<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page goods-categories" id="page-app-goods">
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
	<div class="goods-categories-top">
		<div class="row no-gutter store-title">
			<div class="col-25"><a href="javascript:;" class="icon icon-arrow-left back"></a></div>
			<div class="col-50 text-center"><?php  echo $store['title'];?></div>
			<div class="col-25 text-right"><a href="javascript:;" class="icon icon-search"></a></div>
		</div>
		<div class="goods-categories-bar row no-gutter">
			<div class="col-90 goods-categories-container swiper-container swiper-container-horizontal">
				<ul class="clearfix swiper-wrapper">
					<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
						<li class="swiper-slide category-row" data-id="<?php  echo $category['id'];?>" data-hash="<?php  echo $category['id'];?>"><a href="javascript:;" class="btn <?php  if($category['id'] == $cid) { ?>active<?php  } ?>"><?php  echo $category['title'];?></a></li>
					<?php  } } ?>
				</ul>
			</div>
			<div class="col-10 text-center" id="category-more">
				<span class="icon icon-arrow-down fontsize"></span>
			</div>
		</div>
		<div class="select-container row no-gutter hide">
			<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
				<div class="col-33">
					<a href="javascript:;" class="category-row <?php  if($category['id'] == $cid) { ?>selected<?php  } ?>" data-id="<?php  echo $category['id'];?>"><?php  echo $category['title'];?></a>
				</div>
			<?php  } } ?>
		</div>
	</div>

	<div class="content lazyload-container" style="z-index: 10199">
		<div class="goods-list" id="category-container">
			<form action="<?php  echo imurl('wmall/order/create/goods', array('sid' => $sid));?>" method="post" id="goods-form">
			<input type="hidden" name="goods" value=""/>
			<div class="goods-num">全部共<?php  echo $total;?>件</div>
			<div class="goods-list-con row no-gutter">
				<?php  if(is_array($goods)) { foreach($goods as $ds) { ?>
				<div class="col-33 goods-item <?php  if($ds['show'] != 1) { ?>hide<?php  } ?>" id="goods-<?php  echo $ds['id'];?>">
					<a href="javascript:;">
						<div class="goods-img">
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" class="goods-popup lazyload" data-id="<?php  echo $ds['id'];?>" data-original="<?php  echo tomedia($ds['thumb']);?>" alt="" />
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
			</form>
		</div>
	</div>
</div>
<?php  include itemplate('store/goodsCommon', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>