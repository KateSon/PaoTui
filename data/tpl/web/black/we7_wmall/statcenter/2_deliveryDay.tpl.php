<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('statcenter/delivery/day');?>
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
</form>
<div class="clearfix">
	<div class="panel panel-stat">
		<div class="panel-heading">
			<h3>
				总览
				<span class="text-danger font-12">
					提示：当前订单配送超时时间为<?php  echo $config_takeout['delivery_timeout_limit'];?>分钟,提前时间为<?php  echo $config_takeout['delivery_before_limit'];?>分钟。
					配送时间:从商家通知配送员接单的时间点到配送员送达的时间点的差值。
					普通单:配送时间未超过后台设置的订单配送超时时间
				</span>
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-2">
				<div class="title">
					总配送
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="总配送： 由平台配送并且订单已完成的订单数"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span><?php  echo $stat['total_success_order'];?></span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					普通订单
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="普通订单： 根据平台设置的订单配送超时时间,计算未超时订单的数目"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span><?php  echo intval($stat['total_normal_order']);?></span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					超时订单
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="超时订单：根据平台设置的订单配送超时时间,计算超时订单的数目。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span><?php  echo $stat['total_timeout_order'];?></span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					提前送达订单
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="超时订单：根据平台设置的订单配送超时时间,计算超时订单的数目。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span><?php  echo $stat['total_before_order'];?></span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					普通单平均配送时长(分)
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="普通单平均配送时长:未超时订单的总配送时间除以未超时的总单数。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span><?php  echo $stat['avg_normal_delivery_time'];?></span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					配送准时率
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="配送准时率:未超时订单数的除以总单数。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span><?php  echo $stat['percent_normal'];?>%</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					配送超时率
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="配送超时率:超时订单数的除以总单数。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span><?php  echo $stat['percent_timeout'];?>%</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive">
			<table class="table table-bordered table-hover text-center" style="background: #fff">
			<thead class="navbar-inner">
			<tr>
				<th>配送员</th>
				<th>总配送单数</th>
				<th>正常送达单数</th>
				<th>提前送达单数</th>
				<th>
					超时单数/占比
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="占比:该配送员的超时单数除以当天总超时单数。"></i>
				</th>
				<th>普通单<br>平均配送时长(分)</th>
				<th>订单准时率</th>
				<th>订单超时率</th>
				<th>推单-接单-到店(取货)-送达<br>(普通单,单位:分)</th>
				<th>订单配送评价<br>1星-2星-3星-4星-5星</th>
			</tr>
			</thead>
			<tbody>
			<?php  if(is_array($records)) { foreach($records as $record) { ?>
				<tr>
					<td><strong><?php  echo $record['title'];?></strong></td>
					<td><strong><?php  echo intval($record['total_success_order']);?></strong></td>
					<td><strong><?php  echo intval($record['total_normal_order']);?></strong></td>
					<td><strong><?php  echo intval($record['total_before_order']);?></strong></td>
					<td>
						<strong>
							<?php  echo intval($record['total_timeout_order']);?>
							/
							<?php  echo floatval($record['total_percent_timeout']);?>%
						</strong>
					</td>
					<td>
						<strong>
							<?php  echo $record['avg_normal_delivery_time'];?>
						</strong>
						<?php  if($record['avg_normal_delivery_time'] > $stat['avg_normal_delivery_time']) { ?>
							<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="高于平均值<?php  echo $stat['avg_normal_delivery_time'];?>"></i>
						<?php  } ?>
					</td>
					<td><strong><?php  echo $record['percent_normal'];?>%</strong></td>
					<td>
						<strong><?php  echo $record['percent_timeout'];?>%</strong>
						<?php  if($record['percent_timeout'] > $stat['percent_timeout']) { ?>
							<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="高于平均值<?php  echo $stat['percent_timeout'];?>%"></i>
						<?php  } ?>
					</td>
					<td>
						<strong>
							<?php  echo $record['avg_delivery_notify_time'];?> - <?php  echo $record['avg_delivery_instore_time'];?> - <?php  echo $record['avg_delivery_success_time'];?>
						</strong>
					</td>

					<td>
						<strong><?php  echo intval($record['total_comment_order']);?></strong><br>
						<?php  echo $record['total_comment_1'];?>-<?php  echo $record['total_comment_2'];?>-<?php  echo $record['total_comment_3'];?>-<?php  echo $record['total_comment_4'];?>-<?php  echo $record['total_comment_5'];?>
					</td>
				</tr>
			<?php  } } ?>
			</tbody>
		</table>
		</div>
	</div>
</form>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>