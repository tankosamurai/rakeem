<?php

namespace Rakeem\Persistent;

use Rakeem\Redis\Client as C;

class ProxyClientAddr {

    function __construct($addr){
        $this->addr  = $addr;
        $this->id    = "clientAddr";
        $this->value = C::getInstance()->get($this->id);
    }

    function get(){
        return $this->value;
    }

    function set($value){
        return $this->value = C::getInstance()->set($this->id, $value);
    }

}

?>