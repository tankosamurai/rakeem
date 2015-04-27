<?php

namespace Rakeem\Persistent;

use Rakeem\Redis\Client as C;

class PacketCounter {

    function __construct($addr){
        $this->addr = $addr;
    }

    function getID(){
        return "packetcount:" . $this->addr;
    }

    function exists(){
        return C::getInstance()->exists($this->getID());
    }

    function get(){
        return C::getInstance()->get($this->getID());
    }

    function set($val){
        return C::getInstance()->set($this->getID(), $val);
    }

    function incr(){
        return C::getInstance()->incr($this->getID());
    }

    function decr(){
        return C::getInstance()->decr($this->getID());
    }

    function expire($ttl = 10){
        return C::getInstance()->expire($this->getID());
    }

}

?>
