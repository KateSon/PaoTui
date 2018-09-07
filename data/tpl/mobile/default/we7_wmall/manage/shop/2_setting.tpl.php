<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
	.store-index .list-block .item-link>a{display: inline-block; width: 100%;}
	.store-index .list-block .item-after.business-time{max-width: 10rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: inline-block;}
</style>
<div class="page store-index" id="page-manage-store-index">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back"></a>
		<h1 class="title">店铺管理</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="list-block media-list">
			<ul>
				<li class="store-title border-1px-b">
					<a href="javascript:;" class="item-content">
						<div class="item-media"><img src="<?php  echo tomedia($store['logo']);?>" style='width: 3rem;'></div>
						<div class="item-inner">
							<div class="item-title-row">
								<div class="item-title"><?php  echo $store['title'];?></div>
							</div>
						</div>
					</a>
				</li>
			</ul>
			<ul style="border-top: 0">
				<li class="business-hours">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title">店铺状态</div>
							<div class="item-after">
								<label class="label-switch switch-sm invoice-status">
									<input type="checkbox" class="js-checkbox" data-href="<?php  echo imurl('manage/shop/setting/business_status', array('id' => $store['id']));?>" name="is_in_business" value="1" <?php  if($store['is_in_business'] == 1) { ?>checked<?php  } ?>>
									<div class="checkbox"></div>
								</label>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="list-block">
			<ul>
				<li class="item-content item-link">
					<a href="<?php  echo imurl('manage/shop/setting/business_time')?>" class="js-modal" >
						<div class="item-inner">
							<div class="item-title">营业时间</div>
							<div class="item-after business-time"><?php  echo $store['business_hours_cn'];?></div>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>