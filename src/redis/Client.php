<?php

namespace Rakeem\Redis;

use Rakeem\Config;

class Client {
    private static $instance;
    private $redis;

    private function __construct(){
        $url = Config::getInstance()->get("redis_url");
        $this->redis = new \Predis\Client($url);
    }

    static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Client();
        }

        return  self::$instance->redis;
    }
}

?>
