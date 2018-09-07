<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('member/coupon/list');?>
	<input name="status" type="hidden" value="<?php  echo $status;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">代金券使用状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo iurl('member/coupon/list', array('status' => 0))?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo iurl('member/coupon/list', array('status' => 1))?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未使用</a>
				<a href="<?php  echo iurl('member/coupon/list', array('status' => 2))?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已使用</a>
				<a href="<?php  echo iurl('member/coupon/list', array('status' => 3))?>" class="btn <?php  if($status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已过期</a>
			</div>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">代金券类型和门店</label>
		<div class="col-sm-9 col-xs-12">
			<select name="type" class="form-control">
				<option value="">选择代金券类型</option>
				<option value="couponCollect" <?php  if($type == 'couponCollect') { ?>selected<?php  } ?>>进店领券</option>
				<option value="couponGrant" <?php  if($type == 'couponGrant') { ?>selected<?php  } ?>>下单返券</option>
			</select>
			<select name="sid" class="form-control select2 js-select2">
				<option value="">选择门店</option>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<option value="<?php  echo $store['id'];?>" <?php  if($store['id'] == $sid) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">获取和使用时间</label>
		<div class="col-sm-9 col-xs-12">
			<?php  echo itpl_form_field_daterange('granttime', array('placeholder' => '获取时间'));?>
			<?php  echo itpl_form_field_daterange('usetime', array('placeholder' => '使用时间'));?>

		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-9 col-xs-12">
			<input class="form-control" name="keyword" placeholder="输入会员名或手机号" type="text" value="<?php  echo $_GPC['keyword'];?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($coupons)) { ?>
				<div class="no-result">还没有相关数据</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th width="40">
								<div class="checkbox checkbox-inline">
									<input type="checkbox" name="ids[]"/>
									<label></label>
								</div>
							</th>
							<th>会员</th>
							<th>会员uid</th>
							<th>门店</th>
							<th>获取渠道</th>
							<th>优惠金额</th>
							<th>使用条件</th>
							<th>获得时间</th>
							<th>有效时间</th>
							<th>使用时间</th>
							<th>使用状态</th>
							<th>使用单号</th>
							<th style="text-align: right">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($coupons)) { foreach($coupons as $coupon) { ?>
							<tr>
								<td>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="ids[]" value="<?php  echo $coupon['id'];?>"/>
										<label></label>
									</div>
								</td>
								<td><img width="48" height="48" src="<?php  echo tomedia($coupon['avatar'])?>" alt=""/>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $coupon['realname'];?></td>
								<td><?php  echo $coupon['uid'];?></td>
								<td><img width="48" height="48" src="<?php  echo tomedia($stores[$coupon['sid']]['logo'])?>" alt=""/>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $stores[$coupon['sid']]['title'];?></td>
								<td><span class="label <?php  echo $channel[$coupon['channel']]['css'];?>"><?php  echo $channel[$coupon['channel']]['text'];?></span></td>
								<td><?php  echo $coupon['discount'];?>元</td>
								<td>满<?php  echo $coupon['condition'];?>元可用</td>
								<td><?php  echo date('Y-m-d H:i:s', $coupon['granttime'])?></td>
								<td><?php  if($coupon['starttime'] > 0) { ?><?php  echo date('Y-m-d H:i:s', $coupon['starttime'])?><?php  } else { ?><?php  echo date('Y-m-d H:i:s', $coupon['granttime'])?><?php  } ?>~<?php  echo date('Y-m-d H:i:s', $coupon['endtime'])?></td>
								<td><?php  if($coupon['usetime'] > 0) { ?><?php  echo date('Y-m-d H:i:s', $coupon['usetime'])?><?php  } ?></td>
								<td><span class="label <?php  echo $coupon_status[$coupon['status']]['css'];?>"><?php  echo $coupon_status[$coupon['status']]['text'];?></span></td>
								<td><?php  if($coupon['order_id'] > 0) { ?><?php  echo $coupon['order_id'];?><?php  } ?></td>
								<td align="right"><a class="btn btn-danger btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗" href="<?php  echo iurl('member/coupon/del', array('id' => $coupon['id']))?>">删除</a></td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('member/coupon/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="删除后将不可恢复，确定删除吗">删除所选</a>
						<a class="btn btn-warning js-post" href="<?php  echo iurl('member/coupon/delAll')?>" data-confirm="删除后不可恢复,确定删除所有的记录吗?">删除所有记录</a>
					</div>
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
