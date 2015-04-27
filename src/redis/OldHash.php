<?php

namespace Rakeem\Redis;

use Rakeem\RedisClient;

abstract class Hash {

    abstract function attributes();

    function keyPrefix(){
        return "";
    }

    function setDefault(){
    }

    function key(){
        if(empty($this->keyPrefix())){
            return $this->id;
        }else{
            return $this->keyPrefix() . ":" . $this->id;
        }
    }

    function __construct($id){
        $this->redis = Client::getInstance();
        $this->id    = $id;
        $this->hash  = [];

        if($this->exists()){
            $this->hgetall();
        }else{
            $this->setDefault();
        }
    }

    final function get($hashKey){
        return $this->hash[$hashKey];
    }

    final function set($hashKey, $value){
        if(in_array($hashKey, $this->attributes(), true)){
            return $this->hash[$hashKey] = $value;
        }else{
            return false;
        }
    }

    final function hgetall(){
        return $this->hash = $this->redis->hgetall($this->key());
    }

    final function hmset(){
        return $this->redis->hmset($this->key(), $this->hash);
    }

    final function exists(){
        return $this->redis->exists($this->key());
    }

    final function del(){
        return $this->redis->del($this->key());
    }
}

?>
