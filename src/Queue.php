<?php
/**
 * Created by PhpStorm.
 * User: QiuXin
 * Date: 2018/11/6
 * Time: 11:29
 */

namespace Kibiubiu;

use Kibiubiu\Exception\SystemException;
use Swoole\Process\Pool;

/**
 * 消息队列主进程
 * Class Queue
 * @package Kibiubiu
 */
class Queue {

    private $_config;

    private $_callabes = [];

    public function __construct() {
        $config        = include('Config.php');
        $this->_config = $config;
    }

    public function on(string $event, callable $callable): void {
        $this->_callabes[$event] = $callable;
    }

    /**
     * 启动进程
     */
    public function start($config = []) {
        if (!isset($this->_callabes['start'])) {
            throw new SystemException('Please set the process to start callback');
        }
        if (!isset($this->_callabes['stop'])) {
            throw new SystemException('Please set the process end callback');
        }
        if (!isset($this->_callabes['message'])) {
            throw new SystemException('Please set the process message callback');
        }
        $config = array_merge($this->_config, $config);
        $pool   = new \Swoole\Process\Pool($config['total'],SWOOLE_IPC_SOCKET);
        $pool->on("WorkerStart", $this->_callabes['start']);
        $pool->on("WorkerStop", $this->_callabes['stop']);
        $pool->on("Message", $this->_callabes['message']);
        $pool->listen($config['listen_host'], $config['listen_port']);
        $pool->start();
    }
}