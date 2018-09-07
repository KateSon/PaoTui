<?php
//dezend by http://www.5kym.cn/
defined(base64_decode('SU5fSUE=')) || exit(base64_decode('QWNjZXNzIERlbmllZA=='));
global $_W;
global $_GPC;
icheckauth();
$ta = trim($_GPC['ta']);

if ($ta == 'qianfan') {
	$tid = trim($_GPC['tid']);
	$order_id = trim($_GPC['order_id']);
	$log = pdo_get('tiny_wmall_paylog', array('order_sn' => $tid));

	if (empty($log)) {
		message(error(-1, '交易记录不存在'), '', 'ajax');
	}

	$log = pdo_get('tiny_wmall_paylog', array('order_sn' => $tid, 'out_trade_order_id' => $order_id));

	if (!empty($log)) {
		message(error(-1, '交易记录重复'), '', 'ajax');
	}

	$update = array('out_trade_order_id' => $order_id);
	pdo_update(base64_decode('dGlueV93bWFsbF9wYXlsb2c='), $update, array('order_sn' => $tid));
	message(error(0, ''), '', base64_decode('YWpheA=='));
}

?>
