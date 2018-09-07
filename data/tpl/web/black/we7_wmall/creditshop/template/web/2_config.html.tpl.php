<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<h3>基本设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($config['status'] == '1' || empty($config['status'])) { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="status" id="status-0" <?php  if($config['status'] == '0') { ?>checked<?php  } ?>>
					<label for="status-0">关闭</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">兑吧AppKey</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="appkey" value="<?php  echo $config['appkey'];?>" class="form-control" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">兑吧App Secret</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="appsecret" value="<?php  echo $config['appsecret'];?>" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">直达页面接口</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static text-primary js-clip" data-text="<?php  echo $urls['enter'];?>"><?php  echo $urls['enter'];?></p>
				<span class="help-block">
					复制该以上地址填写到"兑吧"=="配置"=="接口配置"=="直达页面接口"
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">积分消费</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static text-primary js-clip" data-text="<?php  echo $urls['consume'];?>"><?php  echo $urls['consume'];?></p>
				<span class="help-block">
					复制该以上地址填写到"兑吧"=="配置"=="接口配置"=="积分消费"
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">通知结果</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static text-primary js-clip" data-text="<?php  echo $urls['notice'];?>"><?php  echo $urls['notice'];?></p>
				<span class="help-block">
					复制该以上地址填写到"兑吧"=="配置"=="接口配置"=="通知结果"
				</span>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
