<?php

namespace Rakeem;

class Config {
    private static $instance;
    private $config;

    private function __construct() {
        $this->config = \Noodlehaus\Config::load("config.json");
    }

    static function getInstance() {
        if(!isset(self::$instance)){
            self::$instance = new Config();
        }

        return self::$instance->config;
    }
}

?>
