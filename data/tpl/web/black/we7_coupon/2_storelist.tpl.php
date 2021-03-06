<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li<?php  if($op == 'display') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWeburl('storelist');?>">商家列表</a></li>
	<li<?php  if($op == 'post') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWeburl('storelist', array('op' => 'post', 'id' => $id));?>"><?php  if($id > 0) { ?>编辑商家<?php  } else { ?>添加商家<?php  } ?></a></li>
</ul>
<?php  if($op == 'post') { ?>
<?php  if(COUPON_TYPE ==  WECHAT_COUPON && $id) { ?>
<div class="clearfix">
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i> 系统提示：更新服务信息后，需要微信进行审核，审核通过后可在门店详情页显示。在审核通过前，不能再次修改服务信息。<br>
		<i class="fa fa-info-circle"></i> 注意：系统不会保存修改的服务信息，你可以通过“更新门店信息”来保持门店信息的有效性<br>
		<strong class="text-danger">
			<i class="fa fa-info-circle"></i> 提示：新申请的认证服务号无法使用门店管理（错误详情：api未授权），原因：因微信官方调整规则，等微信官方调整后可以继续使用<br>
		</strong>
	</div>
	<?php  if($update_status == 1) { ?>
	<div class="alert alert-danger"><i class="fa fa-info-circle"></i> 系统提示：服务信息正在更新中，尚未生效，不允许再次更新</div>
	<?php  } ?>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1" style="display: block">
		<div class="panel panel-default">
			<div class="panel-heading">
				基本信息 <small class="text-danger">微信公众平台规定：基本信息不可以修改</small>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 门店状态</label>
					<div class="col-sm-8 col-xs-12">
						<p class="form-control-static">
							<?php  if($location['status'] == 1) { ?>
							<span class="label label-success">审核通过</span>
							<?php  } else if($location['status'] == 2) { ?>
							<span class="label label-default">审核中</span>
							<?php  } else { ?>
							<span class="label label-danger">审核未通过</span>
							<?php  } ?>
						</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 门店名</label>
					<div class="col-sm-8 col-xs-12">
						<p class="form-control-static"><?php  echo $location['business_name'];?></p>\
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 分店名</label>
					<div class="col-sm-8 col-xs-12">
						<p class="form-control-static"><?php  echo $location['branch_name'];?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 类目</label>
					<div class="col-sm-8 col-xs-12">
						<p class="form-control-static"><?php  echo $location['category'];?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 地址</label>
					<div class="col-sm-8 col-xs-12">
						<p class="form-control-static"><?php  echo $location['address'];?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				服务信息
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 是否可修改服务信息</label>
					<div class="col-sm-8 col-xs-12">
						<?php  if($update_status == 1 || $location['status'] != 1) { ?>
						<p class="form-control-static"><span class="label label-danger">不可修改</span></p>
						<div class="help-block">服务信息正在更新中，尚未生效，不允许再次更新。审核通过后，可再次更新。</div>
						<?php  } else { ?>
						<p class="form-control-static"><span class="label label-success">可修改</span></p>
						<?php  } ?>

					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 电话</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="telephone" value="<?php  echo $location['telephone'];?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 图片列表</label>
					<div class="col-sm-8 col-xs-12">
						<?php  echo tpl_form_field_wechat_multi_image('photo_list', $location['photo_list'], '', array('mode' => 'file_upload', 'acid' => $acid));?>
						<span class="help-block">图片只支持jpg格式,大小不超过为1M</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 营业时间</label>
					<div class="col-sm-9 col-xs-4 col-md-3">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="8:00" name="open_time_start" value="<?php  echo $location['open_time_start'];?>">
							<span class="input-group-addon">-</span>
							<input type="text" class="form-control" placeholder="24:00" name="open_time_end" value="<?php  echo $location['open_time_end'];?>">
						</div>
						<span class="help-block">营业时间，24小时制表示，如 8:00-20:00</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger"></span> 人均价格</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" name="avg_price" class="form-control" value="<?php  echo $location['avg_price'];?>"/>
						<span class="help-block">人均价格，大于0的整数,单位为人民币（元）</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger"></span> 推荐</label>
					<div class="col-sm-8 col-xs-12">
						<textarea name="recommend" class="form-control" cols="30" rows="3"><?php  echo $location['recommend'];?></textarea>
						<span class="help-block">推荐品，餐厅可为推荐菜；酒店为推荐套房；景点为 推荐游玩景点等，针对自己行业的推荐内容</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 特色服务</label>
					<div class="col-sm-8 col-xs-12">
						<textarea name="special" class="form-control" cols="30" rows="3"><?php  echo $location['special'];?></textarea>
						<span class="help-block">特色服务，如免费wifi，免费停车，送货上门等商户 能提供的特色功能或服务</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger"></span> 简介</label>
					<div class="col-sm-8 col-xs-12">
						<textarea name="introduction" class="form-control" cols="30" rows="3"><?php  echo $location['introduction'];?></textarea>
						<span class="help-block">商户简介，主要介绍商户信息等 </span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1" <?php  if($update_status == 1) { ?>disabled<?php  } ?>>
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<?php  } else { ?>
<div class="clearfix">
	<?php  if(COUPON_TYPE == WECHAT_COUPON) { ?>
	<div class="alert alert-info">
		<strong class="text-danger">
			<i class="fa fa-info-circle"></i> 提示：新申请的认证服务号无法使用门店管理（错误详情：api未授权），原因：因微信官方调整规则，等微信官方调整后可以继续使用<br>
		</strong>
	</div>
	<?php  } ?>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1" style="display: block">
		<div class="panel panel-default" id="step1">
			<div class="panel-heading">
				商家信息
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 商家名</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="business_name" value="<?php  echo $item['business_name'];?>"/>
						<span class="help-block">商家名不得含有区域地址信息（如，北京市XXX公司）</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 分店名(选填)</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="branch_name" value="<?php  echo $item['branch_name'];?>"/>
						<span class="help-block">分店名不得含有区域地址信息（如，“北京国贸店”中的“北京”）</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 类目</label>
					<div class="col-sm-8 col-xs-12">
						<?php  echo we7_coupon_tpl_form_field_location_category('class',array('cate' => $item['category']['cate'], 'sub' => $item['category']['sub'], 'clas' =>$item['category']['clas']));?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger"></span> </label>
					<div class="col-sm-8 col-xs-12">
						<span class="help-block">请选择商家类目。商家类目必须合法有效。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 地址</label>
					<div class="col-sm-8 col-xs-12">
						<?php  echo tpl_fans_form('reside',array('province' => $item['province'], 'city' => $item['city'],'district' => $item['district']));?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 详细地址</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" name="address" id="addresss" class="form-control" placeholder="输入详细地址，请勿重复填写省市区信息" value="<?php  echo $item['address'];?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 定位</label>
					<div class="col-sm-8 col-xs-12" id="map">
						<?php  echo tpl_form_field_coordinate('baidumap', array('lng' => $item['longitude'], 'lat' => $item['latitude']));?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 电话</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="telephone" value="<?php  echo $item['telephone'];?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 图片列表</label>
					<div class="col-sm-8 col-xs-12">
						<?php  if(COUPON_TYPE == WECHAT_COUPON) { ?>
						<?php  echo tpl_form_field_wechat_multi_image('photo_list', $location['photo_list'], '', array('mode' => 'file_upload', 'acid' => $acid));?>
						<?php  } else { ?>
						<?php  echo tpl_form_field_multi_image('photo_list', $item['photo_list'],'');?>
						<?php  } ?>
						<span class="help-block">图片只支持jpg格式,大小不超过1M</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger"></span> 人均价格</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" name="avg_price" class="form-control" value="<?php  echo $item['avg_price'];?>"/>
						<span class="help-block">人均价格，大于0的整数,单位为人民币（元）</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 营业时间</label>
					<div class="col-sm-9 col-xs-4 col-md-3">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="8:00" name="open_time_start" value="<?php  echo $item['open_time_start'];?>">
							<span class="input-group-addon" id="basic-addon2">-</span>
							<input type="text" class="form-control" placeholder="24:00" name="open_time_end" value="<?php  echo $item['open_time_end'];?>">
						</div>
						<span class="help-block">营业时间，24小时制表示，如 8:00-20:00</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger"></span> 推荐</label>
					<div class="col-sm-8 col-xs-12">
						<textarea name="recommend" class="form-control" cols="30" rows="3" ><?php  echo $item['recommend'];?></textarea>
						<span class="help-block">推荐品，餐厅可为推荐菜；酒店为推荐套房；景点为 推荐游玩景点等，针对自己行业的推荐内容</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 特色服务</label>
					<div class="col-sm-8 col-xs-12">
						<textarea name="special" class="form-control" cols="30" rows="3"><?php  echo $item['special'];?></textarea>
						<span class="help-block">特色服务，如免费wifi，免费停车，送货上门等商户 能提供的特色功能或服务</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger"></span> 简介</label>
					<div class="col-sm-8 col-xs-12">
						<textarea name="introduction" class="form-control js-a" cols="30" rows="3"><?php  echo $item['introduction'];?></textarea>
						<span class="help-block">商户简介，主要介绍商户信息等 </span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<?php  } ?>
<?php  } ?>
<?php  if($op == 'display') { ?>
<div class="clearfix">
	<form action="" method="post" id="form2">
		<?php  if(COUPON_TYPE == WECHAT_COUPON) { ?>
		<div class="alert alert-info">
			<strong class="text-danger">
				<i class="fa fa-info-circle"></i> 提示：新申请的认证服务号无法使用门店管理（错误详情：api未授权），原因：因微信官方调整规则，等微信官方调整后可以继续使用<br>
			</strong>
		</div>
		<?php  } ?>
		<input type="hidden" name="acid" value="<?php  echo $acid;?>">
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
					<thead class="navbar-inner">
					<tr>
						<th width="150">门店名称</th>
						<th width="150">分店名</th>
						<th width="170">类型</th>
						<th width="90">营业时间</th>
						<th width="120">电话</th>
						<th>地址</th>
						<?php  if(COUPON_TYPE == WECHAT_COUPON) { ?>
						<th width="100">审核状态</th>
						<?php  } ?>
						<th width="250" style="text-align:right">操作</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($list)) { foreach($list as $li) { ?>
					<tr>
						<td><?php  echo $li['business_name'];?></td>
						<td><?php  echo $li['branch_name'];?></td>
						<td><?php  echo $li['category_'];?></td>
						<td><?php  echo $li['open_time'];?></td>
						<td><?php  echo $li['telephone'];?></td>
						<td><?php  echo $li['province'];?> <?php  echo $li['city'];?> <?php  echo $li['district'];?> <?php  echo $li['address'];?></td>
						<?php  if(COUPON_TYPE == WECHAT_COUPON) { ?>
						<td>
							<?php  if($li['status'] == 1) { ?>
							<span class="label label-success">审核通过</span>
							<?php  } else if($li['status'] == 2) { ?>
							<span class="label label-default">审核中</span>
							<?php  } else { ?>
							<span class="label label-danger">审核未通过</span>
							<?php  } ?>
						</td>
						<?php  } ?>
						<td style="text-align:right">
							<a href=" <?php  echo $this->createWeburl('storelist', array('op' => 'post', 'id' => $li['id']))?>" class="btn btn-default" title="详情">编辑</a>
							<a href="<?php  echo $this->createWeburl('storelist', array('op' => 'delete', 'id' => $li['id']))?>" class="btn btn-default" onclick="if(!confirm('您确定要删除吗？')) return false;" title="删除">删除</a>
						</td>
					</tr>
					<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php  if(COUPON_TYPE ==  WECHAT_COUPON) { ?>
		<a href="<?php  echo $this->createWeburl('storelist', array('op' => 'import'))?>"  class="btn btn-danger col-lg-1 pull-left" style="margin-right:10px;">从微信导入</a>
		<a href="javascript:;" onclick="util.ajaxshow('<?php  echo $this->createWeburl('storelist', array('op' => 'sync', 'type' => 1))?>')" class="btn btn-default pull-left" style="margin-right:10px;">更新全部门店信息</a>
		<?php  } ?>
		<div class="pull-right"><?php  echo $pager;?></div>
	</form>
</div>
<script>
	$('#form1').submit(function() {
		if(!$.trim($(':text[name="business_name"]').val())) {
			util.message('请填写商家名');
			return false;
		}
		if(!$.trim($('select[name="class[cate]"]').val())||!$.trim($('select[name="class[sub]"]').val())) {
			util.message('请填写商家类目');
			return false;
		}
		if(!$.trim($('select[name="reside[province]"]').val())||!$.trim($('select[name="reside[city]"]').val())||!$.trim($('select[name="reside[district]"]').val())) {
			util.message('请填写完整的地址');
			return false;
		}
		if(!$.trim($(':text[name="address"]').val())) {
			util.message('请填写详细地址');
			return false;
		}
		if(!$.trim($(':text[name="baidumap[lng]"]').val())||!$.trim($(':text[name="baidumap[lat]"]').val())) {
			util.message('请选择坐标');
			return false;
		}
		if(!$.trim($(':text[name="telephone"]').val())) {
			util.message('请填写电话号码');
			return false;
		}
		if($('input[name="photo_list[]"]').size()<1) {
			util.message('请选择图片');
			return false;
		}
		if(!$.trim($(':text[name="open_time_start"]').val())|| !$.trim($(':text[name="open_time_end"]'))) {
			util.message('请填写营业时间');
			return false;
		}
		if(!$.trim($('textarea[name="special"]').val())) {
			util.message('请填写特色服务');
			return false;
		}
	});
</script>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>