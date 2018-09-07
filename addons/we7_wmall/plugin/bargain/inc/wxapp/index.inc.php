<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;

if (!check_plugin_perm('bargain')) {
	imessage(error(-1, '暂未开放此功能'), '', 'ajax');
}

$config_bargain = get_plugin_config('bargain');

if ($config_bargain['status'] == 0) {
	imessage(error(-1, '暂未开放此功能'), '', 'ajax');
}

$_W['page']['title'] = '天天特价';
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';

if ($op == 'index') {
	$condition = ' where a.uniacid = :uniacid and a.agentid = :agentid and a.status= 1';
	$params = array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']);
	$page = max(1, intval($_GPC['page']));
	$psize = intval($_GPC['psize']);
	$bargains = pdo_fetchall('select a.discount_price,a.goods_id,a.discount_available_total,b.title,b.thumb,b.price,b.sid,b.sailed from ' . tablename('tiny_wmall_activity_bargain_goods') . ' as a left join ' . tablename('tiny_wmall_goods') . ' as b on a.goods_id = b.id ' . $condition . ' order by a.mall_displayorder desc limit ' . ($page - 1) * $psize . (' , ' . $psize), $params);

	if (!empty($bargains)) {
		$stores = pdo_fetchall('select distinct(a.sid),b.title,b.is_in_business from ' . tablename('tiny_wmall_activity_bargain') . ' as a left join ' . tablename('tiny_wmall_store') . ' as b on a.sid = b.id where a.uniacid = :uniacid and a.agentid = :agentid and a.status = 1', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']), 'sid');

		foreach ($bargains as &$row) {
			if ($row['discount_available_total'] == -1) {
				$row['discount_available_total'] = '无限';
			}

			$row['store'] = $stores[$row['sid']];
			$row['thumb'] = tomedia($row['thumb']);
			$row['discount'] = round($row['discount_price'] / $row['price'] * 10, 1);
		}
	}

	$respon = array('bargains' => $bargains, 'config' => $config_bargain);
	imessage(error(0, $respon), '', 'ajax');
}

?>
