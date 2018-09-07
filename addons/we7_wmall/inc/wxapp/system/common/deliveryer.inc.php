<?php
//dezend by http://www.5kym.cn/
defined(base64_decode('SU5fSUE=')) || exit(base64_decode('QWNjZXNzIERlbmllZA=='));
global $_W;
global $_GPC;
icheckauth();
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'location';

if ($ta == 'location') {
	$id = intval($_GPC['id']);
	$deliveryer = pdo_get('tiny_wmall_deliveryer', array('uniacid' => $_W['uniacid'], 'id' => $id));

	if (empty($deliveryer)) {
		imessage(error(-1, '配送员不存在或已删除'), '', 'ajax');
	}

	$deliveryer['avatar'] = tomedia($deliveryer['avatar']);
	imessage(error(0, $deliveryer), '', 'ajax');
}

?>
