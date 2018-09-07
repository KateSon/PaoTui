<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('deliveryer/plateform/list');?>
	<?php  if($_W['is_agent']) { ?>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择代理区域</label>
			<div class="col-sm-9 col-xs-12">
				<select name="agentid" class="select2 js-select2 form-control width-130">
					<option value="0">选择代理区域</option>
					<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>
	<?php  } ?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">工作状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<div class="btn-group">
					<a href="<?php  echo ifilter_url('work_status:');?>" class="btn <?php  if($work_status == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
					<a href="<?php  echo ifilter_url('work_status:1');?>" class="btn <?php  if($work_status == '1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">接单中</a>
					<a href="<?php  echo ifilter_url('work_status:2');?>" class="btn <?php  if($work_status == '2') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">休息中</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="搜索的姓名、昵称、手机号">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" id="form-deliveryer" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('deliveryer/plateform/add_ptf_deliveryer')?>" class="btn btn-primary btn-sm js-modal">添加平台配送员</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th width="40">
						<div class="checkbox checkbox-inline">
							<input type="checkbox">
							<label></label>
						</div>
					</th>
					<th width="85">头像</th>
					<th>微信昵称</th>
					<?php  if($_W['is_agent']) { ?>
						<th>所属城市</th>
					<?php  } ?>
					<th>配送员名称</th>
					<th>工作状态</th>
					<th>账户余额</th>
					<th>手机号/性别/年龄</th>
					<th>添加时间</th>
					<th>配送权限</th>
					<th style="width:400px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($data)) { foreach($data as $item) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="ids[]" value="<?php  echo $item['deliveryer_id'];?>">
							<label></label>
						</div>
					</td>
					<td>
						<img src="<?php  echo tomedia($item['avatar']);?>" width="48">
					</td>
					<td><?php  echo $item['nickname'];?></td>
					<?php  if($_W['is_agent']) { ?>
						<td><?php  echo toagent($item['agentid'])?></td>
					<?php  } ?>
					<td><?php  echo $item['title'];?></td>
					<td>
						<span class="<?php  echo to_workstatus($item['work_status'], 'css');?>"><?php  echo to_workstatus($item['work_status'], 'text');?></span>
					</td>
					<td>
						<span class="label <?php  if($item['credit2'] > 0) { ?>label-success<?php  } else { ?>label-danger<?php  } ?>"><?php  echo $item['credit2'];?></span>
					</td>
					<td>
						<?php  echo $item['mobile'];?>
						<br/>
						<?php  echo $item['sex'];?> /<?php  echo $item['age'];?>
					</td>
					<td><?php  echo date('Y-m-d H:i', $item['addtime']);?></td>
					<td>
						<span class="label label-success">平台单</span>
						<br>
						<?php  if(!empty($item['stores'])) { ?>
							<?php  if(is_array($item['stores'])) { foreach($item['stores'] as $store) { ?>
								<span class="label label-danger"><?php  echo $stores[$store['sid']]['title'];?></span>
							<?php  } } ?>
						<?php  } ?>
					</td>
					<td style="text-align:right;">
						<a href="javascript:;" class="btn btn-danger btn-sm account-turncate-item" data-type="single" data-deliveryer-id="<?php  echo $item['deliveryer_id'];?>">账户清零</a>
						<a href="<?php  echo iurl('deliveryer/plateform/changes', array('id' => $item['deliveryer_id']))?>" class="btn btn-default btn-sm js-modal">账户变动</a>
						<a href="<?php  echo iurl('deliveryer/plateform/stat', array('id' => $item['deliveryer_id']))?>" class="btn btn-default btn-sm" title="配送统计" data-toggle="tooltip" data-placement="top">统计</a>
						<a href="<?php  echo iurl('deliveryer/getcash/list', array('deliveryer_id' => $item['deliveryer_id']))?>" class="btn btn-default btn-sm" title="提现记录" data-toggle="tooltip" data-placement="top">提现</a>
						<a href="<?php  echo iurl('deliveryer/current/list', array('deliveryer_id' => $item['deliveryer_id']))?>" class="btn btn-default btn-sm" title="账户明细" data-toggle="tooltip" data-placement="top">账户明细</a>
						<a href="<?php  echo iurl('deliveryer/plateform/del_ptf_deliveryer', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" title="取消平台配送权限" data-toggle="tooltip" data-placement="top" data-confirm="确定取消该配送员的配送权限吗?"><i class="fa fa-times"> </i></a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<a href="javascript:;" data-type="mutil" class="btn btn-danger account-turncate-item">账户清零</a>
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal fade" id="modal-account-turncate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">账户清零原因</h4>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="form-group">
						<textarea class="form-control" name="remark" placeholder="请输入账户清零原因" rows="4"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary account-turncate-submit">提交</button>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$(document).on('click', '#show-login-modal', function(){
		$('#qrcode-modal').modal('show');
	});

	$(document).on('click', '.btn-add', function(){
		$('#add-container').modal('show');
		$(document).on('click', '.btn-subm4it', function(){
			var mobile = $('#mobile').val();
			if(!mobile) {
				Notify.info('手机号不能为空');
				return false;
			}
			$.post("<?php  echo iurl('deliveryer/plateform/stat', array('op' => 'add_ptf_deliveryer'));?>", {mobile: mobile}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno == -1) {
					Notify.info(result.message.message);
					return false;
				} else {
					location.reload();
				}
			});
		});
	});

	$(document).on('click', '.account-turncate-item', function(){
		var $this = $(this);
		var type = $this.data('type');
		var ids = [];
		if(type == 'single') {
			var sid = $(this).data('deliveryer-id');
			ids.push(sid);
		} else {
			$('#form-deliveryer :checkbox[name="ids[]"]:checked').each(function(){
				var id = $(this).val();
				if(id) {
					ids.push(id);
				}
			});
		}
		if(ids.length == 0) {
			Notify.info('请选择要操作的账户');
			return false;
		}
		$('#modal-account-turncate').modal('show');
		$(document).on('click', '.account-turncate-submit', function(){
			var remark = $.trim($('#modal-account-turncate textarea[name="remark"]').val());
			if(!remark) {
				Notify.info('账户清零原因不能为空');
				return false;
			}
			$.post("<?php  echo iurl('deliveryer/plateform/account_turncate');?>", {ids: ids, remark: remark}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					Notify.error(result.message.message);
				} else {
					$('#modal-account-turncate').modal('hide');
					Notify.success('账户清零成功', location.href);
				}
			});
		});
	});
});
</script>
<?php  } ?>

<?php  if($op == 'stat') { ?>
<div class="clearfix">
	<div class="panel panel-stat">
		<div class="panel-heading">
			<h3>配送员: <?php  echo $deliveryer['deliveryer']['title'];?></h3>
		</div>
		<div class="panel-body">
			<div class="col-md-3">
				<div class="title">今日配送</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $stat['today_num'];?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">昨日配送</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $stat['yesterday_num'];?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">本月配送</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $stat['month_num'];?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">总配送</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $stat['total_num'];?></a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-trend">
		<div class="panel-heading">
			<h3>详细统计</h3>
		</div>
		<div class="panel-body">
			<form action="" id="trade">
				<?php  echo tpl_form_field_daterange('time', array('start' => date('Y-m-d', $start),'end' => date('Y-m-d', $end)), '')?>
			</form>
			<div id="chart-container">
				<canvas id="myChart" width="1200" height="300"></canvas>
			</div>
		</div>
	</div>
</div>
<script>
require(['chart', 'daterangepicker'], function(c, $) {
	$('.daterange').on('apply.daterangepicker', function(ev, picker) {
		refresh();
	});

	var chart = null;
	var templates = {
		flow1: {
			label: '配送(单)',
			fillColor : "rgba(36,165,222,0.1)",
			strokeColor : "rgba(36,165,222,1)",
			pointColor : "rgba(36,165,222,1)",
			pointStrokeColor : "#fff",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(36,165,222,1)",
		}
	};

	function refresh() {
		$('#chart-container').html('<canvas id="myChart" width="1200" height="300"></canvas>');
		var url = location.href + '&#aaaa';
		var params = {
			'start': $('#trade input[name="time[start]"]').val(),
			'end': $('#trade input[name="time[end]"]').val()
		};
		$.post(url, params, function(data){
			var data = $.parseJSON(data)
			var datasets = data.datasets;
			var label = data.label;
			var ds = $.extend(true, {}, templates);
			ds.flow1.data = datasets.flow1;
			var lineChartData = {
				labels : label,
				datasets : [ds.flow1]
			};
			var ctx = document.getElementById("myChart").getContext("2d");
			chart = new Chart(ctx).Line(lineChartData, {
				responsive: true
			});
		});
	}
	refresh();
});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>