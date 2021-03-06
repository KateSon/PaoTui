<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
	.notice .content{padding-top: .5rem;}
	.notice .content .notice-box{background-color: #fff; padding-top: .3rem;}
	.notice .notice-list{padding: .5rem 0;}
	.notice .notice-list .left{float: left; width: 15%; text-align: right;}
	.notice .notice-list .left .wui-label-danger{background-color: #ff2d4b;}
	.notice .notice-list .right{float: left; width: 82%; margin-left: 2%;}
	.notice .notice-list .wui-label{padding: .3rem .35rem; margin-top: .2rem;}
	.notice .notice-list .right .notice-title{width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}
	.notice .notice-list .right .time{font-size: .7rem;}
	.notice .content .notice-box>a{color: #3D4145;}
	.detail .content{background-color: #fff; padding: 1rem .8rem;}
	.detail .detail-title{text-align: center; font-size: .9rem;}
	.detail .detail-time{text-align: right; margin-top: .2rem; font-size: .7rem; color: #6A6C6C;}
	.detail .detail-content{margin-top: .3rem;}
</style>
<?php  if($ta == 'list') { ?>
<div class="page notice">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">公告列表</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('manage/news/notice/list')?>" data-distance="70" data-min="<?php  echo $min;?>" data-container=".notice-box" data-tpl="tpl-manage-notice">
		<div class="notice-box">
			<?php  if(is_array($data)) { foreach($data as $item) { ?>
				<a href="<?php  if(empty($item['link'])) { ?> <?php  echo imurl('manage/news/notice/detail', array('id' => $item['id']))?> <?php  } else { ?> <?php  echo $item['link'];?> <?php  } ?>">
					<div class="notice-list clearfix border-1px-b">
						<div class="left">
							<div class="wui-label <?php  if($item['is_new'] == 1) { ?> wui-label-danger <?php  } ?>">
								消息
							</div>
						</div>
						<div class="right">
							<div class="notice-title"><?php  echo $item['title'];?></div>
							<div class="time"><?php  echo $item['addtime'];?></div>
						</div>
					</div>
				</a>
			<?php  } } ?>
		</div>
	</div>
</div>

<script id="tpl-manage-notice" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<a href="<{# if(d[i].link == ''){ }> <?php  echo imurl('manage/news/notice/detail')?>&id=<{d[i].id}> <{# }else{ }> <{d[i].link}> <{# } }>">
		<div class="notice-list clearfix border-1px-b">
			<div class="left">
				<div class="wui-label <{# if(d[i].is_new == 1){ }> wui-label-danger <{# } }>">
					消息
				</div>
			</div>
			<div class="right">
				<div class="notice-title"><{d[i].title}></div>
				<div class="time"><{d[i].addtime}></div>
			</div>
		</div>
	</a>
	<{# } }>
</script>
<?php  } ?>

<?php  if($ta == 'detail') { ?>
<div class="page detail">
	<header class="bar bar-nav common-bar-nav">
		<a href="javascript:;" class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">公告详情</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="detail-title"><?php  echo $notice['title'];?></div>
		<div class="detail-time"><?php  echo date('Y-m-d H:i:s', $notice['addtime'])?></div>
		<div class="detail-content">
			<?php  echo htmlspecialchars_decode($notice['content']);?>
		</div>
	</div>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>