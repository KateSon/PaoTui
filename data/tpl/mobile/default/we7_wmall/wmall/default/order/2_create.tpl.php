<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<script type='text/javascript' src='<?php echo WE7_WMALL_URL;?>static/js/components/light7/iscroll-probe.js' charset='utf-8'></script>
<div class="page order-confirm">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">提交订单</h1>
	</header>
	<nav class="bar bar-tab no-gutter order-bar">
		<div class="left">
			<span class="pull-left">
				已优惠
				<span class="activity-price">￥<?php  echo $activity_price;?></span>
			</span>
			<span class="pull-right">
				还需付
				<span class="sum"><span class="wait-price">￥<?php  echo $waitprice;?></span></span>
			</span>
		</div>
		<div class="right text-center bg-danger" id="order-submit">确认下单</div>
	</nav>
	<?php  if(!empty($activityed['list']['vip_delivery'])) { ?>
		<nav class="bar bar-tab info-bar">
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/vip_effective.png" alt="">
			尊贵的会员, 已为您节省<span class="delivery-activity-price"><?php  echo $activityed['list']['vip_delivery']['value'];?></span>元
		</nav>
	<?php  } ?>
	<div class="content">
		<form method="post" id="order-form" action="<?php  echo imurl('wmall/order/create/submit', array('sid' => $sid));?>">
			<input type="hidden" name="sid" value="<?php  echo $sid;?>">
			<input type="hidden" name="address_id" id="address_id" value="<?php  echo $address_id;?>">
			<input type="hidden" name="record_id" id="record_id" value="<?php  echo $recordid;?>">
			<input type="hidden" name="redPacket_id" id="redPacket_id" value="<?php  echo $redPacket_id;?>">
			<input type="hidden" name="note" id="order-note" value="">
			<input type="hidden" name="delivery_time" id="delivery-time" value="<?php  echo $predict_time;?>">
			<input type="hidden" name="delivery_day" id="delivery-day" value="<?php  echo $predict_day;?>">
			<input type="hidden" name="delivery_index" id="delivery-index" value="<?php  echo $predict_index;?>">
			<?php  if($store['delivery_type'] == 2) { ?>
				<input type="radio" name="order_type" class="order_type hide" value="2" checked>
				<div class="content-block-title">选择配送方式 <span class="color-danger">（仅支持到店自提）</span></div>
			<?php  } ?>
			<?php  if($store['delivery_type'] == 1) { ?>
				<input type="radio" name="order_type" class="order_type hide" value="1" checked>
			<?php  } ?>
			<?php  if($store['delivery_type'] == 3) { ?>
				<div class="content-block-title">选择配送方式</div>
				<div class="list-block media-list pay-method">
					<ul class="border-1px-tb">
						<li>
							<label class="label-checkbox item-content border-1px-b">
								<div class="item-inner">
									<div class="item-title">商家配送</div>
								</div>
								<input type="radio" name="order_type" class="order_type" value="1" checked id="order-type-1">
								<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
							</label>
						</li>
						<li>
							<label class="label-checkbox item-content">
								<div class="item-inner">
									<div class="item-title">到店自提</div>
								</div>
								<input type="radio" name="order_type" class="order_type" value="2" id="order-type-2">
								<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
							</label>
						</li>
					</ul>
				</div>
			<?php  } ?>
			<?php  if($store['delivery_type'] == 2 || $store['delivery_type'] == 3) { ?>
			<div class="list-block <?php  if($store['delivery_type'] == 3) { ?>hide<?php  } ?>" id="delivery-time-2">
				<ul class="border-1px-tb">
					<li>
						<a href="javascript:;" class="item-link item-content delivery-time">
							<div class="item-inner border-1px-b">
								<div class="item-title">自提时间</div>
								<div class="item-after"><span class="color-black delivery-time-show">下单后直接去自提</span><span class="color-orange hide">(大约12:00到)</span></div>
							</div>
						</a>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">下单人</div>
								<div class="item-input">
									<input type="text" name="username" placeholder="您的姓名" value="<?php  echo $_W['member']['realname'];?>">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">手机号</div>
								<div class="item-input">
									<input type="text" name="mobile" placeholder="手机号" value="<?php  echo $_W['member']['mobile'];?>">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<?php  } ?>
			<?php  if($store['delivery_type'] == 1 || $store['delivery_type'] == 3) { ?>
			<div class="list-block address" id="address-container">
				<ul>
					<li>
						<a class="item-link item-content external border-1px-b" href="<?php  echo imurl('wmall/member/address', array('sid' => $sid, 'redirect_type' => 'order', 'recordid' => $_GPC['recordid']));?>">
							<div class="item-inner">
								<?php  if(!empty($address)) { ?>
									<div class="item-text">
										<div><span class="name"><?php  echo $address['realname'];?></span><span class="tel"><?php  echo $address['mobile'];?></span></div>
										<div>地址:<?php  echo $address['address'];?></div>
									</div>
								<?php  } else { ?>
									<div class="item-title">请选择送达地址</div>
								<?php  } ?>
							</div>
						</a>
						<div class="top-line"></div>
					</li>
					<li id="delivery-time-1" class="border-1px-b">
						<a href="#" class="item-link item-content delivery-time">
							<div class="item-inner">
								<div class="item-title">请选择送达时间</div>
								<div class="item-after"><span class="color-black delivery-time-show"><?php  echo $text_time;?></span></div>
							</div>
						</a>
					</li>
				</ul>
			</div>
			<?php  } ?>
			<div class="list-block hide">
				<ul class="border-1px-tb">
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title">
									余额抵扣
									<span class="color-danger"> ￥<?php  echo $_W['member']['credit2'];?></span>
								</div>
								<div class="item-after">
									<label class="label-switch switch-sm">
										<input type="checkbox" name="deductcredit2" id="deductcredit2" value="1">
										<div class="checkbox"></div>
									</label>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="content-block-title">选择支付方式</div>
			<div class="list-block media-list pay-method">
				<ul class="border-1px-tb">
					<?php  if(is_array($store['payment'])) { foreach($store['payment'] as $row) { ?>
						<li>
							<label class="label-checkbox item-content border-1px-b">
								<div class="item-inner">
									<div class="item-title"><?php  echo $pay_types[$row]['text'];?></div>
								</div>
								<input type="radio" name="pay_type" class="pay_type" value="<?php  echo $row;?>" <?php  if($row == 'wechat') { ?>checked<?php  } ?>>
								<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
							</label>
						</li>
					<?php  } } ?>
					<?php  if(is_weixin() && in_array('peerpay', $_W['we7_wmall']['config']['payment']['weixin'])) { ?>
						<li>
							<label class="label-checkbox item-content border-1px-b">
								<div class="item-inner">
									<div class="item-title">找朋友代付</div>
								</div>
								<input type="radio" name="pay_type" class="pay_type" value="peerpay">
								<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
							</label>
						</li>
					<?php  } ?>
				</ul>
			</div>
			<div class="list-block coupon-info">
				<ul class="border-1px-tb">
					<li>
						<a href="javascript:;" class="item-link item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">商家代金券</div>
								<div class="item-after color-danger <?php  if(!empty($coupons)) { ?>open-popup<?php  } ?>" data-popup=".popup-coupon">
									<?php  echo $coupon_text;?>
								</div>
							</div>
						</a>
					</li>
					<?php  if($cart['bargain_use_limit'] == 2) { ?>
						<li class="help-block">
							<div class="color-danger">特价商品不与代金券同时使用</div>
						</li>
					<?php  } ?>
					<li>
						<a href="javascript:;" class="item-link item-content">
							<div class="item-inner">
								<div class="item-title">平台红包</div>
								<div class="item-after color-danger <?php  if(!empty($redPackets)) { ?>open-popup<?php  } ?>" data-popup=".popup-redPacket">
									<?php  echo $redPacket_text;?>
								</div>
							</div>
						</a>
					</li>
					<?php  if(!empty($redPacket)) { ?>
						<li class="help-block">
							<?php  if($redPacket['type'] == 'mallNewMember') { ?>
								<div class="color-danger">首单红包不与其他优惠同享</div>
							<?php  } ?>
						</li>
					<?php  } ?>
				</ul>
			</div>
			<div class="list-block">
				<ul class="border-1px-tb">
					<li>
						<a class="item-link item-content border-1px-b">
							<div class="item-inner">
								<div class="item-title">备注</div>
								<div class="item-after order-note" id="order-note-show">(选填)可填入特殊要求</div>
							</div>
						</a>
					</li>
					<?php  if($store['invoice_status']) { ?>
						<li>
							<div class="item-content invoice">
								<div class="item-inner border-1px-b">
									<div class="item-title">需要发票</div>
									<div class="item-after">
										<label class="label-switch switch-sm invoice-status">
											<input type="checkbox" value="1">
											<div class="checkbox"></div>
										</label>
									</div>
								</div>
							</div>
						</li>
					<?php  } ?>
					<li class="hide invoice-value">
						<div class="item-content">
							<input type="text" id="invoice" placeholder="输入个人或者公司抬头"/>
						</div>
					</li>
				</ul>
			</div>
			<div class="list-block detail-info">
				<ul class="border-1px-tb">
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title"><?php  echo $store['title'];?></div>
								<div class="item-after">本单由 <span class="color-black"><?php  if($store['delivery_mode'] == 1) { ?>商家配送<?php  } else { ?><?php  echo $_config_mall['delivery_title'];?><?php  } ?></span> </div>
							</div>
						</div>
					</li>
					<li class="order-list">
						<div class="inner-con border-1px-b">
							<?php  if(is_array($cart['data'])) { foreach($cart['data'] as $val) { ?>
								<?php  if(is_array($val)) { foreach($val as $val1) { ?>
									<div class="row no-gutter">
										<?php  if($val1['bargain_id'] > 0) { ?>
											<div class="col-60 icon-before">
												<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/zhe_b.png">
												<?php  echo $val1['title'];?>
											</div>
										<?php  } else { ?>
											<div class="col-60">
												<?php  echo $val1['title'];?>
											</div>
										<?php  } ?>
										<div class="col-10 text-right color-muted">×<?php  echo $val1['num'];?></div>
										<div class="col-30 text-right">
											<?php  if($val1['bargain_id'] > 0) { ?>
												<span class="color-muted text-line-through">￥<?php  echo $val1['total_price'];?></span>
											<?php  } ?>
											<span class="color-black">￥<?php  echo $val1['total_discount_price'];?></span>
										</div>
									</div>
								<?php  } } ?>
							<?php  } } ?>
						</div>
					</li>
					<li class="order-list">
						<div class="inner-con border-1px-b">
							<?php  if($cart['box_price'] > 0) { ?>
								<div class="row no-gutter">
									<div class="col-80">餐盒费</div>
									<div class="col-20 text-right color-black">￥<?php  echo $cart['box_price'];?></div>
								</div>
							<?php  } ?>
							<div class="row no-gutter">
								<div class="col-80">包装费</div>
								<div class="col-20 text-right color-black">￥<?php  echo $store['pack_price'];?></div>
							</div>
							<?php  if($distance > 0) { ?>
								<div class="row no-gutter row-distance">
									<div class="col-80">配送距离</div>
									<div class="col-20 text-right color-black"><?php  echo $distance;?>公里</div>
								</div>
							<?php  } ?>
							<div class="row no-gutter row-delivery-fee">
								<?php  if($store['delivery_fee_mode'] == 2) { ?>
									<div class="col-80 delivery-fee-modal">配送费 <i class="icon icon-question-circle"></i></div>
								<?php  } else { ?>
									<div class="col-80">配送费</div>
								<?php  } ?>
								<div class="col-20 text-right color-black">￥<span id="delivery-price"><?php  echo $delivery_price;?></span></div>
							</div>
						</div>
					</li>

					<li class="order-list color-muted" style="font-size: .6rem; padding-top: .15rem">
						<?php  if($cart['bargain_use_limit'] == 1) { ?>
							特价商品按照优惠后价格计算满减
						<?php  } else if($cart['bargain_use_limit'] == 2) { ?>
							特价优惠不与满减优惠,满赠优惠等同享
						<?php  } ?>
					</li>

					<?php  if(!empty($activityed['list'])) { ?>
						<li class="order-list activity-list">
							<div class="inner-con border-1px-b">
								<?php  if(is_array($activityed['list'])) { foreach($activityed['list'] as $key => $row) { ?>
									<div class="row no-gutter activity-row activity-<?php  echo $key;?> <?php  if($key == 'selfDelivery' && $store['delivery_type'] != 2) { ?>hide<?php  } ?>">
										<div class="col-50 icon-before"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/<?php  echo $row['icon'];?>"><?php  echo $row['name'];?></div>
										<div class="col-50 text-right color-black <?php  if($row['type'] == 'delivery') { ?>delivery-activity-price-text<?php  } ?>"><?php  echo $row['text'];?></div>
									</div>
								<?php  } } ?>
							</div>
						</li>
					<?php  } ?>
					<li class="order-list">
						<div class="inner-con">
							<div class="row no-gutter">
								<div class="col-60 color-muted">订单 <span class="color-black total-price">￥<?php  echo $cart['price'] + $cart['box_price'] + $store['pack_price'] + $delivery_price?></span> - 优惠 <span class="color-black activity-price">￥<?php  echo $activity_price;?></span></div>
								<div class="col-20 text-right color-muted">总计</div>
								<div class="col-20 text-right color-black"><span class="wait-price">￥<?php  echo $waitprice;?></span></div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="list-block explain-info">
				<ul>
					<?php  if($_W['we7_wmall']['config']['takeout']['handle_time_limit'] > 0) { ?>
						<li><?php  echo $_W['we7_wmall']['config']['takeout']['handle_time_limit'];?>分钟内商户未接单,将自动取消</li>
					<?php  } ?>
				</ul>
			</div>
		</form>
	</div>
</div>
<div class="modal modal-no-buttons delivery-time-modal not-remove">
	<div class="modal-inner">
		<div class="modal-title">
			<div>请选择送达时间</div>
		</div>
		<div class="modal-text">
			<div class="category-container">
				<div class="parent-category" id="delivery-time-parent">
					<ul>
						<?php  if(is_array($delivery_time['days'])) { foreach($delivery_time['days'] as $i => $day) { ?>
							<li <?php  if(!$i) { ?>class="active"<?php  } ?> data-value="<?php  echo $day;?>"><a href="javascript:;"><?php  echo $day;?></a></li>
						<?php  } } ?>
					</ul>
				</div>
				<div class="children-category" id="delivery-time-children">
					<div class="children-category-wrapper">
						<ul id="category1">
							<?php  if($time_flag == 1) { ?>
								<li data-value="尽快送达" data-id="<?php  echo $predict_index;?>" data-extra-price="<?php  echo $predict_extra_price;?>" class="time-flag"><a href="javascript:;">尽快送达 <span>(<?php  echo $predict_delivery_price;?>)</span></a></li>
								<li class="delivery-tips time-flag">约<?php  echo $predict_time;?>送达</li>
							<?php  } ?>
							<?php  if(is_array($delivery_time['times'])) { foreach($delivery_time['times'] as $i => $time) { ?>
								<li data-value="<?php  echo $time['start'];?> ~ <?php  echo $time['end'];?>" data-id="<?php  echo $i;?>" data-extra-price="<?php  echo $time['fee'];?>" class="<?php  if($time['timestamp'] <= $predict_timestamp && !$delivery_time['reserve']) { ?>hide init-hide<?php  } ?>">
									<a href="javascript:;"><?php  echo $time['start'];?>~<?php  echo $time['end'];?> <span>(<?php  echo $time['delivery_price_cn'];?>)</span></a>
								</li>
							<?php  } } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="popup popup-remark" id="popup-remark">
	<div class="content-block">
		<div class="popup-header row no-gutter">
			<div class="col-25"><a href=""><span class="icon icon-arrow-left"></span></a></div>
			<div class="col-50 text-center">填写备注</div>
			<div class="col-25 text-right"><a href="javascript:;" class="sure close-popup" id="note-submit">确定</a></div>
		</div>
		<div class="popup-body">
			<textarea name="" id="note-textarea" placeholder="给商家留言,可输入对商家的要求"></textarea>
			<?php  if(!empty($store['order_note'])) { ?>
				<div class="specs-select">
					<?php  if(is_array($store['order_note'])) { foreach($store['order_note'] as $order_note) { ?>
						<span class="spec-item"><?php  echo $order_note;?></span>
					<?php  } } ?>
				</div>
			<?php  } ?>
		</div>
	</div>
</div>

<div class="popup popup-redPacket" id="popup-redPacket">
	<div class="page">
		<header class="bar bar-nav common-bar-nav">
			<a class="pull-left close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<h1 class="title">选择红包</h1>
		</header>
		<div class="content redPacket-my">
			<div class="wui-loadmore-line wui-loadmore">
				<span class="wui-loadmore-tips">可用红包(<?php  echo count($redPackets)?>个)</span>
			</div>
			<div class="redPacket-list content-padded">
				<?php  if(is_array($redPackets)) { foreach($redPackets as $redPacket) { ?>
					<div class="redPacket-list-item border-1px" data-id="<?php  echo $redPacket['id'];?>">
						<div class="redPacket-info row">
							<div class="col-50">
								<span class="redPacket-title"><?php  echo $redPacket['title'];?></span>
							</div>
							<div class="col-50 text-right">
								<div class="price">￥<span class="price-num"><?php  echo $redPacket['discount'];?></span></div>
							</div>
						</div>
						<div class="redPacket-use-limit row">
							<div class="col-60">限<?php  echo date('Y-m-d', $redPacket['starttime'])?>~<?php  echo date('Y-m-d', $redPacket['endtime'])?>使用</div>
							<div class="col-40 text-right">
								<?php  if($redPacket['condition'] > 0) { ?>
									<p class="use-condition">满<?php  echo $redPacket['condition'];?>元可用</p>
								<?php  } else { ?>
									<p class="use-condition">满任意金额元可用</p>
								<?php  } ?>
							</div>
						</div>
						<?php  if(!empty($redPacket['time_cn']) || !empty($redPacket['category_cn'])) { ?>
							<div class="other-limit">
								<?php  echo $redPacket['category_cn'];?> <?php  echo $redPacket['time_cn'];?>
							</div>
						<?php  } ?>
						<span class="border-1px-r circle circle-left"></span>
						<span class="border-1px-l circle circle-right"></span>
						<span class="selected-status"></span>
					</div>
				<?php  } } ?>
			</div>
		</div>
		<div class="block border-1px-t">
			<a href="<?php  echo imurl('wmall/order/create/index', array('sid' => $sid, 'address_id' => $_GPC['address_id']));?>">
				不使用红包
			</a>
		</div>
	</div>
</div>

<div class="popup popup-coupon" id="popup-coupon">
	<div class="page content-block">
		<header class="bar bar-nav common-bar-nav">
			<a class="pull-left close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<h1 class="title">选择代金券</h1>
		</header>
		<div class="content coupon-content">
			<div class="wui-loadmore-line wui-loadmore">
				<span class="wui-loadmore-tips">可用优惠券(<?php  echo count($coupons)?>张)</span>
			</div>
			<div class="coupon-list">
				<?php  if(is_array($coupons)) { foreach($coupons as $coupon) { ?>
				<div class="coupon-item" data-recordid="<?php  echo $coupon['id'];?>">
					<span class="circle border-1px-r circle-left"></span>
					<span class="circle border-1px-l circle-right"></span>
					<div class="selected-status"></div>
					<label class="label-checkbox">
						<input type="radio" name="recordid" value="<?php  echo $coupon['id'];?>" class="coupon-radio">
						<div class="left">
							<div class="store-logo">
								<img src="<?php  echo tomedia($store['logo']);?>" alt="">
							</div>
							<div class="coupon-detail">
								<div class="coupon-title">
									<?php  echo $store['title'];?>
								</div>
								<div class="use-time">有效期至:<?php  echo date('Y-m-d', $coupon['endtime'])?></div>
							</div>
						</div>
						<div class="right">
							<div class="price">
								<span>¥</span><?php  echo $coupon['discount'];?>
							</div>
							<div class="condition">
								满<?php  echo $coupon['condition'];?>元可用
							</div>
						</div>
					</label>
				</div>
				<?php  } } ?>
			</div>
		</div>
		<div class="block border-1px-t">
			<a href="<?php  echo imurl('wmall/order/create/index', array('sid' => $sid, 'address_id' => $_GPC['address_id']));?>">
				不使用优惠券
			</a>
		</div>
	</div>
</div>

<?php  if($store['delivery_fee_mode'] == 2) { ?>
<div class="modal modal-no-buttons modal-notice modal-delivery-fee">
	<div class="modal-inner">
		<div class="modal-title">
			<div>计价细则</div>
		</div>
		<div class="modal-text">
			<div class="notice">
				<?php  echo $store['delivery_price_extra']['start_km'];?>千米内，收取<?php  echo $store['delivery_price_extra']['start_fee'];?>元配送费 <br>
				<?php  echo $store['delivery_price_extra']['start_km'];?>千米以上，每增加1千米，多收取<?php  echo $store['delivery_price_extra']['pre_km_fee'];?>元
			</div>
			<a href="javascript:;" onclick="$.icloseModal('.modal-notice', true);" class="button button-big button-fill button-danger close-modal">我知道了</a>
		</div>
	</div>
</div>
<?php  } ?>
<script>
$(function(){
	var recordid = 0, redPacket_id = 0;
	$(document).on('click', '.scan-rules', function(){
		var $parent = $(this).parents('.coupon-list-item');
		$parent.find('.coupon-rules').toggleClass('hide');
	});

	$(document).on('click', '#popup-coupon .coupon-radio', function(){
		recordid = $(this).parents('.coupon-item').data('recordid');
		$('.coupon-item').toggleClass('active');
		$.closeModal('.popup-coupon');
		$.showIndicator();
		setTimeout(function(){
			location.href = "<?php  echo imurl('wmall/order/create/index', array('sid' => $sid, 'address_id' => $_GPC['address_id'], 'redPacket_id' => $_GPC['redPacket_id']));?>&recordid=" + recordid;
		}, 1000);
		return;
	});

	$(document).on('click', '#popup-redPacket .redPacket-list-item', function(){
		redPacket_id = $(this).data('id');
		$(this).toggleClass('active');
		$.closeModal('.popup-redPacket');
		$.showIndicator();
		setTimeout(function(){
			location.href = "<?php  echo imurl('wmall/order/create/index', array('sid' => $sid, 'address_id' => $_GPC['address_id'], 'recordid' => $_GPC['recordid']));?>" + "&redPacket_id=" + redPacket_id;
		}, 1000);
		return;
	});

	$(document).on('click', '#order-submit', function(){
		<?php  if($send_diff > 0) { ?>
			send_tips();
			return false;
		<?php  } ?>
		var $this = $(this);
		if($(this).hasClass('bg-grey')) {
			return false;
		}
		$(this).removeClass('bg-danger').addClass('bg-grey');
		var order_type = $(':radio[name="order_type"]:checked').val();
		var username = '';
		var mobile = '';
		if(order_type == 1) {
			if(!$('#address_id').val()) {
				$(this).addClass('bg-danger').removeClass('bg-grey');
				$.toast('请选择收货地址');
				return false;
			}
		} else if(order_type == 2) {
			var username = $.trim($(':text[name="username"]').val());
			if(!username) {
				$(this).addClass('bg-danger').removeClass('bg-grey');
				$.toast('请填写下单人');
				return false;
			}
			var mobile = $.trim($(':text[name="mobile"]').val());
			var reg = /^[01][345678][0-9]{9}$/;
			if(!reg.test(mobile)) {
				$(this).addClass('bg-danger').removeClass('bg-grey');
				$.toast("手机号格式错误");
				return false;
			}
		}
		if(!$('.pay_type:checked').val()) {
			$(this).addClass('bg-danger').removeClass('bg-grey');
			$.toast('请选择支付方式');
			return false;
		}
		var params = {
			delivery_index: $('#delivery-index').val(),
			delivery_day: $('#delivery-day').val(),
			delivery_time: $('#delivery-time').val(),
			address_id: $('#address_id').val(),
			deductcredit2: $('#deductcredit2:checked').val(),
			record_id: $('#record_id').val(),
			redPacket_id: $('#redPacket_id').val(),
			note: $('#order-note').val(),
			pay_type: $('.pay_type:checked').val(),
			invoice: $('#invoice').val(),
			order_type: order_type,
			username: username,
			mobile: mobile
		};
		$.post("<?php  echo imurl('wmall/order/create/submit', array('sid' => $sid));?>", params, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				if(result.message.errno == -1) {
					$(this).addClass('bg-danger').removeClass('bg-grey');
					$.toast(result.message.message);
				} else {
					$.alert(result.message.message, function(){
						location.href = "<?php  echo imurl('wmall/store/goods', array('sid' => $sid));?>";
					});
				}
			} else {
				$.toast('下单成功');
				location.href = "<?php  echo imurl('system/paycenter/pay', array('sid' => $sid, 'order_type' => 'takeout'));?>&id=" + result.message.message;
			}
			return false;
		});
	});

	var delivery_price = "<?php  echo $delivery_price;?>";
	var delivery_price_basic = "<?php  echo $delivery_price_basic;?>";
	var waitprice = "<?php  echo $waitprice;?>";
	var cartprice = "<?php  echo $cart['price'];?>";
	var totalprice = <?php  echo $cart['price'] + $cart['box_price'] + $store['pack_price'] + $delivery_price?>;
	var delivery_activity_price = "<?php  echo $delivery_activity_price;?>";
	var self_delivery_activity_price = "<?php  echo $self_delivery_activity_price;?>";
	var activity_price = "<?php  echo $activity_price;?>";
	var activity_notSelfDelivery_price = "<?php  echo $activity_notSelfDelivery_price;?>";

	<?php  if($send_diff > 0) { ?>
		function send_tips() {
			$.modal({
				title: '不满起送价',
				text: '当前商品不满起送价，是否再添加其他商品一同下单？',
				buttons: [
					{
						text: '查看地址',
						onClick: function() {
							location.href = "<?php  echo imurl('wmall/member/address', array('sid' => $sid, 'redirect_type' => 'order', 'recordid' => $_GPC['recordid'], 'redPacket_id' => $_GPC['redPacket_id']));?>";
							return false;
						}
					},
					{
						text: '<span class="color-danger">好的</span>',
						onClick: function() {
							location.href = "<?php  echo imurl('wmall/store/goods', array('sid' => $sid, 'address_id' => $address['id']));?>";
							return false;
						}
					}
				]
			});
			return false;
		}
		send_tips();
	<?php  } else if($store['delivery_fee_mode'] == 3 && !empty($cookie_price_original) && $cookie_price['delivery_price'] != $cookie_price_original['delivery_price']) { ?>
		$.toast('由于配送地址/时间发生变化,配送费也发生了变化');
	<?php  } ?>
	//配送方式
	$(document).on('click', '#order-type-1', function(){
		$('#address-container').show();
		$('#delivery-time-2').hide();
		$('#delivery-time-1').show();
		$('#delivery-price').html(delivery_price);
		$('.total-price').html('￥' + totalprice);
		$('.activity-price').html('￥' + activity_price);
		waitprice_temp = totalprice - activity_price;
		$('.wait-price').html('￥' + waitprice_temp);
		$('.activity-row').hide();
		$(".activity-row:not(.activity-selfDelivery)").show();
		$('.info-bar').show();
		$('.row-delivery-fee, .row-distance').show();
	});

	$(document).on('click', '#order-type-2', function(){
		$('#address-container').hide();
		$('#delivery-time-2').show();
		$('#delivery-time-1').hide();
		$('#delivery-price').html(0);
		$('.activity-delivery').hide();
		$('.activity-selfDelivery').show();

		$('.activity-row').hide();
		$(".activity-row.activity-selfDelivery").show();

		$('.info-bar').hide();
		var totalprice_temp = (totalprice - 0 - delivery_price).toFixed(2);
		$('.total-price').html('￥' + totalprice_temp);

		activityprice_temp = (activity_price - activity_notSelfDelivery_price + parseFloat(self_delivery_activity_price)).toFixed(2);
		$('.activity-price').html('￥' + activityprice_temp);
		waitprice_temp = (totalprice_temp - activityprice_temp).toFixed(2);
		$('.wait-price').html('￥' + waitprice_temp);
		$('.row-delivery-fee, .row-distance').hide();
	});

	//选择时间
	$(document).on('click', '.delivery-time-show', function(){
		$.iopenModal('.delivery-time-modal', function(){
			var init_show = $('#delivery-time-children li').not('.hide').size();
			if(!init_show) {
				var now_day = $('#delivery-time-parent li.active');
				now_day.next().trigger('click');
				now_day.addClass('hide');
			}
			$('.delivery-time-modal .children-category-wrapper').height(350);
			if($.device.iphone) {
				new IScroll('.delivery-time-modal .children-category-wrapper', {probeType: 3, mouseWheel: true, click: false, tap: true})
			} else {
				new IScroll('.delivery-time-modal .children-category-wrapper', {probeType: 3, mouseWheel: true, click: true})
			}
		});
	});

	$(document).on('click', '#delivery-time-children li:not(.delivery-tips)', function(){
		var day = $('#delivery-time-parent li.active').data('value');
		var time = $(this).data('value');
		var index = $(this).data('id');
		var order_type = $('.order_type:checked').val();
		if(order_type == 2) {
			$('#delivery-index').val(index);
			$('#delivery-time').val(time);
			$('#delivery-day').val(day);
			$('.delivery-time-show').html(day + ' ' + time);
			$.icloseModal('.delivery-time-modal', true);
			return false;
		}
		var delivery_extra_price = $(this).data('extra-price');
		var delivery_price_new = parseFloat(delivery_price_basic) + parseFloat(delivery_extra_price);
		totalprice_temp = totalprice - delivery_price + delivery_price_new;
		activityprice_temp = activity_price;
		if(delivery_activity_price > 0) {
			activityprice_temp = activity_price - delivery_activity_price + delivery_price_new;
			$('.delivery-activity-price').html(delivery_price_new);
			$('.delivery-activity-price-text').html('-￥' + delivery_price_new);
		}
		waitprice_temp = (totalprice_temp - activityprice_temp).toFixed(2);
		$('.activity-price').html('￥' + activityprice_temp);
		$('#delivery-price').html(delivery_price_new);
		$('.total-price').html('￥' + totalprice_temp);
		$('.wait-price').html('￥' + waitprice_temp);

		$('#delivery-index').val(index);
		$('#delivery-time').val(time);
		$('#delivery-day').val(day);
		$('.delivery-time-show').html(day + ' ' + time);
		$.icloseModal('.delivery-time-modal', true);
		return false;
	});
	var today_date = "<?php  echo date('m-d')?>";
	var time_flag = "<?php  echo $time_flag;?>";
	$(document).on('click', '#delivery-time-parent li', function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		var date = $(this).data('value');
		if(today_date == date) {
			if(time_flag == 1) {
				$('#delivery-time-children li.time-flag').removeClass('hide');
			}
			$('#delivery-time-children li.init-hide').addClass('hide');
		} else {
			$('#delivery-time-children li.time-flag').addClass('hide');
			$('#delivery-time-children li.init-hide').removeClass('hide');
		}
		if($.device.iphone) {
			new IScroll('.delivery-time-modal .children-category-wrapper', {probeType: 3, mouseWheel: true, click: false, tap: true})
		} else {
			new IScroll('.delivery-time-modal .children-category-wrapper', {probeType: 3, mouseWheel: true, click: true})
		}
		return false;
	});

	//备注
	$(document).on('click', '#order-note-show', function(){
		$.popup('.popup-remark');
	});

	$(document).on('click', '#popup-remark .spec-item', function(){
		var note = $('#note-textarea').val();
		$('#note-textarea').val(note + ' ' + $(this).html());
	});

	$(document).on('click', '#note-submit', function(){
		var note = $('#note-textarea').val();
		if(note == '') {
			note = '(选填)可填入特殊要求';
		}
		$('#order-note-show').html(note);
		$('#order-note').val(note);
	});

	//发票
	$(document).on('click', '.invoice-status', function(){
		if($(this).find('input').prop('checked')) {
			$('.invoice-value').removeClass('hide');
		} else {
			$('.invoice-value').addClass('hide');
		}
	});

	$(document).on('click', '.delivery-fee-modal', function(){
		$.iopenModal('.modal-delivery-fee', function(){});
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>