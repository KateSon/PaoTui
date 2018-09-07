<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';

if ($op == 'list') {
	$_W['page']['title'] = '自定义页面';
	$condition = ' where uniacid = :uniacid';
	$params = array(':uniacid' => $_W['uniacid']);
	$keyword = trim($_GPC['keyword']);

	if (!empty($keyword)) {
		$condition .= ' and name like \'%' . $keyword . '%\'';
	}

	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tiny_wmall_wxapp_page') . $condition, $params);
	$pages = pdo_fetchall('select * from ' . tablename('tiny_wmall_wxapp_page') . $condition . ' order by id desc limit ' . ($pindex - 1) * $psize . ',' . $psize, $params);
	$pager = pagination($total, $pindex, $psize);
}

if ($op == 'post') {
	$_W['page']['title'] = '新建自定义页面';
	$id = intval($_GPC['id']);

	if (0 < $id) {
		$_W['page']['title'] = '编辑自定义页面';
		$page = get_wxapp_diy($id);
	}

	if ($_W['ispost']) {
		$data = $_GPC['data'];
		$diydata = array('uniacid' => $_W['uniacid'], 'name' => $data['page']['name'], 'type' => 1, 'data' => base64_encode(json_encode($data)), 'updatetime' => TIMESTAMP);

		if (!check_plugin_exist('diypage')) {
			imessage(error(-1, '注意：自定义DIY功能目前仅对购买过"平台装修"插件的客户开放'), '', 'ajax');
		}

		if (!empty($id)) {
			pdo_update('tiny_wmall_wxapp_page', $diydata, array('id' => $id, 'uniacid' => $_W['uniacid']));
		}
		else {
			$diydata['addtime'] = TIMESTAMP;
			pdo_insert('tiny_wmall_wxapp_page', $diydata);
			$id = pdo_insertid();
		}

		imessage(error(0, '编辑成功'), iurl('wxapp/diyPage/post', array('id' => $id)), 'ajax');
	}
}

if ($op == 'del') {
	$ids = $_GPC['id'];

	if (!is_array($ids)) {
		$ids = array($ids);
	}

	foreach ($ids as $id) {
		pdo_delete('tiny_wmall_wxapp_page', array('uniacid' => $_W['uniacid'], 'id' => $id));
	}

	imessage(error(0, '删除自定义页面成功'), referer(), 'ajax');
}

include itemplate('diyPage');

?>
