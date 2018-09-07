<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
icheckAuth();
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';
$sid = intval($_GPC['sid']);
$store = store_fetch($sid);

if (empty($store)) {
	imessage(error(-1, '门店不存在'), '', 'ajax');
}

if ($ta == 'index') {
	$cart = order_fetch_member_cart($sid);

	if (empty($cart)) {
		imessage(error(1000, '购物车数据错误'), '', 'ajax');
	}

	$pay_types = order_pay_types();
	$default_order_type = 1;

	if ($store['delivery_type'] == 2) {
		$default_order_type = 2;
	}

	$condition = array('order_type' => $default_order_type);
	$params = json_decode(htmlspecialchars_decode($_GPC['extra']), true);

	if (!empty($params)) {
		$address_id = intval($params['address_id']);

		if (0 < $address_id) {
			$address = member_takeout_address_check($store, $address_id);
			$condition['address'] = $address;
		}

		$condition = array_merge($condition, $params);
	}

	if (empty($address)) {
		$address = member_fetch_available_address($store);
		$condition['address'] = $address;
	}

	$order = order_calculate($store, $cart, $condition);
	$result = array('store' => $store, 'address' => $address ? $address : array(), 'cart' => $cart, 'coupons' => order_coupon_available($sid, $cart['price']), 'redPackets' => order_redPacket_available($cart['price'], explode('|', $store['cid'])), 'addresses' => member_fetchall_address_bystore($sid), 'order' => $order, 'islegal' => 0);
	$result['islegal'] = $store['is_in_business_hours'] && !empty($address);
	$result['islegal'] = intval($result['islegal']);
	imessage(error(0, $result), '', 'ajax');
}

if ($ta == 'submit') {
	$cart = order_check_member_cart($sid);

	if (is_error($cart)) {
		imessage($cart, '', 'ajax');
	}

	if (!$store['is_in_business_hours']) {
		imessage(error(-1, '商户休息中'), '', 'ajax');
	}

	$default_order_type = 1;

	if ($store['delivery_type'] == 2) {
		$default_order_type = 2;
	}

	$condition = array('order_type' => $default_order_type);
	$params = json_decode(htmlspecialchars_decode($_GPC['extra']), true);

	if (empty($params)) {
		imessage(error(-1, '参数错误'), '', 'ajax');
	}

	if ($params['order_type'] != 2) {
		$address_id = intval($params['address_id']);
		$address = member_takeout_address_check($store, $address_id);

		if (is_error($address)) {
			imessage(error(-1, $address['message']), '', 'ajax');
		}

		$condition['address'] = $address;
	}

	$condition = array_merge($condition, $params);
	$calculate = order_calculate($store, $cart, $condition);
	$invoice_id = intval($condition['invoice_id']);

	if (0 < $invoice_id) {
		$invoice = member_invoice($invoice_id);
		$invoice = iserializer(array('title' => $invoice['title'], 'recognition' => $invoice['recognition']));
	}

	$order = array(
		'uniacid'                => $_W['uniacid'],
		'agentid'                => $store['agentid'],
		'acid'                   => $_W['acid'],
		'sid'                    => $sid,
		'uid'                    => $_W['member']['uid'],
		'mall_first_order'       => $_W['member']['is_mall_newmember'],
		'ordersn'                => date('YmdHis') . random(6, true),
		'serial_sn'              => store_order_serial_sn($sid),
		'code'                   => random(4, true),
		'order_type'             => $calculate['order_type'],
		'openid'                 => $_W['openid'],
		'mobile'                 => $address['mobile'] ? $address['mobile'] : $_W['member']['mobile'],
		'username'               => $address['realname'] ? $address['realname'] : $_W['member']['realname'],
		'sex'                    => $address['sex'],
		'address'                => $address['address'] . $address['number'],
		'location_x'             => $address['location_x'],
		'location_y'             => $address['location_y'],
		'delivery_day'           => $calculate['deliveryTimes']['predict_day_cn'],
		'delivery_time'          => $calculate['deliveryTimes']['predict_time_cn'],
		'delivery_fee'           => $calculate['delivery_fee'],
		'pack_fee'               => $calculate['pack_fee'],
		'pay_type'               => trim($_GPC['pay_type']),
		'num'                    => $cart['num'],
		'distance'               => $address['distance'],
		'box_price'              => $calculate['box_price'],
		'price'                  => $calculate['price'],
		'extra_fee'              => $calculate['extra_fee'],
		'total_fee'              => $calculate['total_fee'],
		'discount_fee'           => $calculate['discount_fee'],
		'store_discount_fee'     => $calculate['activityed']['store_discount_fee'],
		'plateform_discount_fee' => $calculate['activityed']['plateform_discount_fee'],
		'agent_discount_fee'     => $calculate['activityed']['agent_discount_fee'],
		'final_fee'              => $calculate['final_fee'],
		'vip_free_delivery_fee'  => !empty($calculate['activityed']['list']['vip_delivery']) ? 1 : 0,
		'delivery_type'          => $store['delivery_mode'],
		'status'                 => 1,
		'is_comment'             => 0,
		'invoice'                => $invoice,
		'addtime'                => TIMESTAMP,
		'data'                   => array(
			'extra_fee'  => $calculate['extra_fee_detail'],
			'cart'       => iunserializer($cart['original_data']),
			'commission' => array('spread1_rate' => '0%', 'spread1' => 0, 'spread2_rate' => '0%', 'spread2' => 0)
			),
		'note'                   => trim($calculate['note'])
		);

	if ($order['final_fee'] < 0) {
		$order['final_fee'] = 0;
	}

	$order['spreadbalance'] = 1;

	if (check_plugin_perm('spread')) {
		if (!empty($_W['member']['spread1']) && $_W['member']['spreadfixed'] == 1) {
			mload()->model('plugin');
			$_W['plugin'] = array('name' => 'spread');
			pload()->model('spread');
			$config_spread = get_plugin_config('spread');
			$order['spread1'] = $_W['member']['spread1'];

			if ($config_spread['basic']['level'] == 2) {
				$order['spread2'] = $_W['member']['spread2'];
			}

			$spreads = pdo_fetchall('select uid,spread_groupid from ' . tablename('tiny_wmall_members') . ' where uid = :uid1 or uid = :uid2', array(':uid1' => $order['spread1'], ':uid2' => $order['spread2']), 'uid');

			if (!empty($spreads)) {
				$order['spreadbalance'] = 0;
				$groups = spread_groups();
				$spread1_rate = $groups[$spreads[$order['spread1']]['spread_groupid']]['commission1'] / 100;
				$commission_spread1 = round($spread1_rate * $order['final_fee'], 2);

				if (!empty($order['spread2'])) {
					$spread2_rate = $groups[$spreads[$order['spread2']]['spread_groupid']]['commission2'] / 100;
					$commission_spread2 = round($spread2_rate * $order['final_fee'], 2);
				}

				$spread1_rate = $spread1_rate * 100;
				$spread2_rate = $spread2_rate * 100;
				$order['data']['spread'] = array(
	'commission' => array('spread1_rate' => $spread1_rate . '%', 'spread1' => $commission_spread1, 'spread2_rate' => $spread2_rate . '%', 'spread2' => $commission_spread2)
	);
			}
		}
	}

	$order['data'] = iserializer($order['data']);
	pdo_insert('tiny_wmall_order', $order);
	$order_id = pdo_insertid();
	order_update_bill($order_id, array('activity' => $calculate['activityed']));
	order_insert_discount($order_id, $sid, $calculate['activityed']['list']);
	order_insert_status_log($order_id, 'place_order');
	order_update_goods_info($order_id, $sid);
	order_del_member_cart($sid);
	imessage(error(0, $order_id), '', 'ajax');
}

if ($ta == 'note') {
	if ($store['invoice_status'] == 1) {
		$invoices = member_invoices();
	}

	$result = array('invoices' => $invoices, 'store' => $store);
	imessage(error(0, $result), '', 'ajax');
}

?>
