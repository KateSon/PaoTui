<?php
//dezend by http://www.5kym.cn/
class WxAccount
{
	protected $acc;

	public function __construct($account = '')
	{
		global $_W;

		if (empty($account)) {
			$account = $_W['acid'];
		}

		if (!is_array($account)) {
			$account = $account;
			$account = account_fetch($account);
			$acc = WeAccount::create($account);

			if (is_error($acc)) {
				return $acc;
			}

			$this->acc = $acc;
			return NULL;
		}

		if (empty($account['acid'])) {
			$account['acid'] = $account['appid'];
		}

		if (empty($account['type'])) {
			$account['type'] = 1;
		}

		$account['key'] = $account['appid'];
		$account['secret'] = $account['appsecret'];
		$acc = WeAccount::create($account);

		if (is_error($acc)) {
			return $acc;
		}

		$this->acc = $acc;
		$this->acc->account = $account;
	}

	public function media_download($media_id)
	{
		global $_W;
		$access_token = $this->acc->getAccessToken();

		if (is_error($access_token)) {
			return $access_token;
		}

		$url = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=' . $access_token . '&media_id=' . $media_id;
		$response = ihttp_get($url);

		if (is_error($response)) {
			return error(-1, '访问公众平台接口失败, 错误: ' . $response['message']);
		}

		$result = @json_decode($response['content'], true);

		if (!empty($result['errcode'])) {
			return error(-1, '访问微信接口错误, 错误代码: ' . $result['errcode'] . ', 错误信息: ' . $result['errmsg']);
		}

		load()->func('file');
		$path = 'images/' . $_W['uniacid'] . '/' . date('Y/m/');
		$filename = file_random_name(ATTACHMENT_ROOT . '/' . $path, 'jpg');
		$filename = $path . $filename;
		$status = file_write($filename, $response['content']);

		if (!$status) {
			return error(-1, '保存图片失败');
		}

		$status = file_remote_upload($filename);

		if (is_error($status)) {
			return error(-1, '上传到远程失败');
		}

		return $filename;
	}

	public function sendTplNotice($touser, $template_id, $postdata, $url = '', $topcolor = '#FF683F')
	{
		if (empty($this->account['secret']) || empty($this->account['key']) || $this->account['level'] != 4) {
			return error(-1, '你的公众号没有发送模板消息的权限');
		}

		if (empty($touser)) {
			return error(-1, '参数错误,粉丝openid不能为空');
		}

		if (empty($template_id)) {
			return error(-1, '参数错误,模板标示不能为空');
		}

		if (empty($postdata) || !is_array($postdata)) {
			return error(-1, '参数错误,请根据模板规则完善消息内容');
		}

		$token = $this->getAccessToken();

		if (is_error($token)) {
			return $token;
		}

		$data = array();
		$data['touser'] = $touser;
		$data['template_id'] = trim($template_id);
		$data['url'] = trim($url);
		$data['topcolor'] = trim($topcolor);
		$data['data'] = $postdata;
		$data = json_encode($data);
		$post_url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $token;
		$response = ihttp_request($post_url, $data);

		if (is_error($response)) {
			return error(-1, '访问公众平台接口失败, 错误: ' . $response['message']);
		}

		$result = @json_decode($response['content'], true);

		if (empty($result)) {
			return error(-1, '接口调用失败, 元数据: ' . $response['meta']);
		}

		if (!empty($result['errcode'])) {
			return error(-1, '访问微信接口错误, 错误代码: ' . $result['errcode'] . ', 错误信息: ' . $result['errmsg'] . ',信息详情：' . $this->error_code($result['errcode']));
		}

		return true;
	}

	public function getOauthCodeUrl($callback, $state = '')
	{
		return $this->acc->getOauthCodeUrl(urlencode($callback), $state);
	}

	public function getOauthInfo($code)
	{
		$result = $this->acc->getOauthInfo($code);

		if (!empty($result['errcode'])) {
			return error(-1, '错误码:' . $result['errcode'] . ',详细信息:' . $result['errmsg']);
		}

		return $result;
	}
}

defined('IN_IA') || exit('Access Denied');
load()->func('communication');

?>
