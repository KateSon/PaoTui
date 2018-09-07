<?php defined('IN_IA') or exit('Access Denied');?><link href="../addons/we7_wmall/plugin/diypage/static/css/diy.app.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
	.order-danmu{display: none; background: <?php  echo $config_danmu['css']['background'];?>; opacity: <?php  echo $config_danmu['css']['opacity'];?>;}
	.info{color: <?php  echo $config_danmu['css']['color'];?>;}
	.time{color: <?php  echo $config_danmu['css']['color'];?>;}
</style>
<div class="order-danmu <?php  if($config_danmu['params']['styleType'] == '2') { ?>style2<?php  } ?>">
	<img class="thumb" src="../addons/we7_wmall/plugin/diypage/static/img/1.png" alt="">
	<span class="info">最新订单来自某某某</span>
	<span class="time">刚刚</span>
</div>
<script>
	$(function() {
		$.post("<?php  echo imurl('diypage/danmu');?>", function(result){
			if(result.message.errno == -1) {
				return false;
			}
			var danmu = result.message.message;
			var dm_index = 0;
			function danmu_toast() {
				var data = danmu[dm_index];
				$(".order-danmu").find('.thumb').attr('src', data.avatar);
				$(".order-danmu").find('.info').text('新订单来自 ' + data.nickname);
				$(".order-danmu").find('.time').text(data.time);
				$(".order-danmu").css('display', 'flex');
				$(".order-danmu").fadeIn();
				if(dm_index == danmu.length - 1) {
					dm_index = 0;
				} else {
					dm_index++;
				}
				setTimeout(function(){
					$(".order-danmu").fadeOut(500);
				}, 2000);
				return;
			}
			danmu_toast();
			setInterval(function() {
				danmu_toast();
			}, 5000);
		}, 'json');
	});
</script>
