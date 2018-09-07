<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>.form-group.become{display: none;}</style>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data" style="max-width: 100%">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" <?php  if($_GPC['type'] == 'basic' || !$_GPC['type']) { ?>class="active"<?php  } ?>><a href="#basic" aria-controls="basic" role="tab" data-toggle="pill">基本</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'relate') { ?>class="active"<?php  } ?>><a href="#relate" aria-controls="relate" role="tab" data-toggle="pill">上下线关系及推广资格</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'settle') { ?>class="active"<?php  } ?>><a href="#settle" aria-controls="settle" role="tab" data-toggle="pill">结算</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'template') { ?>class="active"<?php  } ?>><a href="#template" aria-controls="template" role="tab" data-toggle="pill">样式/文字</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'protocol') { ?>class="active"<?php  } ?>><a href="#protocol" aria-controls="protocol" role="tab" data-toggle="pill">申请协议</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane <?php  if($_GPC['type'] == 'basic' || !$_GPC['type']) { ?>active<?php  } ?>" role="tabpanel" id="basic">
				<h3>基本</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">推广层级</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="level" id="level-0" value="0" <?php  if(!$basic['level']) { ?>checked<?php  } ?>>
							<label for="level-0">不开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="level" id="level-1" value="1" <?php  if($basic['level'] == 1) { ?>checked<?php  } ?>>
							<label for="level-1">一级推广</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="level" id="level-2" value="2" <?php  if($basic['level'] == 2) { ?>checked<?php  } ?>>
							<label for="level-2">二级推广</label>
						</div>
						<span class="help-block">默认佣金比例请到【推广员等级】进行设置</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">在会员中心显示推广菜单</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="show_in_mine" id="show-in-mine-0" value="0" <?php  if(!$basic['show_in_mine']) { ?>checked<?php  } ?>>
							<label for="show-in-mine-0">不显示</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="show_in_mine" id="show-in-mine-1" value="1" <?php  if($basic['show_in_mine'] == 1) { ?>checked<?php  } ?>>
							<label for="show-in-mine-1">显示</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">菜单名称</label>
					<div class="col-sm-9 col-xs-9 col-md-5">
						<input type="text" class="form-control" name="menu_name" value="<?php  echo $basic['menu_name'];?>">
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'relate') { ?>active<?php  } ?>" role="tabpanel" id="relate">
				<h3>推广员资格设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">成为推广员条件</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="become" id="become-0" value="0" <?php  if(!$relate['become']) { ?>checked<?php  } ?> onclick="$('.become').hide();">
							<label for="become-0">无条件</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="become" id="become-1" value="1" <?php  if($relate['become'] == 1) { ?>checked<?php  } ?> onclick="$('.become').hide();$('.become-1').show();">
							<label for="become-1">申请</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="become" id="become-2" value="2" <?php  if($relate['become'] == 2) { ?>checked<?php  } ?> onclick="$('.become').hide();$('.become-2').show();">
							<label for="become-2">消费次数</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="become" id="become-3" value="3" <?php  if($relate['become'] == 3) { ?>checked<?php  } ?> onclick="$('.become').hide();$('.become-3').show();">
							<label for="become-3">消费金额</label>
						</div>
					</div>
				</div>
				<div class="form-group become become-1" <?php  if($relate['become'] == 1) { ?>style="display: block"<?php  } ?>>
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">显示申请协议</label>
					<div class="col-sm-9 col-xs-9 col-md-5">
						<div class="radio radio-inline">
							<input type="radio" name="open_protocol" id="open_protocol-0" value="0" <?php  if(!$relate['open_protocol']) { ?>checked<?php  } ?>>
							<label for="open_protocol-0">隐藏</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="open_protocol" id="open_protocol-1" value="1" <?php  if($relate['open_protocol'] == 1) { ?>checked<?php  } ?>>
							<label for="open_protocol-1">显示</label>
						</div>
					</div>
				</div>
				<div class="form-group become become-2" <?php  if($relate['become'] == 2) { ?>style="display: block"<?php  } ?>>
					<label class="col-xs-12 col-sm-2 col-md-1 control-label"></label>
					<div class="col-sm-9 col-xs-9 col-md-5">
						<div class="input-group">
							<span class="input-group-addon">消费达到</span>
							<input type="number" class="form-control" name="become_ordercount" value="<?php  echo $relate['become_ordercount'];?>" digits="true">
							<span class="input-group-addon">次</span>
						</div>
						<span class="help-block">仅计算已完成的订单</span>
					</div>
				</div>
				<div class="form-group become become-3" <?php  if($relate['become'] == 3) { ?>style="display: block"<?php  } ?>>
					<label class="col-xs-12 col-sm-2 col-md-1 control-label"></label>
					<div class="col-sm-9 col-xs-9 col-md-5">
						<div class="input-group">
							<span class="input-group-addon">消费达到</span>
							<input type="number" class="form-control" name="become_moneycount" value="<?php  echo $relate['become_moneycount'];?>" digits="true">
							<span class="input-group-addon">元</span>
						</div>
						<span class="help-block">仅计算已完成的订单</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">是否需要审核</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="become_check" id="become_check-1" value="1" <?php  if($relate['become_check'] == 1) { ?>checked<?php  } ?>>
							<label for="become_check-1">需要</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="become_check" id="become_check-0" value="0" <?php  if(!$relate['become_check']) { ?>checked<?php  } ?>>
							<label for="become_check-0">不需要</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">推广员等级升级依据</label>
					<div class="col-sm-5 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" name="group_update_mode" id="group_update_mode-order_money" value="order_money" <?php  if(!$relate['group_update_mode'] || $relate['group_update_mode'] == 'order_money') { ?>checked<?php  } ?>>
							<label for="group_update_mode-order_money">推广订单总额(完成的订单)</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="group_update_mode" id="group_update_mode-order_money_1" value="order_money_1" <?php  if($relate['group_update_mode'] == 'order_money_1') { ?>checked<?php  } ?>>
							<label for="group_update_mode-order_money_1">一级推广订单金额(完成的订单)</label>
						</div>
						<br/>
						<div class="radio radio-inline">
							<input type="radio" name="group_update_mode" id="group_update_mode-order_count" value="order_count" <?php  if($relate['group_update_mode'] == 'order_count') { ?>checked<?php  } ?>>
							<label for="group_update_mode-order_count">推广订单总数(完成的订单)</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="group_update_mode" id="group_update_mode-order_count_1" value="order_count_1" <?php  if($relate['group_update_mode'] == 'order_count_1') { ?>checked<?php  } ?>>
							<label for="group_update_mode-order_count_1">一级推广订单总数(完成的订单)</label>
						</div>
						<br/>
						<div class="radio radio-inline">
							<input type="radio" name="group_update_mode" id="group_update_mode-self_order_money" value="self_order_money" <?php  if($relate['group_update_mode'] == 'self_order_money') { ?>checked<?php  } ?>>
							<label for="group_update_mode-self_order_money">自购订单金额(完成的订单)</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="group_update_mode" id="group_update_mode-self_order_count" value="self_order_count" <?php  if($relate['group_update_mode'] == 'self_order_count') { ?>checked<?php  } ?>>
							<label for="group_update_mode-self_order_count">自购订单数量(完成的订单)</label>
						</div>
						<br/>
						<div class="radio radio-inline">
							<input type="radio" name="group_update_mode" id="group_update_mode-down_count" value="down_count" <?php  if($relate['group_update_mode'] == 'down_count') { ?>checked<?php  } ?>>
							<label for="group_update_mode-down_count">下线总人数</label>
						</div>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						<div class="radio radio-inline">
							<input type="radio" name="group_update_mode" id="group_update_mode-down_count_1" value="down_count_1" <?php  if($relate['group_update_mode'] == 'down_count_1') { ?>checked<?php  } ?>>
							<label for="group_update_mode-down_count_1">一级总人数</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">推广员升级说明</label>
					<div class="col-sm-5 col-xs-12">
						<textarea name="upgrade_explain" id="" cols="30" rows="10"><?php  echo $upgrade_explain;?></textarea>
					</div>
				</div>
				<h3>上下线关系设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">成为下线条件</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="become_child" id="become_child-0" value="0" <?php  if(!$relate['become_child']) { ?>checked<?php  } ?>>
							<label for="become_child-0">首次点击分享链接</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="become_child" id="become_child-1" value="1" <?php  if($relate['become_child'] == 1) { ?>checked<?php  } ?>>
							<label for="become_child-1">首次下单并确认收货</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="become_child" id="become_child-2" value="2" <?php  if($relate['become_child'] == 2) { ?>checked<?php  } ?>>
							<label for="become_child-2">首次下单确认收货并进行评价</label>
						</div>
						<span class="help-block">首次点击分享链接：只要粉丝点击您分享的链接，即可成为您的下线</span>
						<span class="help-block">
							首次完成下单：粉丝点击您分享的链接,需要在平台下单并在订单完成进行评价后才能成为您的下线。
						</span>
						<span class="help-block">
							<span class="text-danger">注意:在"首次完成下单"模式下,因粉丝可能会点击推广员的链接,系统以粉丝最后点击的推广员链接为准。所以在把链接分享给粉丝后,应提醒粉丝尽快下单并评价</span>
						</span>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'settle') { ?>active<?php  } ?>" role="tabpanel" id="settle">
				<h3>结算</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">提现渠道</label>
					<div class="col-sm-5 col-xs-12">
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="cashcredit[]" id="cashcredit-1" value="credit2" <?php  if(in_array('credit2', $settle['cashcredit'])) { ?>checked<?php  } ?>>
							<label for="cashcredit-1">提现到余额</label>
						</div>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="cashcredit[]" id="cashcredit-2" value="wechat" <?php  if(in_array('wechat', $settle['cashcredit'])) { ?>checked<?php  } ?>>
							<label for="cashcredit-2">提现到微信钱包</label>
						</div>
						<span class="help-block">提示: 提现方式支持多选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">最低提现额度</label>
					<div class="col-sm-5 col-xs-12">
						<input type="text" class="form-control" name="withdraw" value="<?php  echo $settle['withdraw'];?>" required="true">
						<span class="help-block">推广员的佣金达到此额度时才能提现,最低1元</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">佣金个人所得税</label>
					<div class="col-sm-9 col-xs-9 col-md-5">
						<div class="input-group">
							<input type="number" class="form-control" name="withdrawcharge" value="<?php  echo $settle['withdrawcharge'];?>" digits="true">
							<span class="input-group-addon">%</span>
						</div>
						<span class="help-block">佣金提现时,扣除的个人所得税.空为不扣除个人所得税</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">结算时间点</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="balance_condition" id="balance_condition-1" value="1" <?php  if($settle['balance_condition'] == 1 || empty($settle['balance_condition'])) { ?>checked<?php  } ?>>
							<label for="balance_condition-1">顾客确认收货</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="balance_condition" id="balance_condition-2" value="2" <?php  if($settle['balance_condition'] == 2) { ?>checked<?php  } ?>>
							<label for="balance_condition-2">顾客确认收货并进行评价</label>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'template') { ?>active<?php  } ?>" role="tabpanel" id="template">
				<h3>样式/文字</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">注册头部页面</label>
					<div class="col-sm-5 col-xs-12">
						<div class="input-group">
							<input class="form-control input-sm diy-bind" data-bind="thumb" data-placeholder="" placeholder="" value="<?php  echo $template['avatar'];?>" id="thumbsrc" name="avatar" />
							<span data-input="#thumbsrc" data-element="#thumbimg" class="input-group-addon btn btn-default js-selectImg">选择图片</span>
						</div>
						<div class="input-group margin-t-5">
							<img src="<?php  echo tomedia($template['avatar'])?>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" class="img-responsive img-thumbnail" width="150" id="thumbimg">
							<em class="close" title="删除这张图片" onclick="$('#thumbsrc').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
						</div>
						<br>
						<br>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'protocol') { ?>active<?php  } ?>" role="tabpanel" id="protocol">
				<h3>申请协议</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">协议内容</label>
					<div class="col-sm-5 col-xs-12">
						<textarea name="protocol" id="" cols="30" rows="10"><?php  echo $protocol;?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="alert alert-info">
					注意:在使用推广功能之前,可能您的平台已经有顾客成功下单,如果您希望将已经成功下单顾客的推广员固定,可点击以下按钮就行固定。固定后,顾客扫描推广员的海报二维码时,不会成为该推广员的下线。
					<br>
					注意:此功能仅能固定 在没有成为任何推广员的下线之前已经成功下单的顾客。
				</div>
				<a href="<?php  echo iurl('spread/fixed');?>" class="btn btn-danger js-post" data-confirm="确定将已成功下单顾客的推广员固定？">将已成功下单顾客的推广员固定</a>
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>