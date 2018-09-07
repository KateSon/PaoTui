<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('member/list/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">顾客等级筛选</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo iurl('member/list')?>" class="btn <?php  if(empty($groupid)) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
				<a href="<?php  echo iurl('member/list', array('groupid' => $group['id']))?>" class="btn <?php  if($groupid == $group['id']) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>"><?php  echo $group['title'];?></a>
				<?php  } } ?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">筛选</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo iurl('member/list')?>" class="btn <?php  if($key == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo iurl('member/list', array('key' => 'success_30'))?>" class="btn <?php  if($key == 'success_30') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近30天成交的客户</a>
				<a href="<?php  echo iurl('member/list', array('key' => 'noorder_30'))?>" class="btn <?php  if($key == 'noorder_30') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近30天未下单的老客户</a>
				<a href="<?php  echo iurl('member/list', array('key' => 'cancel_30'))?>" class="btn <?php  if($key == 'cancel_30') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近30天取消订单的访客</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo iurl('member/list', array('op' => 'list', 'page' => $pindex, 'keyword' => $keyword))?>" class="btn <?php  if($sort == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">默认</a>
				<a href="<?php echo iurl('member/list', array('op' => 'list', 'page' => $pindex, 'keyword' => $keyword , 'sort' => 'success_first_time','sort_val' => ($sort_val ? 0 : 1)))?>" class="btn <?php  if($sort == 'success_first_time') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">首次下单时间 <i class="fa <?php  if($sort_val == 1) { ?>fa-sort-numeric-desc<?php  } else { ?>fa-sort-numeric-asc<?php  } ?>"></i></a>
				<a href="<?php echo iurl('member/list', array('op' => 'list', 'page' => $pindex, 'keyword' => $keyword , 'sort' => 'success_last_time','sort_val' => ($sort_val ? 0 : 1)))?>" class="btn <?php  if($sort == 'success_last_time') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">最近一次下单时间 <i class="fa <?php  if($sort_val == 1) { ?>fa-sort-numeric-desc<?php  } else { ?>fa-sort-numeric-asc<?php  } ?>"></i></a>
				<a href="<?php echo iurl('member/list', array('op' => 'list', 'page' => $pindex, 'keyword' => $keyword , 'sort' => 'success_num','sort_val' => ($sort_val ? 0 : 1)))?>" class="btn <?php  if($sort == 'success_num') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">下单总数 <i class="fa <?php  if($sort_val == 1) { ?>fa-sort-numeric-desc<?php  } else { ?>fa-sort-numeric-asc<?php  } ?>"></i></a>
				<a href="<?php echo iurl('member/list', array('op' => 'list', 'page' => $pindex, 'keyword' => $keyword , 'sort' => 'success_price','sort_val' => ($sort_val ? 0 : 1)))?>" class="btn <?php  if($sort == 'success_price') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">下单总金额 <i class="fa <?php  if($sort_val == 1) { ?>fa-sort-numeric-desc<?php  } else { ?>fa-sort-numeric-asc<?php  } ?>"></i></a>
			</div>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">关键字</label>
		<div class="col-sm-9 col-xs-12">
			<input class="form-control" name="keyword" placeholder="输入用户名或手机号或UID或昵称" type="text" value="<?php  echo $_GPC['keyword'];?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>会员uid</th>
					<th>粉丝</th>
					<th>会员</th>
					<th>等级</th>
					<th>账户</th>
					<th>成功/取消下单</th>
					<th>首次下单时间</th>
					<th>最近一次下单时间</th>
					<th>购买套餐</th>
					<th>套餐开始 / 结束时间</th>
					<th style="text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($data)) { foreach($data as $dca) { ?>
				<tr>
					<td><?php  echo $dca['uid'];?></td>
					<td>
						<?php  if(!empty($dca['avatar']) || !empty($dca['nickname'])) { ?>
							<img src="<?php  echo tomedia($dca['avatar']);?>" alt="" width="50"/>
							<?php  echo $dca['nickname'];?>
						<?php  } else { ?>
							未更新
						<?php  } ?>
					</td>
					<td>
						<?php  echo $dca['realname'];?>
						<br>
						<?php  echo $dca['mobile'];?>
					</td>
					<td>
						<?php  echo $dca['groupname'];?>
					</td>
					<td>
						<span class="label label-info">积分 <?php  echo $dca['credit1'];?></span>
						<br>
						<span class="label label-warning label-br">余额 <?php  echo $dca['credit2'];?></span>
					</td>
					<td>
						<span class="label label-success"><?php  echo $dca['success_num'];?>次 / <?php  echo $dca['success_price'];?>元</span>
						<br>
						<span class="label label-danger label-br"><?php  echo $dca['cancel_num'];?>次 / <?php  echo $dca['cancel_price'];?>元</span>
					</td>
					<td>
						<?php  if(!empty($dca['success_first_time'])) { ?>
							<?php  echo date('Y-m-d H:i', $dca['success_first_time']);?>
						<?php  } ?>
					</td>
					<td>
						<?php  if(!empty($dca['success_last_time'])) { ?>
							<?php  echo date('Y-m-d H:i', $dca['success_last_time']);?>
						<?php  } ?>
					</td>
					<td>
						<?php  if(!empty($dca['card'])) { ?>
							<span class="label label-info">
							<?php  echo $dca['card'];?>
							</span>
						<?php  } ?>
					</td>
					<td>
						<?php  if($dca['setmeal_starttime'] != 0 && $dca['setmeal_endtime'] !=0) { ?>
							<span class="label label-success">
							开始时间 <?php  echo date('Y-m-d', $dca['setmeal_starttime']);?>
							</span>
							<br>
							<span class="label label-danger label-br">
							结束时间 <?php  echo date('Y-m-d', $dca['setmeal_endtime']);?>
							</span>
							<?php  if($dca['setmeal_endtime'] <= time()) { ?>
								<br>
								<span class="label label-warning label-br">已到期</span>
							<?php  } ?>
						<?php  } ?>
					</td>
					<td style="text-align:right;">
						<?php  if($dca['setmeal_id'] != 0 && $dca['setmeal_endtime'] > time()) { ?>
							<a href="<?php  echo iurl('member/list/cancel', array('id' => $dca['id']))?>" class="btn btn-default btn-sm js-post" data-confirm="确定取消套餐吗?">取消套餐</a>
						<?php  } ?>
						<a href="<?php  echo iurl('member/list/setmeal', array('id' => $dca['id'], 'setmeal_id' => $dca['setmeal_id']))?>" class="btn btn-default btn-sm js-modal">配送会员卡</a>
						<?php  if($dca['status'] == 1) { ?>
							<a href="<?php  echo iurl('member/list/status', array('id' => $dca['id'], 'status' => 0))?>" class="btn btn-default btn-sm js-post" data-confirm="确定加入黑名单吗?">加入黑名单</a>
						<?php  } else { ?>
							<a href="<?php  echo iurl('member/list/status', array('id' => $dca['id'], 'status' => 1))?>" class="btn btn-danger btn-sm js-post" data-confirm="确定移出黑名单吗?">移出黑名单</a>
						<?php  } ?>
						<a href="<?php  echo iurl('member/list/changes', array('uid' => $dca['uid']))?>" class="btn btn-primary btn-sm js-modal">账户变动</a>
						<a href="<?php  echo iurl('member/address', array('uid' => $dca['uid']))?>" class="btn btn-info btn-sm">收货地址</a>
						<a href="<?php  echo iurl('member/list/group', array('uid' => $dca['uid']))?>" class="btn btn-primary btn-sm js-modal">会员等级</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
	</div>
</form>
<script>
require(['trade'], function(trade) {
	trade.init();
	$(document).on('click', '#form-changes .nav-tabs li', function() {
		var type = $(this).data('type');
		$('#form-changes input[name="type"]').val(type);
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
