<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';

if ($op == 'index') {
	$_W['page']['title'] = '页面选择';

	if ($_W['ispost']) {
		$use_diy_home = intval($_GPC['use_diy_home']);
		set_plugin_config('wxapp.diy.use_diy_home', $use_diy_home);
		$data = $_GPC['shopPages'];
		set_plugin_config('wxapp.diy.shopPage', $data);
		imessage(error(0, '编辑成功'), referer(), 'ajax');
	}

	$pages = array(
		'home' => array('name' => '平台首页', 'url' => 'pages/home/index', 'key' => 'home')
		);
	$diyPages = pdo_getall('tiny_wmall_wxapp_page', array('uniacid' => $_W['uniacid']), array('id', 'name'));
	$config_diy = get_plugin_config('wxapp.diy');
}

include itemplate('diyShop');

?>
