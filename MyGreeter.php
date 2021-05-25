<?php

class MyGreeter
{
    public static $instance = [];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function instance()
    {
        $class = static::class;
        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new static();
        }
        return self::$instance[$class];
    }

    public function greet()
    {
        $time = time();
        $hour = date('H', $time);
        $min = date('i', $time);
        $sec = date('s', $time);
        var_dump($hour, $min, $sec);
        if (($hour > 6 && $hour < 12) || ($hour == 12 && $min == 0 && $sec == 0)) {
            return 'Good morning';
        } elseif (($hour > 12 && $hour < 18) || ($hour == 18 && $min == 0 && $sec == 0)) {
            return 'Good afternoon';
        } else {
            return 'Good evening';
        }
    }
}

try {
    $class = MyGreeter::instance();
    $message = $class->greet();
    var_dump($message);
} catch (Exception $e) {
    var_dump($e);
    die();
}
