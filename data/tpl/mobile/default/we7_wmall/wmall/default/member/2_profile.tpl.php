<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page my-page" id="page-app-profile">
<?php  if($ta == 'info') { ?>
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">会员资料</h1>
	</header>
	<?php  if(!is_weixin()) { ?>
		<a class="bar bar-tab text-center logout js-post" href="<?php  echo imurl('wmall/auth/loginout');?>" data-confirm="确定退出当前账号吗??">
			退出当前账号
		</a>
	<?php  } ?>
	<div class="content member-info">
		<div class="list-block border-1px-tb">
			<ul>
				<li class="item-content">
					<a href="javascript:;" class="item-inner border-1px-b">
						<div class="item-title">会员UID</div>
						<div class="item-after"><?php  echo $user['uid'];?></div>
					</a>
				</li>
				<li class="item-content item-link">
					<a href="<?php  echo imurl('wmall/member/profile/bind')?>" class="item-inner border-1px-b">
						<div class="item-title">手机号</div>
						<div class="item-after"><?php  if(!empty($user['mobile'])) { ?><?php  echo $user['mobile'];?><?php  } else { ?>绑定手机号<?php  } ?></div>
					</a>
				</li>
				<li class="item-content item-link">
					<a href="<?php  echo imurl('wmall/member/profile/edit', array('type' => 'username'))?>" class="item-inner border-1px-b">
						<div class="item-title">用户名</div>
						<div class="item-after"><?php  echo $user['realname'];?></div>
					</a>
				</li>
				<li class="item-content item-link">
					<a href="<?php  echo imurl('wmall/member/profile/edit', array('type' => 'account'))?>" class="item-inner">
						<div class="item-title">账号密码</div>
						<div class="item-after">修改</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
<?php  } ?>

<?php  if($ta == 'edit') { ?>
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">修改<?php  if($_GPC['type'] == 'username') { ?>用户名<?php  } else { ?>密码<?php  } ?></h1>
	</header>
	<div class="content member-edit">
		<div class="list-block">
			<ul>
				<?php  if($_GPC['type'] == 'username') { ?>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-input">
								<input type="text" name="realname" placeholder="请输入新的用户名" value="<?php  echo $user['realname'];?>">
							</div>
						</div>
					</div>
				</li>
				<?php  } else if($_GPC['type'] == 'account') { ?>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="password" name="password" placeholder="当前密码">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-input border-1px-b">
								<input type="password" name="newpassword" placeholder="新密码">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-input">
								<input type="password" name="repassword" placeholder="确认新密码">
							</div>
						</div>
					</div>
				</li>
				<?php  } ?>
			</ul>
		</div>
		<div class="content-block">
			<a href="javascript:;" class="button button-big button-fill button-danger" id="btnSubmit">确定</a>
		</div>
	</div>
<?php  } ?>

<?php  if($ta == 'bind') { ?>
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title"><?php  if($user['mobile_audit'] == 1) { ?>更改<?php  } ?>绑定手机号</h1>
	</header>
	<div class="content">
		<div class="list-block">
			<ul>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">手机号</div>
							<div class="item-input">
								<input type="number" max="11" name="mobile" placeholder="请输入手机号" value="<?php  echo $user['mobile'];?>">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">图形验证码</div>
							<div class="item-input">
								<input type="number" name="captcha" placeholder="请输入图形验证码">
							</div>
							<img src="<?php  echo imurl('system/common/captcha');?>" class="btn-captcha" data-href="<?php  echo imurl('system/common/captcha')?>&captcha=" />
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">手机验证码</div>
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
						<div class="item-inner border-1px-b">
							<div class="item-title">登陆密码</div>
							<div class="item-input">
								<input type="password" name="password" placeholder="请输入您的登录密码" class="">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title">确认密码</div>
							<div class="item-input">
								<input type="password" name="repassword" placeholder="请输入确认登录密码" class="">
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="content-block">
			<a href="javascript:;" class="button button-big button-fill button-danger button-bind">立即绑定</a>
		</div>
	</div>
<?php  } ?>
</div>
<script>
require(['tiny'], function(tiny){
	$('.button-code').click(function(){
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

	$('.button-bind').click(function(){
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
		$.post(tiny.getUrl('wmall/member/profile/bind'), {mobile: mobile, password: password, repassword: repassword, code: code}, function(result){
			var result = $.parseJSON(result);
			if(result.message.errno != 0) {
				$.toast(result.message.message);
			} else {
				$.toast(result.message.message);
				location.href = "<?php  echo imurl('wmall/member/mine')?>";
			}
		});
	});
});
$(function(){
	$('#btnSubmit').click(function(){
		var type = "<?php  echo $_GPC['type'];?>";
		var realname = $.trim($(":text[name='realname']").val());
		var password = $.trim($(":password[name='password']").val());
		var newpassword = $.trim($(":password[name='newpassword']").val());
		var repassword = $.trim($(":password[name='repassword']").val());
		if(type == 'username') {
			if(!realname) {
				$.toast("用户名不能为空");
				return false;
			}
			$.post("<?php  echo imurl('wmall/member/profile/edit', array('type' => $type))?>", {'realname': realname}, function(result){
				var result = $.parseJSON(result);
				if(result.message.errno != 0) {
					$.toast(result.message.message);
				} else {
					$.toast(result.message.message);
					location.href = "<?php  echo imurl('wmall/member/profile/info')?>";
				}
			})
		} else if(type == 'account') {
			if(!password) {
				$.toast("密码不能为空");
				return false;
			}
			if(!newpassword) {
				$.toast('请输入密码');
				return false;
			} else {
				var length = newpassword.length;
				if(length < 8 || length > 20) {
					$.toast("请输入8-20位密码");
					return false;
				}
				var reg = /[0-9]+[a-zA-Z]+[0-9a-zA-Z]*|[a-zA-Z]+[0-9]+[0-9a-zA-Z]*/;
				if(!reg.test(newpassword)) {
					$.toast("密码必须由数字和字母组合");
					return false;
				}
			}
			if(!repassword) {
				$.toast("请确认密码");
				return false;
			}
			if(repassword != newpassword) {
				$.toast("两次输入的密码不一致");
				return false;
			}
			$.post("<?php  echo imurl('wmall/member/profile/edit', array('type' => $type))?>", {'password': password, 'newpassword': newpassword, 'repassword': repassword}, function(result){
				var result = $.parseJSON(result);
				if(result.message.errno != 0) {
					$.toast(result.message.message);
				} else {
					$.toast(result.message.message);
					location.href = "<?php  echo imurl('wmall/member/profile/info')?>";
				}
			})
		}
	})
})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>