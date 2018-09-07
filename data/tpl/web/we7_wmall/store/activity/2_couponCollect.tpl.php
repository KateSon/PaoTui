<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<h3>活动信息</h3>
		<input type="hidden" name="coupons" value=""/>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动名称</label>
			<div class="col-sm-6 col-xs-6 col-md-4">
				<input type="text" class="form-control" name="title" value="<?php  echo $activity['coupon']['title'];?>" required="true"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动开始时间</label>
			<div class="col-sm-6 col-xs-6 col-md-4">
				<?php  echo tpl_form_field_date('starttime', $activity['starttime'], true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动结束时间</label>
			<div class="col-sm-6 col-xs-6 col-md-4">
				<?php  echo tpl_form_field_date('endtime', $activity['endtime'], true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">面向人群</label>
			<div class="col-sm-6 col-xs-6 col-md-4">
				<div class="radio radio-inline">
					<input type="radio" name="type_limit" value="1" id="type-limit-1" <?php  if($activity['coupon']['type_limit'] == 1 || empty($activity['coupon']['type-limit'])) { ?>checked<?php  } ?>/>
					<label for="type-limit-1">新老用户通用</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="type_limit" value="2" id="type-limit-2" <?php  if($activity['coupon']['type_limit'] == 2) { ?>checked<?php  } ?>/>
					<label for="type-limit-2">新用户</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">券包总数</label>
			<div class="col-sm-6 col-xs-6 col-md-4">
				<input type="number" class="form-control" name="amount" value="<?php  echo $activity['coupon']['amount'];?>" required="true" digtis="true"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">优惠券</label>
			<div class="col-sm-9 col-xs-12 col-md-10">
				<a href="javascript:;" class="btn btn-primary btn-sm btn-coupon-edit">添加优惠券</a>
				<br/><br/>
				<div id="coupon-container"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="modal-coupon">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal form form-validate" id="" action="" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">优惠券信息</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<input type="submit" value="确认并添加" class="btn btn-primary btn-coupon-submit">
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/html" id="coupon-item">
	<{# for(var i in d){ }>
		<{# if(!d[i]) {continue;} }>
		<div class="coupon-detail">
			<div class="coupon-operation">
				<a href="javascript:;" class="btn-coupon-edit" data-key="<{i}>">编辑</a>
				<a href="javascript:;" class="btn-coupon-del" data-key="<{i}>">删除</a>
			</div>
			<div class="coupon-amount pull-left">
				<span class="discount-amount"><i></i><{d[i].discount}></span>
				<p>满<i class="max-amount"><{d[i].condition}></i>可用</p>
			</div>
			<div class="coupon-term pull-left">领券后<i class="deadline"><{d[i].use_days_limit}></i>天内有效</div>
		</div>
	<{# } }>
</script>

<script type="text/html" id="coupon-editor">
	<div class="form-group">
		<label class="col-xs-12 col-sm-4 col-md-3 control-label">优惠券金额</label>
		<div class="col-sm-7 col-md-8">
			<div class="input-group">
				<input type="number" class="form-control" name="discount" value="<{d.discount}>" required="true" digtis="true"/>
				<span class="input-group-addon">元</span>
			</div>
			<span class="help-block">必须填写整数</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-4 col-md-3 control-label">满多少元可用</label>
		<div class="col-sm-7 col-md-8">
			<div class="input-group">
				<input type="number" class="form-control" name="condition" value="<{d.condition}>" required="true" digtis="true"/>
				<span class="input-group-addon">元</span>
			</div>
			<span class="help-block">必须填写整数,且大于优惠券面额</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-4 col-md-3 control-label">领取后几天内有效</label>
		<div class="col-sm-7 col-md-8">
			<div class="input-group">
				<input type="number" class="form-control" name="use_days_limit" value="<{d.use_days_limit}>" required="true" digtis="true"/>
				<span class="input-group-addon">天</span>
			</div>
			<span class="help-block">必须填写整数,且必须大于0</span>
		</div>
	</div>
</script>

<script>
irequire(['laytpl'], function(laytpl){
	$('#form1').submit(function(){
		$(this).attr('stop', 0);
		var coupons = $(':hidden[name="coupons"]').val();
		if(!coupons) {
			Notify.info('请先添加优惠券');
			$(this).attr('stop', 1);
			return false;
		}
	});

	var coupons = {
		items: [],
		editor: {},
		index: -1
	};

	coupons.init = function(params){
		if(params.coupons && params.coupons.length > 0) {
			coupons.items = params.coupons;
			coupons.tplCoupon();
		}

		$(document).on('click', '.btn-coupon-edit', function(){
			var index = $(this).data('key');
			coupons.editor = {};
			coupons.index = -1;
			if(typeof index !== "undefined" && index >= 0) {
				coupons.editor = coupons.items[index];
				coupons.index = index;
			}
			if(!coupons.editor || typeof coupons.editor.discount == "undefined") {
				coupons.editor = {};
			}
			coupons.tplEditor();
		});

		$(document).on('click', '.btn-coupon-submit', function(){
			var item = {
				discount: parseFloat($('#modal-coupon input[name="discount"]').val()),
				condition: parseFloat($('#modal-coupon input[name="condition"]').val()),
				use_days_limit: parseFloat($('#modal-coupon input[name="use_days_limit"]').val())
			};
			if(!item.discount) {
				Notify.info('优惠券金额不能为空');
				return false;
			}
			if(!item.condition) {
				Notify.info('优惠券使用条件不能为空');
				return false;
			}
			if(!item.discount) {
				Notify.info('优惠券金额不能为空');
				return false;
			}
			if(item.discount >= item.condition) {
				Notify.info('优惠金额不能大于使用条件');
				return false;
			}
			if(!item.use_days_limit) {
				Notify.info('优惠券限制使用天数必须大于0');
				return false;
			}
			if(typeof coupons.index != "undefined" && coupons.index >= 0) {
				coupons.items[coupons.index] = item;
			} else {
				coupons.items.push(item);
			}
			coupons.tplCoupon();
			$('#modal-coupon').modal('hide');
			return false;
		});

		$(document).on('click', '.btn-coupon-del', function(){
			var $this = $(this);
			Notify.confirm('确定删除该优惠券?',  function(){
				var index = $this.data('key');
				delete(coupons.items[index]);
				coupons.tplCoupon();
			});
		});
	};

	coupons.tplCoupon = function() {
		var html = $('#coupon-item').html();
		laytpl(html).render(this.items, function(html){
			$('#coupon-container').html(html);
			$(':hidden[name="coupons"]').val('');
			if(coupons.items.length > 0) {
				$(':hidden[name="coupons"]').val(JSON.stringify(coupons.items));
			}
		});
	};

	coupons.tplEditor = function() {
		var html = $('#coupon-editor').html();
		laytpl(html).render(coupons.editor, function(html){
			$('#modal-coupon .modal-body').html(html);
			$('#modal-coupon').modal('show');
		});
	};
	coupons.init({
		coupons: <?php  echo json_encode($activity['data']);?>
	});
});
</script>
<?php  } ?>

<?php  if($ta == 'list') { ?>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a class="btn btn-primary btn-sm" href="<?php  echo iurl('store/activity/couponCollect/post');?>"/><i class="fa fa-plus-circle"> </i> 创建领券活动</a>
		</div>
		<div class="alert alert-warning">每个门店最多支持上架一个进店领券活动。</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>活动名称</th>
					<th>活动时间</th>
					<th>状态</th>
					<th>面向人群</th>
					<th style="width:300px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(!empty($coupons)) { ?>
					<tr>
						<td><?php  echo $coupons['coupon']['title'];?></td>
						<td><?php  echo date('Y-m-d', $coupons['starttime'])?> ~  <?php  echo date('Y-m-d', $coupons['endtime'])?></td>
						<td><?php  if($coupons['status'] == 1) { ?>
							活动生效中
							<?php  } else if($coupons['status'] == 2) { ?>
							活动未开始
							<?php  } else { ?>
							活动已结束或已撤销
							<?php  } ?>
						</td>
						<td>
							<?php  if($coupons['coupon']['type_limit'] == 1) { ?>
							所有用户
							<?php  } else { ?>
							新用户
							<?php  } ?>
						</td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('store/activity/couponCollect/detail', array('id' => $coupons['coupon']['id'], 'activity_id' => $coupons['id']))?>" class="btn btn-default btn-sm" title="查看"> 查看</a>
							<?php  if($coupon['status'] < 2) { ?>
							<a href="<?php  echo iurl('store/activity/couponCollect/del', array('type' => $coupons['type']))?>" class="btn btn-default btn-sm js-post" title="撤销" data-confirm="确定要撤销吗?"> 撤销活动</a>
							<?php  } ?>
						</td>
					</tr>
				<?php  } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($ta == 'detail') { ?>
<div class="coupon-collect-detail">
	<div class="panel-stat">
		<div class="panel-heading">
			<h3>活动信息</h3>
		</div>
		<div class="panel-body">
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title">活动名称</label>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8">
					<span><?php  echo $data['title'];?></span>
				</div>
			</div>
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title">活动状态</label>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8">
					<span><?php  if($data['status'] == 1) { ?>活动已生效<?php  } else { ?>活动未开始或已结束<?php  } ?></span>
				</div>
			</div>
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title">活动时间</label>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8">
					<span><?php  echo date('Y-m-d', $data['starttime'])?> ~  <?php  echo date('Y-m-d', $data['endtime'])?></span>
				</div>
			</div>
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title">面向人群</label>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8">
					<?php  if($data['type_limit'] == 1) { ?>
						<span>所有用户</span>
					<?php  } else { ?>
						<span>新用户</span>
					<?php  } ?>
				</div>
			</div>
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title">券包总数</label>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8">
					<span><?php  echo $data['amount'];?>个</span>
				</div>
			</div>
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title">优惠券</label>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8">
					<?php  if(is_array($data['coupons'])) { foreach($data['coupons'] as $coupon) { ?>
						<div class="coupon-detail">
							<div class="coupon-amount pull-left">
								<span class="discount-amount"><i></i><?php  echo $coupon['discount'];?></span>
								<p>满<i class="max-amount"><?php  echo $coupon['condition'];?></i>可用</p>
							</div>
							<div class="coupon-term pull-left">领券后<i class="deadline"><?php  echo $coupon['use_days_limit'];?></i>天内有效</div>
						</div>
					<?php  } } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-stat">
		<div class="panel-heading">
			<h3>活动统计</h3>
		</div>
		<div class="panel-body">
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title">券包总数</label>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8">
					<span><?php  echo $data['amount'];?>(每个券包中含<?php  echo $data['total'];?>张券)</span>
				</div>
			</div>
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title" title="券总张数 = 券包数量 * 每个券包中的卡券数量">券总张数</label>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<span><?php  echo $data['total'] * $data['amount']?></span>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php  echo $total;?>" aria-valuemin="0" aria-valuemax="<?php  echo $total;?>" style="width: 100%"></div>
					</div>
				</div>
			</div>
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title" title="券总张数 = 已领取的券包数量 * 每个券包中的卡券数量">发放数量</label>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<span><?php  echo $data['dosage_total'];?></span>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php  echo $item['dosage_total'];?>" aria-valuemin="0" aria-valuemax="<?php  echo $total;?>" style="width: <?php  echo $item['dosage_percent'];?>%"></div>
					</div>
				</div>
			</div>
			<div class="item-group row">
				<div class="col-md-2 col-sm-4 col-xs-4 text-right">
					<label class="label-title">使用数量</label>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-1">
					<span><?php  echo $data['is_use_total'];?></span>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="progress">
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php  echo $item['is_use_total'];?>" aria-valuemin="0" aria-valuemax="<?php  echo $total;?>" style="width: <?php  echo $item['is_use_percent'];?>%"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>