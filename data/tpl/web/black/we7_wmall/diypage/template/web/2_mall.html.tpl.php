<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<link href="../addons/we7_wmall/plugin/diypage/static/css/diy.css" rel="stylesheet" type="text/css"/>
<?php  if($op == 'menu') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖模块</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">选择</div>
					<select name="menu[takeout]" class="form-control">
						<option value="0" {$config_menu['takeout'] == 0}>系统默认</option>
						<?php  if(is_array($menus)) { foreach($menus as $menu) { ?>
							<option value="<?php  echo $menu['id'];?>" <?php  if($menu['id'] == $config_menu['takeout']) { ?>selected<?php  } ?>><?php  echo $menu['name'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
		</div>
		<?php  if(check_plugin_perm('errander')) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿模块</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<div class="input-group-addon">选择</div>
						<select name="menu[errander]" class="form-control">
							<option value="0" {$config_menu['errander'] == 0}>系统默认</option>
							<?php  if(is_array($menus)) { foreach($menus as $menu) { ?>
							<option value="<?php  echo $menu['id'];?>" <?php  if($menu['id'] == $config_menu['errander']) { ?>selected<?php  } ?>><?php  echo $menu['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
			</div>
		<?php  } ?>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">下单有礼</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group">
                    <div class="input-group-addon">选择</div>
                    <select name="menu[ordergrant]" class="form-control">
                        <option value="0" {$config_menu['ordergrant'] == 0}>系统默认</option>
                        <?php  if(is_array($menus)) { foreach($menus as $menu) { ?>
                            <option value="<?php  echo $menu['id'];?>" <?php  if($menu['id'] == $config_menu['ordergrant']) { ?>selected<?php  } ?>><?php  echo $menu['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
        </div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>