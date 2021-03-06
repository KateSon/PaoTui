<?php defined('IN_IA') or exit('Access Denied');?><style>
	.page-business-time header span{position: absolute; color: #fff; right: .4rem; top: 50%; transform: translate(0, -50%);}
	.page-business-time .content .help{margin-top: .4rem; font-size: .7rem; padding-left: .4rem;}
	.page-business-time .content #hour input{display: inline-block; width: 45%; text-align: center;}
	.page-business-time .content .item-content .delete{position: absolute; right: .4rem;}
	.page-business-time .content .item-content .delete i{font-size: .8rem;}
	.page-business-time .button-box{text-align: center;}
	.page-business-time #add-time{color: #fff; width: 70%; display: inline-block; padding: .4rem 0; height: auto; border-color: #ff2d4b; background-color: #ff2d4b; font-size: .8rem;}
	.clockpicker-popover{opacity: 1;  margin-top: 10px; border: 1px solid rgba(0,0,0,.2);}
	.clockpicker-popover .popover-title{border-radius: .35rem; padding: 8px 10px;}
	.clockpicker-popover .popover-content{border-radius: .35rem;}
	.clockpicker-popover .text-primary{color: #1ab394;}
	.clockpicker-popover.popover>.arrow {border-width: 11px;}
	.clockpicker-popover.popover>.arrow, .popover>.arrow:after {position: absolute; display: block; width: 0; height: 0; border-color: transparent;border-style: solid;}
	.clockpicker-popover.popover.bottom>.arrow:after { top: 1px; margin-left: -10px; content: " "; border-top-width: 0; border-bottom-color: #fff;}
	.clockpicker-popover.popover>.arrow:after {content: ""; border-width: 10px;}
	.clockpicker-popover.popover.bottom>.arrow {top: -11px; left: 25px; margin-left: -11px; border-top-width: 0; border-bottom-color: #999; border-bottom-color: rgba(0,0,0,.25);}
	.clockpicker-popover .clockpicker-tick{font-size: .7rem!important;}
</style>

<div class="page page-business-time page-js-modal">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left close-popup"></a>
		<h1 class="title">营业时间修改</h1>
		<span id="save">保存</span>
	</header>
	<div class="content">
		<div class="help">请设置营业时间段(最多3个)</div>
		<div class="list-block" id="hour">
			<ul>
				<?php  if(!empty($store['business_hours'])) { ?>
					<?php  if(is_array($store['business_hours'])) { foreach($store['business_hours'] as $hour) { ?>
						<li class="item-content">
							<div class="item-inner">
								<div class="item-title">
									<div id="hour-tpl" class="clockpicker">
										<input type="text" readonly name="business_start_hours[]" class="form-control" placeholder="" value="<?php  echo $hour['s'];?>">
										<span class="input-group-addon">至</span>
										<input type="text" readonly name="business_end_hours[]" class="form-control" placeholder="" value="<?php  echo $hour['e'];?>">
									</div>
								</div>
							</div>
							<span class="delete">
								<i class="icon icon-delete"></i>
							</span>
						</li>
					<?php  } } ?>
				<?php  } else { ?>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">
								<div id="hour-tpl" class="clockpicker">
									<input type="text" readonly name="business_start_hours[]" class="form-control" placeholder="" value="">
									<span class="input-group-addon">至</span>
									<input type="text" readonly name="business_end_hours[]" class="form-control" placeholder="" value="">
								</div>
							</div>
						</div>
						<span class="delete">
							<i class="icon icon-delete"></i>
						</span>
					</li>
				<?php  } ?>
			</ul>
		</div>
		<div class="button-box">
			<a href="javascript:;" id="add-time" class="button">添加营业时间</a>
		</div>
	</div>
</div>
<script type="text/javascript">
require(['clockpicker'], function(){
	$('.clockpicker :text').clockpicker({autoclose: true});

	$('#add-time').click(function(){
		var hour_length = $('#hour .item-content').size();
		if(hour_length < 3) {
			var html =  '<li class="item-content">' +
						'	<div class="item-inner">'+
						'		<div class="item-title">'+
						'			<div id="hour">'+
						'				<div id="hour-tpl" class="clockpicker">'+
						'					<input type="text" readonly name="business_start_hours[]" class="form-control" placeholder="" value="">'+
						'					<span class="input-group-addon">至</span>'+
						'					<input type="text" readonly name="business_end_hours[]" class="form-control" placeholder="" value="">'+
						'				</div>'+
						'			</div>'+
						'		</div>'+
						'	</div>'+
						'	<span class="delete">'+
						'		<i class="icon icon-delete"></i>'+
						'	</span>'+
						'</li>';
			$('#hour ul').append(html);
			$('.clockpicker :text').clockpicker({autoclose: true});
		}
	});

	$(document).on('click', '.item-content .delete', function(){
		$(this).parent().remove();
	});

	$(document).on('click', '#save', function(){
		var business_time = [];
		$('#hour .item-content').each(function(){
			var business_start_hours = $.trim($(this).find(':text[name="business_start_hours[]"]').val());
			var business_end_hours = $.trim($(this).find(':text[name="business_end_hours[]"]').val());
			if(business_start_hours && business_end_hours) {
				business_time.push({
					business_start_hours: business_start_hours,
					business_end_hours: business_end_hours,
				})
			}
		});
		
		var params = {
			business_time: business_time
		}
		
		$.post("<?php  echo imurl('manage/shop/setting/business_time');?>", params, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$.toast(result.message.message);
				$('.confirm .submit').removeClass('disabled');
				return false;
			}
			$.toast('营业时间修改成功', "<?php  echo imurl('manage/shop/setting');?>");
		});
	});
})
</script>