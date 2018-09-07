<?php defined('IN_IA') or exit('Access Denied');?><div class="modal modal-no-buttons delivery-time-modal not-remove">
	<div class="modal-inner">
		<div class="modal-title">
			<div>请选择送达时间</div>
		</div>
		<div class="modal-text">
			<div class="category-container">
				<div class="parent-category" id="delivery-time-parent">
					<ul>
						<?php  if(is_array($delivery_time['days'])) { foreach($delivery_time['days'] as $i => $day) { ?>
							<li <?php  if(!$i) { ?>class="active"<?php  } ?> data-value="<?php  echo $day;?>"><a href="javascript:;"><?php  echo $day;?></a></li>
						<?php  } } ?>
					</ul>
				</div>
				<div class="children-category" id="delivery-time-children">
					<div class="children-category-wrapper">
						<ul id="category1">
							<?php  if($time_flag == 1) { ?>
								<li data-value="尽快送达" data-id="<?php  echo $predict_index;?>" data-extra-price="<?php  echo $predict_extra_price;?>" class="time-flag active"><a href="javascript:;"><?php  echo $text_time;?> <span>(<?php  echo $predict_delivery_price;?>)</span></a></li>
								<li class="delivery-tips time-flag">约<?php  echo $predict_time;?>送达</li>
							<?php  } ?>
							<?php  if(is_array($delivery_time['times'])) { foreach($delivery_time['times'] as $i => $time) { ?>
								<li data-value="<?php  echo $time['start'];?> ~ <?php  echo $time['end'];?>" data-id="<?php  echo $i;?>" data-extra-price="<?php  echo $time['fee'];?>" class="<?php  if($time['timestamp'] <= TIMESTAMP) { ?>hide init-hide<?php  } ?>">
									<a href="javascript:;"><?php  echo $time['start'];?>~<?php  echo $time['end'];?> <span>(<?php  echo $time['delivery_price_cn'];?>)</span></a>
								</li>
							<?php  } } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-no-buttons modal-notice modal-delivery-fee">
	<div class="modal-inner">
		<div class="modal-title">
			<div>计价细则</div>
		</div>
		<div class="modal-text">
			<div class="notice">
				<?php  echo $category['start_km'];?>千米内<?php  if($category['weight_fee_status'] == 1) { ?>，<?php  echo $category['weight_fee']['start_weight'];?>千克内<?php  } ?>，收取<?php  echo $category['start_fee'];?>元配送费 <br>
				<?php  if($category['pre_km'] > 0) { ?>
					<?php  echo $category['start_km'];?>千米以上，每增加<?php  echo $category['pre_km'];?>千米，多收取<?php  echo $category['pre_km_fee'];?>元 <br>
				<?php  } ?>
				特殊时间额外配送费<span id="extra_fee"><?php  echo $predict_extra_price;?></span>元
			</div>
			<a href="javascript:;" onclick="$.icloseModal('.modal-notice', true);" class="button button-big button-fill button-danger close-modal">我知道了</a>
		</div>
	</div>
</div>

<div class="popup popup-select-buy-address">
	<div class="page select-address">
		<header class="bar bar-nav common-bar-nav">
			<a class="pull-left close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<h1 class="title">选择购买地址</h1>
		</header>
		<div class="content">
			<div class="list-block">
				<ul class="border-1px-tb">
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-input">
									<input type="text" id="serach-key" placeholder="请输入购买地址">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div id="search-result" class="hide">
				<div class="content-block-title">搜索结果</div>
				<div class="list-block media-list">
					<ul class="border-1px-tb"></ul>
				</div>
			</div>
			<div id="history-address">
				<?php  if(!empty($serves['available'])) { ?>
				<div class="content-block-title">可用服务地址</div>
				<div class="list-block media-list">
					<ul class="border-1px-tb">
						<?php  if(is_array($serves['available'])) { foreach($serves['available'] as $row) { ?>
						<li>
							<div class="item-inner border-1px-b available-address-item" data-id="<?php  echo $row['id'];?>" data-address="<?php  echo $row['address'];?>" data-name="<?php  echo $row['name'];?>" data-number="<?php  echo $row['number'];?>" data-location_x="<?php  echo $row['location_x'];?>" data-location_y="<?php  echo $row['location_y'];?>">
								<div class="item-title-row">
									<div class="item-title">
										<i class="icon icon-lbs"></i>
										<?php  echo $row['address'];?> ~ <?php  echo $row['number'];?>
									</div>
									<div class="item-after"></div>
								</div>
								<div class="item-text"><?php  echo $row['name'];?></div>
							</div>
						</li>
						<?php  } } ?>
					</ul>
				</div>
				<?php  } ?>
			</div>
		</div>
	</div>
</div>

<div class="popup popup-select-start-address">
	<div class="page select-address">
		<header class="bar bar-nav common-bar-nav">
			<a class="pull-left close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<h1 class="title">选择取货地址</h1>
			<a class="pull-right edit-address" data-input="start_address_id" data-id="0" href="javascript:;">新增</a>
		</header>
		<div class="content">
			<?php  if(!empty($addresses['available'])) { ?>
			<div class="content-block-title">可选取货地址</div>
			<div class="list-block media-list">
				<ul class="border-1px-tb">
					<?php  if(is_array($addresses['available'])) { foreach($addresses['available'] as $address) { ?>
					<li>
						<div class="item-inner border-1px-b available-address-item" data-id="<?php  echo $address['id'];?>" data-address="<?php  echo $address['address'];?>" data-name="<?php  echo $address['name'];?>" data-realname="<?php  echo $address['realname'];?>" data-sex="<?php  echo $address['sex'];?>" data-mobile="<?php  echo $address['mobile'];?>" data-number="<?php  echo $address['number'];?>" data-location_x="<?php  echo $address['location_x'];?>" data-location_y="<?php  echo $address['location_y'];?>">
							<div class="item-title-row">
								<div class="item-title">
									<?php  echo $address['realname'];?> <?php  echo $address['sex'];?>  ~ <?php  echo $address['mobile'];?>
								</div>
								<div class="item-after"><a href="javascript:;" class="edit-address" data-input="start_address_id" data-id="<?php  echo $address['id'];?>"><i class="icon icon-edit"></i></a></div>
							</div>
							<div class="item-text"><?php  echo $address['address'];?> ~ <?php  echo $address['number'];?></div>
						</div>
					</li>
					<?php  } } ?>
				</ul>
			</div>
			<?php  } ?>
			<?php  if(!empty($addresses['dis_available'])) { ?>
			<div class="content-block-title">不在服务范围内</div>
			<div class="list-block media-list">
				<ul class="border-1px-tb">
					<?php  if(is_array($addresses['dis_available'])) { foreach($addresses['dis_available'] as $address) { ?>
					<li>
						<div class="item-inner border-1px-b" onclick="alert('该地址不在跑腿服务范围内'); return false;">
							<div class="item-title-row">
								<div class="item-title">
									<?php  echo $address['realname'];?> <?php  echo $address['sex'];?>  ~ <?php  echo $address['mobile'];?>
								</div>
								<div class="item-after"><a href="javascript:;" class="edit-address" data-input="start_address_id" data-id="<?php  echo $address['id'];?>"><i class="icon icon-edit"></i></a></div>
							</div>
							<div class="item-text"><?php  echo $address['address'];?> ~ <?php  echo $address['number'];?></div>
						</div>
					</li>
					<?php  } } ?>
				</ul>
			</div>
			<?php  } ?>
		</div>
	</div>
</div>

<div class="popup popup-select-end-address">
	<div class="page select-address">
		<header class="bar bar-nav common-bar-nav">
			<a class="pull-left close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<h1 class="title">选择收货地址</h1>
			<a class="pull-right edit-address" data-input="end_address_id" data-id="0" href="javascript:;">新增</a>
		</header>
		<div class="content">
			<?php  if(!empty($addresses['available'])) { ?>
				<div class="content-block-title">可选收货地址</div>
				<div class="list-block media-list">
					<ul class="border-1px-tb">
						<?php  if(is_array($addresses['available'])) { foreach($addresses['available'] as $address) { ?>
						<li>
							<div class="item-inner border-1px-b available-address-item" data-id="<?php  echo $address['id'];?>" data-address="<?php  echo $address['address'];?>" data-name="<?php  echo $address['name'];?>" data-realname="<?php  echo $address['realname'];?>" data-sex="<?php  echo $address['sex'];?>" data-mobile="<?php  echo $address['mobile'];?>" data-number="<?php  echo $address['number'];?>" data-location_x="<?php  echo $address['location_x'];?>" data-location_y="<?php  echo $address['location_y'];?>">
								<div class="item-title-row">
									<div class="item-title">
										<?php  echo $address['realname'];?> <?php  echo $address['sex'];?>  ~ <?php  echo $address['mobile'];?>
									</div>
									<div class="item-after"><a href="javascript:;" class="edit-address" data-input="end_address_id" data-id="<?php  echo $address['id'];?>"><i class="icon icon-edit"></i></a></div>
								</div>
								<div class="item-text"><?php  echo $address['address'];?> ~ <?php  echo $address['number'];?></div>
							</div>
						</li>
						<?php  } } ?>
					</ul>
				</div>
			<?php  } ?>
			<?php  if(!empty($addresses['dis_available'])) { ?>
				<div class="content-block-title">不在服务范围内</div>
				<div class="list-block media-list">
					<ul class="border-1px-tb">
						<?php  if(is_array($addresses['dis_available'])) { foreach($addresses['dis_available'] as $address) { ?>
						<li>
							<div class="item-inner border-1px-b" onclick="alert('该地址不在跑腿服务范围内'); return false;">
								<div class="item-title-row">
									<div class="item-title">
										<?php  echo $address['realname'];?> <?php  echo $address['sex'];?>  ~ <?php  echo $address['mobile'];?>
									</div>
									<div class="item-after"><a href="javascript:;" class="edit-address" data-input="end_address_id" data-id="<?php  echo $address['id'];?>"><i class="icon icon-edit"></i></a></div>
								</div>
								<div class="item-text"><?php  echo $address['address'];?> ~ <?php  echo $address['number'];?></div>
							</div>
						</li>
						<?php  } } ?>
					</ul>
				</div>
			<?php  } ?>
		</div>suggestion
	</div>
</div>

<div class="popup popup-save-address">
	<div class="page save-address">
		<header class="bar bar-nav common-bar-nav">
			<a class="pull-left close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<h1 class="title">选择购买地址</h1>
			<a class="pull-right" href="javascript:;" id="save-address">保存</a>
		</header>
		<div class="content">
			<div class="list-block">
				<ul class="border-1px-tb">
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">地址</div>
								<div class="item-input">
									<input type="text" name="name" placeholder="" readonly>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">门牌号</div>
								<div class="item-input">
									<input type="text" name="number" placeholder="请输入门牌号等详细信息">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="popup popup-errander-rule">
	<div class="page errander-rule">
		<header class="bar bar-nav common-bar-nav">
			<a class="pull-left close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<h1 class="title"><?php  echo $title;?>规则</h1>
		</header>
		<div class="content" style="background: #FFF">
			<div class="content-padded">
				<?php  echo $category['rule'];?>
			</div>
		</div>
	</div>
</div>

<div class="popup popup-errander-agreement">
	<div class="page errander-agreement">
		<header class="bar bar-nav common-bar-nav">
			<a class="pull-left close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<h1 class="title">跑腿服务用户协议</h1>
		</header>
		<div class="content" style="background: #FFF">
			<div class="content-padded">
				<?php  echo $agreement_errander;?>
			</div>
		</div>
	</div>
</div>

<script id="tpl-address" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
		<li>
			<div class="item-inner address-buy-item border-1px-b <{# if(d[i].address_available != 1) { }>not-available<{# } }>" data-lng="<{d[i].lng}>" data-lat="<{d[i].lat}>" data-name="<{d[i].name}>" data-address="<{d[i].address}>" data-distance="<{d[i].distance}>" data-available="<{d[i].address_available}>">
				<div class="item-title-row">
					<div class="item-title">
						<i class="icon icon-lbs"></i>
						<{d[i].name}>
					</div>
					<div class="item-after distance hide"><{# if(d[i].distance_available == 1) { }><{d[i].distance}>km<{# } }></div>
				</div>
				<div class="item-text"><{d[i].address}></div>
			</div>
		</li>
	<{# } }>
</script>
