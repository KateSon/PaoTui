<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
mload()->model('deliveryer');
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'all';

if ($op == 'all') {
	$datas = deliveryer_fetchall();
	$datas = array_values($datas);
	message(error(0, $datas), '', 'ajax');
}

?>
