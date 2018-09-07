<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
icheckauth();
$user = $_W['member'];
$user['avatar'] = tomedia($user['avatar']);
$user['nickname'] = $_W['member']['nickname'];
$user['avatar'] = $_W['member']['avatar'];
$config_settle = $_W['we7_wmall']['config']['store']['settle'];
$config_mall = $_W['we7_wmall']['config']['mall'];
$config_delivery = $_W['we7_wmall']['config']['delivery'];
$favorite = intval(pdo_fetchcolumn('select count(*) from ' . tablename('tiny_wmall_store_favorite') . ' where uniacid = :uniacid and uid = :uid', array(':uniacid' => $_W['uniacid'], ':uid' => $_W['member']['uid'])));
$coupon_nums = intval(pdo_fetchcolumn('select count(*) from ' . tablename('tiny_wmall_activity_coupon_record') . ' where uniacid = :uniacid and uid = :uid and status = 1', array(':uniacid' => $_W['uniacid'], ':uid' => $_W['member']['uid'])));
$redpacket_nums = intval(pdo_fetchcolumn('select count(*) from ' . tablename('tiny_wmall_activity_redpacket_record') . ' where uniacid = :uniacid and uid = :uid and status = 1', array(':uniacid' => $_W['uniacid'], ':uid' => $_W['member']['uid'])));
$deliveryCard_status = check_plugin_perm('deliveryCard') && get_plugin_config('deliveryCard.card_apply_status');
$deliveryCard_setmeal_ok = 0;
if ($deliveryCard_status && 0 < $user['setmeal_id'] && TIMESTAMP < $user['setmeal_endtime']) {
	$deliveryCard_setmeal_ok = 1;
}

$redpacket_status = check_plugin_perm('shareRedpacket') || check_plugin_perm('freeLunch') || check_plugin_perm('superRedpacket');

if (check_plugin_perm('spread')) {
	$config_spread = get_plugin_config('spread.basic');

	if ($config_spread['show_in_mine']) {
		$spread = array('status' => 1, 'title' => $config_spread['menu_name']);
	}
}

if (check_plugin_perm('ordergrant') && get_plugin_config('ordergrant.status')) {
	$ordergrant = 1;
}
else {
	$ordergrant = 0;
}

$slides = sys_fetch_slide('member', true);

if (empty($slides)) {
	$slides = false;
}

$result = array('config' => $_W['we7_wmall']['config'], 'redpacket_nums' => $redpacket_nums, 'coupon_nums' => $coupon_nums, 'credit2' => floatval($user['credit2']), 'credit1' => floatval($user['credit1']), 'user' => $user, 'deliveryCard_status' => $deliveryCard_status, 'deliveryCard_setmeal_ok' => $deliveryCard_setmeal_ok, 'spread' => $spread, 'ordergrant' => $ordergrant, 'slides' => $slides);
imessage(error(0, $result), '', 'ajax');

?>
