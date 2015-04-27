<?php

namespace Rakeem\Redis;

use Rakeem\RedisClient;

class DirtyHash {

    private $array;
    private $oldArray;

    function __construct($keyID){
        $this->keyID    = $keyID;
        $this->hgetall();
    }

    function redis(){
        return Client::getInstance();
    }

    function keyPrefix(){
        return "";
    }

    function get($key){
        return $this->array[$key];
    }

    function getOld($key){
        return $this->oldArray[$key];
    }

    function set($key, $value){
        return $this->array[$key] = $value;
    }

    function getKey(){
        return $this->keyPrefix() . $this->keyID;
    }

    function hgetall(){
        $tmp = $this->redis()->hgetall($this->getKey());

        if(!empty($tmp)){
            $this->array    = array_map("self::unpack", $tmp);
            $this->oldArray = array_map("self::unpack", $tmp);
        }

        return $this->array;
    }

    function hmset(){
        $tmp = array_map("self::pack", $this->array);
        return $this->redis()->hmset($this->getKey(), $tmp);
    }

    function del(){
        return $this->redis()->del($this->getKey());
    }

    function isKeyDirty($key){
        $new = $this->array[$key];
        $old = $this->oldArray[$key];
        return $new === $old;
    }

    function pack($value){
        if(is_int($value)){
            return pack("N", $value);
        }else if(is_float($value)){
            return pack("f", $value);
        }else{
            return $value;
        }
    }

    function unpack($value){
        if(is_int($value)){
            return unpack("N", $value);
        }else if(is_float($value)){
            return unpack("f", $value);
        }else{
            return $value;
        }
    }
}

?>
