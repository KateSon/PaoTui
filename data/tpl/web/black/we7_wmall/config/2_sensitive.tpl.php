<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>敏感词设置</h2>
	<div class="alert alert-warning">
		阿里大鱼电话通知时，如果被通知方的名称中含有敏感词，阿里就不会通知。可以通过如下的设置将敏感词替换，平台向阿里提交替换过的词，这样就不会影响阿里的通知，且不会影响其他功能。
	</div>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div id="sensitive-container">
			<?php  if(!empty($sensitive['group'])) { ?>
				<?php  if(is_array($sensitive['group'])) { foreach($sensitive['group'] as $group) { ?>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">敏感词替换</label>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon">敏感词</span>
								<input type="text" name="sensitive_words[]" value="<?php  echo $group['sensitive_words'];?>" class="form-control" required="true">
								<span class="input-group-addon border-0-lr">替换词</span>
								<input type="text" name="replace_words[]" value="<?php  echo $group['replace_words'];?>" class="form-control" required="true">
								<div class="input-group-btn">
									<a href="javascript:;" class="btn btn-danger sensitive-del">删除</a>
								</div>
							</div>
						</div>
					</div>
				<?php  } } ?>
			<?php  } ?>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<a class="btn btn-default btn-sm sensitive-add" href="javascript:;"><i class="fa fa-plus"></i>添加敏感词</a>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<script>
	$(function() {
		$(document).on('click', '.sensitive-add', function() {
			var html = '<div class="form-group">'+
					'		<label class="col-xs-12 col-sm-3 col-md-2 control-label">敏感词替换</label>'+
					'		<div class="col-sm-6">'+
					'			<div class="input-group">'+
					'				<span class="input-group-addon">敏感词</span>'+
					'				<input type="text" name="sensitive_words[]" class="form-control" required="true">'+
					'				<span class="input-group-addon border-0-lr">替换词</span>'+
					'				<input type="text" name="replace_words[]" class="form-control" required="true">'+
					'				<div class="input-group-btn">'+
					'					<a href="javascript:;" class="btn btn-danger sensitive-del">删除</a>'+
					'				</div>'+
					'			</div>'+
					'		</div>'+
					'	</div>';
			$('#sensitive-container').append(html);
		});
		$(document).on('click', '.sensitive-del', function() {
			var parents = $(this).parents('.form-group');
			Notify.confirm('确定删除?',  function(){
				parents.remove();
			});
		});
	})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
