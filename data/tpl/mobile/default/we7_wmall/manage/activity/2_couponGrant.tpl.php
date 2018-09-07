<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page couponGrant">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title open-popup">创建满返优惠</h1>
	</header>
	<div class="content">
		<input type="hidden" name="coupons" value="">
		<div class="list-block">
			<div class="item-content">
				<div class="item-inner">
					<div class="item-title label">活动名称</div>
					<div class="item-input">
						<input type="text" placeholder="输入活动名称" name="title" class="align-right">
					</div>
				</div>
			</div>
		</div>
		<div class="list-block">
			<ul>
				<li>
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">起始日期</div>
							<div class="item-input">
								<input type="text" placeholder="请选择开始日期" name="starttime" data-toggle='date' class="align-right" />
								<i class="icon icon-right"></i>
							</div>
						</div>
					</div>
				</li>
				<li class="border-1px-b">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">结束日期</div>
							<div class="item-input">
								<input type="text" placeholder="请选择结束日期" name="endtime" data-toggle='date' class="align-right" />
								<i class="icon icon-right"></i>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="list-block">
			<div class="item-content">
				<div class="item-inner">
					<div class="item-title label">返券条件</div>
					<div class="item-input align-right" id="input-condition">
						<div>订单满</div>
						<input type="text" name="condition" class="condition">
						<span>元</span>
					</div>
				</div>
			</div>
		</div>
		<div class="list-block">
			<div class="item-content">
				<div class="item-inner">
					<div class="item-title label">预计发放总数量</div>
					<div class="item-input">
						<input type="text" name="amount" class="align-right">
						<span class="amount">张</span>
					</div>
				</div>
			</div>
		</div>
		<div class="add">
			<a href="javascript:;" id="coupon-add"><i class="icon icon-add"></i> 添加优惠卷</a>
		</div>
		<div class="coupon-container" id="coupon-preview"></div>
		<div class="confirm">
			<a href="javascript:;" class="submit">确认并保存</a>
		</div>
	</div>
</div>

<!-- About Popup -->
<script type="text/html" id="tpl-editor-coupons">
	<div class="popup popup-about" id="couponGrant-popup">
		<header class="bar bar-nav common-bar-nav">
			<h1 class="title">优惠券信息</h1>
			<a href="javascript:;" class="pull-right" id="coupon-cancel">取消</a>
		</header>
		<div class="content-block">
			<input type="hidden" name="id" value="">
			<div class="list-block">
				<div class="item-content border-1px-tb">
					<div class="item-inner">
						<div class="item-title label">优惠券金额</div>
						<div class="item-input" id="item-input">
							<input type="text" placeholder="必须填写整数" name="discount" class="align-right" value="<(discount)>">
							<span>元</span>
						</div>
					</div>
				</div>
			</div>
			<div class="list-block">
				<div class="item-content border-1px-tb">
					<div class="item-inner">
						<div class="item-title label">满多少元可用</div>
						<div class="item-input" id="item-input">
							<input type="text" placeholder="整数,且大于优惠卷面额" name="condition" class="align-right" value="<(condition)>">
							<span>元</span>
						</div>
					</div>
				</div>
			</div>
			<div class="list-block">
				<div class="item-content border-1px-tb">
					<div class="item-inner">
						<div class="item-title label">领取后几天内有效</div>
						<div class="item-input" id="item-input">
							<input type="text" placeholder="必须整数,且大于0" name="use_days_limit" class="align-right" value="<(use_days_limit)>">
							<span>天</span>
						</div>
					</div>
				</div>
			</div>
		    <p class="popup-close">
		    	<a href="#" class="save" id="coupon-submit">确认并关闭</a>
		    </p>
		</div>
	</div>
</script>

<script type='text/html' id="tpl-show-coupons">
	<div class="drag" data-itemid="<(itemid)>">
		<(each items as item)>
			<div class="coupon-detail">
				<div class="coupon-operation">
					<a href="javascript:;" class="btn-coupon-edit" data-id="<(item.itemid)>">编辑</a>
					<a href="javascript:;" class="btn-coupon-del" data-id="<(item.itemid)>">删除</a>
				</div>
				<div class="coupon-amount pull-left">
					<span class="discount-amount"><(item.discount)></span>
					<p>满<i class="max-amount"><(item.condition)></i>可用</p>
				</div>
				<div class="coupon-term pull-left">
					领券后<i class="deadline"><(item.use_days_limit)></i>天内有效
				</div>
			</div>
		<(/each)>
	</div>
</script>


<script>
require(['tmodtpl'],function(tmodtpl){
	var couponGrant = {
		items: {},
		couponSelect: '',
		isAdd: 0
	};

	couponGrant.init = function() {
		$.modal.prototype.defaults.closePrevious = false;
		couponGrant.initEditor();
		couponGrant.tplCoupon();
		couponGrant.save();
	};

	couponGrant.getId = function(S, N) {
		var date = +new Date();
		var id = S + (date + N);
		return id;
	};

	couponGrant.length = function(json) {
		if(typeof(json) === 'undefined') {
			return 0;
		}
		var jsonlen = 0;
		for (var item in json) {
			jsonlen++;
		}
		return jsonlen;
	};

	couponGrant.initEditor = function() {
		$(document).on('click', '.btn-coupon-edit', function(){
			var id = $(this).data('id');
			if(!id) {
				return false;
			}
			couponGrant.isAdd = 0;
			couponGrant.couponSelect = id;
			couponGrant.tplEditor();
		});

		$(document).on('click', '.btn-coupon-del', function(){
			var id = $(this).data('id');
			if(!id) {
				return false;
			}
			$.confirm('确定删除改优惠券？', function(){
				delete(couponGrant.items[id]);
				couponGrant.tplCoupon();
			});
		});

		$(document).on('click', '#coupon-add', function(){
			var length = couponGrant.length(couponGrant.items);
			if(length >= 1) {
				$.toast('最多可以添加1个代金券');
				return false;
			}
			var itemid = couponGrant.getId('M', 0);
			couponGrant.items[itemid] = {
				itemid: itemid,
				discount: 5,
				condition: 20,
				use_days_limit: 7
			};
			couponGrant.isAdd = 1;
			couponGrant.couponSelect = itemid;
			couponGrant.tplEditor();
		});

		$(document).on('click', '#coupon-submit', function(){
			var item = {
				itemid: couponGrant.couponSelect,
				discount: parseFloat($('#item-input input[name="discount"]').val()),
				condition: parseFloat($('#item-input input[name="condition"]').val()),
				use_days_limit: parseInt($('#item-input input[name="use_days_limit"]').val())
			};
			if(!item.discount) {
				$.toast('优惠券金额不能为空');
				return false;
			}
			if(!item.condition) {
				$.toast('优惠券使用条件不能为空');
				return false;
			}
			if(item.discount >= item.condition) {
				$.toast('优惠券金额不能大于使用条件');
				return false;
			}
			if(!item.use_days_limit) {
				$.toast('优惠券限制使用天数必须大于0');
				return false;
			}
			$('#coupon-add').addClass('disabled');
			couponGrant.items[couponGrant.couponSelect] = item;
			couponGrant.tplCoupon();
			$.closeModal('.popup-about');
		});

		$(document).on('click', '#coupon-cancel', function(){
			if(couponGrant.isAdd) {
				delete(couponGrant.items[couponGrant.couponSelect]);
				couponGrant.tplCoupon();
			}
			$.closeModal('.popup-about');
		});
	};

	couponGrant.tplCoupon = function() {
		var html = tmodtpl("tpl-show-coupons", couponGrant);
		$("#coupon-preview").html(html);
	};

	couponGrant.tplEditor = function() {
		if(!couponGrant.couponSelect) {
			return false;
		}
		var coupon = couponGrant.items[couponGrant.couponSelect];
		var html = tmodtpl("tpl-editor-coupons", coupon);
		$.popup(html);
	};

	couponGrant.save = function() {
		$(document).on('click', '.confirm .submit', function(){
			var title = $.trim($(':text[name="title"]').val());
			if(!title) {
				$.toast('活动名称不能为空');
				return false;
			}

			var starttime = $.trim($(':text[name="starttime"]').val());
			if(!starttime) {
				$.toast('活动开始时间不能为空');
				return false;
			}

			var endtime = $.trim($(':text[name="endtime"]').val());
			if(!endtime) {
				$.toast('活动结束时间不能为空');
				return false;
			}

			var condition = $.trim($('#input-condition input[name="condition"]').val());
			if(!condition) {
				$.toast('返券条件不能为空');
				return false;
			}

			var amount = $.trim($(':text[name="amount"]').val());
			if(!amount) {
				$.toast('预计发放总数量不能为空');
				return false;
			}

			var length = couponGrant.length(couponGrant.items);
			if(!length) {
				$.toast('请添加优惠券');
				return false;
			}

			$(this).addClass('disabled');
			var params = {
				title: title,
				starttime: starttime,
				endtime: endtime,
				condition: condition,
				amount: amount,
				coupon: couponGrant.items
			};

			$.post(location.href, params, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					$.toast(result.message.message);
					$('.confirm .submit').removeClass('disabled');
					return false;
				}
				$.toast('满返优惠添加成功', "<?php  echo imurl('manage/activity/index');?>");
			});
		});
	};

	couponGrant.init();
});

</script>


<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>