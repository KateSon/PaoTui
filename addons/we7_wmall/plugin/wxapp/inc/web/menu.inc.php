<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'post';

if ($op == 'post') {
	$_W['page']['title'] = '编辑导航';

	if ($_W['ispost']) {
		$data = $_GPC['menu'];
		$data = base64_encode(json_encode($data));
		set_plugin_config('wxapp.menu', $data);
		imessage(error(0, '保存成功'), iurl('wxapp/menu/post'), 'ajax');
	}

	$menu = get_plugin_config('wxapp.menu');
	$menu = json_decode(base64_decode($menu), true);
}

include itemplate('menu');

?>
