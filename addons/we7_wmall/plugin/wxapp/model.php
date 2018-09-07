<?php
//dezend by http://www.5kym.cn/
function get_wxapp_diy($id, $mobile = false)
{
	global $_W;
	$id = intval($id);

	if (empty($id)) {
		return false;
	}

	$page = pdo_get('tiny_wmall_wxapp_page', array('uniacid' => $_W['uniacid'], 'id' => $id));

	if (empty($page)) {
		return false;
	}

	$page['data'] = base64_decode($page['data']);
	$page['data'] = json_decode($page['data'], true);
	$page['parts'] = array();
	$page['is_has_location'] = $page['is_has_allstore'] = $page['is_show_cart'] = $page['is_show_redpacket'] = 0;

	foreach ($page['data']['items'] as $item) {
		$page['parts'][] = $item['id'];

		if ($item['id'] == 'fixedsearch') {
			$page['is_has_location'] = 1;
		}
		else if ($item['id'] == 'waimai_allstores') {
			$page['is_has_allstore'] = 1;
			$page['stores_list']['diyitems'] = $item;
			$page['stores_list']['orderbys'] = store_orderbys();
			$page['stores_list']['discounts'] = store_discounts();
		}
		else if ($item['id'] == 'cart') {
			if ($item['params']['showcart'] == 1) {
				$page['is_show_cart'] = 1;
			}
		}
		else {
			if ($item['id'] == 'redpacket') {
				if ($item['params']['showredpacket'] == 1) {
					$page['is_show_redpacket'] = 1;
				}
			}
		}
	}

	if (!$mobile) {
		if (!empty($page['data']['items']) && is_array($page['data']['items'])) {
			foreach ($page['data']['items'] as $itemid => &$item) {
				if ($item['id'] == 'waimai_goods') {
					$item['data'] = get_wxapp_waimai_goods($item);

					if (empty($item['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'waimai_stores') {
					$item['data'] = get_wxapp_waimai_store($item);

					if (empty($item['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'notice') {
					$item['data'] = get_wxapp_notice($item);

					if (empty($page['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'bargain') {
					$result = get_wxapp_bargains($item);
					$item['data'] = $result['data'];
					$item['data_num'] = $result['data_num'];

					if (empty($page['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'selective') {
					$result = get_wxapp_waimai_recommend_store($item);
					$item['data'] = $result['data'];

					if (empty($item['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'navs') {
					$result = get_wxapp_navs($item);
					$item['data'] = $result['data'];
					$item['data_num'] = $result['data_num'];

					if (empty($page['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'richtext') {
					$item['params']['content'] = htmlspecialchars_decode($item['params']['content']);
				}
				else {
					if ($item['id'] == 'picture' || $item['id'] == 'picturew') {
						if (empty($item['style'])) {
							$item['style'] = array('background' => '#ffffff', 'paddingtop' => '0', 'paddingleft' => '0');
						}
					}
					else {
						if (empty($item['id'])) {
							unset($page['data']['items'][$itemid]);
						}
					}
				}
			}

			unset($item);
			pdo_update('tiny_wmall_wxapp_page', array('data' => base64_encode(json_encode($page['data']))), array('uniacid' => $_W['uniacid'], 'id' => $id));
		}
	}
	else {
		if (!empty($page['data']['items']) && is_array($page['data']['items'])) {
			foreach ($page['data']['items'] as $itemid => &$item) {
				if ($item['id'] == 'waimai_goods') {
					$item['data'] = get_wxapp_waimai_goods($item, true);

					if (empty($item['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'waimai_stores') {
					$item['data'] = get_wxapp_waimai_store($item, true);

					if (empty($item['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'selective') {
					$result = get_wxapp_waimai_recommend_store($item, true);
					$item['data'] = $result['data'];
					$item['data_num'] = $result['data_num'];

					if (empty($item['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if ($item['id'] == 'bargain') {
					$result = get_wxapp_bargains($item, true);
					$item['data'] = $result['data'];
					$item['data_num'] = $result['data_num'];

					if (empty($page['data'])) {
						unset($page['data']['items'][$itemid]);
					}
				}
				else if (in_array($item['id'], array('copyright', 'notice', 'img_card'))) {
					$item['params']['imgurl'] = tomedia($item['params']['imgurl']);

					if ($item['id'] == 'notice') {
						$item['data'] = get_wxapp_notice($item, true);

						if (empty($item['data'])) {
							unset($page['data']['items'][$itemid]);
						}
					}
				}
				else {
					if (in_array($item['id'], array('banner', 'picture', 'graphic')) && !empty($item['data'])) {
						foreach ($item['data'] as &$v) {
							$v['imgurl'] = tomedia($v['imgurl']);
						}
					}
					else {
						if ($item['id'] == 'picturew' && !empty($item['data'])) {
							foreach ($item['data'] as &$v) {
								$v['imgurl'] = tomedia($v['imgurl']);
							}

							$item['data_num'] = count($item['data']);

							if ($item['params']['row'] == 1) {
								$item['data'] = array_values($item['data']);
							}
							else {
								if ($item['params']['showtype'] == 1 && $item['params']['pagenum'] < count($item['data'])) {
									$item['data'] = array_chunk($item['data'], $item['params']['pagenum']);
									$item['style']['rows_num'] = ceil($item['params']['pagenum'] / $item['params']['row']);
									$row_base_height = array(2 => 122, 3 => 85, 4 => 65);
									$item['style']['base_height'] = $row_base_height[$item['params']['row']];
								}
							}
						}
						else {
							if ($item['id'] == 'navs' && !empty($item['data'])) {
								$result = get_wxapp_navs($item);
								$item['data'] = $result['data'];
								$item['data_num'] = $result['data_num'];

								if (empty($page['data'])) {
									unset($page['data']['items'][$itemid]);
								}
							}
						}
					}
				}
			}

			unset($item);
		}
	}

	return $page;
}

function get_wxapp_waimai_goods($item, $mobile = false)
{
	global $_W;

	if ($item['params']['goodsdata'] == '0') {
		if (!empty($item['data']) && is_array($item['data'])) {
			$goodsids = array();

			foreach ($item['data'] as $data) {
				if (!empty($data['goods_id'])) {
					$goodsids[] = $data['goods_id'];
				}
			}

			if (!empty($goodsids)) {
				$item['data'] = array();
				$goodsids_str = implode(',', $goodsids);
				$goods = pdo_fetchall('select a.*, b.title as store_title from ' . tablename('tiny_wmall_goods') . ' as a left join ' . tablename('tiny_wmall_store') . (' as b on a.sid = b.id where a.uniacid = :uniacid and a.status = 1 and a.id in (' . $goodsids_str . ') order by a.displayorder desc'), array(':uniacid' => $_W['uniacid']));

				if (!empty($goods)) {
					foreach ($goodsids as $goodsid) {
						foreach ($goods as $good) {
							if ($good['id'] == $goodsid) {
								$childid = rand(1000000000, 9999999999);
								$childid = 'C' . $childid;
								$item['data'][$childid] = array('goods_id' => $good['id'], 'sid' => $good['sid'], 'store_title' => $good['store_title'], 'thumb' => tomedia($good['thumb']), 'title' => $good['title'], 'price' => $good['price'], 'old_price' => $good['old_price'] ? $good['old_price'] : $good['price'], 'sailed' => $good['sailed'], 'total' => $good['total'] != -1 ? $good['total'] : '无限', 'discount' => $good['old_price'] == 0 ? 0 : round($good['price'] / $good['old_price'] * 10, 1), 'comment_good_percent' => $good['comment_total'] == 0 ? 0 : round($good['comment_good'] / $good['comment_total'] * 100, 2) . '%');
							}
						}
					}
				}
			}
		}
	}
	else {
		if ($item['params']['goodsdata'] == '1') {
			if (empty($mobile)) {
				return $item['data'];
			}

			$item['data'] = array();
			$condition = ' where a.uniacid = :uniacid and a.agentid = :agentid and a.status= 1';
			$params = array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']);
			$limit = intval($item['params']['goodsnum']);
			$limit = $limit ? $limit : 20;
			$goods = pdo_fetchall('select a.discount_price,a.goods_id,a.discount_available_total,b.* from ' . tablename('tiny_wmall_activity_bargain_goods') . ' as a left join ' . tablename('tiny_wmall_goods') . (' as b on a.goods_id = b.id ' . $condition . ' order by a.mall_displayorder desc limit ' . $limit), $params);

			if (!empty($goods)) {
				$stores = pdo_fetchall('select distinct(a.sid),b.title as store_title,b.is_rest from ' . tablename('tiny_wmall_activity_bargain') . ' as a left join ' . tablename('tiny_wmall_store') . ' as b on a.sid = b.id where a.uniacid = :uniacid and a.agentid = :agentid and a.status = 1', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']), 'sid');

				foreach ($goods as &$good) {
					$childid = rand(1000000000, 9999999999);
					$childid = 'C' . $childid;
					$item['data'][$childid] = array('goods_id' => $good['id'], 'sid' => $good['sid'], 'store_title' => $stores[$good['sid']]['store_title'], 'thumb' => tomedia($good['thumb']), 'title' => $good['title'], 'price' => $good['discount_price'], 'old_price' => $good['old_price'] ? $good['old_price'] : $good['price'], 'sailed' => $good['sailed'], 'total' => $good['discount_available_total'] != -1 ? $good['discount_available_total'] : '无限', 'discount' => $good['old_price'] == 0 ? 0 : round($good['discount_price'] / $good['old_price'] * 10, 1), 'comment_good_percent' => $good['comment_total'] == 0 ? 0 : round($good['comment_good'] / $good['comment_total'] * 100, 2) . '%');
				}
			}
		}
	}

	return $item['data'];
}

function get_wxapp_waimai_recommend_store($item, $mobile = false)
{
	global $_W;

	if ($item['params']['storedata'] == '0') {
		if (!empty($item['data']) && is_array($item['data'])) {
			$storeids = array();

			foreach ($item['data'] as $data) {
				if (!empty($data['store_id'])) {
					$storeids[] = $data['store_id'];
				}
			}

			if (!empty($storeids)) {
				$item['data'] = array();
				$storeids_str = implode(',', $storeids);
				$stores = pdo_fetchall('select id, title, logo, is_rest from ' . tablename('tiny_wmall_store') . ('where uniacid = :uniacid and id in (' . $storeids_str . ')'), array(':uniacid' => $_W['uniacid']));
			}
		}
	}
	else {
		if ($item['params']['storedata'] == '1') {
			$limit = intval($item['params']['storenum']);
			$limit = $limit ? $limit : 20;
			$stores = pdo_fetchall('select id, title, logo from ' . tablename('tiny_wmall_store') . ('where uniacid = :uniacid and is_recommend = 1 order by displayorder desc limit ' . $limit), array(':uniacid' => $_W['uniacid']));
		}
	}

	if (!empty($stores)) {
		$item['data'] = array();

		foreach ($stores as &$row) {
			$row['store_id'] = $row['id'];
			$row['logo'] = tomedia($row['logo']);
			$childid = rand(1000000000, 9999999999);
			$childid = 'C' . $childid;
			$item['data'][$childid] = $row;
			unset($row);
		}
	}

	$item['data_num'] = count($item['data']);
	if ($mobile && ($item['params']['showtype'] == 1 && $item['params']['pagenum'] < count($item['data']))) {
		$item['data'] = array_chunk($item['data'], $item['params']['pagenum']);
	}

	$result = array('data' => $item['data'], 'data_num' => $item['data_num']);
	return $result;
}

function get_wxapp_waimai_store($item, $mobile = false)
{
	global $_W;
	global $_GPC;

	if ($item['params']['storedata'] == '0') {
		if (!empty($item['data']) && is_array($item['data'])) {
			$storeids = array();

			foreach ($item['data'] as $data) {
				if (!empty($data['store_id'])) {
					$storeids[] = $data['store_id'];
				}
			}

			if (!empty($storeids)) {
				$item['data'] = array();
				$storeids_str = implode(',', $storeids);
				$stores = pdo_fetchall('select id, title, logo, delivery_free_price, score, is_rest,delivery_time,sailed,delivery_mode,label from ' . tablename('tiny_wmall_store') . ('where uniacid = :uniacid and id in (' . $storeids_str . ')'), array(':uniacid' => $_W['uniacid']));
			}
		}
	}
	else if ($item['params']['storedata'] == '1') {
		if (empty($mobile)) {
			return $item['data'];
		}

		$limit = intval($item['params']['storenum']);
		$limit = $limit ? $limit : 20;
		$stores = pdo_fetchall('select id, title, logo, delivery_free_price, score, is_rest,delivery_time,sailed,delivery_mode,label from ' . tablename('tiny_wmall_store') . ('where uniacid = :uniacid and is_recommend = 1 order by displayorder desc limit ' . $limit), array(':uniacid' => $_W['uniacid']));
	}
	else {
		if ($item['params']['storedata'] == '2') {
			$condition = 'where uniacid = :uniacid ';
			$params = array(':uniacid' => $_W['uniacid']);
			$limit = intval($item['params']['storenum']);
			$limit = $limit ? $limit : 20;

			if (0 < $item['params']['categoryid']) {
				$condition .= 'and cid like :cid';
				$params[':cid'] = '%|' . $item['params']['categoryid'] . '|%';
			}

			$stores = pdo_fetchall('select id, title, logo, delivery_free_price, score,is_rest,delivery_time,sailed,delivery_mode,label from ' . tablename('tiny_wmall_store') . $condition . (' order by displayorder desc limit ' . $limit), $params);
		}
	}

	if (!empty($stores)) {
		$_config_mall = $_W['we7_wmall']['config']['mall'];

		if (empty($_config_mall['delivery_title'])) {
			$_config_mall['delivery_title'] = '平台专送';
		}

		$store_label = category_store_label();
		$item['data'] = array();

		foreach ($stores as &$row) {
			$row['store_id'] = $row['id'];

			if (0 < $row['label']) {
				$row['label_color'] = $store_label[$row['label']]['color'];
				$row['label_cn'] = $store_label[$row['label']]['title'];
			}

			$row['logo'] = tomedia($row['logo']);
			$row['price'] = store_order_condition($row['id']);
			$row['send_price'] = $row['price']['send_price'];
			$row['delivery_price'] = $row['price']['delivery_price'];

			if ($row['delivery_mode'] == 1) {
				$row['delivery_title'] = '商家自送';
			}
			else {
				$row['delivery_title'] = $_config_mall['delivery_title'];
			}

			$row['score_cn'] = round($row['score'] / 5, 2) * 100;
			$row['hot_goods'] = array();
			$hot_goods = pdo_fetchall('select id,title,price,old_price,thumb from ' . tablename('tiny_wmall_goods') . ' where uniacid = :uniacid and sid = :sid and is_hot = 1 limit 3', array(':uniacid' => $_W['uniacid'], ':sid' => $row['id']));

			if (!empty($hot_goods)) {
				foreach ($hot_goods as &$goods) {
					$goods['thumb'] = tomedia($goods['thumb']);

					if ($goods['old_price'] != 0) {
						$goods['discount'] = round($goods['price'] / $goods['old_price'] * 10, 1);
					}
					else {
						$goods['discount'] = 0;
					}

					$childid = rand(1000000000, 9999999999);
					$childid = 'C' . $childid;
					$row['hot_goods'][$childid] = $goods;
				}

				$row['hot_goods_num'] = count($row['hot_goods']);
				unset($hot_goods);
			}

			$row['activity'] = array();
			$activitys = store_fetch_activity($row['id']);

			if (!empty($activitys['items'])) {
				foreach ($activitys['items'] as $avtivity_item) {
					if (empty($avtivity_item['title'])) {
						continue;
					}

					$row['activity']['items'][] = array('type' => $avtivity_item['type'], 'title' => $avtivity_item['title']);
				}

				$row['activity']['num'] = $activitys['num'];
				unset($activitys);
			}

			$childid = rand(1000000000, 9999999999);
			$childid = 'C' . $childid;
			$item['data'][$childid] = $row;
			unset($row);
		}
	}

	return $item['data'];
}

function get_wxapp_notice($item, $mobile = false)
{
	global $_W;

	if ($item['params']['noticedata'] == 0) {
		$noticenum = $item['params']['noticenum'];
		$notice = pdo_fetchall('select id, title, displayorder, link, status from' . tablename('tiny_wmall_notice') . 'where status = 1 and uniacid = :uniacid and type = :type order by displayorder desc limit ' . $noticenum, array(':uniacid' => $_W['uniacid'], ':type' => 'member'));
		$item['data'] = array();

		if (!empty($notice)) {
			foreach ($notice as &$data) {
				$childid = rand(1000000000, 9999999999);
				$childid = 'C' . $childid;
				$item['data'][$childid] = array('id' => $data['id'], 'title' => $data['title'], 'linkurl' => $data['link']);
			}
		}
	}

	return $item['data'];
}

function get_wxapp_bargains($item, $mobile = false)
{
	global $_W;
	$limit = intval($item['params']['bargainnum']);
	$limit = $limit ? $limit : 20;
	$bargains = pdo_fetchall('select a.discount_price,a.goods_id, a.bargain_id,b.title,b.thumb,b.price,b.sid from ' . tablename('tiny_wmall_activity_bargain_goods') . ' as a left join ' . tablename('tiny_wmall_goods') . (' as b on a.goods_id = b.id where a.uniacid = :uniacid and a.agentid = :agentid and a.status = 1 order by a.mall_displayorder desc limit ' . $limit), array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']));
	$item['data'] = array();

	if (!empty($bargains)) {
		foreach ($bargains as $val) {
			$childid = rand(1000000000, 9999999999);
			$childid = 'C' . $childid;
			$item['data'][$childid] = array('thumb' => tomedia($val['thumb']), 'discount' => round($val['discount_price'] / $val['price'] * 10, 1), 'goods_id' => $val['goods_id'], 'bargain_id' => $val['bargain_id'], 'title' => $val['title'], 'discount_price' => $val['discount_price'], 'price' => $val['price'], 'sid' => $val['sid']);
		}
	}

	$item['data_num'] = count($item['data']);
	if ($mobile && $item['params']['showtype'] == 1 && $item['params']['pagenum'] < count($item['data'])) {
		$item['data'] = array_chunk($item['data'], $item['params']['pagenum']);
	}

	$result = array('data' => $item['data'], 'data_num' => $item['data_num']);
	return $result;
}

function get_wxapp_navs($item, $mobile = false)
{
	global $_W;

	if ($item['params']['navsdata'] == 0) {
		if (!empty($item['data'])) {
			foreach ($item['data'] as &$val) {
				$val['imgurl'] = tomedia($val['imgurl']);
			}
		}
	}
	else {
		$limit = intval($item['params']['navsnum']) ? intval($item['params']['navsnum']) : 4;
		$navs = pdo_fetchall('select id,title,thumb,wxapp_link from' . tablename('tiny_wmall_store_category') . 'where uniacid = :uniacid and agentid = :agentid and status = 1 order by displayorder desc limit ' . $limit, array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']));

		if (!empty($navs)) {
			$item['data'] = array();

			foreach ($navs as $val) {
				$childid = rand(1000000000, 9999999999);
				$childid = 'C' . $childid;
				$item['data'][$childid] = array('linkurl' => empty($val['wxapp_link']) ? 'pages/home/category?cid=' . $val['id'] : $val['wxapp_link'], 'text' => $val['title'], 'imgurl' => tomedia($val['thumb']));
			}
		}
	}

	$item['data_num'] = count($item['data']);
	if ($mobile && $item['params']['showtype'] == 1 && $item['params']['pagenum'] < $item['data_num']) {
		$item['data'] = array_chunk($item['data'], $item['params']['pagenum']);
	}

	$result = array('data' => $item['data'], 'data_num' => $item['data_num']);
	return $result;
}

defined('IN_IA') || exit('Access Denied');

?>
