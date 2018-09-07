<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('common', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form-takeout">
	<input type="hidden" name="type" value="<?php  echo $type;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">模板类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<div class="btn-group">
					<a href="<?php  echo ifilter_url('type:0');?>" class="btn <?php  if($type == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">全部类型</a>
					<a href="<?php  echo ifilter_url('type:1');?>" class="btn <?php  if($type == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">自定义页面</a>
				</div>
			</div>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table js-table">
		<div class="panel-body table-responsive">
			<?php  if(empty($templates)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<div class="diy-row">
					<?php  if(is_array($templates)) { foreach($templates as $item) { ?>
						<div class="item">
							<img src="<?php  echo $item['preview'];?>" alt="">
							<div class="cate">
								<span class='label label-primary'>系统</span>
								<span class='label label-custom'>自定义页面</span>
							</div>
							<div class="title"><?php  echo $item['name'];?></div>
							<div class="mask">
								<div class="btns">
									<a href="<?php  echo iurl('diypage/template/create', array('id' => $item['id']));?>" class='btn btn-primary' data-id="<?php  echo $item['id'];?>">创建页面</a>
									<?php  if(!empty($item['uniacid'])) { ?>
										<a href="<?php  echo iurl('diypage/template/del', array('id' => $item['id']));?>" class="btn btn-default js-remove"  data-confirm="确定删除该模板吗？">删除模板</a>
									<?php  } ?>
								</div>
							</div>
						</div>
					<?php  } } ?>
				</div>
				<div class="btn-region clearfix">
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<script>
$(function(){
	$('.diy-row>.item').hover(function(){
		$(this).find('.title').fadeIn(300);
		$(this).find('.mask').fadeIn(300);
	},function(){
		$(this).find('.title').fadeOut(200);
		$(this).find('.mask').fadeOut(200);
	});
})
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>