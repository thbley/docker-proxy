<?php

error_reporting(E_ALL);

class Test {
    public function connect() {
        $redis = new Redis();
	$redis->connect('127.0.0.1', 6379, 3);
        $redis->close();
    }
}

$t = new Test();

$sum = 0;
for ($i=0; $i < 100000; $i++) {
    $start = microtime(true);
    $t->connect();
    $end = microtime(true);
    $sum += $end - $start;
    if ($i % 10000 === 0) {
        echo round(($sum)*1000, 4), 'ms', PHP_EOL;
        $sum = 0;
    }
}
