<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta== 'post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form-bargain-post" style="max-width: 100%" action="" method="post" enctype="multipart/form-data">
		<h3>活动信息</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>活动主题</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" name="title" value="<?php  echo $bargain['title'];?>" class="form-control" required="true">
				<div class="help-block">8个字以内。例如:双12特价</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>活动描述</label>
			<div class="col-sm-6 col-xs-6">
				<input type="text" name="content" value="<?php  echo $bargain['content'];?>" class="form-control">
				<div class="help-block">例如:惊喜特价,10元吃大餐</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>活动日期</label>
			<div class="col-sm-6 col-xs-6">
				<?php  echo tpl_form_field_daterange('time', array('start' => date('Y-m-d', $bargain['starttime']), 'end' => date('Y-m-d', $bargain['endtime'])));?>
				<div class="help-block">设置活动日期</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>抢购时段</label>
			<div class="col-sm-6 col-xs-6">
				<div class="input-group clockpicker">
					<input type="text" name="starthour" value="<?php  echo $bargain['starthour'];?>" class="form-control" readonly>
					<div class="input-group-addon">至</div>
					<input type="text" name="endhour" value="<?php  echo $bargain['endhour'];?>" class="form-control" readonly>
				</div>
				<div class="help-block">设置活动每天的抢购时间段</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>与其他优惠</label>
			<div class="col-sm-6 col-xs-6">
				<div class="radio radio-inline">
					<input type="radio" name="use_limit" value="1" id="use-limit-1" <?php  if($bargain['use_limit'] == 1) { ?>checked<?php  } ?>/>
					<label for="use-limit-1">同享</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="use_limit" value="2" id="use-limit-2" <?php  if(!$bargain['use_limit'] || $bargain['use_limit'] == 2) { ?>checked<?php  } ?>/>
					<label for="use-limit-2">互斥</label>
				</div>
				<div class="help-block">其他优惠包括: 新用户在线支付立减优惠, 在线支付满减优惠, 在线支付满赠优惠, 门店代金券</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>每个用户每天最多购买</label>
			<div class="col-sm-6 col-xs-6">
				<div class="input-group">
					<input type="number" name="order_limit" value="<?php  echo $bargain['order_limit'];?>" class="form-control">
					<div class="input-group-addon">单</div>
				</div>
				<div class="help-block">设置本活动每个顾客每天的可购买几单</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>每单可购买特价商品</label>
			<div class="col-sm-6 col-xs-6">
				<div class="input-group">
					<input type="number" name="goods_limit" value="<?php  echo $bargain['goods_limit'];?>" class="form-control">
					<div class="input-group-addon">种</div>
				</div>
				<div class="help-block">设置每单可购买几种特价商品</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>参与的商品<span class="text-danger">(不支持多规格商品)</span></label>
			<div class="col-sm-9 col-xs-12 table-responsive">
				<table class="table table-hover table-bordered text-center">
					<thead>
					<tr>
						<th>缩略图</th>
						<th>菜品名称</th>
						<th>原价</th>
						<th>活动价</th>
						<th>每单限购</th>
						<th width="130">活动库存</th>
						<th>当日剩余库存</th>
						<th>新用户专享</th>
						<th>活动状态</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody id="goods-container">
					<?php  if(!empty($bargain['goods'])) { ?>
					<?php  if(is_array($bargain['goods'])) { foreach($bargain['goods'] as $goods) { ?>
						<tr id="goods-<?php  echo $goods['goods_id'];?>">
							<td>
								<input type="hidden" name="goods_id[]" value="<?php  echo $goods['goods_id'];?>"/>
								<input type="hidden" name="poi_user_type[]" value="<?php  echo $goods['poi_user_type'];?>"/>
								<img src="<?php  echo tomedia($goods['thumb']);?>" width="50" alt=""/>
							</td>
							<td><?php  echo $goods['title'];?></td>
							<td>￥<?php  echo $goods['price'];?></td>
							<td>
								<div class="input-group">
									<input type="text" name="discount_price[]" value="<?php  echo $goods['discount_price'];?>" class="form-control">
									<span class="input-group-addon">元</span>
								</div>
							</td>
							<td>
								<div class="input-group">
									<input type="text" name="max_buy_limit[]" value="<?php  echo $goods['max_buy_limit'];?>" class="form-control">
									<span class="input-group-addon">件</span>
								</div>
							</td>
							<td>
								<div class="input-group">
									<input type="text" name="discount_total[]" value="<?php  echo $goods['discount_total'];?>" class="form-control">
									<span class="input-group-addon">件/天</span>
								</div>
							</td>
							<td>
								<div class="input-group">
									<input type="text" name="discount_available_total[]" value="<?php  echo $goods['discount_available_total'];?>" class="form-control">
									<span class="input-group-addon">件</span>
								</div>
							</td>
							<td>
								<div class="switch switch-small" data-on="仅新用户" data-off="所有用户">
									<input type="checkbox" name="poi_user_type_switch[]" value="all" <?php  if($goods['poi_user_type'] == 'new') { ?>checked<?php  } ?> data-id="<?php  echo $goods['goods_id'];?>">
								</div>
							</td>
							<td>
								<?php  if($goods['discount_available_total'] == -1 || $goods['discount_available_total'] > 0) { ?>
								生效
								<?php  } else { ?>
								<span class="text-danger">活动库存不足</span>
								<?php  } ?>
							</td>
							<td>
								<a href="javascript:;" class="btn btn-default btn-goods-item" data-id="<?php  echo $goods['id'];?>">删除</a>
							</td>
						</tr>
					<?php  } } ?>
					<?php  } ?>
					</tbody>
					<tfooter>
						<tr>
							<td colspan="10" style="text-align: left">
								<a href="javascript:;" id="btn-select-goods"><i class="fa fa-plus-circle"></i> 选择商品</a>
							</td>
						</tr>
					</tfooter>
				</table>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<script type="text/html" id="tpl-goods-item">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<tr id="goods-<{d[i].id}>">
		<td>
			<input type="hidden" name="goods_id[]" value="<{d[i].id}>"/>
			<input type="hidden" name="poi_user_type[]" value="all"/>
			<img src="<{d[i].thumb}>" width="50" alt=""/>
		</td>
		<td><{d[i].title}></td>
		<td>￥<{d[i].price}></td>
		<td>
			<div class="input-group">
				<input type="text" name="discount_price[]" value="<{d[i].price}>" class="form-control">
				<span class="input-group-addon">元</span>
			</div>
		</td>
		<td>
			<div class="input-group">
				<input type="number" name="max_buy_limit[]" value="1" class="form-control">
				<span class="input-group-addon">件</span>
			</div>
		</td>
		<td>
			<div class="input-group">
				<input type="number" name="discount_total[]" value="-1" class="form-control">
				<span class="input-group-addon">件/天</span>
			</div>
		</td>
		<td>
			<div class="input-group">
				<input type="number" name="discount_available_total[]" value="-1" class="form-control">
				<span class="input-group-addon">件</span>
			</div>
		</td>
		<td>
			<div class="switch switch-small" data-on="仅新用户" data-off="所有用户">
				<input type="checkbox" name="poi_user_type_switch[]" value="all" data-id="<{d[i].id}>">
			</div>
		</td>
		<td>生效</td>
		<td>
			<a href="javascript:;" class="btn btn-default btn-goods-item" data-id="<{d[i].id}>">删除</a>
		</td>
	</tr>
	<{# } }>
</script>
<script type="text/javascript">
	require(['clockpicker', 'bootstrap.switch'], function($){
		$('.clockpicker :text').clockpicker({autoclose: true});
		$('.switch>:checkbox[name="poi_user_type_switch[]"]').bootstrapSwitch();
		$(':checkbox[name="poi_user_type_switch[]"]').on("switchChange.bootstrapSwitch", function(e, state){
			var type = this.checked ? 'new' : 'all';
			var id = $(this).data('id');
			$('#goods-' + id).find(':hidden[name="poi_user_type[]"]').val(type);
		});
	});

	irequire(['tiny','laytpl'], function(tiny,laytpl){
		$('#btn-select-goods').click(function(){
			tiny.selectgoods(function(goods){
				for(var n in goods) {
					if(goods[n]['id']) {
						$('#goods-' + goods[n]['id']).remove();
					}
				}
				var gettpl = $('#tpl-goods-item').html();
				laytpl(gettpl).render(goods, function(html){
					$('#goods-container').append(html);
					$('.switch>:checkbox[name="poi_user_type_switch[]"]').bootstrapSwitch();
					$(':checkbox[name="poi_user_type_switch[]"]').on("switchChange.bootstrapSwitch", function(e, state){
						var type = this.checked ? 'new' : 'all';
						var id = $(this).data('id');
						$('#goods-' + id).find(':hidden[name="poi_user_type[]"]').val(type);
					});
				});
			}, {mutil: 1, is_options: 0, store_id: "<?php  echo $store['id'];?>"});
		});

		$(document).on('click', '.btn-goods-item', function(){
			$(this).parents('tr').remove();
		});

		$('#form-bargain-post').submit(function(){
			var goods = $('#goods-container tr').size();
			$(this).attr('stop', 0);
			if(!goods) {
				$(this).attr('stop', 1);
				Notify.error('请选择参与活动的商品');
				return false;
			}
			return true;
		});
	});
</script>
<?php  } ?>

<?php  if($ta == 'list') { ?>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a class="btn btn-primary btn-sm" href="<?php  echo iurl('store/activity/bargain/post');?>"/><i class="fa fa-plus-circle"> </i> 创建特价活动</a>
		</div>
		<div class="alert alert-warning">最多可同时进行两个特价活动,超出2个后不在店铺商品列表里显示</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead>
				<tr>
					<th width="40">
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="ids[]" />
							<label></label>
						</div>
					</th>
					<th>活动主题</th>
					<th>每人限购</th>
					<th>活动日期</th>
					<th>抢购时段</th>
					<th>状态</th>
					<th style="width:150px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($bargains)) { foreach($bargains as $bargain) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="ids[]" value="<?php  echo $bargain['id'];?>"/>
							<label></label>
						</div>
					</td>
					<td><?php  echo $bargain['title'];?></td>
					<td>
						<span class="label label-success">每人每天限购<?php  echo $bargain['order_limit'];?>单</span>
						<br>
						<span class="label label-danger label-br">每单限购<?php  echo $bargain['goods_limit'];?>种商品</span>
					</td>
					<td><?php  echo date('Y-m-d', $bargain['starttime'])?> ~  <?php  echo date('Y-m-d', $bargain['endtime'])?></td>
					<td><?php  echo $bargain['starthour'];?> - <?php  echo $bargain['endhour'];?></td>
					<td>
						<span class="<?php  echo $bargain_status[$bargain['status']]['css'];?>">
							<?php  echo $bargain_status[$bargain['status']]['text'];?>
						</span>
					</td>
					<td style="text-align:right;">
						<a href="<?php  echo iurl('store/activity/bargain/post', array('id' => $bargain['id']))?>" class="btn btn-default btn-sm" title="编辑"><i class="fa fa-edit"> </i> 编辑</a>
						<a href="<?php  echo iurl('store/activity/bargain/del', array('id' => $bargain['id']))?>" class="btn btn-default btn-sm js-remove" title="删除" data-confirm="确定要删除吗?"><i class="fa fa-times"> </i> 删除</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<?php  if(!empty($bargains)) { ?>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<a href="<?php  echo iurl('store/activity/bargain/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="确定要删除吗?">删除</a>
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
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>