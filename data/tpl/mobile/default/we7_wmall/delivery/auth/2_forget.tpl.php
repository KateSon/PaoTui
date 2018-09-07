<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page page-auth">
	<div class="content">
		<div class="header">
			<div class="logo">
				<img src="<?php  echo tomedia($config_mall['logo']);?>" alt=""/>
			</div>
			<div class="name"><?php  echo $config_mall['title'];?></div>
		</div>
		<div class="list-block">
			<ul>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-phone1"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="number" max="11" name="mobile" placeholder="请输入手机号">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-code"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="number" name="captcha" placeholder="请输入图形验证码">
							</div>
							<img src="<?php  echo imurl('system/common/captcha');?>" class="btn-captcha" data-href="<?php  echo imurl('system/common/captcha')?>&captcha=" />
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-email"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="number" max="6" name="code" placeholder="请输入6位短信验证码">
							</div>
							<a class="item-remark button-code" href="javascript:;">
								获取验证码<i class="icon icon-arrow-right"></i>
							</a>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-lock"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="password" name="password" placeholder="请输入新密码">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content border-1px-b">
						<div class="item-media"><i class="icon icon-lock"></i></div>
						<div class="item-inner">
							<div class="item-input">
								<input type="password" name="repassword" placeholder="请重复输入新密码">
							</div>
						</div>
					</div>
				</li>
			</ul>
			<div class="content-padded">
				<a href="javascript:;" class="button button-big button-fill button-round button-success button-forget">立即找回</a>
			</div>
		</div>
		<div class="text">
			<p>已有账号？<a href="<?php  echo imurl('delivery/auth/login');?>">立即登陆</a></p>
		</div>
	</div>
</div>
<script>
require(['tiny'], function(tiny){
	$('.button-code').click(function(){
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
		var captcha = $.trim($('input[name="captcha"]').val());
		if(!captcha) {
			$.toast('请输入图形验证码');
			return false;
		}
		$this.addClass("disabled");
		$.post(tiny.getUrl('system/common/code'), {mobile: mobile, product: '找回密码', captcha: captcha}, function(data){
			if(data != 'success') {
				$.toast(data);
			} else {
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
				$.toast('验证码发送成功, 请注意查收');
			}
		});
		return false;
	});

	$('.button-forget').click(function(){
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
		var password = $.trim($('input[name="password"]').val());
		if(!password) {
			$.toast('请输入密码');
			return false;
		} else {
			var length = password.length;
			if(length < 8 || length > 20) {
				$.toast("请输入8-20位密码");
				return false;
			}
			var reg = /[0-9]+[a-zA-Z]+[0-9a-zA-Z]*|[a-zA-Z]+[0-9]+[0-9a-zA-Z]*/;
			if(!reg.test(password)) {
				$.toast("密码必须由数字和字母组合");
				return false;
			}
		}
		var repassword = $.trim($('input[name="repassword"]').val());
		if(!repassword) {
			$.toast('请重复输入密码');
			return false;
		}
		if(password != repassword) {
			$.toast('两次密码输入不一致');
			return false;
		}
		$this.addClass("disabled");
		$.post(tiny.getUrl('delivery/auth/forget'), {mobile: mobile, password: password, code: code}, function(data){
			var result = $.parseJSON(data);
			if(!result.message.errno) {
				$.toast('设置新密码成功', result.message.message);
			} else {
				$.toast(result.message.message);
				$this.removeClass("disabled");
			}
		});
		return false;
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>