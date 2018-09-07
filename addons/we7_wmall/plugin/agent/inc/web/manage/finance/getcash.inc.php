<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';
$agent = get_agent($_W['agentid'], array('amount', 'account'));
$account = $agent['account'];
$account['amount'] = $agent['amount'];

if ($op == 'index') {
	$_W['page']['title'] = '账户余额提现';

	if (empty($account['wechat']['openid'])) {
		header('location:' . iurl('finance/getcash/account'));
		exit();
	}

	if ($_W['ispost']) {
		if (empty($account['wechat']['openid']) || empty($account['wechat']['realname'])) {
			imessage(error(-1, '提现前请先完善提现账户'), '', 'ajax');
		}

		$get_fee = intval($_GPC['get_fee']);

		if ($account['amount'] < $get_fee) {
			imessage(error(-1, '提现金额大于账户可用余额'), '', 'ajax');
		}

		$openid = mktTransfers_get_openid($_W['agentid'], $account['wechat']['openid'], $_GPC['get_fee'], 'agent');

		if (is_error($openid)) {
			imessage($openid, '', 'ajax');
		}

		$account['wechat']['openid'] = $openid;
		$data = array('uniacid' => $_W['uniacid'], 'agentid' => $_W['agentid'], 'trade_no' => date('YmdHis') . random(10, true), 'get_fee' => $get_fee, 'take_fee' => 0, 'final_fee' => $get_fee, 'account' => iserializer($account['wechat']), 'status' => 2, 'addtime' => TIMESTAMP);
		pdo_insert('tiny_wmall_agent_getcash_log', $data);
		agent_update_account($_W['agentid'], 0 - $get_fee, 2, '');
		sys_notice_agent_getcash($_W['agentid'], $getcash_id, 'apply');
		imessage(error(0, '申请提现成功,等待平台管理员审核'), iurl('finance/getcash/log'), 'ajax');
	}
}

if ($op == 'account') {
	$_W['page']['title'] = '设置提现账户';

	if ($_W['ispost']) {
		$wechat = array();
		$wechat['openid'] = trim($_GPC['wechat']['openid']) ? trim($_GPC['wechat']['openid']) : imessage(error(-1, '微信昵称不能为空'), '', 'ajax');
		$wechat['nickname'] = trim($_GPC['wechat']['nickname']);
		$wechat['avatar'] = trim($_GPC['wechat']['avatar']);
		$wechat['realname'] = trim($_GPC['wechat']['realname']) ? trim($_GPC['wechat']['realname']) : imessage(error(-1, '微信实名认证姓名不能为空'), '', 'ajax');
		$update['wechat'] = $wechat;
		pdo_update('tiny_wmall_agent', array('account' => iserializer($update)), array('uniacid' => $_W['uniacid'], 'id' => $_W['agentid']));
		imessage(error(0, '设置提现账户成功'), iurl('finance/getcash/account'), 'ajax');
	}
}

if ($op == 'log') {
	$_W['page']['title'] = '提现记录';
	$condition = ' WHERE uniacid = :uniacid AND agentid = :agentid';
	$params[':uniacid'] = $_W['uniacid'];
	$params = array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']);
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
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tiny_wmall_agent_getcash_log') . $condition, $params);
	$records = pdo_fetchall('SELECT * FROM ' . tablename('tiny_wmall_agent_getcash_log') . $condition . ' ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, $params);

	if (!empty($records)) {
		foreach ($records as &$row) {
			$row['account'] = iunserializer($row['account']);
		}
	}

	$pager = pagination($total, $pindex, $psize);
}

include itemplate('finance/getcash');

?>
