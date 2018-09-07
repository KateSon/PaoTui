<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('deliveryCard/setmeal/post');?>" class="btn btn-primary btn-sm">添加套餐</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($cards)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th width="130">排序</th>
					<th width="200">套餐名称</th>
					<th>有效时间</th>
					<th>套餐价格</th>
					<th>每日免费配送</th>
					<th>状态</th>
					<th style="width:150px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($cards)) { foreach($cards as $card) { ?>
					<tr>
						<input type="hidden" name="ids[]" value="<?php  echo $card['id'];?>">
						<td>
							<input type="text" name="displayorder[]" class="form-control width-100" value="<?php  echo $card['displayorder'];?>">
						</td>
						<td>
							<input type="text" name="title[]" class="form-control width-130" value="<?php  echo $card['title'];?>">
						</td>
						<td><?php  echo $card['days'];?>天</td>
						<td><?php  echo $card['price'];?>元</td>
						<td><?php  echo $card['day_free_limit'];?>单</td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('deliveryCard/setmeal/status', array('id' => $card['id']));?>" data-name="status" value="1" <?php  if($card['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('deliveryCard/setmeal/post', array('id' => $card['id']))?>" class="btn btn-default btn-sm">编辑</a>
							<a href="<?php  echo iurl('deliveryCard/setmeal/del', array('id' => $card['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该套餐吗">删除</a>
						</td>
					</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交修改" />
				</div>
			</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div class="page clearfix">
	<h2>编辑会员卡套餐</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $card['id'];?>"/>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">套餐名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="title" value="<?php  echo $card['title'];?>" class="form-control" required="true">
				<div class="help-block">例如: 月卡, 季卡</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">有效时间</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" name="days" value="<?php  echo $card['days'];?>" class="form-control" digits="true" required="true">
					<span class="input-group-addon">天</span>
				</div>
				<div class="help-block">设置套餐的有效期限. 必须是整数</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">套餐费用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" name="price" value="<?php  echo $card['price'];?>" class="form-control" required="true">
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">设置套餐的购买费用</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">单日可免费配送单数</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" name="day_free_limit" value="<?php  echo $card['day_free_limit'];?>" class="form-control" required="true" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">每天可免费配送的单数.不填写为不限制.</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" name="displayorder" value="<?php  echo $card['displayorder'];?>" class="form-control">
				<div class="help-block">数字越大越靠前</div>
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