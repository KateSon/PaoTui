<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'list') { ?>
<div class="panel panel-table">
	<form action="" class="form-inline">
		<div class="panel-heading">
			<a href="<?php  echo iurl('store/tangshi/table/list', array('t' => 'status'));?>" class="btn btn-sm btn-primary"><i class="fa fa-circle-o"></i> 桌台状态</a>
			<a href="<?php  echo iurl('store/tangshi/table/list', array('t' => 'qrcode'));?>" class="btn btn-sm btn-primary"><i class="fa fa-qrcode"></i> 桌台二维码</a>
			<a href="<?php  echo iurl('store/tangshi/table/list', array('t' => 'list'));?>" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> 桌台列表</a>
			<a href="<?php  echo iurl('store/tangshi/table/table_post');?>" class="btn btn-primary btn-sm">新建桌台</a>
			<?php  echo tpl_form_filter_hidden('store/tangshi/table/list');?>
			<div class="form-group">
				<input class="form-control input-sm" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="名字(桌台号)">
			</div>
			<div class="form-group">
				<select name="cid" class="form-control input-sm">
					<option value="0">==桌台类型==</option>
					<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<option value="<?php  echo $category['id'];?>" <?php  if($_GPC['cid'] == $category['id']) { ?>selected<?php  } ?>><?php  echo $category['title'];?></option>
					<?php  } } ?>
				</select>
			</div>
			<input type="hidden" name="t" value="<?php  echo $_GPC['t'];?>" >
			<input type="submit" name="submit" value="搜索" class="btn btn-sm btn-success"/>
		</div>
	</form>
	<form action="" class="form-table form form-validate" method="post">
		<div class="panel-body table-responsive js-table">
			<?php  if($_GPC['t'] == 'list') { ?>
				<table class="table table-hover">
					<thead>
					<tr>
						<th width="40">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="ids[]" />
								<label></label>
							</div>
						</th>
						<th>桌台号</th>
						<th>桌台类型</th>
						<th>可供就餐人数</th>
						<th>状态</th>
						<th width="350" style="text-align: right">操作</th>
					</tr>
					</thead>
					<?php  if(is_array($data)) { foreach($data as $da) { ?>
					<tr>
						<td>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="ids[]" value="<?php  echo $da['id'];?>"/>
								<label></label>
							</div>
						</td>
						<td><?php  echo $da['title'];?></td>
						<td><?php  echo $categorys[$da['cid']]['title'];?></td>
						<td><?php  echo $da['guest_num'];?></td>
						<td><span class="<?php  echo $table_status[$da['status']]['css'];?>"><?php  echo $table_status[$da['status']]['text'];?></span></td>
						<td align="right"
							</span>
								<?php  if(empty($da['wx_url'])) { ?>
								<a href="<?php  echo iurl('store/common/qrcode/build', array('store_id' => $da['sid'], 'table_id' => $da['id'], 'type' => 'table'));?>"  data-confirm="生成微信二维码吗?" class="btn btn-default js-post">生成微信二维码</a>
								<?php  } ?>
							<a href="<?php  echo iurl('store/tangshi/table/table_post', array('id' => $da['id']));?>" class="btn btn-default btn-sm">编辑</a>
							<a href="<?php  echo iurl('store/tangshi/table/table_del', array('id' => $da['id']));?>" data-confirm="确定删除吗?" class="btn btn-default btn-sm js-remove">删除</a>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<p class="js-clip" data-text="<?php  echo $da['sys_url'];?>">系统链接: <a href="javascript:;"><?php  echo $da['sys_url'];?></a></p>
							<p class="js-clip" data-text="<?php  echo $da['wx_url'];?>">微信链接: <a href="javascript:;"><?php  echo $da['wx_url'];?></a></p>
						</td>
					</tr>
					<?php  } } ?>
				</table>
				<?php  if(!empty($data)) { ?>
					<div class="btn-region clearfix" style="margin-top: -20px">
						<div class="pull-left">
							<a href="<?php  echo iurl('store/tangshi/table/table_del')?>" class="btn btn-danger btn-sm js-batch" data-batch="remove" data-confirm="确定删除选中的桌台吗?">批量删除</a>
						</div>
						<div class="pull-right">
							<?php  echo $pager;?>
						</div>
					</div>
				<?php  } ?>
			<?php  } ?>
			<?php  if($_GPC['t'] == 'qrcode') { ?>
				<div class="alert alert-warning">
					将如下桌台二维码打印并分别贴在对应桌台上，即可实现扫码下单的功能。微信用户到店后只需拿起微信轻轻一扫，即可实现全自动点菜下单。<br>
				</div>
				<div style="margin-top:20px">
					<?php  if(is_array($data)) { foreach($data as $da) { ?>
					<div class="panel panel-default table-qrcode">
						<div class="panel-heading">
							<a href="<?php  echo iurl('store/tangshi/table/table_post', array('id' => $da['id']))?>"><?php  echo $da['title'];?></a>(<?php  echo $categorys[$da['cid']]['title'];?>)
						</div>
						<div class="panel-body">
							<div class="qrcode" data-wx="<?php  echo $da['wx_url'];?>">
								<?php  if(empty($da['wx_url'])) { ?>
									<a href="<?php  echo iurl('store/common/qrcode/build', array('store_id' => $da['sid'], 'table_id' => $da['id'], 'type' => 'table'));?>"  data-confirm="生成微信二维码吗?" class="btn btn-default js-post">生成微信二维码</a>
								<?php  } else { ?>
									<div class="qrcode-block js-qrcode" data-text="<?php  echo $da['wx_url'];?>" data-width="200"></div>
								<?php  } ?>
							</div>
						</div>
						<div class="panel-footer clearfix">
							<a class="pull-left">扫码次数:<?php  echo $da['scan_num'];?></a>
							<a class="pull-right">状态:<span class="<?php  echo $table_status[$da['status']]['css'];?>"><?php  echo $table_status[$da['status']]['text'];?></span></a>
						</div>
					</div>
					<?php  } } ?>
				</div>
			<?php  } ?>
			<?php  if($_GPC['t'] == 'status') { ?>
				<div style="margin-top:20px">
					<?php  if(is_array($data)) { foreach($data as $da) { ?>
					<div class="panel panel-default table-block">
						<div class="panel-body">
							<div class="<?php  echo $table_status[$da['status']]['css_block'];?>"><span><?php  echo $table_status[$da['status']]['text'];?></span></div>
						</div>
						<div class="panel-footer">
							<a href=""><?php  echo $da['title'];?></a> &nbsp;
							<select name="status" data-id="<?php  echo $da['id'];?>" class="table-status">
								<option value="1" <?php  if($da['status'] == 1) { ?>selected<?php  } ?>>空闲中</option>
								<option value="2" <?php  if($da['status'] == 2) { ?>selected<?php  } ?>>已开台</option>
								<option value="3" <?php  if($da['status'] == 3) { ?>selected<?php  } ?>>已下单</option>
								<option value="4" <?php  if($da['status'] == 4) { ?>selected<?php  } ?>>已支付</option>
							</select>
						</div>
					</div>
					<?php  } } ?>
				</div>
			<?php  } ?>
		</div>
	</form>
</div>

<script>
$(function(){
	$('.table-status').change(function(){
		var status = $(this).val();
		var id = $(this).data('id');
		Notify.confirm('确定更改状态吗', function(){
			$.post("<?php  echo iurl('store/tangshi/table/table_status')?>", {id:id, status: status}, function(data){
				if(data != 'success') {
					Notify.error(data);
				} else {
					location.reload();
				}
				return false;
			});
		});
	});
});
</script>
<?php  } ?>

<?php  if($ta == 'table_post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>名字(桌台号)</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" class="form-control" name="title" placeholder="" value="<?php  echo $item['title'];?>" required="true">
				<span class="help-block">例如：C001</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>可供就餐人数</label>
			<div class="col-sm-6 col-xs-6">
				<input type="number" class="form-control" name="guest_num" placeholder="例如:2" value="<?php  echo $item['guest_num'];?>">
				<span class="help-block"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>桌台类型</label>
			<div class="col-sm-6 col-xs-6">
				<select name="cid" class="form-control" required="true">
					<option value="0">==选择桌台类型==</option>
					<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<option value="<?php  echo $category['id'];?>" <?php  if($item['cid'] == $category['id'] || $_GPC['cid'] == $category['id']) { ?>selected<?php  } ?>><?php  echo $category['title'];?></option>
					<?php  } } ?>
				</select>
				<span class="help-block"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"></span>排序</label>
			<div class="col-sm-6 col-xs-6">
				<input type="number" class="form-control" name="displayorder" placeholder="例如:2" value="<?php  echo $item['displayorder'];?>">
				<span class="help-block"></span>
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