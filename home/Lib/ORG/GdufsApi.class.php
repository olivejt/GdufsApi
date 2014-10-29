<?php


define('APIKEY', 'gdufsapi');
define('TIMEOUT',3600); //(60*60) 设置token过期时间 单位秒

/**
 * 模拟登录数字广外的接口
 * 可被其他产品请求 返回登录信息
 * @author
 *
 */
class GdufsApi {
	private $domain = '';
	private $token = '';
	
	/**
	 * 构造函数
	 */
	public function __construct(){
		
	}

	public function getInfo(){	//获取客户端信息
	    return $_SERVER;
	}

	public function timeoutCheck($token){
		//解密$token 判断是否过期 若过期 需要重新进行app_check
		$code = $this->_authcode($token,'DECODE',APIKEY);
		//获取token前10位  即为生成token的时间戳 可判断其是否过期
		$time = (int)substr($code,0,10);
		$now = time();
		if($now - $time > TIMEOUT){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * Ucenter可逆加密算法
	 * @param string $string
	 * @param string $operation
	 * @param string $key
	 * @param int $expiry
	 * @return string
	 */
	function _authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
		$ckey_length = 4;
		// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
		// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
		// 当此值为 0 时，则不产生随机密钥
		$key = md5($key ? $key : APIKEY);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	
		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);
	
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);
	
		$result = '';
		$box = range(0, 255);
	
		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
	
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
	
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
	
		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	
	}
	
	
	/**
	 * 备用加密方案
	 */
	
	public function apiEncode($appId,$appKey){
		//mcrypt拓展的加密算法
		$td = mcrypt_module_open(MCRYPT_DES,'','ecb',''); //使用MCRYPT_DES算法,ecb模式
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		$ks = mcrypt_enc_get_key_size($td);
		$key = substr(md5($key), 0, $ks);
		$code = time().$appId.$appKey;
		mcrypt_generic_init($td, $key, $iv); //初始处理
		//加密
		$encrypted = mcrypt_generic($td,$code);
		//结束处理
		mcrypt_generic_deinit($td);
		return $encrypted;
	}
	
	public function apiDecode ($encrypted) {
		$td = mcrypt_module_open(MCRYPT_DES,'','ecb',''); //使用MCRYPT_DES算法,ecb模式
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		$ks = mcrypt_enc_get_key_size($td);
		$key = substr(md5($key), 0, $ks);
		mcrypt_generic_init($td, $key, $iv); //初始处理
		//解密
		$decrypted = mdecrypt_generic($td, $encrypted);
		//结束
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		//解密后,可能会有后续的\0,需去掉
		return trim($decrypted);
	}


}