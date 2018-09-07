<?php
//dezend by http://www.5kym.cn/
defined(base64_decode('SU5fSUE=')) || exit(base64_decode('QWNjZXNzIERlbmllZA=='));
mload()->model(base64_decode('Y3Jvbg=='));
global $_W;
global $_GPC;
$task = cache_read('we7_wmall:task');
if (!empty($task) && TIMESTAMP < $task['expiretime']) {
	exit('process');
}

cache_write(base64_decode('d2U3X3dtYWxsOnRhc2s='), array(base64_decode('ZXhwaXJldGltZQ==') => TIMESTAMP + 120));
$accounts = pdo_getall('tiny_wmall_config', array());

if (empty($accounts)) {
	exit('success');
}

ignore_user_abort();
set_time_limit(0);

foreach ($accounts as &$account) {
	$_W['uniacid'] = $account['uniacid'];
	if (empty($_W['uniacid']) || $_W['uniacid'] == -1) {
		continue;
	}

	$_W['uniaccount'] = $_W['account'] = uni_fetch($_W['uniacid']);

	if (empty($_W['uniaccount'])) {
		continue;
	}

	$_W['we7_wmall']['config'] = get_system_config();
	cron_order();
}

cache_delete(base64_decode('d2U3X3dtYWxsOnRhc2s='));
exit(base64_decode('c3VjY2Vzcw=='));

?>
