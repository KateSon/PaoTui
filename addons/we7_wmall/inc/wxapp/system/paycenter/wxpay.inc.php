<?php
//dezend by http://www.5kym.cn/
defined(base64_decode('SU5fSUE=')) || exit(base64_decode('QWNjZXNzIERlbmllZA=='));
$sl = $_GPC['ps'];
$params = @json_decode(base64_decode($sl), true);

if ($_GPC['done'] == '1') {
	$sql = 'SELECT * FROM ' . tablename('core_paylog') . ' WHERE `plid`=:plid';
	$pars = array();
	$pars[':plid'] = $params['tid'];
	$log = pdo_fetch($sql, $pars);
	if (!empty($log) && !empty($log['status'])) {
		if (!empty($log['tag'])) {
			$tag = iunserializer($log['tag']);
			$log['uid'] = $tag['uid'];
		}

		$site = WeUtility::createModuleSite($log['module']);

		if (!is_error($site)) {
			$method = 'payResult';

			if (method_exists($site, $method)) {
				$ret = array();
				$ret['weid'] = $log['uniacid'];
				$ret['uniacid'] = $log['uniacid'];
				$ret['result'] = 'success';
				$ret['type'] = $log['type'];
				$ret['from'] = 'return';
				$ret['tid'] = $log['tid'];
				$ret['uniontid'] = $log['uniontid'];
				$ret['user'] = $log['openid'];
				$ret['fee'] = $log['fee'];
				$ret['tag'] = $tag;
				$ret['is_usecard'] = $log['is_usecard'];
				$ret['card_type'] = $log['card_type'];
				$ret['card_fee'] = $log['card_fee'];
				$ret['card_id'] = $log['card_id'];
				exit($site->$method($ret));
			}
		}
	}
}

$sql = 'SELECT * FROM ' . tablename('core_paylog') . ' WHERE `plid`=:plid';
$log = pdo_fetch($sql, array(':plid' => $params['tid']));
if (!empty($log) && $log['status'] != '0') {
	exit('这个订单已经支付成功, 不需要重复支付.');
}

$auth = sha1($sl . $log['uniacid'] . $_W['config']['setting']['authkey']);

if ($auth != $_GPC['auth']) {
	exit('参数传输错误.');
}

$_W['uniacid'] = $log['uniacid'];
$_W['openid'] = $log['openid'];
$_W['we7_wmall']['config'] = get_system_config();
$config_wechat = $_W['we7_wmall']['config']['payment']['wechat'];
$params = array('tid' => $log['tid'], 'fee' => $log['card_fee'], 'user' => $log['openid'], 'title' => urldecode($params['title']), 'uniontid' => $log['uniontid']);
$wechat = $config_wechat[$config_wechat['type']];
$wechat['openid'] = $log['openid'];
mload()->model(base64_decode('cGF5bWVudA=='));
$wOpt = wechat_build($params, $wechat);

if (is_error($wOpt)) {
	if ($wOpt['message'] == 'invalid out_trade_no' || $wOpt['message'] == 'OUT_TRADE_NO_USED') {
		$id = date('YmdH');
		pdo_update(base64_decode('Y29yZV9wYXlsb2c='), array(base64_decode('cGxpZA==') => $id), array('plid' => $log['plid']));
		pdo_query(base64_decode('QUxURVIgVEFCTEUg') . tablename(base64_decode('Y29yZV9wYXlsb2c=')) . base64_decode('IGF1dG9faW5jcmVtZW50ID0g') . ($id + 1) . ';');
		imessage(base64_decode('5oqx5q2J77yM5Y+R6LW35pSv5LuY5aSx6LSl77yM57O757uf5bey57uP5L+u5aSN5q2k6Zeu6aKY77yM6K+36YeN5paw5bCd6K+V5pSv5LuY44CC'), '', base64_decode('aW5mbw=='));
	}

	imessage('抱歉，发起支付失败，具体原因为：“' . $wOpt['errno'] . ':' . $wOpt['message'] . '”。请及时联系站点管理员。', '', 'error');
}

echo "<script type=\"text/javascript\">\r\n\tdocument.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {\r\n\t\tWeixinJSBridge.invoke('getBrandWCPayRequest', {\r\n\t\t\t'appId' : '";
echo $wOpt['appId'];
echo "',\r\n\t\t\t'timeStamp': '";
echo $wOpt['timeStamp'];
echo "',\r\n\t\t\t'nonceStr' : '";
echo $wOpt['nonceStr'];
echo "',\r\n\t\t\t'package' : '";
echo $wOpt['package'];
echo "',\r\n\t\t\t'signType' : '";
echo $wOpt['signType'];
echo "',\r\n\t\t\t'paySign' : '";
echo $wOpt['paySign'];
echo "'\r\n\t\t}, function(res) {\r\n\t\t\tif(res.err_msg == 'get_brand_wcpay_request:ok') {\r\n\t\t\t\tlocation.search += '&done=1';\r\n\t\t\t} else {\r\n\t\t\t\thistory.go(-1);\r\n\t\t\t}\r\n\t\t});\r\n\t}, false);\r\n</script>";

?>
