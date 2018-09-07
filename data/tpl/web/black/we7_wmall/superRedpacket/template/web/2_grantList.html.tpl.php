<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('superRedpacket/grant/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="请输入超级红包标题或关键字进行搜索">
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
			<a href="<?php  echo iurl('superRedpacket/grant/post');?>" class="btn btn-primary btn-sm">新建超级红包</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($superRedpackets)) { ?>
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
						<th>红包名称</th>
						<th>总共发送人数</th>
						<th>发放成功人数</th>
						<th>未发放人数</th>
						<th>创建时间</th>
						<th style="width:300px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
						<?php  if(is_array($superRedpackets)) { foreach($superRedpackets as $superRedpacket) { ?>
							<tr>
								<td>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="ids[]" value="<?php  echo $superRedpacket['id'];?>"/>
										<label></label>
									</div>
								</td>
								<td><?php  echo $superRedpacket['name'];?></td>
								<td><?php  echo $superRedpacket['grant_object']['total'];?></td>
								<td><?php  echo $superRedpacket['grant_object']['grant_success'];?></td>
								<td><?php  echo count($superRedpacket['grant_object']['unissued_uid'])?></td>
								<td><?php  echo date('Y-m-d H:i:s', $superRedpacket['addtime'])?></td>
								<td style="text-align:right;">
									<?php  if(!empty($superRedpacket['grant_object']['unissued_uid'])) { ?>
										<a href="<?php  echo iurl('superRedpacket/grant/send', array('id' => $superRedpacket['id']))?>" class="btn btn-default btn-sm">继续发送</a>
									<?php  } ?>
									<a href="<?php  echo iurl('superRedpacket/grant/post', array('id' => $superRedpacket['id']))?>" class="btn btn-default btn-sm">查看</a>
									<a href="<?php  echo iurl('superRedpacket/grant/del', array('id' => $superRedpacket['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('superRedpacket/grant/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="删除后将不可恢复，确定删除吗">删除</a>
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
