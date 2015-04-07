<?php
namespace Org\Kiteq;

class ClientManager {

	private $lookupServer = null;

	private $kiteQLookupService = "/service/lookup-strategy-kiteq";

	public $group;

	/**
	 * @var \Org\Kiteq\Client[]
	 */
	private $clients = [];


	public function __construct() {
	}

	private function cacheGet($cache_key) {
		if (class_exists('Yac')) {
			$yac = new \Yac();
			$addr = $yac->get($cache_key);
			if (is_array($addr)) {
				return $addr;
			}
		} else if (function_exists('apc_fetch')) {
			$addr = apc_fetch($cache_key);
			if (is_array($addr)) {
				return $addr;
			}
		}
		return null;
	}

	private function cacheSet($cache_key, $val, $cache_time = null) {
		if (!$cache_time) {
			if (date('H') > 19 || date('H') < 3) {
				$cache_time = 60;
			} else {
				$cache_time = 5;
			}
		}
		if (class_exists('Yac')) {
			$yac = new \Yac();
			$yac->set($cache_key, $val, $cache_time);
		} else if (function_exists('apc_fetch')) {
			apc_store($cache_key, $val, $cache_time);
		}
	}

	/**
	 * @param $params
	 * @param $mem \Memcache
	 * @return mixed
	 */
	private function execMemcacheMoa($params, $mem) {
		$json = json_encode($params);
		if (strlen($json) < 240) {
			return $mem->get($json);
		} else {
			$mem->set('_buf_cmd_', $json);
			return $mem->get(json_encode(array(
				'action' => '/service/bufcmd',
				'params' => array(
					'm' => 'execute',
					'args' => array($params['id']))
			)));
		}
	}

	/**
	 * @param $params
	 * @param $redis \Redis
	 */
	private function execRedisMoa($params, $redis) {
		return $redis->get(json_encode($params));
	}

	private function execMoaAdapter($params, $conn, $protocol = 'memcache') {
		if ($protocol == 'memcache') {
			return $this->execMemcacheMoa($params, $conn);
		} else {
			return $this->execRedisMoa($params, $conn);
		}
	}

	private function lookup($service_uri, $protocol) {
		$cache_key = "kiteq_".$service_uri;
		$addr = self::cacheGet($cache_key);
		if ($addr) {
			return $addr;
		}
		$host = "moa_lookup.momo.com";
		$port = 31001;
		if ($this->lookupServer == null) {
			$mc = new \Memcache();
			$mc->addServer($host, $port, true /*persistent*/, 1 /*weight*/, 1 /*timeout*/, 0 /*retry_interval*/);
			$this->lookupServer = $mc;
		}
		$cmd = array(
			'id' => php_uname('n') . getmypid() . microtime(true),
			'action' => '/service/lookup',
			'params' => array(
				'm' => 'getService',
				'args' => array($service_uri, $protocol)
			)
		);

		$respJson = $this->execMoaAdapter($cmd, $this->lookupServer);

		if (!$respJson) {
			return [];
		}
		$rtn = json_decode($respJson, true);
		if (isset($rtn['ec']) && $rtn['ec'] != 0) {
			$em = isset($rtn['em']) ? $rtn['em'] : '';
			trigger_error($em." ".$rtn['ec']);
			return [];
		}
		$addr = $rtn['result']['hosts'];
		self::cacheSet($cache_key, $addr);
		return $addr;
	}

	/**
	 * @param $topic
	 * @return \Org\Kiteq\Client
	 */
	private function fetchServer($topic) {
		if (isset($this->clients[$topic])) {
			return $this->clients[$topic];
		}
		$addrs = $this->lookup($this->kiteQLookupService, 'redis');
		$count = count($addrs);
		if ($count == 0) {
			throw new \Exception($this->kiteQLookupService." 地址没找到");
		}
		$addr = $addrs[mt_rand(0, $count)];
		$cmd = array(
			'id' => php_uname('n') . getmypid() . microtime(true),
			'action' => $this->kiteQLookupService,
			'params' => array(
				'm' => 'getService',
				'args' => array($topic, 'kiteq')
			)
		);
		$redis = new \Redis();
		$hostport = explode(':', $addr, 2);
		$redis->pconnect($hostport[0], $hostport[1], 3000);
		$serverAddrs = $this->execMoaAdapter($cmd, $redis, 'redis');
		$serverAddrsCount = count($serverAddrs);
		if ($serverAddrsCount == 0) {
			throw new \Exception($topic.' 对应的kiteq server未找到');
		}
		$serverAddr = $serverAddrsCount[mt_rand(0, $serverAddrsCount)];
		$serverHostport = explode(':', $serverAddr, 2);
		$client = new Client();
		$client->ip = $serverHostport[0];
		$client->port = $serverHostport[1];
		$client->group = $this->group;
		// 保留参数
		$client->secret = "123456";
		$client->jsonEnable = false;
		$this->clients[$topic] = $client;
		return $client;
	}

	/**
	 * @param $topic
	 * @param $type
	 * @param $msg
	 * @throws \Exception
	 * @return bool
	 */
	public function publish($topic, $type, $msg) {
		$client = $this->fetchServer($topic);
		return $client->publish($topic, $type, $msg);
	}
}