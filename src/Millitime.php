<?php

namespace Rakeem;

trait Millitime {
    function millitime($flag = false){
        return microtime($flag) *1000;
    }

    function intmillitime($flag = false){
        return round($this->millitime($flag));
    }
}

?>