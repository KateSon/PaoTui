<?php defined('IN_IA') or exit('Access Denied');?><?php  if($ta == 'remind') { ?>
<form class="form-horizontal form-validate" id="form-reply" action="<?php  echo iurl('store/order/takeout/remind');?>" method="post" enctype="multipart/form-data">
	<input type='hidden' name='id' value='<?php  echo $id;?>' />
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">回复催单</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<input type="text" name="reply" class="form-control" placeholder="请填写/选择一个催单回复" required="true">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu" style="width:550px">
							<?php  if(is_array($_W['we7_wmall']['store']['remind_reply'])) { foreach($_W['we7_wmall']['store']['remind_reply'] as $reply) { ?>
								<li><a href="javascript:;"><?php  echo $reply;?></a></li>
							<?php  } } ?>
						</ul>
					</div>
				</div>
				<span class="help-block">
					<a href="<?php  echo iurl('store/shop/setting', array('type' => 'remind'));?>" target="_blank"><i class="fa fa-plus-circle"></i> 添加催单回复</a>
				</span>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">提交</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
			</div>
		</div>
	</div>
</form>
<script>
$(function(){
	$('#form-reply').find('.dropdown-menu li').click(function(){
		var reply = $(this).text();
		$('#form-reply').find(':text[name="reply"]').val(reply);
	});
});
</script>
<?php  } else if($ta == 'select_deliveryer') { ?>
<form class="form-horizontal form-validate" id="form-deliveryer" action="" method="post" enctype="multipart/form-data">
	<input type='hidden' name='id' value='<?php  echo $id;?>' />
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">选择配送员</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th class="text-center">姓名</th>
						<th class="text-center">手机号</th>
						<th class="text-center">操作</th>
					</tr>
					</thead>
					<?php  if(!empty($deliveryers)) { ?>
						<?php  if(is_array($deliveryers)) { foreach($deliveryers as $deliveryer) { ?>
							<tr>
								<th class="text-center"><?php  echo $deliveryer['deliveryer']['title'];?></th>
								<th class="text-center"><?php  echo $deliveryer['deliveryer']['mobile'];?></th>
								<th class="text-center">
									<a href="<?php  echo iurl('store/order/takeout/set_deliveryer', array('id' => $id, 'deliveryer_id' => $deliveryer['deliveryer_id']));?>" class="btn btn-primary btn-sm js-post">选择</a>
								</th>
							</tr>
						<?php  } } ?>
					<?php  } ?>
				</table>
			</div>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($ta =='cancel') { ?>
<form class="form-horizontal form-validate" action="<?php  echo iurl('store/order/takeout/cancel', array('set' => 1));?>" method="post" enctype="multipart/form-data">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">取消订单</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" value="<?php  echo $id;?>"/>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">选择退款理由*</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<select name="reason" class="select2 js-select2 form-control">
							<option value="0">选择退款理由</option>
							<?php  if(is_array($reasons)) { foreach($reasons as $key => $val) { ?>
								<option value="<?php  echo $key;?>"><?php  echo $val;?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 control-label">填写备注(选填)</label>
					<div class="col-sm-8 col-xs-9 col-md-8">
						<textarea name="remark" cols="39" rows="7" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">提交</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
			</div>
		</div>
	</div>
</form>
<?php  } ?>
