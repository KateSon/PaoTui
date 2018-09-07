<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
mload()->model('cloud');
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';

if ($op == 'index') {
	$_W['page']['title'] = '基础设置';

	if ($_W['ispost']) {
		$url = cloud_w_get_wxapp_authorize_url();
		imessage($url, '', 'ajax');
	}

	$wxapp = cloud_w_get_wxapp_authorize_info();

	if (is_error($wxapp)) {
		imessage($wxapp['message'], '', 'error');
	}

	$wxapp = $wxapp['message'];
	include itemplate('release/index');
	exit();
}

if ($op == 'commit') {
	$result = cloud_w_wxapp_commit();
	imessage($result, iurl('wxapp/release/index'), 'error');
}

if ($op == 'get_category') {
	$result = cloud_w_wxapp_get_category();
	include itemplate('release/category');
}

if ($op == 'submit_audit') {
	if ($_W['ispost']) {
		if (!$_GPC['first_id'] || !$_GPC['second_id'] || !$_GPC['first_class'] || !$_GPC['second_class']) {
			imessage('所选信息有误,请重新选择', iurl('wxapp/release/index'), 'error');
		}

		$result = cloud_w_wxapp_submit_audit();
		imessage($result['message'], iurl('wxapp/release/index'), 'error');
	}
}

if ($op == 'release') {
	$result = cloud_w_wxapp_release();
	imessage($result, iurl('wxapp/release/index'), 'error');
}

?>
