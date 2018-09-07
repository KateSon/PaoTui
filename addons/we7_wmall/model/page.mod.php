<?php
//dezend by http://www.5kym.cn/
function store_filter($filter = array(), $orderby = '')
{
	global $_W;
	global $_GPC;
	$condition = '  where uniacid = :uniacid and agentid = :agentid and status = 1';
	$params = array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']);

	if (empty($filter)) {
		$filter = $_GPC;
	}

	if (0 < $filter['cid']) {
		$condition .= ' and cid like :cid';
		$params[':cid'] = '%|' . $filter['cid'] . '|%';
	}

	if (defined('IN_WXAPP')) {
		$temp = $_GPC['condition'];
		$temp = json_decode(htmlspecialchars_decode($temp), true);
	}

	if (!empty($temp)) {
		$dis = trim($temp['dis']);

		if (!empty($dis)) {
			if ($dis == 'invoice_status') {
				$condition .= ' and invoice_status = 1';
			}
			else if ($dis == 'delivery_price') {
				$condition .= ' and (delivery_price = 0 or delivery_free_price > 0)';
			}
			else {
				$sids = pdo_getall('tiny_wmall_store_activity', array('uniacid' => $_W['uniacid'], 'type' => $dis, 'status' => 1), array('sid'), 'sid');

				if (empty($sids)) {
					$sids = array(0);
				}

				$sids = implode(',', array_keys($sids));
				$condition .= ' and id in (' . $sids . ')';
			}
		}

		$mode = intval($temp['mode']);

		if (!empty($mode)) {
			$condition .= ' and delivery_mode = ' . $mode;
		}
	}

	$config_mall = $_W['we7_wmall']['config']['mall'];
	$lat = trim($_GPC['lat']);
	$lng = trim($_GPC['lng']);
	$order_by_base = ' order by is_rest asc, is_stick desc';
	$order_by = trim($temp['order']) ? trim($temp['order']) : $config_mall['store_orderby_type'];

	if (in_array($order_by, array('sailed', 'score', 'displayorder'))) {
		$order_by_base .= ', ' . $order_by . ' desc';
	}
	else {
		$order_by_base .= ', ' . $order_by . ' asc';
	}

	$pindex = max(1, intval($_GPC['page']));
	$psize = intval($_GPC['psize']) ? intval($_GPC['psize']) : 20;
	$limit = ' limit ' . ($pindex - 1) * $psize . ',' . $psize;
	$stores = pdo_fetchall("select id,agentid,score,title,logo,content,sailed,score,label,serve_radius,not_in_serve_radius,delivery_areas,business_hours,is_in_business,is_rest,is_stick,delivery_fee_mode,delivery_price,delivery_free_price,send_price,delivery_time,delivery_mode,token_status,invoice_status,location_x,location_y,forward_mode,forward_url,displayorder,click,\r\n ROUND(\r\n        6378.138 * 2 * ASIN(\r\n            SQRT(\r\n                POW(\r\n                    SIN(\r\n                        (\r\n                            " . $lat . " * PI() / 180 - location_x * PI() / 180\r\n                        ) / 2\r\n                    ),\r\n                    2\r\n                ) + COS(" . $lat . " * PI() / 180) * COS(location_x * PI() / 180) * POW(\r\n                    SIN(\r\n                        (\r\n                           " . $lng . "  * PI() / 180 - location_y * PI() / 180\r\n                        ) / 2\r\n                    ),\r\n                    2\r\n                )\r\n            )\r\n        ) * 1000) as distance from " . tablename('tiny_wmall_store') . (' ' . $condition . ' ' . $order_by_base . ' ' . $limit), $params);
	$total = intval(pdo_fetchcolumn('select count(*) from ' . tablename('tiny_wmall_store') . $condition, $params));
	$pagetotal = ceil($total / $psize);

	if (!empty($stores)) {
		$store_label = category_store_label();

		foreach ($stores as $key => &$da) {
			$da['logo'] = tomedia($da['logo']);
			$da['delivery_title'] = $config_mall['delivery_title'];
			$da['scores'] = score_format($da['score']);
			$da['url'] = store_forward_url($da['id'], $da['forward_mode'], $da['forward_url']);
			$da['hot_goods'] = array();
			$hot_goods = pdo_fetchall('select id,title,price,old_price,thumb from ' . tablename('tiny_wmall_goods') . ' where uniacid = :uniacid and sid = :sid and is_hot = 1 limit 3', array(':uniacid' => $_W['uniacid'], ':sid' => $da['id']));

			if (!empty($hot_goods)) {
				foreach ($hot_goods as &$goods) {
					$goods['thumb'] = tomedia($goods['thumb']);
					$goods['old_price'] = $goods['old_price'] ? $goods['old_price'] : $goods['price'];
					$goods['discount'] = round($goods['price'] / $goods['old_price'] * 10, 1);
					$da['hot_goods'][] = $goods;
				}

				$da['hot_goods_num'] = count($da['hot_goods']);
				unset($hot_goods);
			}

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

					$price = store_order_condition($da, array($lng, $lat));
					$da['delivery_price'] = $price['delivery_price'];
					$da['send_price'] = $price['send_price'];
					$da['delivery_free_price'] = $price['delivery_free_price'];
				}
			}

			$da['activity'] = store_fetch_activity($da['id']);

			if (0 < $da['delivery_free_price']) {
				$da['activity']['items']['delivery'] = array('title' => '满' . $da['delivery_free_price'] . '免配送费', 'type' => 'delivery');
				$da['activity']['num'] += 1;
			}

			$da['activity']['items'] = array_values($da['activity']['items']);
			$da['distance'] = round($da['distance'] / 1000, 1);
			if (!empty($lng) && !empty($lat)) {
				$in = is_in_store_radius($da, array($lng, $lat));
				if ($config_mall['store_overradius_display'] == 2 && !$in) {
					unset($stores[$key]);
				}
			}

			unset($da['delivery_areas']);
			$da['activityHeight'] = false;
		}
	}

	$result = array('stores' => $stores, 'total' => $total, 'pagetotal' => $pagetotal);
	return $result;
}

defined('IN_IA') || exit('Access Denied');

?>
