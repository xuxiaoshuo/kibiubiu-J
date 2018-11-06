<?php
/**
 * Created by PhpStorm.
 * User: QiuXin
 * Date: 2018/11/6
 * Time: 11:29
 */

namespace Kibiubiu;

use Kibiubiu\Queue\Push;

class Queue {

    public function start() {
        echo '##############################################启动############################################';
        $push = new Push();
        $push->main();
    }
}