<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('store/service/comment/list');?>
	<input type="hidden" name="status" value="<?php  echo $status;?>"/>
	<input type="hidden" name="reply" value="<?php  echo $reply;?>"/>
	<input type="hidden" name="note" value="<?php  echo $note;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">审核状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('status:-1');?>" class="btn <?php  if($status == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待审核</a>
				<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">审核通过</a>
				<a href="<?php  echo ifilter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">审核未通过</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">评价管理</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('reply:-1');?>" class="btn <?php  if($reply == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('reply:0');?>" class="btn <?php  if($reply == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未回复</a>
				<a href="<?php  echo ifilter_url('reply:1');?>" class="btn <?php  if($reply == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已回复</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">有无内容</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('note:-1');?>" class="btn <?php  if($note == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('note:1');?>" class="btn <?php  if($note == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">有内容</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品质量</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('goods_quality:-1');?>" class="btn <?php  if($goods_quality == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('goods_quality:1');?>" class="btn <?php  if($goods_quality == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一星</a>
				<a href="<?php  echo ifilter_url('goods_quality:2');?>" class="btn <?php  if($goods_quality == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">二星</a>
				<a href="<?php  echo ifilter_url('goods_quality:3');?>" class="btn <?php  if($goods_quality == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三星</a>
				<a href="<?php  echo ifilter_url('goods_quality:4');?>" class="btn <?php  if($goods_quality == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">四星</a>
				<a href="<?php  echo ifilter_url('goods_quality:5');?>" class="btn <?php  if($goods_quality == 5) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">五星</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送服务</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('delivery_service:-1');?>" class="btn <?php  if($delivery_service == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('delivery_service:1');?>" class="btn <?php  if($delivery_service == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一星</a>
				<a href="<?php  echo ifilter_url('delivery_service:2');?>" class="btn <?php  if($delivery_service == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">二星</a>
				<a href="<?php  echo ifilter_url('delivery_service:3');?>" class="btn <?php  if($delivery_service == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三星</a>
				<a href="<?php  echo ifilter_url('delivery_service:4');?>" class="btn <?php  if($delivery_service == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">四星</a>
				<a href="<?php  echo ifilter_url('delivery_service:5');?>" class="btn <?php  if($delivery_service == 5) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">五星</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">评价时间</label>
		<div class="col-sm-9 col-xs-12">
			<div class="js-daterange" data-form=".form-filter">
				<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
			</div>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<?php  if(!empty($comments)) { ?>
	<div class="panel panel-comment">
		<div class="panel-body">
			<?php  if(is_array($comments)) { foreach($comments as $comment) { ?>
			<div class="comment-item clearfix">
				<div class="col-sm-2 col-md-2 col-lg-2 comment-item-left">
					<div class="customer-name"><?php  echo $comment['mobile'];?></div>
					<div class="seller">商品质量
						<?php 
							for($i = 0; $i < $comment['goods_quality']; $i++) {
								echo '<span><i class="fa fa-star star light"></i></span> ';
							}
							for($i = $comment['goods_quality']; $i < 5; $i++) {
								echo '<span><i class="fa fa-star star"></i></span> ';
							}
						?>
					</div>
					<div class="delivery">配送服务
						<?php 
							for($i = 0; $i < $comment['delivery_service']; $i++) {
								echo '<span><i class="fa fa-star star light"></i></span> ';
							}
							for($i = $comment['delivery_service']; $i < 5; $i++) {
								echo '<span><i class="fa fa-star star"></i></span> ';
							}
						?>
					</div>
					<div class="merit">综合评价：<?php  echo $comment['score'];?>星</div>
					<span class="delivery-time btn-gray hide">41分钟送达</span>
				</div>
				<div class="col-sm-10 col-md-10 col-lg-10 comment-item-right">
					<div class="comment-date">
						<?php  echo date('Y-m-d H:i', $comment['addtime'])?>
						&nbsp;
						<?php  if($comment['status'] == 1) { ?>
							<span class="tag tag-success">审核通过</span>
						<?php  } else if($comment['status'] == 2) { ?>
							<span class="tag tag-danger">审核未通过</span>
						<?php  } else { ?>
							<span class="tag tag-default">待审核</span>
						<?php  } ?>
						<a href="<?php  echo iurl('store/order/takeout/detail', array('id' => $comment['oid']));?>" target="_blank" class="pull-right check-order greenest">查看订单 <b class="fa fa-angle-right"></b></a>
					</div>
					<div class="comment-main">
						<div class="customer-comment"><?php  if(!empty($comment['note'])) { ?><?php  echo $comment['note'];?><?php  } else { ?>该用户没有填写评价内容<?php  } ?></div>
						<div class="comment-img">
							<?php  if(is_array($comment['thumbs'])) { foreach($comment['thumbs'] as $thumb) { ?>
								<a href="<?php  echo tomedia($thumb)?>" target="_blank"><img src="<?php  echo tomedia($thumb)?>" alt=""></a>
							<?php  } } ?>
						</div>
						<div class="seller-comment clearfix grayest">
							<?php  if(!empty($comment['data']['good'])) { ?>
								<div class="pull-left seller-comment-goods">
									<b class="fa fa-thumbs-o-up"></b>
									<?php  if(is_array($comment['data']['good'])) { foreach($comment['data']['good'] as $good) { ?>
										<span><?php  echo $good;?></span>
									<?php  } } ?>
								</div>
							<?php  } ?>
							<?php  if(!empty($comment['data']['bad'])) { ?>
								<div class="pull-left seller-comment-delivery">
									<b class="fa fa-thumbs-o-down"></b>
									<div class="comment-favor-oppose">
										<i class="icon favor"></i>
										<?php  if(is_array($comment['data']['bad'])) { foreach($comment['data']['bad'] as $bad) { ?>
											<span><?php  echo $bad;?></span>
										<?php  } } ?>
									</div>
								</div>
							<?php  } ?>
						</div>
						<a href="javascript:;" class="reply greenest" onclick="$(this).next('.reply-area').slideDown();"><b class="fa fa-comment-o"></b>回复</a>
						<div class="reply-area" <?php  if(!empty($comment['replytime'])) { ?>style="display:block"<?php  } ?>>
							<div class="reply-list">
								<div><span class="grayest">商家回复：</span></div>
								<?php  if(!empty($comment['replytime'])) { ?>
									<span class="grayest"><?php  echo date('Y-m-d H:i', $comment['replytime'])?></span>
								<?php  } ?>
							</div>
							<div class="input-area">
								<textarea class="form-control" <?php  if(!empty($comment['replytime'])) { ?>readonly<?php  } ?> placeholder="限300字符，请勿恶意回复，一经查实将严肃处理，回复后不可修改"><?php  echo $comment['reply'];?></textarea>
								<?php  if(empty($comment['replytime'])) { ?>
									<a href="javascript:;" class="btn btn-primary btn-reply" data-id="<?php  echo $comment['oid'];?>">回复</a>
									<a href="javascript:;" class="btn btn-default" onclick="$(this).parents('.reply-area').slideUp();">取消</a>
								<?php  } ?>
								<?php  if($store['self_audit_comment'] == 1) { ?>
									<a href="<?php  echo iurl('store/service/comment/status', array('id' => $comment['id'], 'status' => 1))?>" class="btn btn-success js-post">审核通过</a>
									<a href="<?php  echo iurl('store/service/comment/status', array('id' => $comment['id'], 'status' => 2))?>" class="btn btn-danger js-post">未通过</a>
								<?php  } ?>
							</div>
							<div class="arrow"></div>
						</div>
					</div>
				</div>
			</div>
			<?php  } } ?>
			<?php  echo $pager;?>
		</div>
	</div>
	<?php  } else { ?>
	<div class="no-result">
		<p>还没有相关数据</p>
	</div>
	<?php  } ?>
</form>
<script>
$(function(){
	$(document).on('click', '.comment-item .btn-reply', function(){
		var id = $(this).data('id');
		var reply = $(this).prev('textarea').val();
		if(!reply) {
			Notify.info('回复内容不能为空');
			return false;
		}
		$(this).attr('disabled', true);
		$.post("<?php  echo iurl('store/service/comment/reply')?>", {id: id, reply: reply}, function(data){
			$(this).attr('disabled', false);
			var result = $.parseJSON(data);
			if(!result.message.errno) {
				Notify.success('回复成功', location.href);
			} else {
				Notify.error(result.message.message);
			}
		});
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
