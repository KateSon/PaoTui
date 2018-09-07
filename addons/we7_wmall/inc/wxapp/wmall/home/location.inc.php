<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
icheckauth(false);
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';

if ($ta == 'index') {
	if (0 < $_W['member']['uid']) {
		$addresses = pdo_getall('tiny_wmall_address', array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid']));
	}

	imessage(error(0, $addresses), '', 'ajax');
}

if ($ta == 'suggestion') {
	load()->func('communication');
	$key = trim($_GPC['key']);
	$config = $_W['we7_wmall']['config'];
	$query = array('keywords' => $key, 'city' => '全国', 'output' => 'json', 'key' => '37bb6a3b1656ba7d7dc8946e7e26f39b', 'citylimit' => 'true');

	if (!empty($config['takeout']['range']['city'])) {
		$query['city'] = $config['takeout']['range']['city'];
	}

	$city = trim($_GPC['city']);

	if (!empty($city)) {
		$query['city'] = $city;
	}

	$query = http_build_query($query);
	$result = ihttp_get('http://restapi.amap.com/v3/assistant/inputtips?' . $query);

	if (is_error($result)) {
		imessage(error(-1, '访问出错'), '', 'ajax');
	}

	$result = @json_decode($result['content'], true);

	if (!empty($result['tips'])) {
		$distance_sort = 0;

		foreach ($result['tips'] as $key => &$val) {
			if (is_array($val['location'])) {
				unset($val[$key]);
			}
			else {
				$location = explode(',', $val['location']);
				$val['lng'] = $val['location_y'] = $location[0];
				$val['lat'] = $val['location_x'] = $location[1];
			}

			if (!is_array($val['address'])) {
				$val['address'] = $val['district'] . $val['address'];
			}
			else {
				$val['address'] = $val['district'];
			}
		}
	}

	imessage(error(0, $result['tips']), '', 'ajax');
}

?>
