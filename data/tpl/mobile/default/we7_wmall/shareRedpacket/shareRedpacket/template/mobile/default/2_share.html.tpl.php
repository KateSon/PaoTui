<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'invite') { ?>
<div class="page get-packet">
	<div class="share-page">
		<header class="bar bar-nav bg-black">
			<h1 class="title"><a href="javascript:;" class="back"><i class="icon icon-arrow-left"></i></a><span><?php  echo $redPacket['title'];?></span></h1>
		</header>
	</div>
	<div class="content">
		<div class="platform-ad">
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/shareRedpacket-top.png" alt="">
		</div>
		<div class="active-day">
			<div class="day-picture">
				<img src="<?php  echo tomedia($member['avatar']);?>" alt="">
			</div>
			<p class="day-info">
				Hi,我来<?php  echo $_W['we7_wmall']['config']['mall']['title'];?><?php  echo $days_format;?>了，你也快来吧！
			</p>
		</div>
		<div class="activity-box">
			<div class="activity-info">
				<p>新用户最高可得</p>
				<p class="packet-money">¥<span><?php  echo $redPacket['follow_redpacket_max'];?></span></p>
			</div>
			<div class="user-info">
				<div class="phone-input"><input type="text" name="mobile" placeholder="请输入手机号"></div>
				<div class="captcha clearfix">
					<div class="captcha-input pull-left">
						<input type="text" name="captcha" placeholder="请输入图形验证码">
					</div>
					<img src="<?php  echo imurl('system/common/captcha');?>" class="btn-captcha pull-right" data-href="<?php  echo imurl('system/common/captcha')?>&captcha=" />
				</div>
				<div class="code clearfix">
					<div class="code-input pull-left">
						<input type="text" name="code" placeholder="请输入验证码">
					</div>
					<a href="javascript:;" class="send-code pull-right">获取验证码</a>
				</div>
				<div class="now-get"><a href="javascript:;" id="now-get">立即领取</a></div>
			</div>
			<div class="box-bottom">
				<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/box_bot.png" alt="">
			</div>
			<input type="hidden" name="hidden" value="<?php  echo $uid;?>">
		</div>
	</div>
</div>
<script>
require(['tiny'], function(tiny){
	$('.send-code').click(function(){
		if($(this).hasClass('disabled')) {
			return false;
		}
		var mobile = $.trim($('input[name="mobile"]').val());
		if(!mobile) {
			$.toast('请输入手机号');
			return false;
		}
		var reg = /^[01][345678][0-9]{9}/;
		if(!reg.test(mobile)) {
			$.toast('手机号格式错误');
			return false;
		}
		var captcha = $.trim($('input[name="captcha"]').val());
		if(!captcha) {
			$.toast('请输入图形验证码');
			return false;
		}
		var $this = $(this);
		$this.addClass("disabled");
		var downcount = 60;
		$this.html(downcount + "秒后重新获取");
		var timer = setInterval(function(){
			downcount--;
			if(downcount <= 0){
				clearInterval(timer);
				$this.html("获取验证码");
				$this.removeClass("disabled");
				downcount = 60;
			} else {
				$this.html(downcount + "秒后重新获取");
			}
		}, 1000);

		$.post(tiny.getUrl('system/common/code'), {mobile: mobile, captcha: captcha}, function(data){
			if(data != 'success') {
				$.toast(data);
			} else {
				$.toast('验证码发送成功, 请注意查收');
			}
		});
		return false;
	});
	var uid = "<?php  echo $uid;?>";
	var fansInfo = <?php  echo json_encode($fansInfo);?>;
	$('#now-get').click(function(){
		var $this = $(this);
		if($(this).hasClass('disabled')) {
			return false;
		}
		var mobile = $.trim($('input[name="mobile"]').val());
		if(!mobile) {
			$.toast('请输入手机号');
			return false;
		}
		var reg = /^[01][345678][0-9]{9}/;
		if(!reg.test(mobile)) {
			$.toast('手机号格式错误');
			return false;
		}
		var code = $.trim($('input[name="code"]').val());
		if(!code) {
			$.toast('请输入短信验证码');
			return false;
		}
		var uid = $.trim($('input[name="hidden"]').val());
		$this.addClass("disabled");
		$.post(tiny.getUrl('shareRedpacket/share/invite'), {mobile: mobile, code: code, uid: uid, fans: fansInfo}, function(data){
			$this.removeClass("disabled");
			var result = $.parseJSON(data);
			if(result.message.errno == 0) {
				location.href = "<?php  echo imurl('shareRedpacket/share/success')?>&uid=" + result.message.message;
			} else {
				if(result.message.url) {
					location.href = result.message.url;
					return;
				}
				$.toast(result.message.message);
			}
		});
		return false;
	});
})
</script>
<?php  } ?>

<?php  if($op == 'success') { ?>
<div class="page packet-success">
	<div class="share-page">
		<header class="bar bar-nav bg-black">
			<h1 class="title"><a href="javascript:;" class="back"><i class="icon icon-arrow-left"></i></a><span><?php  echo $redPacket['title'];?></span></h1>
		</header>
	</div>
	<div class="content">
		<div class="platform-ad">
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/shareRedpacket-top.png" alt="">
		</div>
		<div class="getsuccess">
			<p>恭喜你，成功领取了新用户红包</p>
			<p>快去<a href="javascript:;"><?php  echo $_W['we7_wmall']['config']['mall']['title'];?></a>订餐吧</p>
		</div>
		<div class="newuser-share">
			<div class="share-title">新用户专享红包</div>
			<p class="use-limit">仅限首单使用</p>
			<p class="limit-time">有效期<?php  echo $data['follow_redpacket_days_limit'];?>天</p>
			<div class="packet-money">
				¥<span><?php  echo $data['follow_redpacket_discount'];?></span>
			</div>
		</div>
		<div class="use-now">
			<a href="<?php  echo imurl('wmall/home/index');?>">立即使用</a>
		</div>
		<div class="invite">
			<a href="<?php  echo imurl('shareRedpacket/index')?>">邀请好友最高得<?php  echo $redPacket['share_redpacket_max'];?>元</a>
		</div>
		<div class="activity-rule">
			<div class="rule-title">活动规则</div>
			<?php  echo $redPacket['agreement'];?>
		</div>
	</div>
</div>
<?php  } ?>

<?php  if($op == 'repeat') { ?>
<div class="page get-packet">
	<div class="share-page">
		<header class="bar bar-nav bg-black">
			<h1 class="title"><a href="javascript:;" class="back"><i class="icon icon-arrow-left"></i></a><span><?php  echo $redPacket['title'];?></span></h1>
		</header>
	</div>
	<div class="content">
		<div class="platform-ad">
			<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/shareRedpacket-top.png" alt="">
		</div>
		<div class="cannot-get">
			<p class="notice">
				您已经是平台的老朋友啦<br>
				<small class="color-danger">仅限新用户参加</small>
			</p>
		</div>
		<div class="invite clearfix">
			<span class="pull-left"></span>
			<a href="<?php  echo imurl('shareRedpacket/index')?>" class="pull-left">邀请好友,可以各赢大红包哦</a>
			<span class="pull-right"></span>
		</div>
		<a href="<?php  echo imurl('shareRedpacket/index')?>" class="invite-btn">送好友红包，奖励拿不停</a>
	</div>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
