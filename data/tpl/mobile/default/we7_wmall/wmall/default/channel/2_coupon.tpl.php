<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page coupon-channel" id="page-coupon-channel">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">领券专区</h1>
		<a class="pull-right" href="<?php  echo imurl('wmall/member/coupon');?>"><i class="icon icon-coupon"></i></a>
	</header>
	<?php  get_mall_menu();?>
	<div class="content content-padded infinite-scroll" data-distance="50" data-min="<?php  echo $min;?>">
		<div class="coupon-list">
			<?php  if(empty($datas)) { ?>
				<div class="common-no-con">
					<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/coupon_no_con.png" alt="" />
					<p>没有可以领取的代金券</p>
					<div class="btn">
						<a href="<?php  echo imurl('wmall/home/index');?>">去首页看看</a>
					</div>
				</div>
			<?php  } else { ?>
				<?php  if(is_array($datas)) { foreach($datas as $data) { ?>
				<div class="row coupon-item">
					<div class="col-20">
						<div class="imgs">
							<img src="<?php  echo $data['logo'];?>" alt="">
						</div>
					</div>
					<div class="col-50">
						<p class="store-title"><?php  echo $data['store_title'];?></p>
						<p class="price">
							<span class="coupon-discount"><?php  echo $data['discount'];?>元</span>
							<span class="coupon-title"><?php  echo $data['title'];?></span>
						</p>
						<p class="use-condition"><?php  echo $data['couponInfo'];?></p>
					</div>
					<div class="col-30 rob">
						<div class="get <?php  if($data['get_status'] == 1) { ?>hide<?php  } ?>">
							<div class="has-get"></div>
							<p class="receive"><a href="<?php  echo imurl('wmall/store/goods', array('sid' => $data['sid']));?>" class="button button-warning"> 去使用 </a></p>
						</div>
						<div class="can-receive <?php  if($data['get_status'] == 0) { ?>hide<?php  } ?>">
							<div class="myStat" data-dimension="70" data-info="<?php  echo $data['percent'];?>%" data-width="5" data-border="outline" data-fontsize="14" data-type="half" data-percent="<?php  echo $data['percent'];?>" data-fgcolor="#ff2d4b" data-bgcolor="#e3e3e4" data-fill="#fff"></div>
							<p class="receive"><a href="javascript:;" class="button button-danger button-get-coupon" data-id="<?php  echo $data['id'];?>" data-sid="<?php  echo $data['sid'];?>">立即领取</a></p>
						</div>
					</div>
				</div>
				<?php  } } ?>
			<?php  } ?>
		</div>
		<div class="infinite-scroll-preloader hide">
			<div class="preloader"></div>
		</div>
	</div>
</div>

<script id="tpl-coupon" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<div class="row coupon-item">
		<div class="col-20">
			<div class="imgs">
				<img src="<{d[i]['logo']}>" alt="">
			</div>
		</div>
		<div class="col-50">
			<p class="store-title"><{d[i]['store_title']}></p>
			<p class="price">
				<span class="coupon-discount"><{d[i]['discount']}>元</span>
				<span class="coupon-title"><{d[i]['title']}></span>
			</p>
			<p class="use-condition">满<{d[i]['couponInfo']}>元可用</p>
		</div>
		<div class="col-30 rob">
			<div class="get <{# if (d[i]['get_status'] == 1) { }>hide<{# } }>">
				<div class="has-get"></div>
				<p class="receive"><a href="<?php  echo imurl('wmall/store/goods');?>&sid=<{d[i]['sid']}>" class="button button-warning">去使用</a></p>
			</div>
			<div class="can-receive <{# if (d[i]['get_status'] == 0) { }>hide<{# } }>">
				<div class="myStat" data-dimension="70" data-type="half" data-info="<{d[i]['percent']}>%" data-percent="<{d[i]['percent']}>" data-width="5" data-fgcolor="#ff2d4b" data-bgcolor="#e3e3e4" data-fill="#fff"></div>
				<p class="receive" ><a href="javascript:;" class="button button-danger button-get-coupon" data-id="<{d[i]['id']}>" data-sid="<{d[i]['sid']}>" >立即领取</a></p>
			</div>
		</div>
	</div>
	<{# } }>
</script>

<script>
require(['coupon'], function(coupon){
	coupon.initChannel();
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
