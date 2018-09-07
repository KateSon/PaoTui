<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'list') { ?>
<div class="page" id="page-delivery-inout">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back hide"></a>
		<h1 class="title">账户明细</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('delivery/finance/current/list', array('trade_type' => $trade_type))?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".record-container" data-tpl="tpl-current">
		<div class="buttons-tab">
			<a href="<?php  echo imurl('delivery/finance/current', array('trade_type' => 0));?>" class="button <?php  if($trade_type == 0) { ?>active<?php  } ?>">全部</a>
			<a href="<?php  echo imurl('delivery/finance/current', array('trade_type' => 1));?>" class="button <?php  if($trade_type == 1) { ?>active<?php  } ?>">配送费入账</a>
			<a href="<?php  echo imurl('delivery/finance/current', array('trade_type' => 2));?>" class="button <?php  if($trade_type == 2) { ?>active<?php  } ?>">申请提现</a>
			<a href="<?php  echo imurl('delivery/finance/current', array('trade_type' => 3));?>" class="button <?php  if($trade_type == 3) { ?>active<?php  } ?>">其他变动</a>
		</div>
		<?php  if(empty($records)) { ?>
		<div class="no-data">
			<div class="bg"></div>
			<p>没有任何记录哦～</p>
		</div>
		<?php  } else { ?>
		<div class="record-list">
			<ul class="record-container">
				<?php  if(is_array($records)) { foreach($records as $record) { ?>
				<li class="border-1px-b">
					<a href="<?php  echo imurl('delivery/finance/current/detail', array('id' => $record['id']));?>">
						<div class="record-name">
							<span><?php  echo $record['trade_type_cn'];?></span>
							<?php  if($record['fee'] > 0) { ?>
								<span class="right color-success">+<?php  echo $record['fee'];?></span>
							<?php  } else { ?>
								<span class="right color-danger"><?php  echo $record['fee'];?></span>
							<?php  } ?>
						</div>
						<div class="record-time">
							<?php  echo date('Y-m-d H:i', $record['addtime'])?>
							<span class="right">¥<?php  echo $record['amount'];?></span>
						</div>
					</a>
				</li>
				<?php  } } ?>
			</ul>
		</div>
		<div class="infinite-scroll-preloader hide">
			<div class="preloader"></div>
		</div>
		<?php  } ?>
	</div>
</div>
<script id="tpl-current" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li class="border-1px-b">
		<a href="<?php  echo imurl('delivery/finance/current/detail');?>&id=<{d[i].id}>>
			<div class="record-name">
				<span><{d[i].trade_type_cn}></span>
				<{# if(d[i].fee > 0){ }>
					<span class="right color-success">+<{d[i].fee}></span>
				<{# } else { }>
					<span class="right color-danger"><{d[i].fee}></span>
				<{# } }>
			</div>
			<div class="record-time">
				<{d[i].addtime_cn}>
				<span class="right">¥<{d[i].amount}></span>
			</div>
		</a>
	</li>
	<{# } }>
</script>
<?php  } else { ?>
<div class="page page-current-detail">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back"></a>
		<h1 class="title">交易详情</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content trade-details border-1px-tb">
		<div class="row no-gutter border-1px-b">
			<div class="col-20 color-gray">交易类型</div>
			<div class="col-80 text-right">
				<?php  if($current['trade_type'] == 1) { ?>
					配送费入账
				<?php  } else if($current['trade_type'] == 2) { ?>
					申请提现
				<?php  } else { ?>
					其他变动
				<?php  } ?>
			</div>
		</div>
		<div class="row no-gutter border-1px-b">
			<div class="col-20 color-gray">余额变动</div>
			<div class="col-80 text-right <?php  if($current['fee'] > 0) { ?>color-success<?php  } else { ?>color-danger<?php  } ?>">￥<?php  echo $current['fee'];?></div>
		</div>
		<div class="row no-gutter border-1px-b">
			<div class="col-20 color-gray">变动后账户余额</div>
			<div class="col-80 text-right">￥<?php  echo $current['amount'];?></div>
		</div>
		<?php  if($current['trade_type'] == 2) { ?>
			<div class="row no-gutter border-1px-b">
				<div class="col-20 color-gray">订单号</div>
				<div class="col-80 text-right color-black"><?php  echo $getcash_log['trade_no'];?></div>
			</div>
			<div class="row no-gutter border-1px-b">
				<div class="col-20 color-gray">提现金额</div>
				<div class="col-80 text-right color-black">￥<?php  echo $getcash_log['get_fee'];?></div>
			</div>
			<div class="row no-gutter border-1px-b">
				<div class="col-20 color-gray">手续费</div>
				<div class="col-80 text-right color-black">￥<?php  echo $getcash_log['take_fee'];?></div>
			</div>
			<div class="row no-gutter border-1px-b">
				<div class="col-20  color-gray">实际到账</div>
				<div class="col-80 text-right color-black">￥<?php  echo $getcash_log['final_fee'];?></div>
			</div>
			<div class="row no-gutter border-1px-b">
				<div class="col-20 color-gray">提现人</div>
				<div class="col-80 text-right color-black"><?php  echo $deliveryer['nickname'];?></div>
			</div>
			<div class="row no-gutter border-1px-b">
				<div class="col-20 color-gray">开始时间</div>
				<div class="col-80 text-right color-black"><?php  echo date('Y-m-d H:i', $getcash_log['addtime'])?></div>
			</div>
			<div class="row no-gutter border-1px-b">
				<div class="col-20 color-gray">提现状态</div>
				<div class="col-80 text-right color-black"><?php  if($record['status'] == 1) { ?>申请成功<?php  } else { ?>申请中<?php  } ?></div>
			</div>
		<?php  } else if($current['trade_type'] == 1) { ?>
			<div class="row no-gutter border-1px-b">
				<div class="col-20 color-gray">订单类型</div>
				<div class="col-80 text-right color-black"><?php  if($current['order_type'] == 'order') { ?>外卖订单<?php  } else { ?>跑腿订单<?php  } ?></div>
			</div>
			<div class="row no-gutter border-1px-b">
				<div class="col-20 color-gray">订单号</div>
				<div class="col-80 text-right color-black"><?php  echo $current['extra'];?></div>
			</div>
		<?php  } ?>
		<div class="row no-gutter border-1px-b">
			<div class="col-20 color-gray">变动时间</div>
			<div class="col-80 text-right color-black"><?php  echo date('Y-m-d H:i', $current['addtime'])?></div>
		</div>
		<?php  if(!empty($current['remark'])) { ?>
			<div class="row no-gutter">
				<div class="col-20 color-gray">备注</div>
				<div class="col-80 text-right color-black"><?php  echo $current['remark'];?></div>
			</div>
		<?php  } ?>
	</div>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>