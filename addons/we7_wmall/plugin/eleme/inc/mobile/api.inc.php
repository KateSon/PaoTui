<?php
//dezend by http://www.5kym.cn/
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
pload()->classs('subscribe');
$subscribe = new subscribe();
$subscribe->start();

?>
