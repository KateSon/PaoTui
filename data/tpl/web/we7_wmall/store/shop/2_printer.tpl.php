<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用打印机</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
					<label for="status-1">启用</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="status" id="status-0" <?php  if($item['status'] == 0) { ?>checked<?php  } ?>>
					<label for="status-0">不启用</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="name" value="<?php  echo $item['name'];?>" placeholder="填写打印机名称" required="true">
				<div class="help-block">方便区分打印机</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机类型</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="feie" class="printer-type" name="type" id="type-feie" <?php  if($item['type'] == 'feie') { ?>checked<?php  } ?>>
					<label for="type-feie">飞鹅定制打印机</label>
					<span class="label label-success hide">推荐</span>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="365" class="printer-type" name="type" id="type-365" <?php  if($item['type'] == '365') { ?>checked<?php  } ?>>
					<label for="type-365">365定制打印机</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="yilianyun" class="printer-type" name="type" id="type-yilianyun" <?php  if($item['type'] == 'yilianyun') { ?>checked<?php  } ?>>
					<label for="type-yilianyun">易联云定制打印机(不推荐)</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="feiyin" class="printer-type" name="type" id="type-feiyin" <?php  if($item['type'] == 'feiyin') { ?>checked<?php  } ?>>
					<label for="type-feiyin">飞印打印机(不推荐,后期将停止更新)</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="AiPrint" class="printer-type" name="type" id="type-AiPrint" <?php  if($item['type'] == 'AiPrint') { ?>checked<?php  } ?>>
					<label for="type-AiPrint">AiPrint打印机(不推荐,后期将停止更新)</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="qiyun" class="printer-type" name="type" id="type-qiyun" <?php  if($item['type'] == 'qiyun') { ?>checked<?php  } ?>>
					<label for="type-qiyun">启云定制打印机(不推荐,后期将停止更新)</label>
				</div>
				<div class="help-block"><span class="text-danger">平台所有打印机都属于定制打印机，如需购买打印机请联系平台管理员（价格低，质量好），自行购买可能会有不兼容等问题, 因自行购买打印机造成的损失客户自己承担。</strong></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">机器号</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="print_no" value="<?php  echo $item['print_no'];?>" placeholder="填写机器号" required="true">
				<div class="help-block">打印机底部标签信息中获取</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机key</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="key" value="<?php  echo $item['key'];?>" placeholder="填写打印机key" required="true">
				<div class="help-block">
					如果你的打印机是飞鹅打印机, 需要到<a href="http://www.feieyun.cn/admin/login.php" target="_blank">"飞鹅云官网"</a>注册账号并添加打印机获取
					<br>
					如果你的打印机是易联云打印机, 可在打印机底部标签信息中获取
				</div>
			</div>
		</div>
		<div class="form-group <?php  if($item['type'] != 'feiyin' && $item['type'] != 'AiPrint') { ?>hide<?php  } ?> text-feiyin">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户编号</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="member_code" value="<?php  echo $item['member_code'];?>" placeholder="填写商户编号">
				<div class="help-block">
					如果你的打印机是飞印打印机, 需要到<a href="http://my.feyin.net" target="_blank">"飞印中心"</a>注册账号并添加打印机获取
				</div>
			</div>
		</div>
		<div class="<?php  if($item['type'] != 'yilianyun' && $item['type'] != 'qiyun') { ?>hide<?php  } ?> text-yilianyun">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">用户ID</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="userid" value="<?php  echo $item['member_code'];?>" placeholder="填写用户id">
					<div class="help-block yilianyun <?php  if($item['type'] != 'yilianyun') { ?>hide<?php  } ?>">请到<a href="http://yilianyun.10ss.net/" target="_blank">"易联云"</a>管理中心系统集成里默取</div>
					<div class="help-block qiyun <?php  if($item['type'] != 'qiyun') { ?>hide<?php  } ?>">请到<a href="http://www.qiyunkuailian.com" target="_blank">"启云"</a>管理中心系统集成里默取</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">apikey</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="api_key" value="<?php  echo $item['api_key'];?>" placeholder="apikey">
					<div class="help-block yilianyun <?php  if($item['type'] != 'yilianyun') { ?>hide<?php  } ?>">请到<a href="http://yilianyun.10ss.net/" target="_blank">"易联云"</a>管理中心系统集成里默取</div>
					<div class="help-block qiyun <?php  if($item['type'] != 'qiyun') { ?>hide<?php  } ?>">请到<a href="http://www.qiyunkuailian.com" target="_blank">"启云"</a>管理中心系统集成里默取</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印联数</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="print_nums" value="<?php  echo $item['print_nums'];?>">
				<div class="help-block">默认为1</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印指定标签</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="print_label_type" id="print-label-type-0" value="0" <?php  if(in_array(0, $item['print_label'])) { ?>checked<?php  } ?> onclick="$('.print_label-containter').addClass('hide')"> <label for="print-label-type-0">打印所有的商品</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="print_label_type" id="print-label-type-1" value="1" <?php  if(!in_array(0, $item['print_label'])) { ?>checked<?php  } ?> onclick="$('.print_label-containter').removeClass('hide')"> <label for="print-label-type-1">打印指定标签</label>
				</div>
				<div class="print_label-containter <?php  if(in_array(0, $item['print_label'])) { ?>hide<?php  } ?>" >
					<?php  if(is_array($print_labels)) { foreach($print_labels as $label) { ?>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="print_label[]" id="print-label-<?php  echo $label['id'];?>" value="<?php  echo $label['id'];?>" <?php  if(in_array($label['id'], $item['print_label'])) { ?>checked<?php  } ?>>
							<label for="print-label-<?php  echo $label['id'];?>"><?php  echo $label['title'];?></label>
						</div>
					<?php  } } ?>
				</div>
				<div class="help-block">当设置了打印指定标签，该打印机只打印包含【指定标签内的商品(ps: 添加商品的时候，可设置商品的打印标签)】的订单</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">打印类型</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="is_print_all" id="is-print-all-1" value="1" <?php  if($item['is_print_all'] == 1) { ?>checked<?php  } ?>> <label for="is-print-all-1">整单打印</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="is_print_all" id="is-print-all-0" value="0" <?php  if(!$item['is_print_all']) { ?>checked<?php  } ?>> <label for="is-print-all-0">分单打印</label>
				</div>
				<div class="help-block">
					整单打印为： 打印订单的全部商品条目信息。 分单打印为： 订单里的全部商品每个打印一次
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">头部自定义信息</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="print_header" value="<?php  echo $item['print_header'];?>">
				<div class="help-block">建议少于20个字</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">尾部自定义信息</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="print_footer" value="<?php  echo $item['print_footer'];?>">
				<div class="help-block">建议少于20个字</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码类型</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="qrcode_type" id="qrcode-type-delivery-assign" value="delivery_assign" <?php  if($item['qrcode_type'] == 'delivery_assign') { ?>checked<?php  } ?> onclick="$('.qrcode-custom').hide();">
					<label for="qrcode-type-delivery-assign">配送员接单二维码</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="qrcode_type" id="qrcode-type-custom" value="custom" <?php  if($item['qrcode_type'] == 'custom' || !$item['qrcode_type']) { ?>checked<?php  } ?> onclick="$('.qrcode-custom').show();">
					<label for="qrcode-type-custom">自定义二维码链接</label>
				</div>
				<div class="help-block">
					配送员接单二维码: 打印机自动打印该订单的接单二维码,配送员可直接扫码该二维码接单。
				</div>
			</div>
		</div>
		<div class="form-group qrcode-custom" <?php  if($item['qrcode_type'] != 'custom' && $item['qrcode_type'] != '') { ?>style="display:none"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="qrcode_link" value="<?php  echo $item['qrcode_link'];?>">
				<div class="help-block text-danger">该店铺手机端地址为:<a target="_blank" href="<?php  echo imurl('wmall/home/index', array(), true);?>"><?php  echo imurl('wmall/home/index', array(), true);?></a> 您可以用该地址转为短链接作为二维码的链接地址。</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input  type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } else if($ta == 'list') { ?>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('store/shop/printer/post');?>" class="btn btn-primary btn-sm">添加打印机</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($data)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th>打印机品牌</th>
							<th>打印机名称</th>
							<th>打印联数</th>
							<th>打印机状态</th>
							<th>启用?</th>
							<th style="width:150px; text-align:right;">状态/修改/删除</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($data)) { foreach($data as $item) { ?>
						<tr>
							<td>
								<span class="<?php  echo $types[$item['type']]['css'];?>"><?php  echo $types[$item['type']]['text'];?></span>
							</td>
							<td><?php  echo $item['name'];?></td>
							<td><?php  echo $item['print_nums'];?></td>
							<td>
								<span class="label label-info"><?php  echo $item['status_cn'];?></span>
							</td>
							<td>
								<?php  if($item['status'] == 1) { ?>
									<span class="label label-success">启用</span>
								<?php  } else { ?>
									<span class="label label-danger">停用</span>
								<?php  } ?>
							</td>
							<td style="text-align:right;">
								<a href="<?php  echo iurl('store/shop/printer/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm">编辑</a>
								<a href="<?php  echo iurl('store/shop/printer/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗?">删除</a>
							</td>
						</tr>
						<?php  } } ?>
					</tbody>
				</table>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } else if($ta == 'label_post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div id="tpl">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">标签名称</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="title[]" value="">
				</div>
			</div>
			<div class="form-group" style="border-bottom: 0">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类排序</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="displayorder[]" value="">
				</div>
			</div>
			<hr>
		</div>
		<div id="tpl-container"></div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<a href="javascipt:;" id="post-add"><i class="fa fa-plus-circle"></i> 继续添加</a>
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
<?php  } else if($ta == 'label_list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('store/shop/printer/label_post');?>" class="btn btn-primary btn-sm">添加打印标签</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($lists)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="">
					<tr>
						<th>标签名称</th>
						<th>排序</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
						<tr>
							<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
							<td><input type="text" style="width:130px" name="title[]" class="form-control" value="<?php  echo $item['title'];?>"></td>
							<td><input type="text" style="width:100px" name="displayorder[]" class="form-control" value="<?php  echo $item['displayorder'];?>"></td>
							<td style="text-align:right;">
								<a href="<?php  echo iurl('store/shop/printer/label_del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除吗?">删除</a>
							</td>
						</tr>
					<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<input type="submit" class="btn btn-primary" name="submit" value="提交修改"/>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>
<script>
$(function(){
	$('.printer-type').click(function(){
		if($(this).val() == 'yilianyun' || $(this).val() == 'qiyun') {
			$('.text-feiyin').addClass('hide');
			$('.text-yilianyun').removeClass('hide');
			if($(this).val() == 'yilianyun') {
				$('.yilianyun').removeClass('hide');
				$('.qiyun').addClass('hide');
			} else{
				$('.qiyun').removeClass('hide');
				$('.yilianyun').addClass('hide');
			}
		} else if($(this).val() == 'feiyin' || $(this).val() == 'AiPrint') {
			$('.text-yilianyun').addClass('hide');
			$('.text-feiyin').removeClass('hide');
		} else {
			$('.text-feiyin').addClass('hide');
			$('.text-yilianyun').addClass('hide');
		}
	});

	$('#post-add').click(function(){
		$('#tpl-container').append($('#tpl').html());
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>