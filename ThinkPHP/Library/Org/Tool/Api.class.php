<?php
namespace Org\Tool;

/**
 * http请求工具类
 * 2017-04-28
 */
class Api {
	
	//public $a = 'aaa';
	private $url = 'https://dx.ipyy.net/smsJson.aspx';
	private $userid = '52441';
	private $account = 'liujinming';
	private $password = '35F08C6DCF210D7239779F775999556E';
	
	/**
	 * 发送验证码
	 */
	public function sendMesg($phone,$code){
		$data['action'] = 'send';
		$data['account'] = $this->account;
		$data['password'] = $this->password;
		$data['mobile'] = $phone;
		$data['content'] = '【美甲小程序】您的手机短信验证码是：'.$code;
		$data['sendTime'] = '';
		$data['extno'] = '';
		$json = $this->http_post($this->url, $data);
		$result = json_decode($json); 
		return $result->returnstatus=='Success' ? true : false;
	}
	
	/**
	 * 查询短信剩余条数
	 */
	public function getCount(){
		$data['action'] = 'overage';
		$data['userid'] = $this->userid;
		$data['account'] = $this->account;
		$data['password'] = $this->password;
		$json = $this->http_post($this->url, $data);
		$result = json_decode($json); 
		return $result->overage;
	}
	
	/**
	 * POST 请求
	 */
	public function http_post($url,$data,$post_file=false){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		if (is_string($data) || $post_file) {
			$strPOST = $data;
		} else {
			$aPOST = array();
			foreach($data as $key=>$val){
				$aPOST[] = $key."=".urlencode($val);
			}
			$strPOST =  join("&", $aPOST);
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($oCurl, CURLOPT_POST,true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}
	}
	
}