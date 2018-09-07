<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div id="tpl">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类名称</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="title[]" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类内最低消费金额</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<input type="text" class="form-control" name="min_fee[]" value="0">
						<div class="input-group-addon">元</div>
					</div>
					<div class="help-block">
						限制在该分类内， 购买的商品不能少于多少元。适用场景：快餐分类，这个分类内的商品，下单金额必须满足元才能下单。该设置仅对外卖有效。消费金额不包括餐盒费
					</div>
				</div>
			</div>
			<div class="form-group" style="border-bottom: 0">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类排序</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="displayorder[]" value="">
				</div>
			</div>
			<hr>
		</div>
		<div id="tpl-container"></div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<a href="javascipt:;" id="post-add"><i class="fa fa-plus-circle"></i> 继续添加</a>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$(function(){
	$('#post-add').click(function(){
		$('#tpl-container').append($('#tpl').html());
	});
});
</script>
<?php  } else if($ta == 'list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('store/goods/category/post');?>" class="btn btn-primary btn-sm">添加分类</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th>分类名称</th>
						<th>最低消费金额（元）</th>
						<th>排序</th>
						<th>商品数</th>
						<th>是否显示</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
					<tr>
						<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
						<td><input type="text" name="title[]" class="form-control width-100" value="<?php  echo $item['title'];?>"></td>
						<td><input type="text" name="min_fee[]" class="form-control width-100" value="<?php  echo $item['min_fee'];?>"></td>
						<td><input type="text" name="displayorder[]" class="form-control width-100" value="<?php  echo $item['displayorder'];?>"></td>
						<td><?php  echo intval($nums[$item['id']]['num'])?></td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('store/goods/category/status', array('id' => $item['id']));?>" data-name="status" value="<?php  echo $item['status'];?>" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('store/goods/index/list', array('cid' => $item['id']))?>" class="btn btn-default btn-sm" title="查看商品" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"> </i></a>
							<a href="<?php  echo iurl('store/goods/index/post', array('cid' => $item['id']))?>" class="btn btn-default btn-sm" title="添加商品" data-toggle="tooltip" data-placement="top" ><i class="fa fa-plus"> </i></a>
							<a href="<?php  echo iurl('store/goods/category/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" title="删除" data-toggle="tooltip" data-placement="top" data-confirm="删除后该分类下的商品也会删除，确定删除吗?"><i class="fa fa-times"> </i></a>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<input type="submit" class="btn btn-primary btn-sm" value="提交修改">
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>
</form>
<?php  } else if($ta == 'export') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<a class="btn btn-default" href="<?php echo WE7_WMALL_URL;?>resource/excel/goods_category.xls">下载导入模板</a>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="file" name="file" value="" required="true">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="导入" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>