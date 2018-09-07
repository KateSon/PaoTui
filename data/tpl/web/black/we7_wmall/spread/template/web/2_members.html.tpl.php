<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter" >
	<?php  echo tpl_form_filter_hidden('spread/members/index');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('spread_status:-1');?>" class="btn <?php  if($spread_status == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('spread_status:0');?>" class="btn <?php  if($spread_status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待审核</a>
				<a href="<?php  echo ifilter_url('spread_status:1');?>" class="btn <?php  if($spread_status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">正常</a>
				<a href="<?php  echo ifilter_url('spread_status:2');?>" class="btn <?php  if($spread_status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">黑名单</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">等级</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('spread_groupid:0');?>" class="btn <?php  if($spread_groupid == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<?php  if(is_array($group)) { foreach($group as $grade) { ?>
					<a href="<?php  echo ifilter_url('spread_groupid:' . $grade['id']);?>" class="btn <?php  if($spread_groupid == $grade['id']) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>"><?php  echo $grade['title'];?></a>
				<?php  } } ?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">成为推广员时间</label>
		<div class="col-sm-9 col-xs-12">
			<?php  echo itpl_form_field_daterange('spreadtime', array('placeholder' => '成为推广员的时间'));?>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索栏</label>
		<div class="col-sm-3 col-xs-12">
			<input type="text" name="membername" value="<?php  echo $_GPC['membername'];?>" class="form-control" placeholder="昵称/姓名/手机号"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-3 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table">
	<div class="panel panel-table">
		<?php  if(empty($members)) { ?>
			<div class="no-result">
				<p>还没有相关数据</p>
			</div>
		<?php  } else { ?>
			<div class="panel-body table-responsive js-table">
				<?php  if(empty($members)) { ?>
					<div class="no-result">
						<p>还没有相关数据</p>
					</div>
				<?php  } else { ?>
				<div class="alert alert-info">
					注意:如果您想永久取消某人的推广权限,可将此人加入推广黑名单
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>
								<div class="checkbox checkbox-inline">
									<input type="checkbox" name="id[]"/>
									<label></label>
								</div>
							</th>
							<th>头像</th>
							<th>会员</th>
							<th>佣金</th>
							<th>等级</th>
							<th>推广会员</th>
							<th>注册时间</th>
							<th>状态</th>
							<th class="text-right">操作</th>
						</tr>
					</thead>
						<?php  if(is_array($members)) { foreach($members as $member) { ?>
						<tr>
							<td>
								<div class="checkbox checkbox-inline">
									<input type="checkbox" name="id[]" value="<?php  echo $member['id'];?>"/>
									<label></label>
								</div>
							</td>
							<td><img src="<?php  echo tomedia($member['avatar'])?>" alt="" width="50px"><?php  echo $member['nickname'];?></td>
							<td>
								<?php  echo $member['realname'];?>
								<br>
								<?php  echo $member['mobile'];?>
							</td>
							<td><?php  echo $member['spreadcredit2'];?></td>
							<td><?php  echo to_spreadgroup($member['spread_groupid'], 'title')?></td>
							<td>
								<?php  echo $member['total'];?>
								<?php  if($member['total'] > 0) { ?>
									<i class="fa fa-info-circle" data-toggle="popover" data-placement="bottom" data-html="true" data-content="一级：<?php  echo $member['level1'];?>人 <br> 二级：<?php  echo $member['level2'];?>人"></i>
								<?php  } ?>
							</td>
							<td>
								<?php  echo date('Y-m-d', $member['addtime'])?>
								<br/>
								<?php  echo date('H:i:s', $member['addtime'])?>
							</td>
							<td><span class="<?php  echo spread_status($member['spread_status'], 'css')?>"><?php  echo spread_status($member['spread_status'], 'text')?></span></td>
							<td class="text-right">
								<a href="<?php  echo iurl('spread/user/index', array('spread' => $member['uid']))?>" class="btn btn-primary btn-sm">查看下线</a>
								<a href="<?php  echo iurl('spread/members/del', array('id' => $member['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定取消分销资格?">取消分销资格</a>
								<a href="<?php  echo iurl('spread/members/changes', array('id' => $member['id']))?>" class="btn btn-default btn-sm js-modal">账户变动</a>
							</td>
						</tr>
						<?php  } } ?>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('spread/members/del')?>" class="btn btn-primary btn-sm btn-danger js-batch" data-batch="remove" data-confirm="确定取消分销资格吗">取消分销资格</a>
						<a href="<?php  echo iurl('spread/members/status', array('value' => 1))?>" class="btn btn-primary btn-sm js-batch" data-confirm="确定审核通过吗">审核通过</a>
						<a href="<?php  echo iurl('spread/members/status', array('value' => 0))?>" class="btn btn-danger btn-sm js-batch" data-confirm="确定取消审核吗">取消审核</a>
						<a href="<?php  echo iurl('spread/members/status', array('value' => 2))?>" class="btn btn-danger btn-sm js-batch" data-confirm="确定加入黑名单吗">加入黑名单</a>
					</div>
					<div class="pull-right">
						<?php  echo $page;?>
					</div>
				</div>
				<?php  } ?>
			</div>
		<?php  } ?>
	</div>
</form>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
