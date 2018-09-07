<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';

if ($op == 'index') {
	$_W['page']['title'] = '跑腿设置';

	if ($_W['ispost']) {
		$errander = array('status' => intval($_GPC['status']), 'mobile' => trim($_GPC['mobile']), 'pay_time_limit' => intval($_GPC['pay_time_limit']), 'handle_time_limit' => intval($_GPC['handle_time_limit']), 'dispatch_mode' => intval($_GPC['dispatch_mode']), 'deliveryer_fee_type' => intval($_GPC['deliveryer_fee_type']), 'deliveryer_collect_max' => intval($_GPC['deliveryer_collect_max']), 'over_collect_max_notify' => intval($_GPC['over_collect_max_notify']), 'deliveryer_transfer_status' => intval($_GPC['deliveryer_transfer_status']), 'deliveryer_transfer_max' => intval($_GPC['deliveryer_transfer_max']), 'deliveryer_transfer_reason' => explode("\n", trim($_GPC['deliveryer_transfer_reason'])));
		$order['deliveryer_transfer_reason'] = array_filter($order['deliveryer_transfer_reason'], trim);
		$errander['deliveryer_fee'] = $errander['deliveryer_fee_type'] == 1 ? trim($_GPC['deliveryer_fee_1']) : trim($_GPC['deliveryer_fee_2']);
		$errander['anonymous'] = array();

		if (!empty($_GPC['anonymous'])) {
			foreach ($_GPC['anonymous'] as $anonymous) {
				if (empty($anonymous)) {
					continue;
				}

				$errander['anonymous'][] = $anonymous;
			}
		}

		set_agent_plugin_config('errander', $errander);
		imessage(error(0, '设置跑腿服务参数成功'), 'refresh', 'ajax');
	}

	$config_errander = get_agent_plugin_config('errander');
	$config_errander['deliveryer_transfer_reason'] = implode("\n", $config_errander['deliveryer_transfer_reason']);
}

include itemplate('config');

?>
