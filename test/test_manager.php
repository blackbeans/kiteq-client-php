<?php
date_default_timezone_set('PRC');
$begin = microtime(true);
for ($n=0; $n<$argv[1]; $n++) {
	$pid = pcntl_fork();
	if ($pid) {
		continue;
	} else {
		require_once "../src/ClientManager.php";

		$client = new \Org\Kiteq\ClientManager();
		$client->group = "pb-mts-test";

		$begin = microtime(true)*1000;
		$beginAll = microtime(true)*1000;
		$N = $argv[2];
		if ($N < 0) {
			while (true) {
				$sendData = json_encode(array('param'=>mt_rand(0,1000000)));
				$client->publish("trade", "pay-succ", str_pad($sendData, 1024));
			}
		}
		$benchSize = 100;
		$bench = 1;
		for ($i=0;$i<$N;$i++) {
			$sendData = json_encode(array('param'=>$n*$N+$i));
			$client->publish("trade", "pay-succ", str_pad($sendData, 1024));
			if ($i == $benchSize * $bench) {
				$end = microtime(true)*1000;
				$use = intval($end- $begin);
				$per = $use / floatval($benchSize);
				$qps = 1000 / $per;
				echo "部分投递 $benchSize 个消息用时: $use ms 每个用时: $per ms qps: $qps 个/s".PHP_EOL;
				$begin = microtime(true)*1000;
				$bench++;
			}
			//echo $n*$N + $i.PHP_EOL;
		}
		$end = microtime(true)*1000;
		$use = intval($end- $beginAll);
		$per = $use / floatval($N);
		$qps = 1000 / $per;
		echo "投递 $N 个消息用时: $use ms 每个用时: $per ms qps: $qps 个/s".PHP_EOL;
		die;
	}
}
pcntl_wait($status);
$end = microtime(true);
$qps = $argv[1] * $argv[2] / ($end-$begin);
echo "qps $qps".PHP_EOL;