<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'list') { ?>
<form action="" class="form-table form news-list" id="form-deliveryer" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($data)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="navbar-inner">
					<tr>
						<?php  if(!empty($_W['clerk'])) { ?>
						<th width="20"></th>
						<?php  } ?>
						<th>信息</th>
						<th>时间</th>
						<th style="width:350px; text-align: right">详情</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($data)) { foreach($data as $item) { ?>
					<tr>
						<?php  if(!empty($_W['clerk'])) { ?>
							<td>
								<?php  if($item['is_new'] == 1) { ?>
								<i class="fa fa-circle" style="color: #06c1ae"></i>
								<?php  } else { ?>
								<i class="fa fa-circle" style="color: #d5d5d5;"></i>
								<?php  } ?>
							</td>
						<?php  } ?>
						<td><?php  echo $item['title'];?></td>
						<td><?php  echo date('Y-m-d H:i', $item['addtime']);?></td>
						<td align="right">
							<a href="<?php  echo iurl('store/shop/notice/detail', array('id' => $item['id']))?>" class="btn btn-default btn-sm" >查看</a>
						</td>
					</tr>
					<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($ta == 'detail') { ?>
<div class="page news-detail clearfix">
	<h2 class="text-center"><?php  echo $item['title'];?></h2>
	<div><?php  echo $item['content'];?></div>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>