<?php

namespace xxs;

use Kibiubiu\Queue;
use Swoole\Process\Pool;

require_once 'vendor/autoload.php';


$queue = new Queue();
$queue->on('start', function (Pool $pool, $worker_id) {
    echo 'start;' . $worker_id . PHP_EOL;
    while (true) {
        usleep(100);
    }
});
$queue->on('stop', function (Pool $pool, $worker_id) {
    echo 'stop;' . $worker_id . PHP_EOL;
});
$queue->on("message", function (Pool $pool, $message) {
    echo "Message: {$message}" . PHP_EOL;
    $pool->write("hello ");
    $pool->write("world ");
    $pool->write("\n");
});
$queue->start();