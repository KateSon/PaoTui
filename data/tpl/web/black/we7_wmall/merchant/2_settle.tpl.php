<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter">
	<input type="hidden" name="c" value="site">
	<input type="hidden" name="a" value="entry">
	<input type="hidden" name="m" value="we7_wmall">
	<input type="hidden" name="do" value="web"/>
	<input type="hidden" name="ctrl" value="merchant"/>
	<input type="hidden" name="ac" value="settle"/>
	<input type="hidden" name="op" value="list"/>
	<input type="hidden" name="status" value="<?php  echo $status;?>"/>
	<?php  if($_W['is_agent']) { ?>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择代理区域</label>
			<div class="col-sm-9 col-xs-12">
				<select name="agentid" class="select2 js-select2 form-control width-130">
					<option value="0">选择代理区域</option>
					<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>
	<?php  } ?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('status:-1');?>" class="btn <?php  if($status == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待审核</a>
				<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">审核通过</a>
				<a href="<?php  echo ifilter_url('status:3');?>" class="btn <?php  if($status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">审核未通过</a>
			</div>
		</div>
	</div>
</form>
<form class="form-table " action="" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>商户名称</th>
					<?php  if($_W['is_agent']) { ?>
						<th>所属城市</th>
					<?php  } ?>
					<th>商户地址</th>
					<th>申请人</th>
					<th>申请人手机号</th>
					<th>审核状态</th>
					<th>申请时间</th>
					<th class="text-right">操作</th>
				</tr>
				</thead>
				<tbody id="list">
					<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
						<tr>
							<td><?php  echo $item['title'];?></td>
							<?php  if($_W['is_agent']) { ?>
								<td><?php  echo toagent($item['agentid'])?></td>
							<?php  } ?>
							<td><?php  echo $item['address'];?></td>
							<td><?php  echo $item['user']['title'];?></td>
							<td><?php  echo $item['user']['mobile'];?></td>
							<td>
								<span class="<?php  echo $store_status[$item['status']]['css'];?>"><?php  echo $store_status[$item['status']]['text'];?></span>
							</td>
							<td><?php  echo date('Y-m-d H:i', $item['addtime']);?></td>
							<td class="text-right">
								<a href="javascript:;" data-id="<?php  echo $item['id'];?>" class="btn btn-default btn-audit">审核</a>
								<a href="<?php  echo iurl('store/shop/setting', array('_sid' => $item['id']))?>" target="_blank" class="btn btn-default">编辑</a>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
	</div>
</form>
<div class="modal fade" id="store-audit-container" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">审核入驻申请</h4>
			</div>
			<div class="modal-body">
				<form action="" class="form-horizontal form">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<div class="radio radio-inline">
								<input type="radio" name="status" value="1" id="status-1" checked>
								<label for="status-1">通过</label>
							</div>
							<div class="radio radio-inline">
								<input type="radio" name="status" value="3" id="status-3">
								<label for="status-3">不通过</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
						<div class="col-sm-9 col-xs-9 col-md-9">
							<textarea name="remark" class="form-control" cols="30" rows="5"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-primary js-reply-submit">确定</a>&nbsp;&nbsp;
				<a class="btn btn-default" data-dismiss="modal">取消</a>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$('.btn-audit').click(function(){
		var id = $(this).data('id');
		if(!id) {
			return false;
		}
		$('#store-audit-container').modal('show');
		$('.js-reply-submit').click(function(){
			var status = $('#store-audit-container :radio[name="status"]:checked').val();
			var remark = $('#store-audit-container textarea[name="remark"]').val();
			$.post("<?php  echo iurl('merchant/settle/audit');?>", {id: id, status: status, remark: remark}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					Notify.error(result.message.message);
					return;
				} else {
					Notify.success(result.message.message, location.href);
				}
			});
		});
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>