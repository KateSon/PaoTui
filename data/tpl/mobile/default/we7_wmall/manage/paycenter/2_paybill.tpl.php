<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?> 
<?php  if($ta == 'index') { ?>
<div class="page page-paybill">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title open-popup">账单</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('manage/paycenter/paybill/more', array('pay_type' => $pay_type))?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".paybill-order-list" data-tpl="tpl-paybill-order">
		<div class="buttons-tab">
			<a href="<?php  echo imurl('manage/paycenter/paybill/index', array('pay_type' => 'all'));?>" class="button <?php  if($pay_type == 'all') { ?>active<?php  } ?>">所有</a>
			<a href="<?php  echo imurl('manage/paycenter/paybill/index', array('pay_type' => 'wechat'));?>" class="button <?php  if($pay_type == 'wechat') { ?>active<?php  } ?>">微信</a>
			<a href="<?php  echo imurl('manage/paycenter/paybill/index', array('pay_type' => 'alipay'));?>" class="button <?php  if($pay_type == 'alipay') { ?>active<?php  } ?>">支付宝</a>
			<a href="<?php  echo imurl('manage/paycenter/paybill/index', array('pay_type' => 'credit'));?>" class="button <?php  if($pay_type == 'credit') { ?>active<?php  } ?>">余额</a>
		</div>
		<div class="paybill-order-list">
			<?php  if(empty($orders)) { ?>
				<div class="no-data">
					<div class="bg"></div>
					<p>没有任何订单哦～</p>
				</div>
			<?php  } else { ?>
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
					<a href="<?php  echo imurl('manage/paycenter/paybill/detail', array('id' => $order['id']));?>" class="paybill-item clearfix border-1px-tb">
						<span class="pay-type">
							<span class="type <?php  echo $order['pay_type'];?>"></span>
						</span>
						<span class="pay-content">
							<div class="top">
								#<b class="order-sn"><?php  echo $order['serial_sn'];?></b>
								<span class="username"><?php  echo $order['nickname'];?></span>
							</div>
							<div class="bottom">
								<?php  echo date('Y-m-d H:i:s', $order['addtime'])?>
							</div>
						</span>
						<span class="pay-price">
							<div class="total-fee">
								<span>顾客支付</span>¥<?php  echo $order['final_fee'];?>
							</div>
							<div class="store-final-fee">
								<span>最终收入</span>¥<?php  echo $order['store_final_fee'];?>
							</div>
						</span>
					</a>
				<?php  } } ?>
			<?php  } ?>
		</div>
	</div>
</div>

<script id="tpl-paybill-order" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
		<a href="<?php  echo imurl('manage/paycenter/paybill/detail');?>&id=<{d[i].id}>" class="paybill-item clearfix border-1px-tb">
			<span class="pay-type">
				<span class="type <{d[i].pay_type}>"></span>
			</span>
			<span class="pay-content">
				<div class="top">
					#<b class="order-sn"><{d[i].serial_sn}></b>
					<span class="username"><{d[i].nickname}></span>
				</div>
				<div class="bottom">
					<{d[i].addtime}>
				</div>
			</span>
			<span class="pay-price">
				<div class="total-fee">
					<span>顾客支付</span>¥<{d[i].final_fee}>
				</div>
				<div class="store-final-fee">
					<span>最终收入</span>¥<{d[i].store_final_fee}>
				</div>
			</span>
		</a>
	<{# } }>
</script>
<?php  } ?>

<?php  if($ta == 'detail') { ?>
<div class="page paybill-detail">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title open-popup">账单详情</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="wui-form-preview">
  			<div class="wui-form-preview-hd">
    			<label class="wui-form-preview-label">顾客支付金额</label>
    			<em class="wui-form-preview-value">¥<?php  echo $order['final_fee'];?></em>
  			</div>
	 		<div class="wui-form-preview-bd">
	    		<div class="wui-form-preview-item">
	      			<label class="wui-form-preview-label">订单号</label>
	      			<span class="wui-form-preview-value"><?php  echo $order['order_sn'];?></span>
	    		</div>
	    		<div class="wui-form-preview-item">
	     			<label class="wui-form-preview-label">支付方式</label>
	      			<span class="wui-form-preview-value"><?php  echo to_paytype($order['pay_type'], 'text')?></span>
	    		</div>
	    		<div class="wui-form-preview-item">
	      			<label class="wui-form-preview-label">消费总额</label>
	      			<span class="wui-form-preview-value">¥ <?php  echo $order['total_fee'];?></span>
	    		</div>
	    		<div class="wui-form-preview-item">
	      			<label class="wui-form-preview-label">不参与优惠金额</label>
	      			<span class="wui-form-preview-value">¥ <?php  echo $order['no_discount_part'];?></span>
	    		</div>
	    		<div class="wui-form-preview-item">
	      			<label class="wui-form-preview-label">优惠金额</label>
	      			<span class="wui-form-preview-value">¥ <?php  echo $order['discount_fee'];?></span>
	    		</div>
	    		<div class="wui-form-preview-item">
	      			<label class="wui-form-preview-label">平台抽取佣金</label>
	      			<span class="wui-form-preview-value">¥ <?php  echo $order['plateform_serve_fee'];?></span>
	    		</div>
	    		<div class="wui-form-preview-item">
	      			<label class="wui-form-preview-label">商户预计收入</label>
	      			<span class="wui-form-preview-value">¥ <?php  echo $order['store_final_fee'];?></span>
	    		</div>
	  		</div>
		</div>
	</div>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>