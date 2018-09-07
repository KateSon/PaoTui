<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$_W['page']['title'] = '入口';
$urls = array('agent' => iurl('oauth/login', array('agent' => 1), true), 'index' => imurl('agent/area', array(), true));
include itemplate('cover');

?>
