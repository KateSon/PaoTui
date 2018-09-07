<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
icheckauth();
$config_mall = $_W['we7_wmall']['config']['mall'];
$id = intval($_GPC['min']);
$condition = ' where a.uniacid = :uniacid and a.uid = :uid';
$params = array(':uniacid' => $_W['uniacid'], ':uid' => $_W['member']['uid']);

if (0 < $id) {
	$condition .= ' and a.id < :id';
	$params[':id'] = $id;
}

$stores = pdo_fetchall('select a.id as aid, b.* from ' . tablename('tiny_wmall_store_favorite') . ' as a left join ' . tablename('tiny_wmall_store') . ' as b on a.sid = b.id' . $condition . ' order by a.id desc limit 10', $params, 'aid');
$min = 0;

if (!empty($stores)) {
	$store_label = category_store_label();

	foreach ($stores as &$da) {
		$da['logo'] = tomedia($da['logo']);
		$da['delivery_title'] = $config_mall['delivery_title'];
		$da['scores'] = score_format($da['score']);
		$da['business_hours'] = (array) iunserializer($da['business_hours']);
		$da['is_in_business_hours'] = store_is_in_business_hours($da['business_hours']);
		$da['hot_goods'] = pdo_fetchall('select title from ' . tablename('tiny_wmall_goods') . ' where uniacid = :uniacid and sid = :sid and is_hot = 1 limit 3', array(':uniacid' => $_W['uniacid'], ':sid' => $da['id']));
		$da['activity'] = store_fetch_activity($da['id']);
		$da['activity']['num'] += 0 < $da['delivery_free_price'] ? 1 : 0;
		$da['score_cn'] = round($da['score'] / 5, 2) * 100;
		$da['url'] = store_forward_url($da['id'], $da['forward_mode'], $da['forward_url']);

		if (0 < $da['label']) {
			$da['label_color'] = $store_label[$da['label']]['color'];
			$da['label_cn'] = $store_label[$da['label']]['title'];
		}

		if ($da['delivery_fee_mode'] == 2) {
			$da['delivery_price'] = iunserializer($da['delivery_price']);
			$da['delivery_price'] = $da['delivery_price']['start_fee'];
		}
		else {
			if ($da['delivery_fee_mode'] == 3) {
				$da['delivery_areas'] = iunserializer($da['delivery_areas']);

				if (!is_array($da['delivery_areas'])) {
					$da['delivery_areas'] = array();
				}

				$price = store_order_condition($da);
				$da['delivery_price'] = $price['delivery_price'];
				$da['send_price'] = $price['send_price'];
			}
		}

		$da['activityHeight'] = false;
	}

	$min = min(array_keys($stores));
}

$stores = array_values($stores);
$respon = array('errno' => 0, 'message' => $stores, 'min' => $min);
imessage($respon, '', 'ajax');

?>
