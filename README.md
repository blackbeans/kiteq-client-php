# 这是一个kiteq的PHP sdk

## 如果有php pb扩展使用扩展序列化以后发送，没有扩展使用php序列化

## 安装extension中的kiteq扩展可以获得更好的性能

## 使用方法

```
$client = new \Org\Kiteq\Client();

$client->ip = "localhost";
$client->port = 13800;
$client->group = "pb-mts-test";
$client->secret = "12345";
$client->connect();
$client->greet();

$begin = microtime(true)*1000;
$N = 100;
for ($i=0;$i<$N;$i++) {
	$client->publish("trade", "pay-succ", "abc");
}
$end = microtime(true)*1000;
$use = intval($end- $begin);
$per = $use / floatval($N);
$qps = 1000 / $per;
echo "投递 $N 个消息用时: $use ms 每个用时: $per ms qps: $qps 个/s".PHP_EOL;
```
