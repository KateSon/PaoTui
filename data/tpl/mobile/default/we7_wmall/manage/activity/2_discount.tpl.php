<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page discount">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title open-popup">创建店铺满减</h1>
	</header>
	<div class="content">
		<?php  if(empty($activity['id'])) { ?>
			<div class="list-block">
				<ul>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">起始日期</div>
								<div class="item-input">
									<input type="text" placeholder="请选择开始日期" name="starttime" data-toggle='date' class="align-right" />
									<i class="icon icon-right"></i>
								</div>
							</div>
						</div>
					</li>
					<li class="border-1px-b">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">结束日期</div>
								<div class="item-input">
									<input type="text" placeholder="请选择结束日期" name="endtime" data-toggle='date' class="align-right" />
									<i class="icon icon-right"></i>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="activity-box">
				<div class="activity-title">满减规则</div>
				<ul id="activity-content">
					<li class="activity-col">
						<span>满</span>
						<div class="input-box">
							<input type="text" name="condition[]" value="">
						</div>
						<span>减</span>
						<div class="input-box">
							<input type="text" name="back[]" value="">
						</div>
						<span>元</span>
						<a href="javascript:;" class="activity-delete">
							<i class="icon icon-delete"></i>
						</a>
					</li>
					<li class="activity-col">
						<span>满</span>
						<div class="input-box">
							<input type="text" name="condition[]" value="">
						</div>
						<span>减</span>
						<div class="input-box">
							<input type="text" name="back[]" value="">
						</div>
						<span>元</span>
						<a href="javascript:;" class="activity-delete">
							<i class="icon icon-delete"></i>
						</a>
					</li>
					<li class="activity-col">
						<span>满</span>
						<div class="input-box">
							<input type="text" name="condition[]" value="">
						</div>
						<span>减</span>
						<div class="input-box">
							<input type="text" name="back[]" value="">
						</div>
						<span>元</span>
						<a href="javascript:;" class="activity-delete">
							<i class="icon icon-delete"></i>
						</a>
					</li>
					<li class="activity-col">
						<span>满</span>
						<div class="input-box">
							<input type="text" name="condition[]" value="">
						</div>
						<span>减</span>
						<div class="input-box">
							<input type="text" name="back[]" value="">
						</div>
						<span>元</span>
						<a href="javascript:;" class="activity-delete">
							<i class="icon icon-delete"></i>
						</a>
					</li>
				</ul>
				<div class="activity-add">新增阶梯配置</div>
			</div>
			<div class="confirm">
				<a href="javascript:;" class="submit">确认并保存</a>
			</div>
		<?php  } else { ?>
			<div class="list-block">
				<ul>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">起始日期</div>
								<div class="item-input align-right">
									<?php  echo date('Y-m-d', $activity['starttime']);?>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">结束日期</div>
								<div class="item-input align-right">
									<?php  echo date('Y-m-d', $activity['endtime']);?>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="activitys">
				<div class="activity-title">已创建活动</div>
				<ul>
					<?php  if(is_array($activity['data'])) { foreach($activity['data'] as $item) { ?>
						<li>
							满<?php  echo $item['condition'];?>元减<?php  echo $item['back'];?>元，平台承担<?php  if(!empty($item['plateform_charge'])) { ?><?php  echo $item['plateform_charge'];?><?php  } else { ?>0<?php  } ?>元
						</li>
					<?php  } } ?>
				</ul>
			</div>
			<div class="cancel">
				<a href="<?php  echo imurl('manage/activity/discount/del')?>" class="js-post button button-fill" data-confirm="确定撤销活动么">撤销此活动</a>
			</div>
		<?php  } ?>
	</div>
</div>
<script>
$(function(){
	$(document).on('click', '.confirm .submit', function(){
		
		var starttime = $.trim($(':text[name="starttime"]').val());
		if(!starttime) {
			$.toast('活动开始时间不能为空');
			return false;
		};
		var endtime = $.trim($(':text[name="endtime"]').val());
		if(!endtime) {
			$.toast('活动结束时间不能为空');
			return false;
		};
		
		var options = [];
		$('#activity-content .activity-col').each(function(){
			var condition = $.trim($(this).find(':text[name="condition[]"]').val());
			var back = $.trim($(this).find(':text[name="back[]"]').val());
			if(condition && back) {
				options.push({
					condition: condition,
					back: back,
				});
			}
		});

		$(this).addClass('disabled');
		var params = {
			starttime: starttime,
			endtime: endtime,
			options: options,
		};
		$.post("<?php  echo imurl('manage/activity/discount');?>", params, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$.toast(result.message.message);
				$('.confirm .submit').removeClass('disabled');
				return false;
			}
			$.toast('店铺满减活动创建完成', "<?php  echo imurl('manage/activity/index');?>");
		})
	});

	$(document).on('click', '.activity-delete', function(){
		$(this).parent().remove();
	});

	$(document).on('click', '.activity-add', function(){
		var size = $('#activity-content .activity-col').size();
		if(size >= 4) {
			$.toast('最多只能添加4个活动');
			return false;
		}
		var html = '<li class="activity-col">'+
					'	<span>满</span>'+
					'	<div class="input-box">'+
					'		<input type="text" name="condition[]" value="">'+
					'	</div>'+
					'	<span>减</span>'+
					'	<div class="input-box">'+
					'		<input type="text" name="back[]" value="">'+
					'	</div>'+
					'	<span>元</span>'+
					'	<a href="javascript:;" class="activity-delete">'+
					'		<i class="icon icon-delete"></i>'+
					'	</a>'+
					'</li>';
		$('#activity-content').append(html);
	});
})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>