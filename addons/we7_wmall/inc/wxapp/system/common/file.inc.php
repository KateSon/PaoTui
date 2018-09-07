<?php
//dezend by http://www.5kym.cn/
defined(base64_decode('SU5fSUE=')) || exit(base64_decode('QWNjZXNzIERlbmllZA=='));
global $_W;
global $_GPC;
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'image';

if ($ta == 'image') {
	$media_id = trim($_GPC['media_id']);
	$status = media_id2url($media_id);

	if (is_error($status)) {
		message($status, '', 'ajax');
	}

	$data = array('errno' => 0, 'message' => $status, 'url' => tomedia($status));
	message($data, '', 'ajax');
}

?>
