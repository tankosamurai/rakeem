<?php

namespace Rakeem;

trait Millitime {
    static function millitime($flag = false){
        return microtime($flag) *1000;
    }

    static function intmillitime($flag = false){
        return round(static::millitime($flag));
    }
}

?>