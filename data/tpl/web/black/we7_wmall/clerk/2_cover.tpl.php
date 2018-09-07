<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<h3 class="margin-t-0">电脑端登陆入口</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['wmerchant'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['wmerchant'];?></a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="qrcode-block js-qrcode" data-text="<?php  echo $urls['wmerchant'];?>"></div>
			</div>
		</div>
		<h3 class="margin-t-0">手机注册入口</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['register'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['register'];?></a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="qrcode-block js-qrcode" data-text="<?php  echo $urls['register'];?>"></div>
			</div>
		</div>
		<h3>手机登陆入口</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['login'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['login'];?></a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="qrcode-block js-qrcode" data-text="<?php  echo $urls['login'];?>"></div>
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>