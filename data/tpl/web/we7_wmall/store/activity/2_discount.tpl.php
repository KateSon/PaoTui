<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<h3>活动信息</h3>
		<?php  if(!empty($activity['id'])) { ?>
			<?php  if(empty($activity['status'])) { ?>
				<div class="alert alert-warning">活动已失效,你可以选择点击下方"删除"按钮删除该活动</div>
			<?php  } else { ?>
				<div class="alert alert-info">活动进行中,你可以选择点击下方"撤销"按钮撤销该活动</div>
			<?php  } ?>
		<?php  } ?>
		<?php  if(!empty($activity['id']) && empty($_W['ismanager']) && empty($_W['isagenter'])) { ?>
			<h3>活动信息</h3>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动期限</label>
				<div class="col-sm-8">
					<p class="form-control-static">
						<?php  echo date('Y-m-d H:i', $activity['starttime']);?> ~ <?php  echo date('Y-m-d H:i', $activity['endtime']);?>
					</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">优惠</label>
				<div class="col-sm-8">
					<p class="form-control-static">
						<?php  if(is_array($activity['data'])) { foreach($activity['data'] as $item) { ?>
							<?php  if(!empty($item['condition'])) { ?>
								在线支付满<?php  echo $item['condition'];?>元减<?php  echo $item['back'];?>元 (平台承担: <?php  echo $item['plateform_charge'];?>元, 代理商承担: <?php  echo $item['agent_charge'];?>元, 商户承担: <?php  echo $item['store_charge'];?>元)
								<br><br>
							<?php  } ?>
						<?php  } } ?>
					</p>
				</div>
			</div>
		<?php  } else { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动开始时间</label>
				<div class="col-sm-6 col-xs-6 col-md-4">
					<?php  echo tpl_form_field_date('starttime', $activity['starttime'], true);?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动结束时间</label>
				<div class="col-sm-6 col-xs-6 col-md-4">
					<?php  echo tpl_form_field_date('endtime', $activity['endtime'], true);?>
				</div>
			</div>
			<h3>优惠信息</h3>
			<?php  if(is_array($activity['data'])) { foreach($activity['data'] as $item) { ?>
				<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">满减优惠<?php  echo $item['condition'];?></label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">满</span>
							<input type="text" name="condition[]" value="<?php  echo $item['condition'];?>" class="form-control">
							<span class="input-group-addon">元</span>
							<span class="input-group-addon">减</span>
							<input type="text" name="back[]" value="<?php  echo $item['back'];?>" class="form-control">
							<?php  if(!empty($_W['ismanager'])) { ?>
								<span class="input-group-addon">平台承担</span>
								<input type="text" name="plateform_charge[]" value="<?php  echo $item['plateform_charge'];?>" class="form-control">
								<span class="input-group-addon">元</span>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge[]" value="<?php  echo $item['agent_charge'];?>" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } else if(!empty($_W['isagenter'])) { ?>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge[]" value="<?php  echo $item['agent_charge'];?>" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } ?>
							<div class="input-group-btn">
								<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
							</div>
						</div>
						<span class="help-block">
							在线支付满<?php  echo $item['condition'];?>元减<?php  echo $item['back'];?>元 (平台承担: <?php  echo $item['plateform_charge'];?>元, 代理商承担: <?php  echo $item['agent_charge'];?>元, 商户承担: <?php  echo $item['store_charge'];?>元)
						</span>
					</div>
				</div>
			<?php  } } ?>
		<?php  } ?>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<?php  if(empty($activity['id']) || !empty($_W['ismanager']) || !empty($_W['isagenter'])) { ?>
					<input type="submit" value="提交" class="btn btn-primary">
				<?php  } ?>
				<?php  if(!empty($activity['id'])) { ?>
					<?php  if(empty($activity['status'])) { ?>
						<a href="<?php  echo iurl('store/activity/discount/del');?>" class="btn btn-danger js-post" data-confirm="确定删除此活动?">删除</a>
					<?php  } else { ?>
						<a href="<?php  echo iurl('store/activity/discount/del');?>" class="btn btn-danger js-post" data-confirm="确定撤销此活动?">撤销此活动</a>
					<?php  } ?>
				<?php  } ?>
			</div>
		</div>
	</form>
</div>
<script>
$(function(){
	$(document).on('click', '.btn-turncate', function(){
		$(this).parents('.input-group').find(':text').val('');
	})
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>