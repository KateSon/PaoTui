<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<h2>编辑商品</h2>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品编号</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="number" value="<?php  echo $item['number'];?>">
				<div class="help-block">此项可选填,便于商品查找</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品分类</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<select name="cid" id="cid" class="form-control">
					<?php  if(is_array($category)) { foreach($category as $li) { ?>
						<option value="<?php  echo $li['id'];?>" <?php  if($item['cid'] == $li['id'] || $_GPC['cid'] == $li['id']) { ?>selected<?php  } ?>><?php  echo $li['title'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品缩略图</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品幻灯片</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_multi_image('slides', $item['slides']);?>
				<div class="help-block">推荐大小: 640*230, 最多不能超过4张图片</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品价格</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">商品现价</div>
					<input type="text" class="form-control" name="price" value="<?php  echo $item['price'];?>">
					<div class="input-group-addon">商品原价</div>
					<input type="text" class="form-control" name="old_price" value="<?php  echo $item['old_price'];?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> 启用规格</span></label>
			<div class="col-sm-9 col-xs-12">
				<div class="checkbox checkbox-inline">
					<input type="checkbox" name="is_options" id="is-options-1" value="1" <?php  if($item['is_options'] == 1) { ?>checked<?php  } ?> onclick="$('#options').toggle();">
					<label for="is-options-1">启用</label>
				</div>
				<br>
				<div id="options" <?php  if($item['is_options']) { ?>style="display:block"<?php  } ?>>
					<div class="tpl">
						<?php  if(!empty($item['options'])) { ?>
							<?php  if(is_array($item['options'])) { foreach($item['options'] as $row) { ?>
								<div class="input-group">
									<span class="input-group-addon">规格名称</span>
									<input type="hidden" name="options[id][]" value="<?php  echo $row['id'];?>">
									<input type="text" name="options[name][]" value="<?php  echo $row['name'];?>" class="form-control" placeholder="规格名称">
									<span class="input-group-addon">价格</span>
									<input type="text" name="options[price][]" value="<?php  echo $row['price'];?>" class="form-control" placeholder="价格">
									<span class="input-group-addon">库存</span>
									<input type="text" name="options[total][]" value="<?php  echo $row['total'];?>" class="form-control" placeholder="库存">
									<span class="input-group-addon">库存预警</span>
									<input type="text" name="options[total_warning][]" value="<?php  echo $row['total_warning'];?>" class="form-control" placeholder="库存预警">
									<span class="input-group-addon">排序</span>
									<input type="text" name="options[displayorder][]" value="<?php  echo $row['displayorder'];?>" class="form-control" placeholder="排序">
									<span class="input-group-addon"><a href="javascript:;" class="delOptions"><i class="fa fa-times"></i></a></span>
								</div>
							<?php  } } ?>
						<?php  } else { ?>
							<div class="input-group">
								<span class="input-group-addon">规格名称</span>
								<input type="hidden" name="options[id][]" value="">
								<input type="text" name="options[name][]" class="form-control" placeholder="规格名称">
								<span class="input-group-addon">价格</span>
								<input type="text" name="options[price][]" class="form-control" placeholder="价格">
								<span class="input-group-addon">库存</span>
								<input type="text" name="options[total][]" class="form-control" placeholder="库存" value="-1">
								<span class="input-group-addon">库存预警</span>
								<input type="text" name="options[total_warning][]" class="form-control" placeholder="库存预警" value="0">
								<span class="input-group-addon">排序</span>
								<input type="text" name="options[displayorder][]" class="form-control" placeholder="排序" value="0">
								<span class="input-group-addon"><a href="javascript:;" class="delOptions"><i class="fa fa-times"></i></a></span>
							</div>
						<?php  } ?>
					</div>
					<a href="javascript:;" class="addOptions"><i class="fa fa-plus-circle"></i> 添加规格</a>
					<span class="help-block">-1为库存无限制. 排序数字越大越靠前</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">总库存</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="text" class="form-control" name="total" value="<?php  echo $item['total'];?>" required="true" number="true">
				<div class="help-block">-1为库存无限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">库存预警</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="text" class="form-control" name="total_warning" value="<?php  echo $item['total_warning'];?>" required="true" number="true">
				<div class="help-block">当库存小于等于库存预警数量的时候,会给店员发送微信模板消息提醒,0为无库存预警限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品属性</label>
			<div class="col-sm-9 col-xs-12">
				<div id="attrs-container">
					<?php  if(!empty($item['attrs'])) { ?>
						<?php  if(is_array($item['attrs'])) { foreach($item['attrs'] as $attr) { ?>
							<div class="attr-item">
								<div class="col-md-3">
									<input type="text" name="attrs[name][]" class="form-control" value="<?php  echo $attr['name'];?>" placeholder="列如:辣度">
								</div>
								<div class="col-md-8">
									<input type="text" name="attrs[label][]" class="form-control" value="<?php  echo $attr['label'];?>" placeholder="列如:微辣">
								</div>
								<div class="col-md-1">
									<span class="attrs-delete"><i class="fa fa-remove"></i></span>
								</div>
							</div>
						<?php  } } ?>
					<?php  } ?>
				</div>
				<a class="btn btn-primary btn-sm add-attr" href="javascript:;">添加商品属性</a>
				<span class="help-block">列如：属性名称可以设为辣度，属性标签可以设为微辣，中辣等。输入多个属性标签时用英文状态的逗号隔开。</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">餐盒价格</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="box_price" value="<?php  echo $item['box_price'];?>">
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">设置餐盒费</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品单位</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="unitname" value="<?php  echo $item['unitname'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">简单描述</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="content" value="<?php  echo $item['content'];?>">
				<div class="help-block">该信息显示在商品列表页面, 字数控制在30个以内</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义标签</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="text" class="form-control" name="label" value="<?php  echo $item['label'];?>">
				<div class="help-block">可设置为：热卖，新品，爆款等。只能设置一个，不超过两个字</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印标签</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<select name="print_label" class="form-control">
					<option value="0" <?php  if($item['print_label'] == 0) { ?>selected<?php  } ?>>选择打印标签</option>
					<?php  if(is_array($print_labels)) { foreach($print_labels as $label) { ?>
						<option value="<?php  echo $label['id'];?>" <?php  if($item['print_label'] == $label['id']) { ?>selected<?php  } ?>><?php  echo $label['title'];?></option>
					<?php  } } ?>
				</select>
				<div class="help-block">如果您的店铺有多台打印机， 打印标签可实现不同的打印机打印指定的商品。<a href="<?php  echo iurl('store/shop/printer/label_list');?>" target="_blank"><i class="fa fa-plus-circle"></i> 添加打印标签</a></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">库存更新方式</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="total_update_type" id="total-update-type-1" value="1" <?php  if(!$item['total_update_type'] || $item['total_update_type'] == 1) { ?>checked<?php  } ?>>
					<label for="total-update-type-1">拍下减库存</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="total_update_type" id="total-update-type-2" value="2" <?php  if($item['total_update_type'] == 2) { ?>checked<?php  } ?>>
					<label for="total-update-type-2">付款减库存</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio"  name="total_update_type" id="total-update-type-3" value="3" <?php  if($item['total_update_type'] == 3) { ?>checked<?php  } ?>>
					<label for="total-update-type-3">永不减库存</label>
				</div>
			</div>
		</div>
		<?php  if($store_config['custom_goods_sailed_status'] == 1) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">已卖出</label>
				<div class="col-sm-9 col-xs-9 col-md-9">
					<input type="text" class="form-control" name="sailed" value="<?php  echo $item['sailed'];?>">
					<div class="help-block">已卖出的份数默认会根据订单自动更新。您也可以手动设置</div>
				</div>
			</div>
		<?php  } ?>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否上架</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="status" id="status-1" value="1" <?php  if($item['status'] == 1 || !$item['status']) { ?>checked<?php  } ?>>
					<label for="status-1">上架</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="status" id="status-2" value="2" <?php  if($item['status'] == 2) { ?>checked<?php  } ?>>
					<label for="status-2">下架</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">设置为热销</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="is_hot" id="is-hot-1" value="1" <?php  if($item['is_hot'] == 1) { ?>checked<?php  } ?>>
					<label for="is-hot-1">设置</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="is_hot" id="is-hot-0" value="0" <?php  if(!$item['is_hot']) { ?>checked<?php  } ?>>
					<label for="is-hot-0">不设置</label>
				</div>
				<div class="help-block">设为热销后,将在门店信息列表页显示</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品详情</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo itpl_ueditor('description', $item['description']);?>
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
$(function() {
	$('#form1').submit(function(){
		var is_options = $(':checkbox[name="is_options"]').prop('checked');
		if(is_options) {
			var name_flag = price_flag = false;
			$.each($(':text[name="options[name][]"]'), function(){
				if(!$.trim($(this).val())) {
					name_flag = true;
				}
				if(!$.trim($(this).next().next().val())) {
					price_flag = true;
				}
			});
			if(name_flag) {
				Notify.info('存在没有设置名称的规格项');
				$('form').attr('stop',1);
				return false;
			}
			if(price_flag) {
				Notify.info('存在没有设置价格的规格项');
				$('form').attr('stop',1);
				return false;
			}
		}
		$('form').attr('stop',0);
		return false;
	});

	$('.addOptions').click(function(){
		var html = '<div class="input-group">'+
						'<span class="input-group-addon">规格名称</span>'+
						'<input type="hidden" name="options[id][]" value="">'+
						'<input type="text" name="options[name][]" class="form-control" placeholder="规格名称">'+
						'<span class="input-group-addon">价格</span>'+
						'<input type="text" name="options[price][]" class="form-control" placeholder="价格">'+
						'<span class="input-group-addon">库存</span>'+
						'<input type="text" name="options[total][]" class="form-control" value="-1" placeholder="库存">'+
						'<span class="input-group-addon">库存预警</span>'+
						'<input type="text" name="options[total_warning][]" class="form-control" value="0" placeholder="库存预警">'+
						'<span class="input-group-addon">排序</span>'+
						'<input type="text" name="options[displayorder][]" class="form-control" value="0" placeholder="排序">'+
						'<span class="input-group-addon"><a href="javascript:;" class="" onclick="$(this).parent().parent().remove();"><i class="fa fa-times"></i></a></span>'+
					'</div>';
		$('#options .tpl').append(html);
	});

	$('.delOptions').click(function(){
		$(this).parent().parent().remove();
	});

	$(document).on('click', '.add-attr', function() {
		var length = $('#attrs-container .attr-item').length;
		if(length >= 10) {
			Notify.info('最多可添加10个属性');
			return false;
		}
		var html = '<div class="attr-item">'+
				'		<div class="col-md-3">'+
				'			<input type="text" name="attrs[name][]" class="form-control" placeholder="列如:辣度">'+
				'		</div>'+
				'		<div class="col-md-8">'+
				'			<input type="text" name="attrs[label][]" class="form-control" placeholder="列如:微辣">'+
				'		</div>'+
				'		<div class="col-md-1">'+
				'			<span class="attrs-delete"><i class="fa fa-remove"></i></span>'+
				'		</div>'+
				'	</div>';
		$('#attrs-container').append(html);
	});
	$(document).on('click', '.attrs-delete', function() {
		$(this).parent().parent().remove();
	});
});
</script>
<?php  } else if($ta == 'list') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('store/goods/index');?>
	<input type="hidden" name="ta" value="list"/>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">筛选</label>
		<div class="col-sm-9 col-xs-12">
			<select name="cid" id="cid" class="form-control select2">
				<option value="">商品分类</option>
				<?php  if(is_array($category)) { foreach($category as $li) { ?>
					<option value="<?php  echo $li['id'];?>" <?php  if($li['id'] == $_GPC['cid']) { ?>selected<?php  } ?>><?php  echo $li['title'];?></option>
				<?php  } } ?>
			</select>
			<div class="input-group">
				<span class="input-group-addon">名称</span>
				<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="商品名称或编号">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a class="btn <?php  if($order_by_type == 'displayorder') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('store/goods/index/list', array('order_by_type' => 'displayorder'))?>">排序</a>
				<a class="btn <?php  if($order_by_type == 'sailed') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('store/goods/index/list', array('order_by_type' => 'sailed'))?>">销量</a>
				<a class="btn <?php  if($order_by_type == 'total') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('store/goods/index/list', array('order_by_type' => 'total'))?>">库存</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>

<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('store/goods/index/post');?>" class="btn btn-primary btn-sm">添加商品</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th width="30">
							<div class="checkbox checkbox-inline">
								<input type="checkbox">
								<label></label>
							</div>
						</th>
						<th>缩略图</th>
						<th>价格</th>
						<th>餐盒费</th>
						<th>库存</th>
						<th>排序</th>
						<th>商品名称</th>
						<th>所属分类</th>
						<th>已售出</th>
						<th>标签</th>
						<th>是否上架</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
					<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
					<tr>
						<td>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="id[]" value="<?php  echo $item['id'];?>">
								<label></label>
							</div>
						</td>
						<td><img src="<?php  echo tomedia($item['thumb']);?>" width="38" style="border-radius: 3px;"></td>
						<td>
							<input type="text" name="prices[]" class="form-control width-100" value="<?php  echo $item['price'];?>">
						</td>
						<td>
							<input type="text" name="box_prices[]" class="form-control width-100" value="<?php  echo $item['box_price'];?>">
						</td>
						<td>
							<input type="text" name="totals[]" class="form-control width-100" value="<?php  echo $item['total'];?>">
						</td>
						<td>
							<input type="text" name="displayorders[]" class="form-control width-100" value="<?php  echo $item['displayorder'];?>">
						</td>
						<td>
							<input type="text" name="titles[]" class="form-control width-100" value="<?php  echo $item['title'];?>">
						</td>
						<td><?php  echo $category[$item['cid']]['title'];?></td>
						<td><?php  echo $item['sailed'];?> 份</td>
						<td><?php  echo $item['label'];?></td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('store/goods/index/status', array('id' => $item['id']));?>" data-name="status" value="<?php  echo $item['status'];?>" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('store/goods/index/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"> </i></a>
							<a href="<?php  echo iurl('store/goods/index/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" title="删除" data-toggle="tooltip" data-placement="top" data-confirm="删除后将不可恢复，确定删除吗?"><i class="fa fa-times"> </i></a>
							<a href="<?php  echo iurl('store/goods/index/copy', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-post" data-confirm="确定复制吗?">复制</a>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<input type="submit" class="btn btn-primary btn-sm" value="提交修改">
					<a href="<?php  echo iurl('store/goods/index/del')?>" class="btn btn-danger btn-sm js-batch" data-batch="remove" data-confirm="确定删除选中的商品吗?">批量删除</a>
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>
</form>
<?php  } else if($ta == 'eleme_category') { ?>
<div class="page">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="从饿了么导入" class="btn btn-primary">
			</div>
		</div>
		<div class="alert alert-info">
			点击从饿了么导入按钮,即可开始导入
		</div>
	</form>
</div>
<?php  } else if($ta == 'export') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<a class="btn btn-default" href="<?php echo WE7_WMALL_URL;?>/resource/excel/goods.xlsx">下载导入模板</a>
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
<?php  } else if($ta == 'eleme') { ?>
<div class="page clearfix" ng-controller="processor">
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<h2>正在从饿了么导入</h2>
		<div class="progress">
			<div class="progress-bar progress-bar-danger" ng-style="style">
				{{pragress}}
			</div>
		</div>
		<span class="help-block">正在从饿了么导入，请勿关闭浏览器</span>
	</form>
</div>
<script>
	require(['angular'], function(angular) {
		var running = true;
		window.onbeforeunload = function(e) {
			if(running) {
				return (e || window.event).returnValue = '正在导入中,确定离开页面吗?';
			}
		}
		angular.module('app', []).controller('processor', function($scope, $http) {
			$scope.categorys = <?php  echo json_encode($category)?>; // 获取分类数组
			$scope.fails = [];
			var total = $scope.categorys.length;  //统计分类个数
			var i = 1;
			running = true;
			var proc = function() {
				var category = $scope.categorys.pop();
				if(!category) {
					running = false;
					Notify.success('商品导入成功', "<?php  echo iurl('store/goods/index/list')?>");
					return;
				}
				$scope.category = category;
				$scope.pragress = (i / total).toFixed(2) * 100 + "%";
				$scope.style = {'width': (i / total).toFixed(2) * 100 + "%"};
				var params = {category: category};
				$http.post(location.href, params).success(function(data) {
					i++;
					if(data.message.errno != 0) {
						$scope.fails.push(category);
						Notify.error(data.message.message);
						return;
					}
					proc();
				}).error(function() {
					i++;
					$scope.fails.push(category);
					proc();
				});
			}
			proc();
		});
		angular.bootstrap(document, ['app']);
	});
</script>
<?php  } else if($ta == 'meituan_category') { ?>
<div class="page">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="从美团导入" class="btn btn-primary">
			</div>
		</div>
		<div class="alert alert-info">
			点击从美团导入按钮,即可开始导入
		</div>
	</form>
</div>
<?php  } else if($ta == 'meituan') { ?>
<div class="page clearfix" ng-controller="processor">
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<h2>正在从美团导入</h2>
		<div class="progress">
			<div class="progress-bar progress-bar-danger" ng-style="style">
				{{pragress}}
			</div>
		</div>
		<span class="help-block">正在从美团导入，请勿关闭浏览器</span>
	</form>
</div>
<script>
	require(['angular'], function(angular) {
		var running = true;
		window.onbeforeunload = function(e) {
			if(running) {
				return (e || window.event).returnValue = '正在导入中,确定离开页面吗?';
			}
		}
		angular.module('app', []).controller('processor', function($scope, $http) {
			$scope.goods = <?php  echo json_encode($goods)?>; // 获取分类数组
			$scope.fails = [];
			var total = $scope.goods.length;  //统计分类个数
			var i = 1;
			running = true;
			var proc = function() {
				var good = $scope.goods.pop();
				if(!good) {
					running = false;
					Notify.success('商品导入成功', "<?php  echo iurl('store/goods/index/list')?>");
					return;
				}
				$scope.good = good;
				$scope.pragress = (i / total).toFixed(2) * 100 + "%";
				$scope.style = {'width': (i / total).toFixed(2) * 100 + "%"};
				var params = {good: good};
				$http.post(location.href, params).success(function(data) {
					i++;
					if(data.message.errno != 0) {
						$scope.fails.push(good);
						Notify.error(data.message.message);
						return;
					}
					proc();
				}).error(function() {
					i++;
					$scope.fails.push(good);
					proc();
				});
			}
			proc();
		});
		angular.bootstrap(document, ['app']);
	});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>