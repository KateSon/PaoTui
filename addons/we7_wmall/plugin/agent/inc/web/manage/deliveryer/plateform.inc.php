<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
mload()->model('deliveryer');
global $_W;
global $_GPC;
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';

if ($op == 'list') {
	$_W['page']['title'] = '平台配送员';
	$condition = ' WHERE a.uniacid = :uniacid and a.agentid = :agentid and a.sid = 0';
	$params[':uniacid'] = $_W['uniacid'];
	$params = array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']);
	$keyword = trim($_GPC['keyword']);

	if (!empty($keyword)) {
		$condition .= ' and (b.title like \'%' . $keyword . '%\' or b.nickname like \'%' . $keyword . '%\' or b.mobile like \'%' . $keyword . '%\')';
	}

	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tiny_wmall_store_deliveryer') . ' as a left join ' . tablename('tiny_wmall_deliveryer') . ' as b on a.deliveryer_id = b.id' . $condition, $params);
	$data = pdo_fetchall('SELECT a.*,b.nickname,b.title,b.mobile,b.sex,b.age,b.avatar,b.credit2 FROM ' . tablename('tiny_wmall_store_deliveryer') . ' as a left join ' . tablename('tiny_wmall_deliveryer') . ' as b on a.deliveryer_id = b.id' . $condition . ' ORDER BY a.id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, $params);

	if (!empty($data)) {
		$deliveryers = pdo_getall('tiny_wmall_deliveryer', array('uniacid' => $_W['uniacid'], 'agentid' => $_W['agentid']), array(), 'id');

		foreach ($data as &$row) {
			$row['stores'] = pdo_fetchall('select sid from ' . tablename('tiny_wmall_store_deliveryer') . ' where uniacid = :uniacid and agentid = :agentid and deliveryer_id = :deliveryer_id and sid > 0', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid'], ':deliveryer_id' => $row['deliveryer_id']));
		}

		$stores = pdo_getall('tiny_wmall_store', array('uniacid' => $_W['uniacid']), array('id', 'title'), 'id');
	}

	$pager = pagination($total, $pindex, $psize);
}

if ($op == 'add_ptf_deliveryer') {
	if ($_W['ispost']) {
		$mobile = trim($_GPC['mobile']);

		if (empty($mobile)) {
			imessage(error(-1, '手机号不能为空'), '', 'ajax');
		}

		$deliveryer = pdo_get('tiny_wmall_deliveryer', array('uniacid' => $_W['uniacid'], 'agentid' => $_W['agentid'], 'mobile' => $mobile));

		if (empty($deliveryer)) {
			imessage(error(-1, '未找到该手机号对应的配送员'), '', 'ajax');
		}

		$is_exist = pdo_get('tiny_wmall_store_deliveryer', array('uniacid' => $_W['uniacid'], 'deliveryer_id' => $deliveryer['id'], 'sid' => 0));

		if (!empty($is_exist)) {
			if (0 < $is_exist['agentid']) {
				if ($is_exist['agentid'] != $_W['agentid']) {
					imessage(error(-1, '该手机号对应的配送员已经是其他代理商的配送员, 如需修改,请联系平台管理员操作'), '', 'ajax');
				}
				else {
					imessage(error(-1, '您已添加该配送员为平台配送员，请勿重复添加'), '', 'ajax');
				}
			}
		}

		$data = array('uniacid' => $_W['uniacid'], 'agentid' => $_W['agentid'], 'sid' => 0, 'deliveryer_id' => $deliveryer['id'], 'delivery_type' => 2, 'addtime' => TIMESTAMP);
		pdo_insert('tiny_wmall_store_deliveryer', $data);
		imessage(error(0, '添加平台配送员成功'), referer(), 'ajax');
	}

	include itemplate('deliveryer/plateformAdd');
	exit();
}

if ($op == 'del_ptf_deliveryer') {
	$id = intval($_GPC['id']);
	pdo_delete('tiny_wmall_store_deliveryer', array('uniacid' => $_W['uniacid'], 'agentid' => $_W['agentid'], 'sid' => 0, 'id' => $id));
	imessage(error(0, '取消配送员平台配送权限成功'), referer(), 'ajax');
}

if ($op == 'inout') {
	$title = '收支明细';
	$condition = ' WHERE uniacid = :uniacid and agentid = :agentid';
	$params[':uniacid'] = $_W['uniacid'];
	$params = array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']);
	$deliveryer_id = intval($_GPC['deliveryer_id']);

	if (0 < $deliveryer_id) {
		$condition .= ' AND deliveryer_id = :deliveryer_id';
		$params[':deliveryer_id'] = $deliveryer_id;
	}

	$trade_type = intval($_GPC['trade_type']);

	if (0 < $trade_type) {
		$condition .= ' and trade_type = :trade_type';
		$params[':trade_type'] = $trade_type;
	}

	if (!empty($_GPC['addtime'])) {
		$starttime = strtotime($_GPC['addtime']['start']);
		$endtime = strtotime($_GPC['addtime']['end']) + 86399;
	}
	else {
		$today = strtotime(date('Y-m-d'));
		$starttime = strtotime('-15 day', $today);
		$endtime = $today + 86399;
	}

	$condition .= ' AND addtime > :start AND addtime < :end';
	$params[':start'] = $starttime;
	$params[':end'] = $endtime;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tiny_wmall_deliveryer_current_log') . $condition, $params);
	$records = pdo_fetchall('SELECT * FROM ' . tablename('tiny_wmall_deliveryer_current_log') . $condition . ' ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, $params);
	$order_trade_type = order_trade_type();
	$pager = pagination($total, $pindex, $psize);
	$deliveryers = deliveryer_all(true);
}

if ($op == 'stat') {
	$_W['page']['title'] = '配送统计';
	$id = intval($_GPC['id']);
	$deliveryer = deliveryer_fetch($id);

	if (empty($deliveryer)) {
		imessage('配送员不存在', referer(), 'error');
	}

	$start = $_GPC['start'] ? strtotime($_GPC['start']) : strtotime(date('Y-m'));
	$end = $_GPC['end'] ? strtotime($_GPC['end']) + 86399 : strtotime(date('Y-m-d')) + 86399;
	$day_num = ($end - $start) / 86400;
	if ($_W['isajax'] && $_W['ispost']) {
		$days = array();
		$datasets = array(
			'flow1' => array()
			);
		$i = 0;

		while ($i < $day_num) {
			$key = date('m-d', $start + 86400 * $i);
			$days[$key] = 0;
			$datasets['flow1'][$key] = 0;
			++$i;
		}

		$data = pdo_fetchall('SELECT * FROM ' . tablename('tiny_wmall_order') . 'WHERE uniacid = :uniacid AND agentid = :agentid AND deliveryer_id = :deliveryer_id AND delivery_type = 2 and status = 5', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid'], ':deliveryer_id' => $id));

		foreach ($data as $da) {
			$key = date('m-d', $da['addtime']);

			if (in_array($key, array_keys($days))) {
				++$datasets['flow1'][$key];
			}
		}

		$shuju['label'] = array_keys($days);
		$shuju['datasets'] = $datasets;
		exit(json_encode($shuju));
	}

	$stat = deliveryer_plateform_order_stat($id);
}

if ($op == 'getcashlog') {
	$condition = ' WHERE uniacid = :uniacid and agentid = :agentid';
	$params = array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']);
	$deliveryer_id = intval($_GPC['deliveryer_id']);

	if (0 < $deliveryer_id) {
		$condition .= ' AND deliveryer_id = :deliveryer_id';
		$params[':deliveryer_id'] = $deliveryer_id;
	}

	$status = intval($_GPC['status']);

	if (0 < $status) {
		$condition .= ' AND status = :status';
		$params[':status'] = $status;
	}

	if (!empty($_GPC['addtime'])) {
		$starttime = strtotime($_GPC['addtime']['start']);
		$endtime = strtotime($_GPC['addtime']['end']) + 86399;
	}
	else {
		$today = strtotime(date('Y-m-d'));
		$starttime = strtotime('-15 day', $today);
		$endtime = $today + 86399;
	}

	$condition .= ' AND addtime > :start AND addtime < :end';
	$params[':start'] = $starttime;
	$params[':end'] = $endtime;
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tiny_wmall_deliveryer_getcash_log') . $condition, $params);
	$records = pdo_fetchall('SELECT * FROM ' . tablename('tiny_wmall_deliveryer_getcash_log') . $condition . ' ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, $params);
	$pager = pagination($total, $pindex, $psize);
	$deliveryers = deliveryer_all(true);
}

include itemplate('deliveryer/plateform');

?>
