<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
$_W['page']['title'] = '图标魔方';

if ($op == 'list') {
	if ($_W['ispost']) {
		pdo_delete('tiny_wmall_cube', array('uniacid' => $_W['uniacid'], 'agentid' => $_W['agentid']));

		if (!empty($_GPC['titles'])) {
			foreach ($_GPC['titles'] as $key => $title) {
				$title = trim($title);
				if (empty($title) && empty($_GPC['thumbs'][$key])) {
					continue;
				}

				$row = array('uniacid' => $_W['uniacid'], 'agentid' => $_W['agentid'], 'title' => $title, 'tips' => trim($_GPC['tips'][$key]), 'link' => trim($_GPC['links'][$key]), 'wxapp_link' => trim($_GPC['wxapp_links'][$key]), 'thumb' => trim($_GPC['thumbs'][$key]), 'displayorder' => intval($_GPC['displayorder'][$key]));
				pdo_insert('tiny_wmall_cube', $row);
			}
		}

		imessage(error(0, '图片魔方设置成功'), iurl('dashboard/cube/list'), 'ajax');
	}

	$condition = ' where uniacid = :uniacid and agentid = :agentid';
	$params = array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']);
	$cubes = pdo_fetchall('select * from ' . tablename('tiny_wmall_cube') . $condition . ' order by displayorder desc', $params);
}

include itemplate('dashboard/cube');

?>
