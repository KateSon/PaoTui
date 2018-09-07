<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
	td span{display: inline-block; vertical-align: middle;}
</style>
<form action="./index.php" class="form-horizontal form-filter" >
	<?php  echo tpl_form_filter_hidden('spread/user/index');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">成为会员时间</label>
		<div class="col-sm-9 col-xs-12">
			<?php  echo itpl_form_field_daterange('spreadtime', array('placeholder' => '成为会员的时间'));?>
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
			<table class="table table-hover">
				<thead>
				<tr>
					<th>会员</th>
					<th>直接上线</th>
					<th>间接上线</th>
					<th>上线是否已固定</th>
					<th>注册时间</th>
				</tr>
				</thead>
				<?php  if(is_array($members)) { foreach($members as $member) { ?>
				<tr>
					<td>
						<span>
							<img src="<?php  echo tomedia($member['avatar'])?>" alt="" width="50px">
						</span>
						<span>
							<?php  echo $member['nickname'];?>
							<br/>
							<?php  echo $member['realname'];?>
						</span>
					</td>
					<td>
						<?php  if(empty($member['spread1'])) { ?>
							<?php  if($member['spreadfixed'] > 0) { ?>
								平台直属
							<?php  } else { ?>
								暂无推广人
							<?php  } ?>
						<?php  } else { ?>
							<img src="<?php  echo tomedia($member['spread1']['avatar'])?>" alt="" width="50"/>
							<?php  echo $member['spread1']['nickname'];?>
						<?php  } ?>
					</td>
					<td>
						<?php  if(empty($member['spread2'])) { ?>
							<?php  if($member['spreadfixed'] > 0) { ?>
								平台直属
							<?php  } else { ?>
								暂无推广人
							<?php  } ?>
						<?php  } else { ?>
							<img src="<?php  echo tomedia($member['spread2']['avatar'])?>" alt="" width="50px"/>
							<?php  echo $member['spread2']['nickname'];?>
						<?php  } ?>
					</td>
					<td>
						<?php  if($member['spreadfixed'] == 1) { ?>
							是
						<?php  } else { ?>
							否
						<?php  } ?>
					</td>
					<td>
						<?php  echo date('Y-m-d', $member['addtime'])?>
						<br/>
						<?php  echo date('H:i:s', $member['addtime'])?>
					</td>
				</tr>
				<?php  } } ?>
			</table>
			<?php  echo $pager;?>
			<?php  } ?>
		</div>
		<?php  } ?>
	</div>
</form>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>