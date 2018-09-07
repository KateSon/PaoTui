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
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">满减优惠</label>
			<div class="col-sm-6">
				<div class="input-group">
					<span class="input-group-addon">满</span>
					<input type="text" name="condition[]" value="<?php  echo $item['condition'];?>" class="form-control">
					<span class="input-group-addon">元</span>
					<span class="input-group-addon">赠送</span>
					<input type="text" name="back[]" value="<?php  echo $item['back'];?>" class="form-control">
					<div class="input-group-btn">
						<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
					</div>
				</div>
			</div>
		</div>
		<?php  } } ?>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
				<?php  if(!empty($activity['id'])) { ?>
					<?php  if(empty($activity['status'])) { ?>
						<a href="<?php  echo iurl('store/activity/grant/del');?>" class="btn btn-danger js-post" data-confirm="确定删除此活动?">删除</a>
					<?php  } else { ?>
						<a href="<?php  echo iurl('store/activity/grant/del');?>" class="btn btn-danger js-post" data-confirm="确定撤销此活动?">撤销此活动</a>
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