<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('bargain/goods/index');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择门店</label>
		<div class="col-sm-9 col-xs-9 col-md-9">
			<select name="sid" id="select-sid"  class="form-control">
				<option value="0">选择门店</option>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<option value="<?php  echo $store['sid'];?>" <?php  if($store['sid'] == $_GPC['sid']) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
</form>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($bargains)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead>
					<tr>
						<th style="width: 100px">排序</th>
						<th>缩略图</th>
						<th>菜品名称</th>
						<th>所属门店</th>
						<th>原价</th>
						<th>活动价格</th>
						<th>每单限购</th>
						<th>活动库存</th>
						<th>今天剩余库存</th>
						<th>面向群体</th>
						<th style="width: 100px;text-align: right;">操作</th>
					</tr>
					</thead>
					<tbody>
						<?php  if(is_array($bargains)) { foreach($bargains as $bargain) { ?>
							<tr>
								<td>
									<input type="number" name="mall_displayorder[]" value="<?php  echo $bargain['mall_displayorder'];?>" class="form-control" digits="true">
									<input type="hidden" name="ids[]" value="<?php  echo $bargain['id'];?>">
								</td>
								<td><img width="50" height="50" src="<?php  echo tomedia($bargain['goods']['thumb'])?>" alt=""></td>
								<td><?php  echo $bargain['goods']['title'];?></td>
								<td><?php  echo $bargain['store']['title'];?></td>
								<td><?php  echo $bargain['goods']['price'];?>元</td>
								<td><?php  echo $bargain['discount_price'];?>元</td>
								<td><?php  echo $bargain['order_limit'];?>件</td>
								<td><?php  echo $bargain['discount_total'];?></td>
								<td><?php  echo $bargain['discount_available_total'];?></td>
								<td><?php  if($bargain['poi_user_type'] == 'all') { ?>新老用户<?php  } else { ?>新用户<?php  } ?></td>
								<td align="right"><a href="<?php  echo iurl('bargain/goods/del', array('id' => $bargain['id']))?>" class="btn btn-danger btn-sm js-remove" data-confirm="确定下架此商品吗?">下架此商品</a></td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
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
<script>
$(function(){
	$('#select-sid').change(function(){
		$('#form1')[0].submit();
	});
})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
