<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">预订时间</h1>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="wx-order-time">
			<ul>
				<li class="wxactive" data-value="<?php  echo date('Y-m-d');?>">
					<p>今天</p>
					<span><?php  echo date('m-d'); ?> <?php  echo date2week(time());?></span>
				</li>
				<li class="" data-value="<?php  echo date('Y-m-d', strtotime('+1 days'));?>">
					<p>明天</p>
					<span><?php  echo date('m-d', strtotime('+1 days')); ?> <?php  echo date2week(strtotime('+1 days'));?></span>
				</li>
				<li style="display: none" data-value="<?php  echo date('Y-m-d', strtotime('+2 days'));?>">
					<p>后天</p>
					<span><?php  echo date('m-d', strtotime('+2 days')); ?> <?php  echo date2week(strtotime('+2 days'));?></span>
				</li>
				<li style="display: none" data-value="<?php  echo date('Y-m-d', strtotime('+3 days'));?>">
					<p><?php  echo date('m-d', strtotime('+3 days')); ?></p>
					<span><?php  echo date2week(strtotime('+3 days'));?></span>
				</li>
				<li style="display: none" data-value="<?php  echo date('Y-m-d', strtotime('+4 days'));?>">
					<p><?php  echo date('m-d', strtotime('+4 days')); ?></p>
					<span><?php  echo date2week(strtotime('+4 days'));?></span>
				</li>
				<li style="display: none" data-value="<?php  echo date('Y-m-d', strtotime('+5 days'));?>">
					<p><?php  echo date('m-d', strtotime('+5 days')); ?></p>
					<span><?php  echo date2week(strtotime('+5 days'));?></span>
				</li>
				<li style="display: none" data-value="<?php  echo date('Y-m-d', strtotime('+6 days'));?>">
					<p><?php  echo date('m-d', strtotime('+6 days')); ?></p>
					<span><?php  echo date2week(strtotime('+6 days'));?></span>
				</li>
			</ul>
		</div>
		<div class="wx-order-con">
			<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
				<section>
					<h5><?php  echo $category['title'];?></h5>
					<p>¥<?php  echo $category['reservation_price'];?>起订</p>
					<ul>
						<?php  if(is_array($reserves[$category['id']])) { foreach($reserves[$category['id']] as $row) { ?>
							<li class="border-red time-point <?php  if(strtotime($row) < time()) { ?>time-disabled<?php  } ?>" data-value="<?php  echo $row;?>" data-cid="<?php  echo $category['id'];?>" data-flag="<?php  if(strtotime($row) < time()) { ?>0<?php  } else { ?>1<?php  } ?>">
								<a href="javascript:;"><?php  echo $row;?></a>
							</li>
						<?php  } } ?>
					</ul>
				</section>
			<?php  } } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var date = $('.wx-order-time li.wxactive').data('value');
		var today = "<?php  echo date('Y-m-d');?>";
		if(date == today) {
			$('.time-disabled').removeClass('border-red').addClass('border-gray');
		}

		$('.wx-order-time li').click(function(){
			$('.wx-order-time li').removeClass('wxactive').hide();
			$(this).prev().css({display: 'table-cell'});
			$(this).next().css({display: 'table-cell'});
			$(this).addClass('wxactive').css({display: 'table-cell'});

			var date = $('.wx-order-time li.wxactive').data('value');
			var today = "<?php  echo date('Y-m-d');?>";
			if(date == today) {
				$('.time-disabled').removeClass('border-red').addClass('border-gray');
			} else {
				$('.time-disabled').addClass('border-red').removeClass('border-gray');
			}
		});

		$('.time-point').click(function(){
			if($(this).hasClass('border-gray')) {
				return false;
			}
			var date = $('.wx-order-time li.wxactive').data('value');
			var time = $(this).data('value');
			var cid = $(this).data('cid');
			location.href = "<?php  echo imurl('wmall/store/reserve/post', array('sid' => $sid))?>" + '&date=' + date + '&time=' + time + '&cid=' + cid;
		});
	});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
