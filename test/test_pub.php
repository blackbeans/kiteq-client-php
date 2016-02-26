<?php
require_once "../src/Client.php";
require_once "../src/Guid.php";

$client = new \Org\Kiteq\Client();

$client->ip = "172.16.190.68";
$client->port = 13800;
$client->group = "go-kite-test";
$client->secret = "12345";
$client->connect();
$client->greet();

$begin = microtime(true)*1000;
$beginAll = microtime(true)*1000;
$N = $argv[1];

$benchSize = 100;
$bench = 1;
for ($i=0;$i<$N;$i++) {
	$sendData = json_encode(array('param'=>$i));
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