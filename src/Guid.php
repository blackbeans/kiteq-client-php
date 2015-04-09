<?php
namespace Org\Kiteq;

// 三段
// 一段是微秒 一段是地址 一段是随机数
class Guid
{

	var $valueBeforeMD5;
	var $valueAfterMD5;

	public static function currentTimeMillis() {
		list($usec, $sec) = explode(" ",microtime());
		return $sec.substr($usec, 2, 3);
	}

	public static function nextLong() {
		$tmp = rand(0,1)?'-':'';
		return $tmp.rand(1000, 9999).rand(1000, 9999).rand(1000, 9999).rand(100, 999).rand(100, 999);
	}

	public static function getLocalHost() {
		if (!isset($_SERVER["SERVER_ADDR"])) {
			$_SERVER["SERVER_ADDR"] = '127.0.0.1';
		}
		return strtolower('localhost/'.$_SERVER["SERVER_ADDR"]);
	}

	public function __construct()
	{
		$this->getGuid();
	}

	private function getGuid()
	{
		$address = self::getLocalHost();
		$this->valueBeforeMD5 = $address.':'.self::currentTimeMillis().':'.self::nextLong();
		$this->valueAfterMD5 = md5($this->valueBeforeMD5);
	}

	public function toString()
	{
		$raw = strtoupper($this->valueAfterMD5);
		return substr($raw,0,8).substr($raw,8,4).substr($raw,12,4).substr($raw,16,4).substr($raw,20);
	}

}

?>