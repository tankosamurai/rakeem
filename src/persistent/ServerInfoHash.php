<?php

namespace Rakeem\Persistent;

use Rakeem\Redis\OldHash;
use Rakeem\Millitime;

class ServerInfoHash extends OldHash {
    use Millitime;

    function key(){
        return "server";
    }

    function __construct(){
        parent::__construct("server");
    }

    function attributes(){
        $array[] = "id";
        $array[] = "startAt";

        return $array;
    }

    function setDefault(){
        $this->set("id", mt_rand(0, PHP_INT_MAX));
        $this->set("startAt", $this->intmillitime(true));
    }

    function pingID(){
        return $this->intmillitime(true) - $this->get("startAt");
    }
}

?>
