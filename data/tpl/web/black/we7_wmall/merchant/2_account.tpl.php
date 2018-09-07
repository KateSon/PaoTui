<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'index') { ?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('merchant/account/index');?>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-9 col-xs-12">
			<?php  if($_W['is_agent']) { ?>
				<select name="agentid" class="select2 js-select2 form-control width-130">
					<option value="0">选择代理区域</option>
					<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
					<?php  } } ?>
				</select>
			<?php  } ?>
			<select name="sid" class="form-control select2 js-select2">
				<option value="0" <?php  if(!$sid) { ?>selected<?php  } ?>>全部门店</option>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<option value="<?php  echo $store['id'];?>" <?php  if($sid == $store['id']) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post" id="form-account">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th width="40">
						<div class="checkbox checkbox-inline" data-scope="#form-account">
							<input type="checkbox" name="sids[]" value="<?php  echo $account['sid'];?>"/>
							<label></label>
						</div>
					</th>
					<th>门店</th>
					<?php  if($_W['is_agent']) { ?>
						<th>所属城市</th>
					<?php  } ?>
					<th>账户余额</th>
					<th>配送模式</th>
					<th>提现费率</th>
					<th>最低提现</th>
					<th>手续费最低</th>
					<th>手续费最高</th>
					<th style="width:350px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($accounts)) { foreach($accounts as $account) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="sid[]" value="<?php  echo $account['sid'];?>"/>
							<label></label>
						</div>
					</td>
					<td>
						<?php  echo $stores[$account['sid']]['title'];?>
					</td>
					<?php  if($_W['is_agent']) { ?>
						<td><?php  echo toagent($account['agentid'])?></td>
					<?php  } ?>
					<td>
						<span class="label label-warning"><?php  echo $account['amount'];?></span>
					</td>
					<td>
						<span class="<?php  echo $delivery_modes[$account['delivery_mode']]['css'];?>">
							<?php  echo $delivery_modes[$account['delivery_mode']]['text'];?>
						</span>
						<?php  if($account['delivery_mode'] == 2) { ?>
						<br/>
							<?php  if($account['delivery_fee_mode'] == 1) { ?>
								<span class="label label-success label-br">固定配送费: <?php  echo $account['delivery_price'];?>元</span>
							<?php  } else if($account['delivery_fee_mode'] == 2) { ?>
								<span class="label label-danger label-br">按距离收取配送费</span>
								<br/>
								<span class="label label-info label-br"><?php  echo $account['delivery_price']['start_fee'];?>元包含<?php  echo $account['delivery_price']['start_km'];?>公里</span>
								<br/>
								<span class="label label-info label-br">超过<?php  echo $account['delivery_price']['start_km'];?>公里每公里加<?php  echo $account['delivery_price']['pre_km_fee'];?>元</span>
							<?php  } else { ?>
								<span class="label label-primary label-br">按区域收取配送费</span>
							<?php  } ?>
						<?php  } ?>
					</td>
					<td><?php  echo $account['fee_rate'];?>%</td>
					<td><?php  echo $account['fee_limit'];?>元</td>
					<td><?php  echo $account['fee_min'];?>元</td>
					<td><?php  echo $account['fee_max'];?>元</td>
					<td style="text-align:right;">
						<a href="javascript:;" class="btn btn-danger btn-sm account-turncate-item" data-type="single" data-sid="<?php  echo $account['sid'];?>">账户清零</a>
						<a href="<?php  echo iurl('merchant/account/changes', array('id' => $account['sid']))?>" class="btn btn-default btn-sm js-modal">账户变动</a>
						<a href="<?php  echo iurl('merchant/account/set', array('id' => $account['sid']))?>" class="btn btn-default btn-sm" title="账户设置" data-toggle="tooltip" data-placement="top">账户设置</a>
						<a href="<?php  echo iurl('merchant/current/list', array('sid' => $account['sid']))?>" class="btn btn-default btn-sm" title="账户明细" data-toggle="tooltip" data-placement="top" target="_blank">账户明细</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<a href="javascript:;" class="btn btn-sm btn-danger account-turncate-item">账户清零</a>
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>
</form>

<div class="modal fade" id="modal-account-turncate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">账户清零原因</h4>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="form-group">
						<textarea class="form-control" name="remark" placeholder="请输入账户清零原因" rows="7"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary account-turncate-submit">提交</button>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$(document).on('click', '.account-turncate-item', function(){
		var $this = $(this);
		var type = $this.data('type');
		var ids = [];
		if(type == 'single') {
			var sid = $(this).data('sid');
			ids.push(sid);
		} else {
			$('#form-account :checkbox[name="sid[]"]:checked').each(function(){
				var id = $(this).val();
				if(id) {
					ids.push(id);
				}
			});
		}
		if(ids.length == 0) {
			Notify.info('请选择要操作的账户');
			return false;
		}

		$('#modal-account-turncate').modal('show');
		$(document).on('click', '.account-turncate-submit', function(){
			var remark = $.trim($('#modal-account-turncate textarea[name="remark"]').val());
			if(!remark) {
				Notify.info('账户清零原因不能为空');
				return false;
			}
			$.post("<?php  echo iurl('merchant/account/turncate')?>", {ids: ids, remark: remark}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					Notify.info(util.message.message, '', 'error');
				} else {
					$('#modal-account-turncate').modal('hide');
					Notify.success('清空账户余额成功', location.href);
				}
			});
		});
	});
});
</script>
<?php  } ?>

<?php  if($op == 'set') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data" style="max-width: 100%">
		<h3>商户基本信息</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">当前门店</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static text-danger"><strong><?php  echo $store['title'];?></strong></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员模式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="delivery_mode" id="delivery-mode-1" <?php  if($store['delivery_mode'] == 1 || !$store['delivery_mode']) { ?>checked<?php  } ?> onclick="$('.delivery-mode-2').hide()">
					<label for="delivery-mode-1">店内配送员</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="delivery_mode" id="delivery-mode-2" <?php  if($store['delivery_mode'] == 2) { ?>checked<?php  } ?> onclick="$('.delivery-mode-2').show()">
					<label for="delivery-mode-2">平台配送员</label>
				</div>
			</div>
		</div>
		<div class="delivery-mode-2 page-config-store-delivery" <?php  if($store['delivery_mode'] != 2) { ?>style="display:none"<?php  } ?>>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">预计送达时间</label>
				<div class="col-sm-9 col-xs-9 col-md-9">
					<div class="input-group">
						<input type="number" class="form-control" name="delivery_time" value="<?php  echo $store['delivery_time'];?>" digits="true">
						<span class="input-group-addon">分钟</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">服务半径</label>
				<div class="col-sm-9 col-xs-9 col-md-9">
					<div class="input-group">
						<input type="number" class="form-control" name="serve_radius" value="<?php  echo $store['serve_radius'];?>">
						<span class="input-group-addon">KM</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">收货地址是否自动获取</label>
				<div class="col-sm-9 col-xs-9 col-md-9">
					<div class="radio radio-inline">
						<input type="radio" name="auto_get_address" id="auto-get-address-1" value="1" <?php  if($store['auto_get_address'] == 1) { ?>checked<?php  } ?>>
						<label for="auto-get-address-1">是, 高德地图自动获取</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="auto_get_address" id="auto-get-address-0" value="0" <?php  if(!$store['auto_get_address']) { ?>checked<?php  } ?>>
						<label for="auto-get-address-0">否, 用户自己填写</label>
					</div>
					<span class="help-block">设置为用户自己填写后, 将不能获取用户的具体位置, 不能实现超出服务范围禁制下单的功能</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">在配送半径之外是否允许下单</label>
				<div class="col-sm-9 col-xs-9 col-md-9">
					<div class="radio radio-inline">
						<input type="radio" name="not_in_serve_radius" id="not-in-serve-radius-1" value="1" <?php  if($store['not_in_serve_radius'] == 1) { ?>checked<?php  } ?>>
						<label for="not-in-serve-radius-1">允许</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="not_in_serve_radius" id="not-in-serve-radius-0" value="0" <?php  if(!$store['not_in_serve_radius']) { ?>checked<?php  } ?> onclick="$('#auto-get-address-1').prop('checked', true)">
						<label for="not-in-serve-radius-0">不允许</label>
					</div>
					<div class="help-block"><span class="text-danger">距离大于配送半径时是否允许下单，注意：手机定位精确性受天气、用户终端设备是否开启GPS以及硬件配置等影响很大，若此项设置为不允许下单，可能会导致部分用户无法成功下单.</span></div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费</label>
				<div class="col-sm-9 col-xs-12">
					<div class="radio radio-inline">
						<input type="radio" name="delivery_fee_mode" id="delivery-fee-mode-1" value="1" <?php  if($store['delivery_fee_mode'] == 1 || !$store['delivery_fee_mode']) { ?>checked<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-1').show();">
						<label for="delivery-fee-mode-1">固定金额</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="delivery_fee_mode" id="delivery-fee-mode-2" value="2" <?php  if($store['delivery_fee_mode'] == 2) { ?>checked<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-2').show();">
						<label for="delivery-fee-mode-2">按距离收取</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="delivery_fee_mode" id="delivery-fee-mode-3" value="3" <?php  if($store['delivery_fee_mode'] == 3) { ?>checked<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-3').show();">
						<label for="delivery-fee-mode-3">按区域收取</label>
					</div>
				</div>
			</div>
			<div class="delivery-fee-mode delivery-fee-mode-1" <?php  if($store['delivery_fee_mode'] == 1 || !$store['delivery_fee_mode']) { ?>style="display: block"<?php  } ?>>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<div class="input-group-addon">起送价</div>
							<input type="number" name="send_price_1" value="<?php  echo $store['send_price'];?>" class="form-control"/>
							<div class="input-group-addon">元</div>
							<div class="input-group-addon">满</div>
							<input type="number" name="delivery_free_price_1" value="<?php  echo $store['delivery_free_price'];?>" class="form-control"/>
							<div class="input-group-addon">元免配送费</div>
						</div>
						<br>
						<div class="input-group">
							<div class="input-group-addon">每单</div>
							<input type="number" name="delivery_price" value="<?php  echo $store['delivery_price'];?>" class="form-control"/>
							<div class="input-group-addon">元</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group delivery-fee-mode delivery-fee-mode-2" <?php  if($store['delivery_fee_mode'] == 2) { ?>style="display: block"<?php  } ?>>
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<div class="input-group-addon">起送价</div>
						<input type="number" name="send_price_2" value="<?php  echo $store['send_price'];?>" class="form-control"/>
						<div class="input-group-addon">元</div>
						<div class="input-group-addon">满</div>
						<input type="number" name="delivery_free_price_2" value="<?php  echo $store['delivery_free_price'];?>" class="form-control"/>
						<div class="input-group-addon">元免配送费</div>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">起步价</span>
						<input type="number" class="form-control" name="start_fee" value="<?php  echo $store['delivery_price_extra']['start_fee'];?>">
						<span class="input-group-addon">元包含</span>
						<input type="number" class="form-control" name="start_km" value="<?php  echo $store['delivery_price_extra']['start_km'];?>">
						<span class="input-group-addon">公里</span>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">每增加1公里加</span>
						<input type="number" class="form-control" name="pre_km_fee" value="<?php  echo $store['delivery_price_extra']['pre_km_fee'];?>">
						<span class="input-group-addon">元</span>
					</div>
					<div class="help-block">
						<strong class="text-danger">
							特别注意: 设置按照"按距离收取"配送费后,系统会自动变更使用"平台配送"模式商家的某些配置。包括:收货地址被设置为自动获取, 超过配送范围是仍可下单
						</strong>
						<br/>
					</div>
				</div>
			</div>
			<div class="form-group delivery-fee-mode delivery-fee-mode-3" <?php  if($store['delivery_fee_mode'] == 3) { ?>style="display: block"<?php  } ?>>
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12">
					<?php  include itemplate('store/shop/geofence', TEMPLATE_INCLUDEPATH);?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家额外承担配送费</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon">每单</span>
						<input type="number" name="store_bear_deliveryprice" class="form-control" value="<?php  echo $store['delivery_extra']['store_bear_deliveryprice'];?>">
						<span class="input-group-addon">元</span>
					</div>
					<span class="help-block">设置了商家额外承担配送费,将会从商家利润中扣除相应的这部分金额</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">满金额免配送费由谁承担</label>
				<div class="col-sm-9 col-xs-12">
					<div class="radio radio-inline">
						<input type="radio" name="delivery_free_bear" id="delivery_free_bear-plateform" value="plateform" <?php  if($store['delivery_extra']['delivery_free_bear'] == 'plateform' || !$store['delivery_extra']['delivery_free_bear']) { ?>checked<?php  } ?>>
						<label for="delivery_free_bear-plateform">平台</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="delivery_free_bear" id="delivery_free_bear-store" value="store" <?php  if($store['delivery_extra']['delivery_free_bear'] == 'store') { ?>checked<?php  } ?>>
						<label for="delivery_free_bear-store">商家</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送时间段</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon">间隔</span>
						<input type="number" class="form-control" name="pre_delivery_time_minute" value="<?php  echo $account_takeout['pre_delivery_time_minute'];?>">
						<span class="input-group-addon">分钟</span>
						<div class="input-group-btn btn-build-delivery-time">
							<a href="javascript:;" class="btn btn-primary" >生成配送时间段</a>
						</div>
					</div>
				</div>
			</div>
			<div id="delivery-times" class="delivery-times">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12 containter">
						<?php  if(is_array($store['delivery_times'])) { foreach($store['delivery_times'] as $time) { ?>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><?php  echo $time['start'];?> ~ <?php  echo $time['end'];?></span>
								<span class="input-group-addon">附加费</span>
								<input type="text" class="form-control" name="times[fee][]" value="<?php  echo $time['fee'];?>" placeholder="附加费">
								<input type="hidden" name="times[start][]" value="<?php  echo $time['start'];?>"/>
								<input type="hidden" name="times[end][]" value="<?php  echo $time['end'];?>"/>
								<input type="hidden" name="times[status][]" value="<?php  echo $time['status'];?>">
								<span class="input-group-addon">元</span>
								<div class="input-group-btn">
									<a href="javascript:;" class="btn btn-delivery-time-item <?php  if($time['status'] == 1) { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>"><?php  if($time['status'] == 1) { ?>使用中<?php  } else { ?>已弃用<?php  } ?></a>
								</div>
							</div>
						</div>
						<?php  } } ?>
					</div>
				</div>
			</div>
		</div>

		<h3>佣金计算方式</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖单佣金计算方式</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".fee-takeout-type">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="fee_takeout[type]" id="fee-takeout-type-1" <?php  if($account['fee_takeout']['type'] == 1 || empty($account['fee_takeout']['type'])) { ?>checked<?php  } ?>>
					<label for="fee-takeout-type-1" class="toggle-role" data-target="fee-takeout-1">订单百分比抽成</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="fee_takeout[type]" id="fee-takeout-type-2" <?php  if($account['fee_takeout']['type'] == 2) { ?>checked<?php  } ?>>
					<label for="fee-takeout-type-2" class="toggle-role" data-target="fee-takeout-2">固定抽成</label>
				</div>
			</div>
		</div>
		<div class="toggle-content fee-takeout-type">
			<div class="toggle-pane <?php  if($account['fee_takeout']['type'] == 1 || empty($account['fee_takeout']['type'])) { ?>active<?php  } ?>" id="fee-takeout-1">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成项目：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="price" name="fee_takeout[items_yes][]" id="fee-takeout-items-price" <?php  if(in_array('price', $account['fee_takeout']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-takeout-items-price">商品费用</label>
							</div>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="box_price" name="fee_takeout[items_yes][]" id="fee-takeout-items-box-price" <?php  if(in_array('box_price', $account['fee_takeout']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-takeout-items-box-price">餐盒费</label>
							</div>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="pack_fee" name="fee_takeout[items_yes][]" id="fee-takeout-items-pack-fee" <?php  if(in_array('pack_fee', $account['fee_takeout']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-takeout-items-pack-fee">包装费</label>
							</div>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="delivery_fee" name="fee_takeout[items_yes][]" id="fee-takeout-items-delivery-fee" <?php  if(in_array('delivery_fee', $account['fee_takeout']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-takeout-items-delivery-fee">配送费(仅限店内配送模式)</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">不抽成项目：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="store_discount_fee" name="fee_takeout[items_no][]" id="fee-takeout-items-discount" <?php  if(in_array('store_discount_fee', $account['fee_takeout']['items_no'])) { ?>checked<?php  } ?>>
								<label for="fee-takeout-items-discount">商户活动补贴</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成比例：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_takeout[fee_rate]" value="<?php  echo $account['fee_takeout']['fee_rate'];?>" class="form-control"/>
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="toggle-pane <?php  if($account['fee_takeout']['type'] == 2) { ?>active<?php  } ?>" id="fee-takeout-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成金额：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_takeout[fee]" value="<?php  echo $account['fee_takeout']['fee'];?>" class="form-control"/>
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">自提单佣金计算方式</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".fee-selfDelivery-type">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="fee_selfDelivery[type]" id="fee-selfDelivery-type-1" <?php  if($account['fee_selfDelivery']['type'] == 1 || empty($account['fee_selfDelivery']['type'])) { ?>checked<?php  } ?>>
					<label for="fee-selfDelivery-type-1" class="toggle-role" data-target="fee-selfDelivery-1">订单百分比抽成</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="fee_selfDelivery[type]" id="fee-selfDelivery-type-2" <?php  if($account['fee_selfDelivery']['type'] == 2) { ?>checked<?php  } ?>>
					<label for="fee-selfDelivery-type-2" class="toggle-role" data-target="fee-selfDelivery-2">固定抽成</label>
				</div>
			</div>
		</div>
		<div class="toggle-content fee-selfDelivery-type">
			<div class="toggle-pane <?php  if($account['fee_selfDelivery']['type'] == 1 || empty($account['fee_selfDelivery']['type'])) { ?>active<?php  } ?>" id="fee-selfDelivery-1">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成项目：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="price" name="fee_selfDelivery[items_yes][]" id="fee-selfDelivery-items-price" <?php  if(in_array('price', $account['fee_selfDelivery']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-selfDelivery-items-price">商品费用</label>
							</div>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="box_price" name="fee_selfDelivery[items_yes][]" id="fee-selfDelivery-items-box-price" <?php  if(in_array('box_price', $account['fee_selfDelivery']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-selfDelivery-items-box-price">餐盒费</label>
							</div>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="pack_fee" name="fee_selfDelivery[items_yes][]" id="fee-selfDelivery-items-pack-fee" <?php  if(in_array('pack_fee', $account['fee_selfDelivery']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-selfDelivery-items-pack-fee">包装费</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">不抽成项目：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="store_discount_fee" name="fee_selfDelivery[items_no][]" id="fee-selfDelivery-items-discount" <?php  if(in_array('store_discount_fee', $account['fee_selfDelivery']['items_no'])) { ?>checked<?php  } ?>>
								<label for="fee-selfDelivery-items-discount">商户活动补贴</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成比例：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_selfDelivery[fee_rate]" value="<?php  echo $account['fee_selfDelivery']['fee_rate'];?>" class="form-control"/>
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="toggle-pane <?php  if($account['fee_selfDelivery']['type'] == 2) { ?>active<?php  } ?>" id="fee-selfDelivery-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成金额：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_selfDelivery[fee]" value="<?php  echo $account['fee_selfDelivery']['fee'];?>" class="form-control"/>
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">店内单佣金计算方式</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".fee-instore-type">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="fee_instore[type]" id="fee-instore-type-1" <?php  if($account['fee_instore']['type'] == 1 || empty($account['fee_instore']['type'])) { ?>checked<?php  } ?>>
					<label for="fee-instore-type-1" class="toggle-role" data-target="fee-instore-1">订单百分比抽成</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="fee_instore[type]" id="fee-instore-type-2" <?php  if($account['fee_instore']['type'] == 2) { ?>checked<?php  } ?>>
					<label for="fee-instore-type-2" class="toggle-role" data-target="fee-instore-2">固定抽成</label>
				</div>
			</div>
		</div>
		<div class="toggle-content fee-instore-type">
			<div class="toggle-pane <?php  if($account['fee_instore']['type'] == 1 || empty($account['fee_instore']['type'])) { ?>active<?php  } ?>" id="fee-instore-1">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成项目：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="price" name="fee_instore[items_yes][]" id="fee-instore-items-price" <?php  if(in_array('price', $account['fee_instore']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-instore-items-price">商品费用</label>
							</div>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="serve_fee" name="fee_instore[items_yes][]" id="fee-instore-items-serve-fee" <?php  if(in_array('serve_fee', $account['fee_instore']['items_yes'])) { ?>checked<?php  } ?>>
								<label for="fee-instore-items-serve-fee">店内单服务费</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">不抽成项目：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="store_discount_fee" name="fee_instore[items_no][]" id="fee-instore-items-discount" <?php  if(in_array('store_discount_fee', $account['fee_instore']['items_no'])) { ?>checked<?php  } ?>>
								<label for="fee-instore-items-discount">商户活动补贴</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成比例：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_instore[fee_rate]" value="<?php  echo $account['fee_instore']['fee_rate'];?>" class="form-control"/>
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="toggle-pane <?php  if($account['fee_instore']['type'] == 2) { ?>active<?php  } ?>" id="fee-instore-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成金额：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_instore[fee]" value="<?php  echo $account['fee_instore']['fee'];?>" class="form-control"/>
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">买单佣金计算方式</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".fee-paybill-type">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="fee_paybill[type]" id="fee_paybill-type-1" <?php  if($account['fee_paybill']['type'] == 1 || empty($account['fee_paybill']['type'])) { ?>checked<?php  } ?>>
					<label for="fee_paybill-type-1" class="toggle-role" data-target="fee_paybill-1">订单百分比抽成</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="fee_paybill[type]" id="fee_paybill-type-2" <?php  if($account['fee_paybill']['type'] == 2) { ?>checked<?php  } ?>>
					<label for="fee_paybill-type-2" class="toggle-role" data-target="fee_paybill-2">固定抽成</label>
				</div>
			</div>
		</div>
		<div class="toggle-content fee-paybill-type">
			<div class="toggle-pane <?php  if($account['fee_paybill']['type'] == 1 || empty($account['fee_paybill']['type'])) { ?>active<?php  } ?>" id="fee_paybill-1">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成比例：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_paybill[fee_rate]" value="<?php  echo $account['fee_paybill']['fee_rate'];?>" class="form-control"/>
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="toggle-pane <?php  if($account['fee_paybill']['type'] == 2) { ?>active<?php  } ?>" id="fee_paybill-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成金额：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_paybill[fee]" value="<?php  echo $account['fee_paybill']['fee'];?>" class="form-control"/>
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">最低提现金额</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" name="get_cash_fee_limit" value="<?php  echo $account['fee_limit'];?>" class="form-control" required="true"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">只能填写整数，最低为1元(因为微信企业付款接口支持的最低付款金额为1元)</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">提现费率</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" name="get_cash_fee_rate" value="<?php  echo $account['fee_rate'];?>" class="form-control"/>
					<span class="input-group-addon">%</span>
				</div>
				<div class="help-block">
					商户申请提现时，每笔申请提现扣除的费用，默认为空，即提现不扣费，支持填写小数
					<br>
					<strong clas="text-danger">商户入驻时的默认提现费率</strong>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">提现费用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">最低</span>
					<input type="number" name="get_cash_fee_min" value="<?php  echo $account['fee_min'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">最高</span>
					<input type="number" name="get_cash_fee_max" value="<?php  echo $account['fee_max'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">
					<strong class="text-danger">最高金额设置为0， 表示不限制最高提现费用。</strong>
					<br>
					商户提现时，提现费用的上下限，最高为空时，表示不限制扣除的提现费用
					<br>
					例如：提现100元，费率5%，最低1元，最高2元，商户最终提现金额=100-2=98
					<br>
					例如：提现100元，费率5%，最低1元，最高10元，商户最终提现金额=100-100*5%=95
				</div>
			</div>
		</div>
		<?php  if(check_plugin_perm('eleme') && get_plugin_config('eleme.status')) { ?>
		<h3>饿了么对接</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许对接饿了么平台订单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="eleme_status" id="eleme_status-1" <?php  if($store['eleme_status'] == 1) { ?>checked<?php  } ?>>
					<label for="eleme_status-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="eleme_status" id="eleme_status-0" <?php  if(empty($store['eleme_status'])) { ?>checked<?php  } ?>>
					<label for="eleme_status-0">不允许</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">饿了么订单佣金计算方式</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".eleme-fee-type">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="fee_eleme[fee_type]" id="eleme-fee-type-1" <?php  if($account['fee_eleme']['fee_type'] == 1 || empty($account['fee_eleme']['fee_type'])) { ?>checked<?php  } ?>>
					<label for="eleme-fee-type-1" class="toggle-role" data-target="eleme-fee-1">订单百分比抽成</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="fee_eleme[fee_type]" id="eleme-fee-type-2" <?php  if($account['fee_eleme']['fee_type'] == 2) { ?>checked<?php  } ?>>
					<label for="eleme-fee-type-2" class="toggle-role" data-target="eleme-fee-2">固定抽成</label>
				</div>
			</div>
		</div>
		<div class="toggle-content eleme-fee-type">
			<div class="toggle-pane <?php  if($account['fee_eleme']['fee_type'] == 1 || empty($account['fee_eleme']['fee_type'])) { ?>active<?php  } ?>" id="eleme-fee-1">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成比例：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_eleme[fee_rate]" value="<?php  echo $account['fee_eleme']['fee_rate'];?>" class="form-control"/>
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="toggle-pane <?php  if($account['fee_eleme']['fee_type'] == 2) { ?>active<?php  } ?>" id="eleme-fee-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成金额：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_eleme[fee]" value="<?php  echo $account['fee_eleme']['fee'];?>" class="form-control"/>
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">饿了么订单配送方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="eleme[delivery_mode]" id="eleme-delivery-mode-0" <?php  if(empty($store['openplateform_extra']['eleme']['delivery']['delivery_mode'])) { ?>checked<?php  } ?> onclick="$('.eleme-delivery-fee').addClass('hide');">
					<label for="eleme-delivery-mode-0">饿了么配送</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="1" name="eleme[delivery_mode]" id="eleme-delivery-mode-1" <?php  if($store['openplateform_extra']['eleme']['delivery']['delivery_mode'] == 1) { ?>checked<?php  } ?> onclick="$('.eleme-delivery-fee').addClass('hide');">
					<label for="eleme-delivery-mode-1">店内配送</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="eleme[delivery_mode]" id="eleme-delivery-mode-2" <?php  if($store['openplateform_extra']['eleme']['delivery']['delivery_mode'] == 2) { ?>checked<?php  } ?> onclick="$('.eleme-delivery-fee').removeClass('hide');">
					<label for="eleme-delivery-mode-2">平台配送</label>
				</div>
			</div>
		</div>
		<div class="eleme-delivery-fee <?php  if($store['openplateform_extra']['eleme']['delivery']['delivery_mode'] != 2) { ?>hide<?php  } ?>" >
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台配送费</label>
				<div class="col-sm-9 col-xs-12">
					<div class="radio radio-inline">
						<input type="radio" name="eleme[delivery_fee_mode]" id="eleme-delivery-fee-mode-1" value="1" <?php  if($store['openplateform_extra']['eleme']['delivery']['delivery_fee_mode'] == 1 || !$store['openplateform_extra']['eleme']['delivery']['delivery_fee_mode']) { ?>checked<?php  } ?> onclick="$('.eleme-delivery-fee-mode').addClass('hide');$('.eleme-delivery-fee-mode-1').removeClass('hide');">
						<label for="eleme-delivery-fee-mode-1">固定金额</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="eleme[delivery_fee_mode]" id="eleme-delivery-fee-mode-2" value="2" <?php  if($store['openplateform_extra']['eleme']['delivery']['delivery_fee_mode'] == 2) { ?>checked<?php  } ?> onclick="$('.eleme-delivery-fee-mode').addClass('hide');$('.eleme-delivery-fee-mode-2').removeClass('hide');">
						<label for="eleme-delivery-fee-mode-2">按距离收取</label>
					</div>
				</div>
			</div>
			<div class="eleme-delivery-fee-mode eleme-delivery-fee-mode-1 <?php  if($store['openplateform_extra']['eleme']['delivery']['delivery_fee_mode'] == 2) { ?>hide<?php  } ?>">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<div class="input-group-addon">每单</div>
							<input type="number" name="eleme[delivery_price]" value="<?php  echo $store['openplateform_extra']['eleme']['delivery']['delivery_price'];?>" class="form-control"/>
							<div class="input-group-addon">元</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group eleme-delivery-fee-mode eleme-delivery-fee-mode-2 <?php  if($store['openplateform_extra']['eleme']['delivery']['delivery_fee_mode'] == 1 || !$store['openplateform_extra']['eleme']['delivery']['delivery_fee_mode']) { ?>hide<?php  } ?>">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon">起步价</span>
						<input type="number" class="form-control" name="eleme[start_fee]" value="<?php  echo $store['openplateform_extra']['eleme']['delivery']['delivery_price']['start_fee'];?>">
						<span class="input-group-addon">元包含</span>
						<input type="number" class="form-control" name="eleme[start_km]" value="<?php  echo $store['openplateform_extra']['eleme']['delivery']['delivery_price']['start_km'];?>">
						<span class="input-group-addon">公里</span>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">每增加1公里加</span>
						<input type="number" class="form-control" name="eleme[pre_km_fee]" value="<?php  echo $store['openplateform_extra']['eleme']['delivery']['delivery_price']['pre_km_fee'];?>">
						<span class="input-group-addon">元</span>
					</div>
					<div class="help-block">
						如果该店铺的饿了么订单需要使用本平台的配送员进行配送,你可以通过以上设置收取商家的配送费
					</div>
				</div>
			</div>
		</div>
		<?php  } ?>

		<?php  if(check_plugin_perm('meituan') && get_plugin_config('meituan.status')) { ?>
		<h3>美团对接</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许对接美团平台订单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="meituan_status" id="meituan_status-1" <?php  if($store['meituan_status'] == 1) { ?>checked<?php  } ?>>
					<label for="meituan_status-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="meituan_status" id="meituan_status-0" <?php  if(empty($store['meituan_status'])) { ?>checked<?php  } ?>>
					<label for="meituan_status-0">不允许</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">美团订单佣金计算方式</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".meituan-fee-type">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="fee_meituan[fee_type]" id="meituan-fee-type-1" <?php  if($account['fee_meituan']['fee_type'] == 1 || empty($account['fee_meituan']['fee_type'])) { ?>checked<?php  } ?>>
					<label for="meituan-fee-type-1" class="toggle-role" data-target="meituan-fee-1">订单百分比抽成</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="fee_meituan[fee_type]" id="meituan-fee-type-2" <?php  if($account['fee_meituan']['fee_type'] == 2) { ?>checked<?php  } ?>>
					<label for="meituan-fee-type-2" class="toggle-role" data-target="meituan-fee-2">固定抽成</label>
				</div>
			</div>
		</div>
		<div class="toggle-content meituan-fee-type">
			<div class="toggle-pane <?php  if($account['fee_meituan']['fee_type'] == 1 || empty($account['fee_meituan']['fee_type'])) { ?>active<?php  } ?>" id="meituan-fee-1">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成比例：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_meituan[fee_rate]" value="<?php  echo $account['fee_meituan']['fee_rate'];?>" class="form-control"/>
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="toggle-pane <?php  if($account['fee_meituan']['fee_type'] == 2) { ?>active<?php  } ?>" id="meituan-fee-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">抽成金额：</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="fee_meituan[fee]" value="<?php  echo $account['fee_meituan']['fee'];?>" class="form-control"/>
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">美团订单配送方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="meituan[delivery_mode]" id="meituan-delivery-mode-0" <?php  if(empty($store['openplateform_extra']['meituan']['delivery']['delivery_mode'])) { ?>checked<?php  } ?> onclick="$('.meituan-delivery-fee').addClass('hide');">
					<label for="meituan-delivery-mode-0">美团配送</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="1" name="meituan[delivery_mode]" id="meituan-delivery-mode-1" <?php  if($store['openplateform_extra']['meituan']['delivery']['delivery_mode'] == 1) { ?>checked<?php  } ?> onclick="$('.meituan-delivery-fee').addClass('hide');">
					<label for="meituan-delivery-mode-1">店内配送</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="meituan[delivery_mode]" id="meituan-delivery-mode-2" <?php  if($store['openplateform_extra']['meituan']['delivery']['delivery_mode'] == 2) { ?>checked<?php  } ?> onclick="$('.meituan-delivery-fee').removeClass('hide');">
					<label for="meituan-delivery-mode-2">平台配送</label>
				</div>
			</div>
		</div>
		<div class="meituan-delivery-fee <?php  if($store['openplateform_extra']['meituan']['delivery']['delivery_mode'] != 2) { ?>hide<?php  } ?>" >
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台配送费</label>
				<div class="col-sm-9 col-xs-12">
					<div class="radio radio-inline">
						<input type="radio" name="meituan[delivery_fee_mode]" id="meituan-delivery-fee-mode-1" value="1" <?php  if($store['openplateform_extra']['meituan']['delivery']['delivery_fee_mode'] == 1 || !$store['openplateform_extra']['meituan']['delivery']['delivery_fee_mode']) { ?>checked<?php  } ?> onclick="$('.meituan-delivery-fee-mode').addClass('hide');$('.meituan-delivery-fee-mode-1').removeClass('hide');">
						<label for="meituan-delivery-fee-mode-1">固定金额</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="meituan[delivery_fee_mode]" id="meituan-delivery-fee-mode-2" value="2" <?php  if($store['openplateform_extra']['meituan']['delivery']['delivery_fee_mode'] == 2) { ?>checked<?php  } ?> onclick="$('.meituan-delivery-fee-mode').addClass('hide');$('.meituan-delivery-fee-mode-2').removeClass('hide');">
						<label for="meituan-delivery-fee-mode-2">按距离收取</label>
					</div>
				</div>
			</div>
			<div class="meituan-delivery-fee-mode meituan-delivery-fee-mode-1 <?php  if($store['openplateform_extra']['meituan']['delivery']['delivery_fee_mode'] == 2) { ?>hide<?php  } ?>">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<div class="input-group-addon">每单</div>
							<input type="number" name="meituan[delivery_price]" value="<?php  echo $store['openplateform_extra']['meituan']['delivery']['delivery_price'];?>" class="form-control"/>
							<div class="input-group-addon">元</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group meituan-delivery-fee-mode meituan-delivery-fee-mode-2 <?php  if($store['openplateform_extra']['meituan']['delivery']['delivery_fee_mode'] == 1 || !$store['openplateform_extra']['meituan']['delivery']['delivery_fee_mode']) { ?>hide<?php  } ?>">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon">起步价</span>
						<input type="number" class="form-control" name="meituan[start_fee]" value="<?php  echo $store['openplateform_extra']['meituan']['delivery']['delivery_price']['start_fee'];?>">
						<span class="input-group-addon">元包含</span>
						<input type="number" class="form-control" name="meituan[start_km]" value="<?php  echo $store['openplateform_extra']['meituan']['delivery']['delivery_price']['start_km'];?>">
						<span class="input-group-addon">公里</span>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">每增加1公里加</span>
						<input type="number" class="form-control" name="meituan[pre_km_fee]" value="<?php  echo $store['openplateform_extra']['meituan']['delivery']['delivery_price']['pre_km_fee'];?>">
						<span class="input-group-addon">元</span>
					</div>
					<div class="help-block">
						如果该店铺的美团订单需要使用本平台的配送员进行配送,你可以通过以上设置收取商家的配送费
					</div>
				</div>
			</div>
		</div>
		<?php  } ?>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<script id="tpl-delivery-time" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<div class="col-sm-6">
		<div class="input-group">
			<span class="input-group-addon"><{d[i].start}> ~ <{d[i].end}></span>
			<span class="input-group-addon">附加费</span>
			<input type="text" class="form-control" name="times[fee][]" value="<{d[i].fee}>" placeholder="附加费">
			<input type="hidden" name="times[start][]" value="<{d[i].start}>"/>
			<input type="hidden" name="times[end][]" value="<{d[i].end}>"/>
			<input type="hidden" name="times[status][]" value="1">
			<span class="input-group-addon">元</span>
			<div class="input-group-btn">
				<a href="javascript:;" class="btn btn-success btn-delivery-time-item">使用中</a>
			</div>
		</div>
	</div>
	<{# } }>
</script>
<script>
irequire(['laytpl', 'tiny'], function(laytpl, tiny){
	$(document).on('click', '.btn-build-delivery-time', function(){
		tiny.confirm($(this), '确定重新生成配送时间段吗?', function(){
			var pre_minute = parseInt($.trim($('input[name="pre_delivery_time_minute"]').val()));
			if(isNaN(pre_minute)) {
				Notify.info('时间间隔只能是整数');
				return false;
			}
			if(!pre_minute) {
				Notify.info('时间间隔必须大于0');
				return false;
			}
			$.post("<?php  echo iurl('common/utility/build_time');?>", {pre_minute: pre_minute}, function(data) {
				var result = $.parseJSON(data);
				if(result.message.errno == -1) {
					Notify.info(result.message.message);
					return false;
				}
				var gettpl = $('#tpl-delivery-time').html();
				laytpl(gettpl).render(result.message.message, function(html){
					$('#delivery-times .containter').html(html);
				});
			});
		});
	});

	$(document).on('click', '.btn-delivery-time-item', function(){
		if($(this).hasClass('btn-success')) {
			$(this).parent().prev().prev().val(0);
			$(this).removeClass('btn-success').addClass('btn-default');
			$(this).html('已弃用');
		} else {
			$(this).parent().prev().prev().val(1);
			$(this).removeClass('btn-default').addClass('btn-success');
			$(this).html('使用中');
		}
	});
});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>