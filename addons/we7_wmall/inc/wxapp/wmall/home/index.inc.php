<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
mload()->model('page');
global $_W;
global $_GPC;
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';
$config_mall = $_W['we7_wmall']['config']['mall'];
icheckauth();
$_config_wxapp = get_plugin_config('wxapp.basic');

if ($_config_wxapp['audit_status'] == 1) {
	$config_mall['version'] = 2;
	$config_mall['default_sid'] = $_config_wxapp['default_sid'];
}

if ($ta == 'index') {
	$slides = sys_fetch_slide('homeTop', true);
	$categorys = store_fetchall_category();
	$categorys_chunk = array_chunk($categorys, 8);
	$notices = pdo_fetchall('select id,title,link,wxapp_link,displayorder,status from' . tablename('tiny_wmall_notice') . ' where uniacid = :uniacid and agentid = :agentid and type = :type and status = 1 order by displayorder desc', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid'], ':type' => 'member'));
	$recommends = store_fetchall_by_condition('recommend', array('extra_type' => 'base'));
	$cubes = pdo_fetchall('select * from ' . tablename('tiny_wmall_cube') . ' where uniacid = :uniacid and agentid = :agentid order by displayorder desc', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']));

	if (!empty($cubes)) {
		foreach ($cubes as &$c) {
			$c['thumb'] = tomedia($c['thumb']);
		}
	}

	if (check_plugin_perm('bargain')) {
		$_config_bargain = get_plugin_config('bargain');
		if ($_config_bargain['status'] == 1 && $_config_bargain['is_home_display'] == 1) {
			$bargains = pdo_fetchall('select a.discount_price,a.goods_id,b.title,b.thumb,b.price,b.sid from ' . tablename('tiny_wmall_activity_bargain_goods') . ' as a left join ' . tablename('tiny_wmall_goods') . ' as b on a.goods_id = b.id where a.uniacid = :uniacid and a.agentid = :agentid and a.status = 1 order by a.mall_displayorder desc limit 4', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']));

			foreach ($bargains as &$val) {
				$val['discount'] = round($val['discount_price'] / $val['price'] * 10, 1);
			}
		}
	}

	$orderbys = store_orderbys();
	$discounts = store_discounts();
	$result = array('config' => $config_mall, 'slides' => $slides, 'categorys' => $categorys, 'categorys_chunk' => $categorys_chunk, 'notices' => $notices, 'recommends' => $recommends, 'cubes' => $cubes, 'bargains' => $bargains, 'stores' => store_filter(), 'orderbys' => $orderbys, 'discounts' => $discounts, 'cart_sum' => get_member_cartnum());
	imessage(error(0, $result), '', 'ajax');
	return 1;
}

if ($ta == 'store') {
	$result = store_filter();
	imessage(error(0, $result), '', 'ajax');
	return 1;
}

if ($ta == 'spread') {
	if (check_plugin_perm('spread')) {
		mload()->model('plugin');
		pload()->model('spread');
		$spread = member_spread_bind();
		imessage($spread, '', 'ajax');
		return 1;
	}
}
else {
	if ($ta == 'cart') {
		$result = array('cart_sum' => get_member_cartnum());
		imessage(error(0, $result), '', 'ajax');
	}
}

?>
