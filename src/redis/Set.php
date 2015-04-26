<?php

namespace Rakeem\Redis;

use Rakeem\RedisClient;

abstract class Set {

    abstract function key();

    final function __construct(){
        $this->redis = Client::getInstance();
    }

    function sadd($value){
        return $this->redis->sadd($this->key(), $value);
    }

    function srem($value){
        return $this->redis->srem($this->key(), $value);
    }

    function sismember($value){
        return $this->redis->sismember($this->key(), $value);
    }

    function smembers(){
        return $this->redis->smembers($this->key());
    }

}

?>
