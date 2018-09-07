<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('statcenter/takeout/index');?>
	<input type="hidden" name="days" value="<?php  echo $days;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">筛选时间</label>
		<div class="col-sm-9 col-xs-12 js-daterange" data-form="#form1">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('days:0');?>" class="btn <?php  if(!$days) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">今天</a>
				<a href="<?php  echo ifilter_url('days:7');?>" class="btn <?php  if($days == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">最近7天</a>
				<a href="<?php  echo ifilter_url('days:30');?>" class="btn <?php  if($days == 30) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">最近30天</a>
				<a href="javascript:;" class="btn js-btn-custom <?php  if($days == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">自定义</a>
			</div>
			<span class="btn-daterange js-btn-daterange <?php  if($days != -1) { ?>hide<?php  } ?>">
				<?php  echo tpl_form_field_daterange('stat_day', array('start' => $starttime, 'end' => $endtime));?>
			</span>
		</div>
	</div>
	<div class="form-group clearfix form-inline">
		<label class="col-xs-12 col-sm-2 col-md-1 control-label">其他</label>
		<div class="col-sm-7 col-lg-8 col-xs-12">
			<?php  if($_W['is_agent']) { ?>
				<select name="agentid" class="select2 js-select2 form-control width-130">
					<option value="0">选择代理区域</option>
					<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
					<?php  } } ?>
				</select>
			<?php  } ?>
			<select name="sid" class="form-control select2 js-select2 width-130" id="select-sid">
				<option value="0" <?php  if(!$sid) { ?>selected<?php  } ?>>全部门店</option>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<option value="<?php  echo $store['id'];?>" <?php  if($store['id'] == $sid) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
</form>
<div class="clearfix">
	<div class="panel panel-stat">
		<div class="panel-heading">
			<h3>总览</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-3">
				<div class="title">
					营业总额(元)
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="商家通过销售商品获得的有效订单的总金额。（参考公式：流水=在线支付金额+线下支付金额+商家补贴+平台补贴）"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-fee">￥--</span>
					</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">
					总入账
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="平台账户收入的总金额。（参考公式：总入帐=支付宝支付总额+微信支付总额+余额支付总额+货到付款支付总额）"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-final-fee">￥--</span>
					</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">
					有效订单量
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="有效订单量：交易成功且用户未退单的订单。客单价：每笔订单的平均交易金额。（公式：客单价=营业总额÷有效订单数）"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-success-order">--</span>
					</a>
					<span class="info" id="html-avg-pre-order">￥--</span>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">
					无效订单量
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="无效订单量：用户支付成功但最终被取消的订单。包括用户取消、商家取消和系统因超时未处理取消的订单。损失营业额约：根据被取消的订单估算出的商家未获得的营业总额。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-cancel-order">--</span>
					</a>
					<span class="info" id="html-total-cancel-fee">￥--</span>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="col-md-2">
				<div class="title">
					佣金收入
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="佣金收入：平台从有效订单扣除的服务佣金。（单个订单佣金计算公式：服务佣金（商户配送模式）=商品费用+餐盒费+包装费+配送费-商户优惠费用） x 佣金费率。服务佣金（平台配送模式）=商品费用+餐盒费+包装费-商户优惠费用） x 佣金费率"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-serve-fee">￥--</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					配送费收入
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="配送费收入：所有由平台配送的有效订单里的配送费。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-delivery-fee">￥--</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					配送员配送费支出
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-deliveryer-fee">￥--</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					平台补贴
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-plateform-discount-fee">￥--</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					总退款
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-refund-fee">￥--</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix <?php  if(!$days) { ?>hide<?php  } ?>">
	<div class="panel panel-trend">
		<div class="panel-heading">
			<h3>趋势图</h3>
		</div>
		<div class="panel-body">
			<div id="chart-order-holder" style="width: 100%;height:400px;"></div>
		</div>
	</div>
</div>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive">
			<table class="table table-bordered table-hover text-center" style="background: #fff">
			<thead class="navbar-inner">
			<tr>
				<th>账期</th>
				<th>已完成单数</th>
				<th>总营业额</th>
				<th>总入账</th>
				<th>佣金收入</th>
				<th>配送费收入</th>
				<th>配送员配送费支出</th>
				<th>平台补贴</th>
				<th>总退款</th>
			</tr>
			</thead>
			<tbody>
			<?php  if(is_array($records)) { foreach($records as $record) { ?>
				<tr>
					<td><strong><?php  echo $record['stat_day'];?></strong></td>
					<td><strong><?php  echo intval($record['total_success_order']);?></strong></td>
					<td><span class="text-success">￥<?php  echo $record['total_fee'];?></span></td>
					<td><span class="text-success">￥<?php  echo $record['final_fee'];?></span></td>
					<td><span class="text-danger">￥<?php  echo $record['plateform_serve_fee'];?></span></td>
					<td><span class="text-danger">￥<?php  echo $record['plateform_delivery_fee'];?></span></td>
					<td><span class="text-danger">￥<?php  echo $record['plateform_deliveryer_fee'];?></span></td>
					<td><span class="text-danger">￥<?php  echo $record['plateform_discount_fee'];?></span></td>
					<td><strong class="text-danger">￥<?php  echo floatval($cancel_records[$record['stat_day']]['refund_fee']);?></strong></td>
				</tr>
			<?php  } } ?>
			</tbody>
		</table>
		</div>
	</div>
</form>
<script type="text/javascript">
irequire(['echarts'], function(echarts){
	var option = {
		title: {
			text: '营业趋势图'
		},
		tooltip : {
			trigger: 'axis'
		},
		legend: {
			data:[]
		},
		toolbox: {
			feature: {
				saveAsImage: {}
			}
		},
		grid: {
			left: '3%',
			right: '4%',
			bottom: '3%',
			containLabel: true
		},
		xAxis : [{
			type : 'category',
			boundaryGap : false,
			data :[1, 2, 3]
		}],
		yAxis : [
			{
				type : 'value'
			}
		],
		series : []
	};
	var myChart = echarts.init($('#chart-order-holder')[0]);
	myChart.setOption(option);
	myChart.showLoading();
	$.post(location.href, function(data){
		myChart.hideLoading();
		var result = $.parseJSON(data);
		option.legend.data = result.message.message.titles;
		var xAxis = {
			type : 'category',
			boundaryGap : false,
			data : result.message.message.days
		};
		option.xAxis = xAxis;
		$.each(result.message.message.fields, function(k, v){
			var serie = {
				name: result.message.message.titles[k],
				type: 'line',
				areaStyle: {normal: {}},
				data: result.message.message[v]
			};
			option.series.push(serie);
		});
		myChart.setOption(option);
		var stat = result.message.message.stat;
		$('#html-total-fee').html('￥' + stat.total_fee);
		$('#html-final-fee').html('￥' + stat.total_final_fee);
		$('#html-total-success-order').html(stat.total_success_order);
		$('#html-avg-pre-order').html('客单价:￥' + stat.avg_pre_order);
		$('#html-total-cancel-order').html(stat.total_cancel_order);
		$('#html-total-cancel-fee').html('损失营业额约:￥' + stat.total_cancel_fee);
		$('#html-total-delivery-fee').html('￥' + stat.total_delivery_fee);
		$('#html-total-deliveryer-fee').html('￥' + stat.total_deliveryer_fee);
		$('#html-total-refund-fee').html('￥' + stat.total_refund_fee);
		$('#html-total-serve-fee').html('￥' + stat.total_serve_fee);
		$('#html-total-plateform-discount-fee').html('￥' + stat.plateform_discount_fee);
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
