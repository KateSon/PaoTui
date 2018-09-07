<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'category_list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('store/tangshi/table/category_post');?>" class="btn btn-primary btn-sm">新建桌台类型</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead>
				<tr>
					<th width="40">
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="ids[]" value="<?php  echo $item['id'];?>"/>
							<label></label>
						</div>
					</th>
					<th>名字</th>
					<th>最低消费</th>
					<th>预定预付款</th>
					<th>桌子数量</th>
					<th width="350" style="text-align:right">操作</th>
				</tr>
				</thead>
				<?php  if(is_array($data)) { foreach($data as $da) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="ids[]" />
							<label></label>
						</div>
					</td>
					<td><?php  echo $da['title'];?></td>
					<td><?php  echo $da['limit_price'];?></td>
					<td><?php  echo $da['reservation_price'];?></td>
					<td><?php  echo $tables[$da['id']]['num'];?></td>
					<td align="right">
						<a href="<?php  echo iurl('store/tangshi/table/table_post', array('cid' => $da['id']));?>" class="btn btn-default">添加桌台</a>
						<a href="<?php  echo iurl('store/tangshi/table/category_post', array('id' => $da['id']));?>" class="btn btn-default">编辑</a>
						<a href="<?php  echo iurl('store/tangshi/table/category_del', array('id' => $da['id']));?>" data-confirm="确定删除吗?" class="btn btn-default js-remove">删除</a>
					</td>
				</tr>
				<?php  } } ?>
			</table>
			<?php  if(!empty($data)) { ?>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<a href="<?php  echo iurl('store/tangshi/table/category_del')?>" class="btn btn-danger btn-sm js-batch" data-batch="remove" data-confirm="确定删除选中的桌台类型吗?">批量删除</a>
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($ta == 'category_post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>名字</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" class="form-control" name="title" placeholder="" value="<?php  echo $item['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>最低消费</label>
			<div class="col-sm-6 col-xs-6">
				<input type="number" class="form-control" name="limit_price" placeholder="例如:2" value="<?php  echo $item['limit_price'];?>">
				<span class="help-block"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>预定预付款</label>
			<div class="col-sm-6 col-xs-6">
				<input type="number" class="form-control" name="reservation_price" placeholder="" value="<?php  echo $item['reservation_price'];?>">
				<span class="help-block">仅预订订座时需要预付款的金额</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span></label>
			<div class="col-sm-6 col-xs-6">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>