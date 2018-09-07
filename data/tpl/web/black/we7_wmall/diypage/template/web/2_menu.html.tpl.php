<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('common', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('diypage/menu/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="请输入页面标题或关键字进行搜索">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('diypage/menu/post');?>" class="btn btn-primary btn-sm">新建菜单</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($menus)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
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
						<th>菜单名称</th>
						<th>创建时间</th>
						<th>最后修改时间</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
						<?php  if(is_array($menus)) { foreach($menus as $menu) { ?>
							<tr>
								<td>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="ids[]" value="<?php  echo $menu['id'];?>"/>
										<label></label>
									</div>
								</td>
								<td><?php  echo $menu['name'];?></td>
								<td><?php  echo date('Y-m-d H:i:s', $menu['addtime'])?></td>
								<td><?php  echo date('Y-m-d H:i:s', $menu['updatetime'])?></td>
								<td style="text-align:right;">
									<a href="<?php  echo iurl('diypage/menu/post', array('id' => $menu['id']))?>" class="btn btn-default btn-sm">编辑</a>
									<a href="<?php  echo iurl('diypage/menu/del', array('id' => $menu['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('diypage/menu/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
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

<?php  if($op == 'post') { ?>
<div class="clearfix">
	<div class="app-preview">
		<div class="app-header"></div>
		<div class="app-body">
			<div class="title">自定义菜单</div>
			<div class="main" id="app-preview">
			</div>
		</div>
		<div class="app-footer"></div>
	</div>
	<div class="app-editor form-horizontal" id="app-editor">
		<div class="editor-arrow"></div>
		<div class="inner">
		</div>
	</div>
</div>
<div class="app-action">
	<div class="action">
		<nav class="btn btn-default btn-sm pull-left" id="gotop">返回顶部</nav>
		<nav class="btn btn-primary btn-sm btn-save">保存菜单</nav>
	</div>
</div>
<script type="text/html" id="tpl-show-menu">
	<style type="text/css">
		.app-menu .tab-item span.icon {color: <(css.iconColor)>}
		.app-menu .tab-item span.tab-label {color: <(css.textColor)>}
	</style>
	<div class="app-menu">
		<(each data as item)>
			<(if params.navstyle == 0)>
				<a class="tab-item" href="javascript:;">
					<span class="icon <(item.icon)>"></span>
					<span class="tab-label"><(item.text)></span>
				</a>
			<(/if)>
			<(if params.navstyle == 1)>
				<a class="tab-item image" href="javascript:;">
					<img src="<(tomedia item.img)>" alt="">
				</a>
			<(/if)>
		<(/each)>
	</div>
</script>

<script type="text/html" id="tpl-edit-menu">
	<div class="form-group">
		<div class="col-sm-2 control-label">菜单名称</div>
		<div class="col-sm-10">
			<input class="form-control input-sm diy-bind" data-bind="name" data-placeholder="未命名自定义菜单" placeholder="请输入名称" value="<(name)>">
			<div class="help-block">注意：菜单名称是便于后台查找。</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">图标样式</div>
		<div class="col-sm-10">
			<div class="radio radio-inline">
				<input type="radio" value="0" name="navstyle" class="diy-bind" data-bind-child="params" data-bind="navstyle" data-bind-init="true" id="navstyle-0" <(if params.navstyle == 0)>checked<(/if)>>
				<label for="navstyle-0">图标+文字</label>
			</div>
			<div class="radio radio-inline">
				<input type="radio" value="1" name="navstyle" class="diy-bind" data-bind-child="params" data-bind="navstyle" data-bind-init="true" id="navstyle-1" <(if params.navstyle == 1)>checked<(/if)>>
				<label for="navstyle-1">图片</label>
			</div>
		</div>
	</div>
	<(if params.navstyle == 0 )>
		<div class="form-group">
			<div class="col-sm-2 control-label">图标颜色</div>
			<div class="col-sm-10 color">
				<div class="input-group">
					<span class="input-group-addon">默认</span>
					<input class="form-control input-sm diy-bind color" type="color" data-bind-child="css" data-bind="iconColor" value="<(css.iconColor)>" />
					<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#163636').trigger('propertychange')">清除</span>
					<span class="input-group-addon">选中</span>
					<input class="form-control input-sm diy-bind color" type="color" data-bind-child="css" data-bind="iconColorActive" value="<(css.iconColorActive)>" />
					<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff2d4b').trigger('propertychange')">清除</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">文字颜色</div>
			<div class="col-sm-10 color">
				<div class="input-group">
					<span class="input-group-addon">默认</span>
					<input class="form-control input-sm diy-bind color" type="color" data-bind-child="css" data-bind="textColor" value="<(css.textColor)>" />
					<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#929292').trigger('propertychange')">清除</span>
					<span class="input-group-addon">选中</span>
					<input class="form-control input-sm diy-bind color" type="color" data-bind-child="css" data-bind="textColorActive" value="<(css.textColorActive)>" />
					<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff2d4b').trigger('propertychange')">清除</span>
				</div>
			</div>
		</div>
	<(/if)>
	<div class="line"></div>
	<div class="form-items" data-min="1" data-max="5">
		<div class="inner">
			<(each data as item index)>
				<(if params.navstyle == 0 )>
					<div class="item" data-id="<(index)>">
						<span class="btn-del del-item" title="删除"></span>
						<div class="item-body">
							<div class="item-image">
								<span class="btn-del" title="清空图标" onclick='$("#cicon-<(index)>").val("").trigger("change")'></span>
								<div class="icon-main">
									<(if item.icon)>
										<span class="icon <(item.icon)>" id="cicon-<(index)>"></span>
									<(else)>
										<p>无图标</p>
									<(/if)>
								</div>
								<input type="hidden" class="diy-bind" value="<(item.icon)>"  id="picon-<(index)>" data-bind="icon" data-bind-child="data" data-bind-parent="<(index)>" data-bind-init="true"/>
								<div class="select-icon js-selectIcon" data-input="#picon-<(index)>" data-element="cicon-<(index)>">选择图标</div>
							</div>
							<div class="item-form">
								<div class="input-group">
									<span class="input-group-addon">文字</span>
									<input type="text" class="form-control input-sm diy-bind" value="<(item.text)>" placeholder="留空则不显示文字" data-bind-parent="<(index)>" data-bind-child="data" data-bind="text">
								</div>
								<div class="input-group">
									<input type="text" class="form-control input-sm diy-bind" value="<(item.link)>" placeholder="请选择链接或输入链接地址" id="plink-<(index)>" data-bind-parent="<(index)>" data-bind-child="data" data-bind="link">
									<span class="input-group-addon btn btn-default js-selectLink" data-input="#plink-<(index)>">选择链接</span>
								</div>
							</div>
						</div>
					</div>
				<(/if)>
				<(if params.navstyle == 1)>
					<div class="item" data-id="<(index)>">
						<span class="btn-del del-item" title="删除"></span>
						<div class="item-body">
							<div class="item-image">
								<img src="<(tomedia item.img)>" id="cimg-<(index)>">
							</div>
							<div class="item-form">
								<div class="input-group">
									<input type="text" class="form-control input-sm diy-bind" placeholder="请选择图片或输入图片地址" value="<(item.img)>" data-bind-parent="<(index)>" data-bind-child="data" data-bind="img" id="pimg-<(index)>">
									<span class="input-group-addon btn btn-default js-selectImg" data-input="#pimg-<(index)>" data-element="#cimg-<(index)>">选择图片</span>
								</div>
								<div class="input-group">
									<input type="text" class="form-control input-sm diy-bind" value="<(item.link)>" placeholder="请选择链接或输入链接地址" id="plink-<(index)>" data-bind-parent="<(index)>" data-bind-child="data" data-bind="link">
									<span class="input-group-addon btn btn-default js-selectLink" data-input="#plink-<(index)>">选择链接</span>
								</div>
							</div>
						</div>
					</div>
				<(/if)>
			<(/each)>
		</div>
		<div class="btn btn-default btn-block" id="addItem"><i class="icon icon-plus"></i> 添加一个</div>
	</div>
</script>

<script language="javascript">
	var path = '../../plugin/diypage/static/js/diy.menu';
	irequire([path, 'tmodtpl'],function(diyMenu, tmodtpl){
		diyMenu.init({
			tmodtpl: tmodtpl,
			attachurl: "<?php  echo $_W['attachurl'];?>",
			id: '<?php  echo intval($_GPC["id"])?>',
			menu: <?php  if(!empty($menu['data'])) { ?><?php  echo json_encode($menu['data'])?><?php  } else { ?>null<?php  } ?>
		});
	});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>