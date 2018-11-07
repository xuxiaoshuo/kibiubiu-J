<?php

namespace Kibiubiu\Console;

class Command {

    public function analysis() {
        self::$argc = $_SERVER['argc'];
        self::$argv = $_SERVER['argv'];

        self::$exec_file = self::$argv[0];

    }
}