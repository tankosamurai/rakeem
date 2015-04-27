<?php

namespace Rakeem\Redis;

use Rakeem\Redis\Client as C;
use Rakeem\Packer;
use Rakeem\Unpacker;

abstract class Hash {

    const idPrefix = "";

    const format = [];

    private $hash;

    static function isFormatKeyExists($key){
        return array_key_exists($key, static::format);
    }

    function __construct($id){
        $this->id   = $id;
        $this->hash = [];
    }

    function __get($key){
        if($key === "id"){
            return $this->id;
        }else if(array_key_exists($key, $this->hash)){
            return $this->hash[$key];
        }else{
            return;
        }
    }

    function __set($key, $value){
        if($key === "id"){
            return $this->id = $value;
        }else{
            return $this->hash[$key] = $value;
        }
    }

    function getID(){
        return static::idPrefix . ":" . $this->id;
    }

    function exists(){
        return C::getInstance()->exists($this->getID());
    }

    function hgetall(){
        $temp = C::getInstance()->hgetall($this->getID());

        foreach($temp as $key => $value){
            if(static::isFormatKeyExists($key)){
                $format = static::format[$key];
                $this->hash[$key] = Unpacker::unpack($format, $value);
            }else{
                $this->hash[$key] = $value;
            }
        }

        return $this;
    }

    function hmset(){
        $temp = [];

        foreach($this->hash as $key => $value){
            if(static::isFormatKeyExists($key)){
                $format = static::format[$key];
                $temp[$key] = Packer::pack($format, $value);
            }else{
                $temp[$key] = $value;
            }
        }

        $hmset = C::getInstance()->hmset($this->getID(), $temp);
        $this->expire();

        return $hmset;
    }

    function del(){
        return C::getInstance()->del($this->getID());
    }

    function expire($ttl = 10){
        return C::getInstance()->expire($this->getID(), $ttl);
    }

}

?>
