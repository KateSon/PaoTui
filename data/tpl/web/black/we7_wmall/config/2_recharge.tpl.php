<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>充值</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="recharge" value=""/>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline radio-primary">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($recharge['status'] == 1 || empty($recharge['status'])) { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline radio-primary">
					<input type="radio" value="2" name="status" id="status-2" <?php  if($recharge['status'] == 2) { ?>checked<?php  } ?>>
					<label for="status-2">关闭</label>
				</div>
			</div>
		</div>
		<div id="recharge-container"></div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<a href="javascript:;" class="btn btn-default btn-sm btn-add"><i class="fa fa-plus"></i> 添加优惠</a>
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
<script type="text/html" id="recharge-item">
<{# for(var i in d){ }>
	<{# if(!d[i]) {continue;} }>
	<div class="form-group recharge-item" data-key="<{i}>">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">充值优惠</label>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon">充</span>
				<input type="text" name="charge[]" value="<{d[i].charge}>" class="form-control bind-charge">
				<span class="input-group-addon">元</span>
				<span class="input-group-addon">送</span>
				<input type="text" name="back[]" value="<{d[i].back}>" class="form-control bind-back">
				<div class="input-group-btn dropdown">
					<a href="javascript:;" class="btn btn-default" data-toggle="dropdown">
						<{# if(d[i].type == 'credit1') { }>
							<span class="bind-type" data-bind="type" data-type="credit1"> 积分 </span>
						<{# } else { }>
							<span class="bind-type" data-bind="type" data-type="credit2"> 余额 </span>
						<{# } }>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li data-key="<{i}>" data-type="credit2"><a href="javascript:;">余额 &nbsp;&nbsp;</a></li>
						<li data-key="<{i}>" data-type="credit1"><a href="javascript:;">积分</a></li>
					</ul>
					<a href="javascript:;" class="btn btn-danger btn-del" data-key="<{i}>">删除</a>
				</div>
			</div>
		</div>
	</div>
<{# } }>
</script>
<script>
irequire(['laytpl'], function(laytpl){
	var recharge = {
		items: [],
		index: -1
	};

	recharge.init = function(params){
		if(params.items && params.items.length > 0) {
			recharge.items = params.items;
			recharge.tplRecharge();
		}

		$(document).on('click', '.btn-add', function(){
			recharge.items.push({
				charge: '',
				back: '',
				type: 'credit2'
			});
			recharge.tplRecharge();
		});

		$(document).on('click', '.btn-del', function(){
			var $this = $(this);
			Notify.confirm('确定删除该充值优惠?',  function(){
				var index = $this.data('key');
				delete(recharge.items[index]);
				recharge.tplRecharge();
			});
		});

		$(document).on('click', '.dropdown-menu>li', function(){
			var index = $(this).data('key');
			if(!recharge.items[index]) {
				return;
			}
			recharge.items[index].type = $(this).data('type');

			recharge.tplRecharge();
		});
	};

	recharge.tplRecharge = function() {
		$('.recharge-item').each(function(){
			var $this = $(this);
			var index = $(this).data('key');
			if(!recharge.items[index]) {
				return;
			}
			var type = recharge.items[index].type;
			recharge.items[index] = {
				charge: $this.find('.bind-charge').val(),
				back: $this.find('.bind-back').val(),
				type: type ? type : $this.find('.bind-type').attr('data-type')
			};
			if(!recharge.items[index].type) {
				recharge.items[index].type = 'credit2';
			}
		});

		var html = $('#recharge-item').html();
		laytpl(html).render(recharge.items, function(html){
			$('#recharge-container').html(html);
			$(':hidden[name="recharge"]').val('');
			if(recharge.items.length > 0) {
				$(':hidden[name="recharge"]').val(JSON.stringify(recharge.items));
			}
		});
	};

	recharge.init({
		items: <?php  echo json_encode($recharge['items']);?>
	});

	$('#form1').submit(function(){
		$(this).attr('stop', 1);
		recharge.tplRecharge();
		$(this).attr('stop', 0);
		return true;
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
