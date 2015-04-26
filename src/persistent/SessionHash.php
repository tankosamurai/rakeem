<?php

namespace Rakeem\Persistent;

use Rakeem\Redis\Hash;
use Rakeem\Millitime;

class SessionHash extends Hash {
    use Millitime;

    function attributes(){
        $array[] = "state";
        $array[] = "clientID";
        $array[] = "lastUpdate";
        $array[] = "startTime";
        $array[] = "reliableLastIndex";
        $array[] = "reliableRangeStart";
        $array[] = "reliableRangeEnd";
        $array[] = "isActive;";

        return $array;
    }

    function keyPrefix(){
        return "sessions";
    }

    function setDefault(){
        $this->set("state", "unconnected");
        $this->set("lastUpdate", $this->intmillitime(true));
        $this->set("startTime", $this->intmillitime(true));
        $this->set("isActive", false);
        $this->set("reliableLastIndex", -1);
        $this->set("reliableRangeStart", 0);
        $this->set("reliableRangeEnd", 1024);
    }

    function touch(){
        return $this->set("lastUpdate", $this->intmillitime(true));
    }

    function isUnconnected(){
        return $this->get("state") === "unconnected";
    }

    function isConnecting1(){
        return $this->get("state") === "connecting1";
    }

    function isConnecting2(){
        return $this->get("state") === "connecting2";
    }

    function elapsedTime(){
        return $this->intmillitime(true) - $this->get("lastUpdate");
    }

    function isExpired(){
        return 10 * 1000 < $this->elapsedTime();
    }

    function isInReliableRange($index){
        $a = $this->get("reliableRangeStart") < $index;
        $b = $index < $this->get("reliableRangeEnd");
        return $a and $b;
    }

    function updateReliability(){
        $keys = ["reliableLastIndex", "reliableRangeStart", "reliableRangeEnd"];

        foreach($keys as $key){
            $val = intval($this->get($key));
            $this->set($key, ++$val);
        }

    }

}

?>
