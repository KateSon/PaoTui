<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
mload()->classs('wxapp');
load()->model('mc');
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'openid';
$account_api = new Wxapp();

if ($op == 'openid') {
	$code = $_GPC['code'];
	if (empty($_W['account']['oauth']) || empty($code)) {
		exit('通信错误，请在微信中重新发起请求');
	}

	$oauth = $account_api->getOauthInfo($code);
	if (!empty($oauth) && !is_error($oauth)) {
		$_SESSION['openid'] = $oauth['openid'];
		$_SESSION['session_key'] = $oauth['session_key'];
		$fans = mc_fansinfo($oauth['openid']);

		if (empty($fans)) {
			$record = array('openid' => $oauth['openid'], 'unionid' => $oauth['unionId'], 'uid' => 0, 'acid' => $_W['acid'], 'uniacid' => $_W['uniacid'], 'salt' => random(8), 'updatetime' => TIMESTAMP, 'nickname' => '', 'follow' => '1', 'followtime' => TIMESTAMP, 'unfollowtime' => 0, 'tag' => '');
			$union_fans = array();

			if (!empty($oauth['unionId'])) {
				$union_fans = pdo_get('mc_mapping_fans', array('unionid' => $oauth['unionId'], 'openid !=' => $oauth['openId']));
			}

			if (empty($union_fans)) {
				$email = md5($oauth['openid']) . '@we7.cc';
				$email_exists_member = pdo_getcolumn('mc_members', array('email' => $email), 'uid');

				if (!empty($email_exists_member)) {
					$uid = $email_exists_member;
				}
				else {
					$default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' . tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $_W['uniacid']));
					$data = array('uniacid' => $_W['uniacid'], 'email' => $email, 'salt' => random(8), 'groupid' => $default_groupid, 'createtime' => TIMESTAMP, 'password' => md5($message['from'] . $data['salt'] . $_W['config']['setting']['authkey']), 'nickname' => '', 'avatar' => '', 'gender' => '', 'nationality' => '', 'resideprovince' => '', 'residecity' => '');
					pdo_insert('mc_members', $data);
					$uid = pdo_insertid();
				}
			}
			else {
				$uid = $union_fans['uid'];
			}

			$record['uid'] = $fans['uid'] = $uid;
			$_SESSION['uid'] = $uid;
			pdo_insert('mc_mapping_fans', $record);
		}

		if (!empty($oauth['unionId'])) {
			$union_fans = pdo_get('mc_mapping_fans', array('unionid' => $oauth['unionId'], 'openid !=' => $oauth['openId']));

			if (!empty($union_fans['uid'])) {
				if (!empty($fans['uid'])) {
					pdo_delete('mc_members', array('uid' => $fans['uid']));
				}

				$fans_update = array('uid' => $union_fans['uid']);
				$_SESSION['uid'] = $fans['uid'] = $union_fans['uid'];
			}

			pdo_update('mc_mapping_fans', $fans_update, array('fanid' => $fans['fanid']));
			$wmall_member = get_member($oauth['unionId'], 'unionId');
		}

		if (empty($wmall_member)) {
			$wmall_member = get_member($oauth['openid'], 'openid_wxapp');
		}

		if (empty($wmall_member)) {
			$wmall_member = array('uniacid' => $_W['uniacid'], 'uid' => $fans['uid'], 'openid_wxapp' => $oauth['openid'], 'unionId' => $oauth['unionId'], 'nickname' => '', 'realname' => '', 'mobile' => '', 'sex' => '', 'avatar' => '', 'is_sys' => 1, 'status' => 1, 'token' => random(32), 'addtime' => TIMESTAMP);
			pdo_insert('tiny_wmall_members', $wmall_member);
		}
		else {
			if (!empty($oauth['unionId'])) {
				if (empty($wmall_member['unionId'])) {
					pdo_update('tiny_wmall_members', array('unionId' => $oauth['unionId']), array('id' => $wmall_member['id']));
				}

				member_union($oauth['unionId']);
			}
		}

		$account_api->result(0, '', array('sessionid' => $_W['session_id']));
		return 1;
	}

	$account_api->result(1, $oauth['message']);
	return 1;
}

if ($op == 'userinfo') {
	$encrypt_data = $_GPC['encryptedData'];
	$iv = $_GPC['iv'];
	if (empty($_SESSION['session_key']) || empty($encrypt_data) || empty($iv)) {
		$account_api->result(1, '请先登录');
	}

	$sign = sha1(htmlspecialchars_decode($_GPC['rawData']) . $_SESSION['session_key']);

	if ($sign !== $_GPC['signature']) {
		$account_api->result(1, '签名错误');
	}

	$userinfo = $account_api->pkcs7Encode($encrypt_data, $iv);
	$fans = mc_fansinfo($userinfo['openId']);
	$fans_update = array('nickname' => $userinfo['nickName'], 'unionid' => $userinfo['unionId'], 'tag' => base64_encode(iserializer(array('subscribe' => 1, 'openid' => $userinfo['openId'], 'nickname' => $userinfo['nickName'], 'sex' => $userinfo['gender'], 'language' => $userinfo['language'], 'city' => $userinfo['city'], 'province' => $userinfo['province'], 'country' => $userinfo['country'], 'headimgurl' => $userinfo['avatarUrl']))));

	if (!empty($userinfo['unionId'])) {
		$union_fans = pdo_get('mc_mapping_fans', array('unionid' => $userinfo['unionId'], 'openid !=' => $userinfo['openId']));

		if (!empty($union_fans['uid'])) {
			if (!empty($fans['uid'])) {
				pdo_delete('mc_members', array('uid' => $fans['uid']));
			}

			$fans_update['uid'] = $union_fans['uid'];
			$_SESSION['uid'] = $union_fans['uid'];
		}
	}

	pdo_update('mc_mapping_fans', $fans_update, array('fanid' => $fans['fanid']));
	$update = array('nickname' => $userinfo['nickName'], 'sex' => $fansInfo['sex'] == 1 ? '男' : '女', 'avatar' => rtrim(rtrim($fansInfo['avatarUrl'], '0'), 132) . 132);
	pdo_update('tiny_wmall_members', $update, array('openid_wxapp' => $userinfo['openId'], 'unionid' => $userinfo['unionid']), 'or');
	$member = get_member($userinfo['openId']);
	unset($member['password']);
	unset($member['salt']);
	$account_api->result(0, '', $member);
}

?>
