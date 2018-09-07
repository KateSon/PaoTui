<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
icheckauth();
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'list';

if ($ta == 'list') {
	$addresses = member_fetchall_address();
	$respon = array('errno' => 0, 'message' => array_values($addresses));
	imessage($respon, '', 'ajax');
}

if ($ta == 'post') {
	$id = intval($_GPC['id']);

	if (0 < $id) {
		$address = member_fetch_address($id);

		if (empty($address)) {
			imessage(error(-1, '地址不存在或已经删除'), '', 'ajax');
		}
	}
	else {
		$address = array('mobile' => $_W['member']['mobile'], 'realname' => $_W['member']['realname']);
	}

	if ($_W['ispost']) {
		if (empty($_GPC['realname']) || empty($_GPC['mobile'])) {
			imessage(error(-1, '信息有误'), '', 'ajax');
		}

		$data = array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid'], 'realname' => trim($_GPC['realname']), 'sex' => trim($_GPC['sex']), 'mobile' => trim($_GPC['mobile']), 'address' => trim($_GPC['address']), 'number' => trim($_GPC['number']), 'location_x' => trim($_GPC['location_x']), 'location_y' => trim($_GPC['location_y']), 'type' => 1);
		if (0 && $_W['is_agent']) {
			$store['auto_get_address'] = 1;
			$agentid = get_location_agent($data['location_x'], $data['location_y']);

			if ($agentid < 0) {
				imessage(error(-1, '该地址不在平台服务范围,请重新选择'), '', 'ajax');
			}
		}

		$sid = intval($_GPC['sid']);
		$force = intval($_GPC['force']);
		if (!$force && 0 < $sid) {
			$address = member_takeout_address_check($sid, $data);

			if (is_error($address)) {
				imessage(error(-1000, '亲,您的地址已超出商家的配送范围了'), '', 'ajax');
			}
		}

		if (!empty($id)) {
			pdo_update('tiny_wmall_address', $data, array('uniacid' => $_W['uniacid'], 'id' => $id));
		}
		else {
			pdo_insert('tiny_wmall_address', $data);
			$id = pdo_insertid();
		}

		imessage(error(0, $id), '', 'ajax');
	}

	imessage(error(0, $address), '', 'ajax');
}

if ($ta == 'del') {
	$id = intval($_GPC['id']);
	pdo_delete('tiny_wmall_address', array('uniacid' => $_W['uniacid'], 'id' => $id));
	imessage(error(0, '删除成功'), '', 'ajax');
}

if ($ta == 'default') {
	$id = intval($_GPC['id']);
	pdo_update('tiny_wmall_address', array('is_default' => 0), array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid'], 'type' => 1));
	pdo_update('tiny_wmall_address', array('is_default' => 1), array('uniacid' => $_W['uniacid'], 'id' => $id));
	exit();
}

?>
