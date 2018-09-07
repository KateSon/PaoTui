<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page page-paycenter">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">支付订单</h1>
	</header>
	<div class="content">
		<?php  if($params['pay_endtime'] > 0) { ?>
			<div class="remaining-time border-1px-t">
				<div>支付剩余时间</div>
				<div class="in-clock">
					<span class="in-num" id="minute_0">-</span>
					<span class="in-num" id="minute_1">-</span>
					<span class="in-colon">:</span>
					<span class="in-num" id="second_0">-</span>
					<span class="in-num" id="second_1">-</span>
				</div>
			</div>
		<?php  } ?>
		<div class="in-order-summary row">
			<div class="col-30">
				<img src="<?php  echo tomedia($logo);?>" alt="">
			</div>
			<div class="col-70">
				<div class="cell-ellipsis"><span class="in-order-fee in-bottom-line">¥<?php  echo $params['fee'];?></span></div>
				<div class="ce1l-ellipsis"><span class="in-order-title in-bottom-line"><?php  echo $title;?></span></div>
			</div>
		</div>
		<div class="content-block-title">选择支付方式</div>
		<div class="list-block media-list in-pay-type border-1px-t">
			<ul>
				<?php  if(in_array('wechat', $payment)) { ?>
					<li>
						<a href="javascript:;" class="item-link item-content border-1px-b js-pay js-wechat-pay disabled" data-type="wechat">
							<form action="<?php  echo imurl('system/paycenter/cash/wechat');?>" method="post">
								<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
							</form>
							<div class="item-media">
								<img src="<?php  echo WE7_WMALL_TPL_URL . '/static/img/wx-icon.png'?>">
							</div>
							<div class="item-inner">
								<div class="item-title-row"><div class="item-title">微信支付(必须使用微信内置浏览器)</div></div>
								<div class="item-subtitle"><span class="in-pay-recommend">推荐使用</span>微信支付,安全快捷</div>
							</div>
						</a>
					</li>
				<?php  } ?>
				<?php  if(in_array('alipay', $payment)) { ?>
					<li>
						<a href="javascript:;" class="item-link item-content border-1px-b js-pay" data-type="alipay">
							<form action="<?php  echo imurl('system/paycenter/cash/alipay');?>" method="post">
								<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
							</form>
							<div class="item-media">
								<img src="<?php  echo WE7_WMALL_TPL_URL . '/static/img/zfb-icon.png'?>">
							</div>
							<div class="item-inner">
								<div class="item-title-row"><div class="item-title">支付宝</div></div>
								<div class="item-subtitle"><span class="in-pay-recommend">推荐使用</span>简单、安全、快速</div>
							</div>
						</a>
					</li>
				<?php  } ?>
				<?php  if(in_array('credit', $payment)) { ?>
					<li>
						<a href="javascript:;" class="item-link item-content border-1px-b js-pay" data-type="credit">
							<form action="<?php  echo imurl('system/paycenter/cash/credit');?>" method="post">
								<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
							</form>
							<div class="item-media">
								<img src="<?php  echo WE7_WMALL_TPL_URL . '/static/img/money-icon.png'?>">
							</div>
							<div class="item-inner">
								<div class="item-title-row"><div class="item-title">余额支付</div></div>
								<div class="item-subtitle">当前账户余额: <span class="money">￥<?php  echo sprintf('%.2f', $_W['member']['credit2']);?></span></div>
							</div>
						</a>
					</li>
				<?php  } ?>
				<?php  if(in_array('delivery', $payment)) { ?>
					<li>
						<a href="javascript:;" class="item-link item-content border-1px-b js-pay" data-type="delivery">
							<form action="<?php  echo imurl('system/paycenter/cash/delivery');?>" method="post">
								<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
							</form>
							<div class="item-media">
								<img src="<?php  echo WE7_WMALL_TPL_URL . '/static/img/delivery-icon.png'?>">
							</div>
							<div class="item-inner">
								<div class="item-title-row"><div class="item-title">货到付款</div></div>
								<div class="item-subtitle">线下当面交易，到店付款，货到付款</div>
							</div>
						</a>
					</li>
				<?php  } ?>
				<?php  if(in_array('peerpay', $payment)) { ?>
					<li>
						<a href="<?php  echo imurl('system/paycenter/peerpay/message', array('id' => $record['id']))?>" class="item-link item-content border-1px-b">
							<div class="item-media">
								<img src="<?php  echo WE7_WMALL_TPL_URL . '/static/img/delivery-icon.png'?>">
							</div>
							<div class="item-inner">
								<div class="item-title-row"><div class="item-title">找人代付</div></div>
								<div class="item-subtitle">将订单分享给小伙伴（朋友圈、微信群、微信好友），请他帮忙付款。</div>
							</div>
						</a>
					</li>
				<?php  } ?>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		$('.js-wechat-pay').removeClass('disabled');
	});
	require(['tiny'], function(tiny){
		var credit2 = parseFloat("<?php  echo $_W['member']['credit2'];?>");
		var fee = parseFloat("<?php  echo $params['fee'];?>");
		$(document).on('click', '.js-pay', function() {
			var type = $(this).data('type');
			if(tiny.ish5app() && (type == 'wechat' || type == 'alipay')) {
				h5app.pay(type, '', '', true);
				return false;
			}
			if(type == 'credit' && credit2 < fee) {
				$.toast('余额不足,请使用其他方式支付');
				return false;
			}
			$(this).find('form').submit();
		});
		<?php  if($params['pay_endtime'] > 0) { ?>
			tiny.countDown("<?php  echo $params['pay_endtime_cn'];?>", '', "#hours", "#minute", "#second", 1);
		<?php  } ?>
	});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>