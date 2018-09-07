<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'list') { ?>
<div class="page" id="page-manage-goods">
	<header class="bar bar-nav common-buttons-nav">
		<div class="row">
			<div class="col-10 align-left">
				<a class="back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			</div>
			<div class="col-80">
				<div class="buttons-row align-center">
					<a href="<?php  echo imurl('manage/goods/index/list');?>" class="active button">商品列表</a>
					<a href="<?php  echo imurl('manage/goods/category/list');?>" class="button">商品分组</a>
				</div>
			</div>
			<div class="col-10 align-right">
				<a class="pull-right" href="<?php  echo imurl('manage/goods/index/post');?>"><i class="icon icon-plus"></i></a>
			</div>
		</div>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="buttons-tab">
			<a href="<?php  echo imurl('manage/goods/index/list', array('status' => -1));?>" class="button <?php  if($status == -1 && empty($cid)) { ?>active<?php  } ?>">所有商品</a>
			<a href="<?php  echo imurl('manage/goods/index/list', array('status' => 1));?>" class="button <?php  if($status == 1) { ?>active<?php  } ?>">上架中</a>
			<a href="<?php  echo imurl('manage/goods/index/list', array('status' => 0));?>" class="button <?php  if($status == 0) { ?>active<?php  } ?>">已下架</a>
			<a href="javascript:;" class="button <?php  if($cid > 0) { ?>active<?php  } ?> open-popover" data-popover=".popover-goods-cagegory"><?php  echo $cid_cn;?> <i class="icon icon-arrow-down"></i></a>
		</div>
		<?php  if(empty($goods)) { ?>
			<div class="no-data">
				<div class="bg"></div>
				<p>没有任何商品哦～</p>
			</div>
		<?php  } else { ?>
		<div class="goods-list">
			<ul>
				<?php  if(is_array($goods)) { foreach($goods as $good) { ?>
				<li class="border-1px-tb">
					<a href="<?php  echo imurl('manage/goods/index/post', array('id' => $good['id']));?>">
						<div class="goods-list-pic"><img src="<?php  echo tomedia($good['thumb']);?>" alt="" width="100%" height="100%"></div>
						<div class="goods-list-info">
							<div class="goods-title"><?php  echo $good['title'];?></div>
							<div class="goods-money">¥<?php  echo $good['price'];?>/<?php  echo $good['unitname'];?></div>
							<p class="goods-p"></p>
							<div class="goods-sum">
								<span>库存：<?php  if($good['total'] == -1) { ?>不限库存<?php  } else { ?><?php  echo $good['total'];?><?php  } ?></span>
								<span>销量：<?php  echo $good['sailed'];?></span>
							</div>
						</div>
					</a>
					<div class="goods-btn border-1px-t">
						<a href="<?php  echo imurl('manage/goods/index/del', array('id' => $good['id']))?>" data-confirm="确定删除该商品吗?"  class="border-1px-r js-post">删除</a>
						<a href="<?php  echo imurl('manage/goods/index/turncate', array('id' => $good['id']))?>" data-confirm="确定清空库存吗?" class="border-1px-r js-post">清零</a>
						<?php  if($good['status'] == 1) { ?>
							<a href="<?php  echo imurl('manage/goods/index/status', array('id' => $good['id'], 'value' => 0))?>" data-confirm="确定下架吗?" class="js-post">下架</a>
						<?php  } else { ?>
							<a href="<?php  echo imurl('manage/goods/index/status', array('id' => $good['id'], 'value' => 1))?>" data-confirm="确定上架吗?" class="js-post">上架</a>
						<?php  } ?>
					</div>
				</li>
				<?php  } } ?>
			</ul>
		</div>
		<?php  } ?>
	</div>
</div>

<div class="popover popover-manage popover-goods-cagegory">
	<div class="popover-angle"></div>
	<div class="popover-inner" style="max-height: 400px">
		<div class="list-block">
			<ul>
				<li><a href="<?php  echo imurl('manage/goods/index/list', array('cid' => 0));?>" class="list-button item-link border-1px-b">不限</a></li>
				<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<li><a href="<?php  echo imurl('manage/goods/index/list', array('cid' => $category['id']));?>" class="list-button item-link border-1px-b"><?php  echo $category['title'];?></a></li>
				<?php  } } ?>
			</ul>
		</div>
	</div>
</div>
<?php  } ?>

<?php  if($ta == 'post') { ?>
<div class="page goods-add" id="page-goods-post">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">编辑商品</h1>
		<a href="javascript:;" onclick="location.reload();" class="pull-right">刷新</a>
	</header>
	<div class="btn-submit">
		<a href="javascript:;" class="button button-big button-fill button-danger">上架出售</a>
	</div>
	<div class="content">
		<div class="list-block">
			<ul class="border-1px-tb">
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">名称</div>
							<div class="item-input">
								<input type="text" name="title" value="<?php  echo $goods['title'];?>" placeholder="请输入商品名称">
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="content-block-title">商品封面图片</div>
		<?php  echo tpl_image('thumb', $goods['thumb'])?>
		<div class="list-block">
			<ul class="border-1px-tb">
				<li class="item-content item-link">
					<div class="item-inner">
						<div class="item-title">商品类型</div>
						<div class="item-after">
							<?php  echo tpl_select('商品类型', 'cid', $goods['cid'], $categorys);?>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="list-block">
			<ul class="border-1px-tb">
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">价格</div>
							<div class="item-input">
								<input type="text" name="price" value="<?php  echo $goods['price'];?>" placeholder="给商品定个好价格">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">餐盒费</div>
							<div class="item-input">
								<input type="text" name="box_price" value="<?php  echo $goods['box_price'];?>" placeholder="设置餐盒费(元)">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">单位</div>
							<div class="item-input">
								<input type="text" name="unitname" value="<?php  echo $goods['unitname'];?>" placeholder="份/盘/斤">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">标签</div>
							<div class="item-input">
								<input type="text" name="label" value="<?php  echo $goods['label'];?>" placeholder="热卖,新品,爆款等,不超过两个字">
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div id="goods-options-containter">
			<?php  if(!empty($goods['options'])) { ?>
				<?php  if(is_array($goods['options'])) { foreach($goods['options'] as $row) { ?>
					<div class="list-block goods-options-item">
						<ul class="border-1px-tb">
							<li>
								<div class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title label">规格名称</div>
										<div class="item-input">
											<input type="hidden" name="options[id][]" value="<?php  echo $row['id'];?>">
											<input type="text" name="options[title][]" value="<?php  echo $row['name'];?>" placeholder="请输入商品规格">
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title label">价格</div>
										<div class="item-input">
											<input type="text" name="options[price][]" value="<?php  echo $row['price'];?>" placeholder="给商品定个好价格">
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title label">库存</div>
										<div class="item-input">
											<input type="text" name="options[total][]" value="<?php  echo $row['total'];?>" placeholder="设置合理库存避免超卖,-1为不限">
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="item-content">
									<div class="item-inner">
										<div class="item-title label">排序</div>
										<div class="item-input">
											<input type="text" name="options[displayorder][]" value="<?php  echo $row['displayorder'];?>" placeholder="数字越大越靠前">
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div class="btn-delete"><span></span></div>
					</div>
				<?php  } } ?>
			<?php  } ?>
		</div>
		<div class="content-block-title goods-options-add color-danger"><i class="icon icon-plus-circle fa-2x"></i> 添加商品规格</div>
		<div class="list-block">
			<ul class="border-1px-tb">
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">上架</div>
							<div class="item-input align-right">
								<label class="label-switch switch-sm">
									<input type="checkbox" name="status" value="1" <?php  if($goods['status'] == 1) { ?>checked<?php  } ?>>
									<div class="checkbox"></div>
								</label>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">热销</div>
							<div class="item-input align-right">
								<label class="label-switch switch-sm">
									<input type="checkbox" name="is_hot" <?php  if($goods['is_hot'] == 1) { ?>checked<?php  } ?>>
									<div class="checkbox"></div>
								</label>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="list-block">
			<ul class="border-1px-tb">
				<li class="align-top">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">描述</div>
							<div class="item-input">
								<textarea name="description"><?php  echo $goods['description'];?></textarea>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="list-block">
			<ul class="border-1px-tb">
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title label">总库存</div>
							<div class="item-input">
								<input type="text" name="total" value="<?php  echo $goods['total'];?>" placeholder="-1为库存无限制">
							</div>
						</div>
					</div>
				</li>
				<?php  if($store_config['custom_goods_sailed_status'] == 1) { ?>
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">已卖出</div>
								<div class="item-input">
									<input type="text" name="sailed" value="<?php  echo $goods['sailed'];?>" placeholder="已卖出份数">
								</div>
							</div>
						</div>
					</li>
				<?php  } ?>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">排序</div>
							<div class="item-input">
								<input type="text" name="displayorder" value="<?php  echo $goods['displayorder'];?>" placeholder=数字越大越靠前>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<script>
$(function(){
	$(document).on('click', '.goods-options-item .btn-delete', function(){
		var $parent = $(this).parent();
		$.confirm('确定删除该规格吗?', function(){
			$parent.remove();
			return false;
		});
	});

	$(document).on('click', '.goods-options-add', function(){
		var size = $('#goods-options-containter .goods-options-item').size();
		if(size >= 5) {
			$.toast('最多只能添加5个规格');
			return false;
		}
		var html = '<div class="list-block goods-options-item">'+
				'	<ul class="border-1px-tb">'+
				'		<li>'+
				'			<div class="item-content">'+
				'				<div class="item-inner border-1px-b">'+
				'					<div class="item-title label">规格名称</div>'+
				'					<div class="item-input">'+
				'						<input type="hidden" name="options[id][]" value="0">'+
				'						<input type="text" name="options[title][]" value="" placeholder="请输入商品规格">'+
				'					</div>'+
				'				</div>'+
				'			</div>'+
				'		</li>'+
				'		<li>'+
				'			<div class="item-content">'+
				'				<div class="item-inner border-1px-b">'+
				'					<div class="item-title label">价格</div>'+
				'					<div class="item-input">'+
				'						<input type="text" name="options[price][]" value=""" placeholder="给商品定个好价格">'+
				'					</div>'+
				'				</div>'+
				'			</div>'+
				'		</li>'+
				'		<li>'+
				'			<div class="item-content">'+
				'				<div class="item-inner border-1px-b">'+
				'					<div class="item-title label">库存</div>'+
				'					<div class="item-input">'+
				'						<input type="text" name="options[total][]" value="-1" placeholder="设置合理库存避免超卖,-1为不限">'+
				'					</div>'+
				'				</div>'+
				'			</div>'+
				'		</li>'+
				'		<li>'+
				'			<div class="item-content">'+
				'				<div class="item-inner">'+
				'					<div class="item-title label">排序</div>'+
				'					<div class="item-input">'+
				'						<input type="text" name="options[displayorder][]" value="0" placeholder="数字越大越靠前">'+
				'					</div>'+
				'				</div>'+
				'			</div>'+
				'		</li>'+
				'	</ul>'+
				'	<div class="btn-delete"><span></span></div>'+
				'</div>';
		$('#goods-options-containter').append(html);
	});

	$(document).on('click', '.goods-add .button-danger', function(){
		var $button = $(this);
		if($button.hasClass('disabled')) {
			return false;
		}
		var title = $.trim($(':text[name="title"]').val());
		if(!title) {
			$.toast('商品名称不能为空');
			return false;
		}
		var thumb = $.trim($(':hidden[name="thumb"]').val());
/*
		if(!thumb) {
			$.toast('商品图片不能为空');
			return false;
		}
*/
		var cid = $.trim($(':hidden[name="cid"]').val());
		if(!cid) {
			$.toast('请选择商品所属分类');
			return false;
		}
		var price = $.trim($(':text[name="price"]').val());
		if(!price) {
			$.toast('商品价格不能为空');
			return false;
		}
		var cid = $.trim($(':hidden[name="cid"]').val());
		if(!cid) {
			$.toast('请选择商品所属分类');
			return false;
		}
		var options = [];
		$('#goods-options-containter .goods-options-item').each(function(){
			var title = $.trim($(this).find(':text[name="options[title][]"]').val());
			var price = $.trim($(this).find(':text[name="options[price][]"]').val());
			if(title && price) {
				options.push({
					id: $(this).find(':hidden[name="options[id][]"]').val(),
					title: title,
					price: price,
					total: $(this).find(':text[name="options[total][]"]').val(),
					displayorder: $(this).find(':text[name="options[displayorder][]"]').val()
				});
			}
		});
		var params = {
			id: "<?php  echo $goods['id'];?>",
			title: title,
			thumb: thumb,
			price: price,
			box_price: $(':text[name="box_price"]').val(),
			cid: cid,
			label: $(':text[name="label"]').val(),
			unitname: $(':text[name="unitname"]').val(),
			total: $(':text[name="total"]').val(),
			displayorder: $(':text[name="displayorder"]').val(),
			sailed: $(':text[name="sailed"]').val(),
			description: $('textarea[name="description"]').val(),
			status: $(':checkbox[name="status"]').prop('checked') ? 1 : 0,
			is_hot: $(':checkbox[name="is_hot"]').prop('checked') ? 1 : 0,
			options: options
		};
		$button.addClass('disabled');
		$.post("<?php  echo imurl('manage/goods/index/post');?>", params, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$button.removeClass('disabled');
				$.toast(result.message.message);
				return false;
			}
			$.toast('编辑商品成功', "<?php  echo imurl('manage/goods/index/list');?>");
		});
	});
});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>