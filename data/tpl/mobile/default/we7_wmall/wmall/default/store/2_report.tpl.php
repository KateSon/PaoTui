<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page report">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">举报商家</h1>
		<button class="button button-link button-nav pull-right" id="btnSubmit">提交</button>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="list-block">
			<ul class="border-1px-tb">
				<li>
					<label class="border-1px-b"><i class="icon icon-info-circle"></i> 举报商家：<?php  echo $store['title'];?></label>
				</li>
				<?php  if(is_array($reports)) { foreach($reports as $report) { ?>
					<li>
						<label class="label-checkbox item-content border-1px-b">
							<input type="radio" name="title" checked value="<?php  echo $report;?>">
							<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
							<div class="item-inner">
								<div class="item-title-row">
									<div class="item-title"><?php  echo $report;?></div>
								</div>
							</div>
						</label>
					</li>
				<?php  } } ?>
			</ul>
		</div>
		<div class="list-block report-msg border-1px-tb">
			<textarea placeholder="必填。描述详细。" name="note"></textarea>
		</div>
		<div class="content-block-title">有图有真相</div>
		<?php  echo tpl_mutil_image('images', '', 3);?>
		<div class="content-block-title">手机号,仅平台管理员可见</div>
		<div class="report-phone border-1px-tb">
			<input type="text" name="mobile" value="<?php  echo $_W['member']['mobile'];?>" placeholder="手机号码：仅平台管理员可见">
		</div>
	</div>
</div>
<script>
require(['store'], function(store){
	store.initReport({
		sid: "<?php  echo $sid;?>"
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>