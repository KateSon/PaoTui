<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php?" method="get" class="form-horizontal form-filter" role="form">
	<input type="hidden" name="c" value="site">
	<input type="hidden" name="m" value="we7_wmall">
	<input type="hidden" name="a" value="entry">
	<input type="hidden" name="ctrl" value="merchant">
	<input type="hidden" name="ac" value="news">
	<input type="hidden" name="op" value="list">
	<input type="hidden" name="do" value="web">
	<input type="hidden" name="cateid" value="">
	<input type="hidden" name="createtime" value="">
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">资讯分类</label>
		<div class="col-sm-8 col-lg-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo iurl('merchant/news/list', array('cateid' => 0))?>" class="btn <?php  if($_GPC['cateid'] == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<a href="<?php  echo iurl('merchant/news/list', array('cateid' => $category['id']))?>" class="btn <?php  if($_GPC['cateid'] == $category['id']) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>"><?php  echo $category['title'];?></a>
				<?php  } } ?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">添加时间</label>
		<div class="col-sm-8 col-lg-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo iurl('merchant/news/list', array('createtime' => 0))?>" class="btn <?php  if($_GPC['createtime'] == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo iurl('merchant/news/list', array('createtime' => 3))?>" class="btn <?php  if($_GPC['createtime'] == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三天内</a>
				<a href="<?php  echo iurl('merchant/news/list', array('createtime' => 7))?>" class="btn <?php  if($_GPC['createtime'] == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一周内</a>
				<a href="<?php  echo iurl('merchant/news/list', array('createtime' => 30))?>" class="btn <?php  if($_GPC['createtime'] == 30) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一月内</a>
				<a href="<?php  echo iurl('merchant/news/list', array('createtime' => 90))?>" class="btn <?php  if($_GPC['createtime'] == 90) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三月内</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
		<div class="col-sm-8 col-lg-3 col-xs-12">
			<input class="form-control" name="title" id="" type="text" value="">
		</div>
		<div class="pull-left col-xs-12 col-sm-2 col-lg-2">
			<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
		</div>
	</div>
</form>
<form class="form-table form form-validate" action="" method="post">
	<div class="panel panel-table">
		<div class="panel-heading clearfix">
			<a href="<?php  echo iurl('merchant/news/post');?>" class="btn btn-primary btn-sm">添加资讯</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th width="80">排序</th>
					<th width="100">阅读次数</th>
					<th width="300">标题</th>
					<th>所属分类</th>
					<th>是否显示</th>
					<th>是否在首页显示</th>
					<th>添加时间</th>
					<th class="text-right">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
					<input type="hidden" name="ids[]" value="<?php  echo $item['aid'];?>">
					<tr>
						<td>
							<input type="text" class="form-control" name="displayorder[]" value="<?php  echo $item['adisplayorder'];?>" digits="true">
						</td>
						<td>
							<input type="text" class="form-control" name="click[]" value="<?php  echo $item['click'];?>" digits="true">
						</td>
						<td>
							<input type="text" class="form-control" name="title[]" value="<?php  echo $item['atitle'];?>" required="true">
						</td>
						<td><?php  echo $item['btitle'];?></td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('merchant/news/is_display', array('id' => $item['aid']));?>" data-name="is_display" value="1" <?php  if($item['is_display'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('merchant/news/is_show_home', array('id' => $item['aid']));?>" data-name="is_show_home" value="1" <?php  if($item['is_show_home'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td><?php  echo date('Y-m-d H:i',$item['addtime'])?></td>
						<td class="text-right">
							<a href="<?php  echo iurl('merchant/news/post', array('id' => $item['aid']))?>" class="btn btn-default btn-sm">编辑</a>
							<a href="<?php  echo iurl('merchant/news/del', array('id' => $item['aid']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除资讯吗?">删除</a>
						</td>
					</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<?php  if(!empty($lists)) { ?>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交" />
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
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">资讯标题</label>
			<div class="col-sm-8 col-lg-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" placeholder="资讯标题" required="true">
				<div class="help-block">请填写资讯标题</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">资讯分类</label>
			<div class="col-sm-8 col-lg-9 col-xs-12">
				<select name="cateid" class="form-control">
					<option value="0">==请选择资讯分类==</option>
					<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
						<option value="<?php  echo $category['id'];?>" <?php  if($category['id'] == $item['cateid']) { ?>selected<?php  } ?>><?php  echo $category['title'];?></option>
					<?php  } } ?>
				</select>
				<div class="help-block">还没有分类，点我 <a href="<?php  echo iurl('merchant/newsCategory/post')?>"><i class="fa fa-plus-circle"></i> 添加分类</a></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">缩略图</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-8">
				<div class="help-block">
					<div class="checkbox checkbox-inline">
						<input type="checkbox" name="autolitpic" value="1" checked="true">
						<label>提取内容的第一个图片为缩略图</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">资讯描述</label>
			<div class="col-sm-9 col-xs-12">
				<textarea name="desc" rows="5" class="form-control"><?php  echo $item['desc'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">资讯内容</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('content', $item['content']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">资讯作者</label>
			<div class="col-sm-8 col-lg-9 col-xs-12">
				<input type="text" class="form-control" name="author" value="<?php  echo $item['author'];?>" placeholder="资讯作者">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">阅读次数</label>
			<div class="col-sm-8 col-lg-9 col-xs-12">
				<input type="text" class="form-control" name="click" value="<?php  echo $item['click'];?>" placeholder="阅读次数" digits="true">
				<div class="help-block">默认为0。您可以设置一个初始值,阅读次数会在该初始值上增加。</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-8 col-lg-9 col-xs-12">
				<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>" placeholder="排序" digits="true">
				<div class="help-block">数字越大，越靠前。</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示</label>
			<div class="col-sm-8 col-lg-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="is_display" value="1" id="is-display-1" <?php  if($item['is_display'] == 1 || !$item['is_display']) { ?>checked<?php  } ?>>
					<label for="is-display-1">显示</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="is_display" value="0" id="is-display-0" <?php  if($item['is_display'] == 0) { ?>checked<?php  } ?>>
					<label for="is-display-0">不显示</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否在商户首页显示</label>
			<div class="col-sm-8 col-lg-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="is_show_home" value="1" id="is-show-home-1" <?php  if($item['is_show_home'] == 1 || !$item['is_show_home']) { ?>checked<?php  } ?>>
					<label for="is-show-home-1">显示</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="is_show_home" value="0" id="is-show-home-0" <?php  if($item['is_show_home'] == 0) { ?>checked<?php  } ?>>
					<label for="is-show-home-0">不显示</label>
				</div>
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
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>