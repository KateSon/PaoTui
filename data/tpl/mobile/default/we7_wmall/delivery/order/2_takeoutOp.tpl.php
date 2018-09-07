<?php defined('IN_IA') or exit('Access Denied');?><?php  if($type == 'transfer') { ?>
	<div class="page page-js-modal">
		<header class="bar bar-nav common-bar-nav">
			<h1 class="title">转单理由</h1>
			<a class="pull-right close-popup" href="javascript:;">取消</a>
		</header>
		<div class="content">
			<div class="list-block">
				<ul class="border-1px-tb padding-15px-lr">
					<?php  if(is_array($reasons)) { foreach($reasons as $reason) { ?>
					<li>
						<label class="label-checkbox item-content border-1px-t">
							<input type="radio" name="reason" checked="" value="<?php  echo $reason;?>">
							<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
							<div class="item-inner">
								<div class="item-title-row">
									<div class="item-title"><?php  echo $reason;?></div>
								</div>
							</div>
						</label>
					</li>
					<?php  } } ?>
					<li>
						<label class="label-checkbox item-content border-1px-t">
							<input type="radio" name="reason" checked="" value="其他原因">
							<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
							<div class="item-inner">
								<div class="item-title-row">
									<div class="item-title">其他原因</div>
								</div>
							</div>
						</label>
					</li>
				</ul>
				<div class="content-padded">
					<a href="<?php  echo imurl('delivery/order/takeout/delivery_transfer', array('id' => $id, 'reason' => '其他原因'))?>" class="button button-big button-fill button-success button-transfer js-post" data-confirm="确定申请转单吗?">确定转单</a>
				</div>
			</div>
		</div>
	</div>
	<script>
		$.modal.prototype.defaults.closePrevious = false;
		var url_temp = "<?php  echo imurl('delivery/order/takeout/delivery_transfer', array('id' => $id))?>&reason=";
		$('.label-checkbox').click(function(){
			var reason = $(this).find(':radio').val();
			var url = url_temp + reason;
			$('.button-transfer').attr('href', url);
			return;
		});
	</script>
<?php  } ?>