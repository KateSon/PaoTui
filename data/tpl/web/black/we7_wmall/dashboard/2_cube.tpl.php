<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<?php  if($_W['is_agent']) { ?>
<form action="" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('dashboard/cube/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择代理区域</label>
		<div class="col-sm-4 col-xs-4">
			<select name="agentid" class="select2 js-select2 form-control width-130">
				<option value="0">选择代理区域</option>
				<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
					<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
</form>
<?php  } ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead>
				<tr>
					<th></th>
					<?php  if($_W['is_agent']) { ?>
						<th>所属城市</th>
					<?php  } ?>
					<th>图片</th>
					<th>标题</th>
					<th>副标题</th>
					<th>跳转链接</th>
					<th class="text-right">操作</th>
				</tr>
				</thead>
				<tbody id="tpl-cube-container">
				<?php  if(is_array($cubes)) { foreach($cubes as $cube) { ?>
					<tr class="cube-item">
						<td><a href="javascript:;" class="btn btn-default btn-sm btn-move"><i class="fa fa-arrows"></i></a></td>
						<?php  if($_W['is_agent']) { ?>
							<td><?php  echo toagent($cube['agentid'])?></td>
						<?php  } ?>
						<td>
							<div class="input-group ">
								<div class="input-group-addon">
									<img src="<?php  echo tomedia($cube['thumb']);?>" width="20" height="20">
								</div>
								<input type="text" name="thumbs[]" value="<?php  echo $cube['thumb'];?>" class="form-control" autocomplete="off">
								<span class="input-group-btn">
									<button class="btn btn-default btn-image" type="button">选择图片</button>
								</span>
							</div>
						</td>
						<td>
							<input type="text" name="titles[]" value="<?php  echo $cube['title'];?>" class="form-control width-130">
						</td>
						<td>
							<input type="text" name="tips[]" value="<?php  echo $cube['tips'];?>" class="form-control width-130">
						</td>
						<td>
							<div class="input-group">
								<input type="text" value="<?php  echo $cube['link'];?>" name="links[]" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-default btn-links" type="button">选择链接</button>
								</span>
							</div>
						</td>
						<td class="text-right">
							<a href="javascript:;" class="btn btn-danger btn-sm btn-cube-del"><i class="fa fa-times"> </i></a>
						</td>
					</tr>
				<?php  } } ?>
				</tbody>
				<tr>
					<td colspan="6">
						<a href="javascript:;" class="btn btn-default btn-sm btn-cube-add"><i class="fa fa-plus"></i> 添加魔方</a>
					</td>
				</tr>
			</table>
			<div class="btn-region clearfix">
				<input type="submit" class="btn btn-primary btn-sm" name="submit" value="保存" />
			</div>
		</div>
	</div>
</form>
<?php  } ?>
<script type="text/javascript">
	irequire(['web/tiny'], function(tiny){
		var html = '<tr class="cube-item">'+
				'	<td><a href="javascript:;" class="btn btn-default btn-sm btn-move"><i class="fa fa-arrows"></i></a></td>'+
				'	<td>'+
				'		<div class="input-group ">'+
				'			<div class="input-group-addon">'+
				'				<img src="" width="20" height="20">'+
				'			</div>'+
				'			<input type="text" name="thumbs[]" value="" class="form-control" autocomplete="off">'+
				'			<span class="input-group-btn">'+
				'				<button class="btn btn-default btn-image" type="button">选择图片</button>'+
				'			</span>'+
				'		</div>'+
				'	</td>'+
				'	<td><input type="text" name="titles[]" class="form-control width-130" value="" placeholder="标题"></td>'+
				'	<td><input type="text" name="tips[]" class="form-control width-130" value="" placeholder="副标题"></td>'+
				'	<td>'+
				'		<div class="input-group">'+
				'			<input type="text" value="" name="links[]" class="form-control " autocomplete="off">'+
				'			<span class="input-group-btn">'+
				'				<button class="btn btn-default btn-links " type="button">选择链接</button>'+
				'			</span>'+
				'		</div>'+
				'	</td>'+
				'	<td class="text-right">'+
				'		<a href="javascript:;" class="btn btn-danger btn-sm btn-cube-del"><i class="fa fa-times"> </i></a>'+
				'	</td>'+
				'</tr>';

		$(document).on('click', '.btn-image', function(){
			var btn = $(this);
			var ipt = btn.parent().prev();
			var val = ipt.val();
			var img = ipt.parent().parent().find(".input-group-addon img");
			util.image(val, function(url){
				if(url.url){
					if(img.length > 0){
						img.get(0).src = url.url;
					}
					ipt.val(url.attachment);
					ipt.attr("filename",url.filename);
					ipt.attr("url",url.url);
				}
			}, null);
		});

		$(document).on('click', '.btn-links', function() {
			var ipt = $(this).parent().prev();
			tiny.selectLink(function(href){
				ipt.val(href);
			});
		});

		$(document).on('click', '.btn-cube-add', function(){
			if($('#tpl-cube-container .cube-item').length >= 10) {
				Notify.error('最多可添加10个魔方');
				return false;
			}
			$('#tpl-cube-container').append(html);
			require(['jquery.ui'] ,function(){
				$("#tpl-cube-container").sortable({handle: '.btn-move', axis: 'y'});
			})
		});

		$(document).on('click', '.btn-cube-del', function(){
			$(this).parent().parent().remove();
		});

		require(['jquery.ui'] ,function(){
			$("#tpl-cube-container").sortable({handle: '.btn-move', axis: 'y'});
		})
	});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
