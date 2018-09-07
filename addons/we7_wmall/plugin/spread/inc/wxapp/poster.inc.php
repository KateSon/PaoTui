<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
icheckauth();
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';
$_W['page']['title'] = '推广海报';
$settle = get_plugin_config('spread.settle');
$relate = get_plugin_config('spread.relate');

if ($op == 'index') {
	mload()->model('poster');
	mload()->model('qrcode');
	$_config_plugin['poster']['data'] = json_decode(base64_decode($_config_plugin['poster']['data']), true);
	$_config_qrcode = $_config_plugin['poster']['qrcode'];
	$array = array('url' => 'pages/home/index', 'scene' => 'spread:' . $_W['member']['uid'], 'path' => '/we7_wmall/wxappqrcode/spread/' . $_W['uniacid'] . '/' . $_W['member']['uid'] . '_spread.png');
	$qrcode_url = qrcode_wxapp_build($array);

	if (is_error($qrcode_url)) {
		$respon = array('errno' => 1, 'message' => '生成二维码失败' . $qrcode_url);
		imessage($respon, '', 'ajax');
	}

	$qrcode_url = tomedia($qrcode_url);
	$_config_plugin['poster']['qrcode_url'] = $qrcode_url;
	$params = array('config' => $_config_plugin['poster'], 'member' => $_W['member'], 'name' => 'spread_wxapp_' . $_W['member']['uid'], 'plugin' => 'spread');
	$url = poster_create($params);

	if (is_error($data)) {
		$respon = array('errno' => 1, 'message' => '生成海报失败');
		imessage($respon, '', 'ajax');
	}

	$reslut = array('relate' => $relate, 'settle' => $settle, 'respon' => $url);
	imessage(error(0, $reslut), '', 'ajax');
}

?>
