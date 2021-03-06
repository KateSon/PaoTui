<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2><?php  echo $_W['page']['title'];?></h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-warning">开启此功能需要先开启短信功能并正确配置AppKey和AppSecret,<a href="<?php  echo iurl('config/sms/set');?>" target="_blank">现在去配置>></a></div>
		<h3>店员语音通知</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">开启电话通知店员功能</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="clerk[status]" id="clerk-status-1" <?php  if($sms['clerk']['status'] == 1) { ?>checked<?php  } ?>>
					<label for="clerk-status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="clerk[status]" id="clerk-status-0" <?php  if(!$sms['clerk']['status']) { ?>checked<?php  } ?>>
					<label for="clerk-status-0">关闭</label>
				</div>
				<div class="help-block">
					<span class="text-danger">开启此功能需要先开启短信功能并正确配置AppKey和AppSecret</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">语音通知模板</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="clerk[tts_code]" value="<?php  echo $sms['clerk']['tts_code'];?>">
				<span class="help-block">语音通知模板,请到大鱼平台申请. </span>
				<span class="help-block">
					<strong class="text-danger">模板标题: 新外卖订单通知</strong>
					<br>
					<strong class="text-danger">模板内容: 您好${name},您的店铺${store},有新的订单,订单总金额${price}元,请及时处理</strong>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">来电号码</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="clerk[called_show_num]" value="<?php  echo $sms['clerk']['called_show_num'];?>">
				<span class="help-block">传入的显示号码必须是阿里大鱼“管理中心-号码管理”中申请或购买的号码. </span>
			</div>
		</div>
		<h3>外卖订单配送员语音通知</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">开启电话通知配送员功能</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="deliveryer[status]" id="deliveryer-status-1" <?php  if($sms['deliveryer']['status'] == 1) { ?>checked<?php  } ?>>
					<label for="deliveryer-status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="deliveryer[status]" id="deliveryer-status-0" <?php  if(!$sms['deliveryer']['status']) { ?>checked<?php  } ?>>
					<label for="deliveryer-status-0">关闭</label>
				</div>
				<div class="help-block">
					<span class="text-danger">开启此功能需要先开启短信功能并正确配置AppKey和AppSecret</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">语音通知模板</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="deliveryer[tts_code]" value="<?php  echo $sms['deliveryer']['tts_code'];?>">
				<span class="help-block">语音通知模板,请到大鱼平台申请. </span>
				<span class="help-block">
					<strong class="text-danger">模板标题: 新外卖配送订单通知</strong>
					<br>
					<strong class="text-danger">模板内容: 您好${name}, 门店${store}有新的配送订单,快去抢单吧</strong>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">来电号码</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="deliveryer[called_show_num]" value="<?php  echo $sms['deliveryer']['called_show_num'];?>">
				<span class="help-block">传入的显示号码必须是阿里大鱼“管理中心-号码管理”中申请或购买的号码. </span>
			</div>
		</div>
		<?php  if(check_plugin_perm('errander')) { ?>
			<h3>跑腿订单配送员语音通知</h3>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">开启电话通知配送员功能</label>
				<div class="col-sm-9 col-xs-12">
					<div class="radio radio-inline">
						<input type="radio" value="1" name="errander_deliveryer[status]" id="errander-deliveryer-status-1" <?php  if($sms['errander_deliveryer']['status'] == 1) { ?>checked<?php  } ?>>
						<label for="errander-deliveryer-status-1">开启</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" value="0" name="errander_deliveryer[status]" id="errander-deliveryer-status-0" <?php  if(!$sms['errander_deliveryer']['status']) { ?>checked<?php  } ?>>
						<label for="errander-deliveryer-status-0">关闭</label>
					</div>
					<div class="help-block">
						<span class="text-danger">开启此功能需要先开启短信功能并正确配置AppKey和AppSecret</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">语音通知模板</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="errander_deliveryer[tts_code]" value="<?php  echo $sms['errander_deliveryer']['tts_code'];?>">
					<span class="help-block">语音通知模板,请到大鱼平台申请. </span>
					<span class="help-block">
						<strong class="text-danger">模板标题: 新跑腿配送订单通知</strong>
						<br>
						<strong class="text-danger">模板内容: 您好${name},平台有新的配送订单,本单可收益${deliveryer_fee}元,快去抢单吧</strong>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">来电号码</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="errander_deliveryer[called_show_num]" value="<?php  echo $sms['errander_deliveryer']['called_show_num'];?>">
					<span class="help-block">传入的显示号码必须是阿里大鱼“管理中心-号码管理”中申请或购买的号码. </span>
				</div>
			</div>
		<?php  } ?>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
