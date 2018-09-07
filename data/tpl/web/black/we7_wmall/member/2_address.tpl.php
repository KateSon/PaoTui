<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('member/address');?>
	<input name="status" type="hidden" value="<?php  echo $status;?>">
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否有经纬度</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a class="btn <?php  if(empty($status)) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('member/address', array('status' => 0))?>">不限</a>
				<a class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('member/address', array('status' => 1))?>">有</a>
				<a class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('member/address', array('status' => 2))?>">无</a>
			</div>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-9 col-xs-12">
			<input class="form-control" name="keyword" placeholder="输入收货人名或手机号" type="text" value="<?php  echo $_GPC['keyword'];?>">
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
			<?php  if(empty($addresses)) { ?>
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
							<th>会员uid</th>
							<th>收货人</th>
							<th>性别</th>
							<th>手机号</th>
							<th>地址/门牌号</th>
							<th>是否有经纬度</th>
							<th style="width: 200px; text-align: right;">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($addresses)) { foreach($addresses as $address) { ?>
							<tr>
								<td>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="ids[]" value="<?php  echo $address['id'];?>"/>
										<label></label>
									</div>
								</td>
								<td><?php  echo $address['uid'];?></td>
								<td><?php  echo $address['realname'];?></td>
								<td><?php  echo $address['sex'];?></td>
								<td><?php  echo $address['mobile'];?></td>
								<td><?php  echo $address['address'];?><br><?php  echo $address['number'];?></td>
								<td>
									<?php  if(!empty($address['location_x']) && !empty($address['location_y'])) { ?>
										<span class="label label-success">有</span>
									<?php  } else { ?>
										<span class="label label-danger">无</span>
									<?php  } ?>
								</td>
								<td align="right"><a href="<?php  echo iurl('member/address/del', array('id' => $address['id']))?>" class="btn btn-danger btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a></td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('member/address/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
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
