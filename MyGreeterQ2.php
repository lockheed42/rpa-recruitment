<?php

class MyGreeterQ2
{
    public static $instance = [];

    /**
     * greeting for output string
     */
    const MORNING = 'Good morning';
    const AFTERNOON = 'Good afternoon';
    const EVENING = 'Good evening';

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * 单例模式
     * @return mixed|static
     */
    public static function instance()
    {
        $class = static::class;
        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new static();
        }
        return self::$instance[$class];
    }

    /**
     * 设置时区
     * @param $timeZone
     */
    public function setTimeZone($timeZone)
    {
        if (empty($timeZone)) {
            $timeZone = date_default_timezone_get();
        }
        date_default_timezone_set($timeZone);
    }

    /**
     * 获取招呼字符串
     * @return string
     */
    public function greet()
    {
        $time = time();
        $hour = date('H', $time);
        $min = date('i', $time);
        $sec = date('s', $time);
        if (($hour > 6 && $hour < 12) || ($hour == 12 && $min == 0 && $sec == 0)) {
            return self::MORNING;
        } elseif (($hour > 12 && $hour < 18) || ($hour == 18 && $min == 0 && $sec == 0)) {
            return self::AFTERNOON;
        } else {
            return self::EVENING;
        }
    }
}

try {
    $class = MyGreeterQ2::instance();
    $class->setTimeZone("Asia/Shanghai");
    $message = $class->greet();
    echo $message;
} catch (Exception $e) {
    //#TODO import log class
}
/**
 * 1、常量化特定字符串，便于后期修改或优化
 * 2、捕获异常记录日志。线上出错时报警
 * 3、var_dump调试输出修改为echo
 * 4、根据访问用户设置时区参数，兼容全球各地正确获取时间
 */