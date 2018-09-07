<?php
/**
 * 外送系统
 * @author 微擎.源码
 * @QQ 2058430070
 * @url http://www.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

//引用公共函数curl  调取物流信息
load()->func('communication');
mload()->model('table');
global $_W, $_GPC;
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';

if($op == 'list'){
	$_W['page']['title'] = '店内订单';
	//订单统计
	$condition = ' where uniacid = :uniacid and status = 5 and order_type > 2 and stat_day = :stat_day';
	$stat = pdo_fetch('select count(*) as total_num, sum(final_fee) as total_price from ' . tablename('tiny_wmall_order') . $condition, array(':uniacid' => $_W['uniacid'], ':stat_day' => date('Ymd')));

	$filter_type = trim($_GPC['filter_type']) ? trim($_GPC['filter_type']) : 'process';
	$condition = ' WHERE uniacid = :uniacid and order_type > 2';
	$params = array(
		':uniacid' => $_W['uniacid'],
	);
	if($filter_type == 'process') {
		$condition .= ' AND (status != 5 and status != 6)';
	}
	$uid = intval($_GPC['uid']);
	if($uid > 0) {
		$condition .= ' AND uid = :uid';
		$params[':uid'] = $uid;
	}
	$sid = intval($_GPC['sid']);
	if($sid > 0) {
		$condition .= ' AND sid = :sid';
		$params[':sid'] = $sid;
	}
	$agentid = intval($_GPC['agentid']);
	if($agentid > 0) {
		$condition .= ' and agentid = :agentid';
		$params[':agentid'] = $agentid;
	}
	$status = intval($_GPC['status']);
	if($status > 0) {
		$condition .= ' AND status = :status';
		$params[':status'] = $status;
	}
	$is_remind = intval($_GPC['is_remind']);
	if($is_remind > 0) {
		$condition .= ' AND is_remind = :is_remind';
		$params[':is_remind'] = $is_remind;
	}
	$re_status = intval($_GPC['refund_status']);
	if($re_status > 0) {
		$condition .= ' AND refund_status = :refund_status';
		$params[':refund_status'] = $re_status;
	}
	$is_pay = intval($_GPC['is_pay']) ? intval($_GPC['is_pay']) : -1;
	if($is_pay > -1) {
		$condition .= ' AND is_pay = :is_pay';
		$params[':is_pay'] = $is_pay;
	}
	$pay_type = trim($_GPC['pay_type']);
	if(!empty($pay_type)) {
		$condition .= ' AND is_pay = 1 AND pay_type = :pay_type';
		$params[':pay_type'] = $pay_type;
	}
	$keyword = trim($_GPC['keyword']);
	if(!empty($keyword)) {
		$condition .= " AND (username LIKE '%{$keyword}%' OR mobile LIKE '%{$keyword}%' OR ordersn LIKE '%{$keyword}%')";
	}
	if(!empty($_GPC['addtime'])) {
		$starttime = strtotime($_GPC['addtime']['start']);
		$endtime = strtotime($_GPC['addtime']['end']) + 86399;
	} else {
		$starttime = strtotime('-7 day');
		$endtime = TIMESTAMP + 86400;
	}
	$condition .= " AND addtime > :start AND addtime < :end";
	$params[':start'] = $starttime;
	$params[':end'] = $endtime;

	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;

	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tiny_wmall_order') .  $condition, $params);
	$orders = pdo_fetchall('SELECT * FROM ' . tablename('tiny_wmall_order') . $condition . ' ORDER BY addtime DESC LIMIT '.($pindex - 1) * $psize.','.$psize, $params, 'id');
	if(!empty($orders)) {
		$order_ids = implode(',', array_keys($orders));
		$goods_temp = pdo_fetchall('select * from ' . tablename('tiny_wmall_order_stat') . " where uniacid = :uniacid and oid in ({$order_ids})", array(':uniacid' => $_W['uniacid']));
		$goods_all = array();
		foreach($goods_temp as $row) {
			$goods_all[$row['oid']][] =  $row;
		}
		foreach($orders as &$da) {
			$da['pay_type_class'] = '';
			if($da['is_pay'] == 1) {
				$da['pay_type_class'] = 'have-pay';
				if($da['pay_type'] == 'delivery') {
					$da['pay_type_class'] = 'delivery-pay';
				}
			}
			if($da['order_type'] == 3) {
				$tables[] = $da['table_id'];
			}
		}
		if(!empty($tables)) {
			$tables_str = implode(',', $tables);
			$tables = pdo_fetchall('select * from ' . tablename('tiny_wmall_tables') . " where uniacid = :uniacid and sid = :sid and id in ({$tables_str})", array(':uniacid' => $_W['uniacid'], ':sid' => $sid), 'id');
		}
	}
	$pager = pagination($total, $pindex, $psize);

	$pay_types = order_pay_types();
	$order_types = order_types();
	$order_status = order_status();
	$refund_status = order_refund_status();
	$order_reserve_types = order_reserve_type();
	$table_categorys = table_category_fetchall($sid);
	$stores = pdo_getall('tiny_wmall_store', array('uniacid' => $_W['uniacid']), array('id', 'title'), 'id');	
	include itemplate('order/tangshiList');
}

if($op == 'detail') {
	$_W['page']['title'] = '订单详情';
	$id = intval($_GPC['id']);
	$order = order_fetch($id);
	//var_dump($order);
	if(empty($order)) {
		imessage('订单不存在或已经删除', iurl('order/takeout/list'), 'error');
	}
	$order['goods'] = order_fetch_goods($order['id']);
	

	if($order['is_comment'] == 1) {
		$comment = pdo_fetch('SELECT * FROM ' . tablename('tiny_wmall_order_comment') .' WHERE uniacid = :aid AND oid = :oid', array(':aid' => $_W['uniacid'], ':oid' => $id));
		if(!empty($comment)) {
			$comment['data'] = iunserializer($comment['data']);
			$comment['thumbs'] = iunserializer($comment['thumbs']);
		}
	}
	if($order['discount_fee'] > 0) {
		$discount = order_fetch_discount($id);
	}
	
	if($order['logistics_company'] && $order['logistics_order']){	
		$com=$order['logistics_company'];
		$nu=$order['logistics_order'];	
		$data = "type=".$com."&postid=".$nu;
		$url='http://www.kuaidi100.com/query';
		$res=doCurlPostRequest($url,$data);
		$logictics=json_decode($res,true);  			
	}
	
	$pay_types = order_pay_types();
	$order_types = order_types();
	$order_status = order_status();
	$logs = order_fetch_status_log($id);
	include itemplate('order/tangshiDetail');
}



if($op == 'logistics') {
	if($_POST){		
		$data = array(			
			'username' =>$_POST['username'],
			'logistics_company'=>$_POST['company'],
			'mobile'=>$_POST['mobile'],
			'logistics_order'=>$_POST['logistics_order'],
			'address'=>$_POST['address']				
		);
		//var_dump($data);die();
		$result = pdo_update('tiny_wmall_order', $data, array('id' =>$_POST['id']));
		if ($result) {
			message('物流信息提交成功');
		}else{			
			imessage('信息提交失败,请重试!', iurl('order/tangshi/logistics',array('id'=>$_POST['id'])), 'error');			
		}
	}else{
		$_W['page']['title'] = '物流设置';
		$id = intval($_GPC['id']);
		$order = order_fetch($id);	
		if(empty($order)) {
			imessage('订单不存在或已经删除', iurl('order/takeout/list'), 'error');
		}		
		if($order['logistics_company']){
			$logistics = pdo_fetch("SELECT company FROM ".tablename('tiny_logistics_company')." WHERE sign = :sign LIMIT 1", array(':sign' =>$order['logistics_company']));
		
		}else{
			$logistics = pdo_fetchall("SELECT * FROM ".tablename('tiny_logistics_company'), array(), 'id');	
		}			
		include itemplate('order/tangshiLogistics');	
	}
	
}



if($op == 'status') {
	$ids = $_GPC['id'];
	if(!is_array($ids)) {
		$ids = array($ids);
	}
	$type = trim($_GPC['type']);
	if(empty($type)) {
		imessage(error(-1, '订单状态错误'), '', 'ajax');
	}
	foreach($ids as $id) {
		$id = intval($id);
		if($id <= 0) continue;
		$result = order_status_update($id, $type);
		if(is_error($result)) {
			imessage(error(-1, "处理编号为:{$id}的订单失败，具体原因：{$result['message']}"), '', 'ajax');
		}
	}
	imessage(error(0, '更新订状态成功'), '', 'ajax');
}

if($op == 'cancel') {
	$id = intval($_GPC['id']);
	$result = order_status_update($id, 'cancel', array('force_cancel' => 1));
	if(is_error($result)) {
		imessage(error(-1, "处理编号为:{$id} 的订单失败，具体原因：{$result['message']}"), '', 'ajax');
	}
	if($result['message']['is_refund']) {
		$refund = order_begin_payrefund($id);
		if(is_error($refund)) {
			imessage(error(-1, $refund['message']), '', 'ajax');
		}
		imessage(error(0, "取消订单成功,{$refund['message']}"), '', 'ajax');
	} else {
		imessage(error(0, '取消订单成功'), '', 'ajax');
	}
}

if($op == 'refund_handle') {
	$id = intval($_GPC['id']);
	$refund = order_begin_payrefund($id);
	if(is_error($refund)) {
		imessage(error(-1, $refund['message']), '', 'ajax');
	}
	imessage(error(0, "取消订单成功,{$refund['message']}"), '', 'ajax');
}

if($op == 'refund_query') {
	$id = intval($_GPC['id']);
	$query = order_query_payrefund($id);
	if(is_error($query)) {
		imessage(error(-1, $query['message']), '', 'ajax');
	}
	imessage(error(0, $query['message']), '', 'ajax');
}

if($op == 'refund_status') {
	$id = intval($_GPC['id']);
	$refund = pdo_get('tiny_wmall_order_refund', array('uniacid' => $_W['uniacid'], 'order_id' => $id));
	if(empty($refund)) {
		imessage(error(-1, '退款申请不存在或已删除'), referer(), 'ajax');
	}
	pdo_update('tiny_wmall_order_refund', array('status' => 3), array('uniacid' => $_W['uniacid'], 'id' => $refund['id']));
	pdo_update('tiny_wmall_order', array('refund_status' => 3), array('uniacid' => $_W['uniacid'], 'id' => $id));
	order_insert_refund_log($id, 'success');
	imessage(error(0, '设置为已退款成功'), referer(), 'ajax');
}

if($op == 'remind'){
	$id = intval($_GPC['id']);
	if($_W['ispost']) {
		$reply = trim($_GPC['reply']);
		$result = order_status_update($id, 'reply', array('reply' => $reply));
		imessage(error(0, '回复催单成功'), referer(), 'ajax');
	}
	include itemplate('store/order/tangshiOp');
}

if($op == 'print') {
	$id = intval($_GPC['id']);
	$status = order_print($id);
	if(is_error($status)) {
		imessage(error(-1, $status['message']), '', 'ajax');
	}
	imessage(error(0, '发送打印指定成功'), '', 'ajax');
}

if($op == 'pay_status') {
	$id = intval($_GPC['id']);
	$result = order_status_update($id, 'pay');
	if(is_error($result)) {
		message($result['message'], referer(), 'error');
	}
	message('设置订单支付成功', referer(), 'success');
}




