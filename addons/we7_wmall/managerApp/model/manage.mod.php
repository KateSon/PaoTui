<?php
/**
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 * $sn$
 */
defined('IN_IA') or exit('Access Denied');

function icheckmanage() {
	global $_W, $_GPC;
	$_W['manager'] = array();;
	if(is_weixin()) {
		if(!empty($_W['openid'])) {
			$clerk = pdo_get('tiny_wmall_clerk', array('uniacid' => $_W['uniacid'], 'openid' => $_W['openid']));
			if(!empty($clerk)) {
				$_W['manager'] = $clerk;
			}
		}
	} else {
		$key = "we7_wmall_manager_session_{$_W['uniacid']}";
		if(isset($_GPC[$key])) {
			$session = json_decode(base64_decode($_GPC[$key]), true);
			if(is_array($session)) {
				$clerk = pdo_get('tiny_wmall_clerk', array('uniacid' => $_W['uniacid'], 'id' => $session['id']));
				if(is_array($clerk) && ($session['hash'] == $clerk['password'])) {
					$_W['manager'] = $clerk;
				} else {
					isetcookie($key, false, -100);
				}
			} else {
				isetcookie($key, false, -100);
			}
		}
	}
	if(empty($_W['openid'])) {
		$_W['openid'] = $_W['manager']['openid'];
	}
	if(!empty($_W['manager'])) {
		return true;
	}
	if($_W['ispost']) {
		imessage(error(-1, '请先登录'), imurl('manage/auth/login', array('force' => 1)), 'ajax');
	}
	header("location: " . imurl('manage/auth/login', array('force' => 1)), true);
	exit;
}