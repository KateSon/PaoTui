<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('common', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('diypage/diy/list');?>
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
			<a href="<?php  echo iurl('diypage/diy/post');?>" class="btn btn-primary btn-sm">新建自定义页面</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($pages)) { ?>
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
						<th>页面名称</th>
						<th>创建时间</th>
						<th>最后修改时间</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($pages)) { foreach($pages as $page) { ?>
					<tr>
						<td>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="ids[]" value="<?php  echo $page['id'];?>"/>
								<label></label>
							</div>
						</td>
						<td><?php  echo $page['name'];?></td>
						<td><?php  echo date('Y-m-d H:i:s', $page['addtime'])?></td>
						<td><?php  echo date('Y-m-d H:i:s', $page['updatetime'])?></td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('diypage/diy/post', array('id' => $page['id']))?>" class="btn btn-default btn-sm">编辑</a>
							<a href="<?php  echo iurl('diypage/diy/del', array('id' => $page['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
							<a href="javascript:;" class="btn btn-default btn-sm js-clip" data-href="<?php  echo imurl('diypage/diy/index', array('id' => $page['id']), true)?>"><i class="fa fa-link"></i></a>
						</td>
					</tr>
					<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('diypage/diy/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
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
			<div class="title" id="page">新建自定义页面</div>
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
	<div class="parts" id="parts"></div>
	<div class="action">
		<nav class="btn btn-default btn-sm pull-left" id="gotop">返回顶部</nav>
		<nav class="btn btn-primary btn-sm btn-save">保存并设置</nav>
	</div>
</div>
<?php  include itemplate('tplShow', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('tplEditor', TEMPLATE_INCLUDEPATH);?>
<script type="text/javascript" src="./resource/components/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="./resource/components/ueditor/lang/zh-cn/zh-cn.js"></script>
<script language="javascript">
	var path = '../../plugin/diypage/static/js/diy';
	irequire([path, 'tmodtpl'],function(diy, tmodtpl){
		diy.init({
			tmodtpl: tmodtpl,
			attachurl: "<?php  echo $_W['attachurl'];?>",
			id: '<?php  echo intval($_GPC["id"])?>',
			type: 0,
			data: <?php  if(!empty($page['data'])) { ?><?php  echo json_encode($page['data'])?><?php  } else { ?>null<?php  } ?>,
			diymenu: <?php  echo json_encode($diymenus)?>,
			mallset: {}
		});
	});

	function callbackGoods(data) {
		irequire([path],function(diy) {
			diy.callbackGoods(data);
		});
	}

	function callbackStore(data) {
		irequire([path],function(diy) {
			console.dir(data)
			diy.callbackStore(data);
		});
	}
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>