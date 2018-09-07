<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
	#select-link-modal .modal-dialog{width: 750px;}
	#select-link-modal .modal-dialog .modal-body{padding: 15px;}
	#select-link-modal .link-container{height: 420px; overflow-y: auto;}
	#select-link-modal .page-header{padding: 9px 0; margin-top: 5px; margin-bottom: 8px}
	#select-link-modal .page-header h4{margin: 0; font-size: 14px; font-weight: 600}
	#select-link-modal .btn{margin-bottom: 3px; border: 1px solid #e7eaec;}
	#select-link-modal .btn:hover{border: 1px solid #d2d2d2; background: #ffffff; text-decoration: none}
</style>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button">×</button>
			<h4 class="modal-title">选择链接</h4>
		</div>
		<div class="modal-body clearfix link-container">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#takeout" aria-controls="takeout" role="tab" data-toggle="pill">外卖</a></li>
				<?php  if(check_plugin_perm('errander')) { ?>
					<li role="presentation"><a href="#errander" aria-controls="errander" role="tab" data-toggle="pill">跑腿</a></li>
				<?php  } ?>
				<?php  if(check_plugin_perm('ordergrant')) { ?>
					<li role="presentation"><a href="#errander" aria-controls="ordergrant" role="tab" data-toggle="pill">下单有礼</a></li>
				<?php  } ?>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" role="tabpanel" id="takeout">
					<?php  if(is_array($data['takeout'])) { foreach($data['takeout'] as $da) { ?>
						<div class="page-header">
							<h4><i class="fa fa-folder-open-o"></i> <?php  echo $da['title'];?></h4>
						</div>
						<?php  if(is_array($da['items'])) { foreach($da['items'] as $item) { ?>
							<div class="btn btn-default btn-sm btn-link" data-href="<?php  echo $item['url'];?>" title="<?php  echo $item['title'];?>"><?php  echo $item['title'];?></div>
						<?php  } } ?>
					<?php  } } ?>
				</div>
				<div class="tab-pane active" role="tabpanel" id="errander">
					<?php  if(is_array($data['errander'])) { foreach($data['errander'] as $da) { ?>
						<div class="page-header">
							<h4><i class="fa fa-folder-open-o"></i> <?php  echo $da['title'];?></h4>
						</div>
						<?php  if(is_array($da['items'])) { foreach($da['items'] as $item) { ?>
							<div class="btn btn-default btn-sm btn-link" data-href="<?php  echo $item['url'];?>" title="<?php  echo $item['title'];?>"><?php  echo $item['title'];?></div>
						<?php  } } ?>
					<?php  } } ?>
				</div>
				<div class="tab-pane active" role="tabpanel" id="ordergrant">
					<?php  if(is_array($data['ordergrant'])) { foreach($data['ordergrant'] as $da) { ?>
						<div class="page-header">
							<h4><i class="fa fa-folder-open-o"></i> <?php  echo $da['title'];?></h4>
						</div>
						<?php  if(is_array($da['items'])) { foreach($da['items'] as $item) { ?>
							<div class="btn btn-default btn-sm btn-link" data-href="<?php  echo $item['url'];?>" title="<?php  echo $item['title'];?>"><?php  echo $item['title'];?></div>
						<?php  } } ?>
					<?php  } } ?>
				</div>
			</div>
		</div>
	</div>
</div>
