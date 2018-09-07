<?php
//dezend by http://www.5kym.cn/
abstract class TyAccount
{
	static public function create($acidOrAccount = '', $type = 'wap')
	{
		global $_W;

		if ($type != 'wxapp') {
			return WeAccount::create($acidOrAccount);
		}

		if (empty($acidOrAccount)) {
			$acidOrAccount = $_W['acid'];
		}

		if (is_array($acidOrAccount)) {
			$account = $acidOrAccount;
			return NULL;
		}

		$wxapp = get_plugin_config('wxapp.basic');
		$account = array('key' => $wxapp['key'], 'secret' => $wxapp['secret']);
		mload()->classs('wxapp');
		return new Wxapp($account);
	}
}

defined('IN_IA') || exit('Access Denied');

?>
