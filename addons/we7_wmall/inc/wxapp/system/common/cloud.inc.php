<?php
//dezend by http://www.5kym.cn/
defined(base64_decode('SU5fSUE=')) || exit(base64_decode('QWNjZXNzIERlbmllZA=='));
mload()->model(base64_decode('Y2xvdWQ='));
global $_W;
global $_GPC;
$ta = trim($_GPC['ta']);
$post = file_get_contents('php://input');

if ($ta == 'touch') {
	imessage(error(0, 'success'), '', 'ajax');
}

if ($ta == 'build') {
	$data = cloud_w_parse_build($post);
	imessage($data, '', 'ajax');
}

if ($ta == 'schema') {
	cloud_w_parse_schema($post);
}

if ($ta == 'download') {
	$data = cloud_w_parse_download($post);
	imessage($data, '', 'ajax');
}

?>
