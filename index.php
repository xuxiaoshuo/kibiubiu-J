<?php

namespace xxs;

use Kibiubiu\Queue;

require_once 'vendor/autoload.php';


$queue = new Queue();
$queue->start();