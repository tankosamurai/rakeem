<?php

namespace Rakeem\Persistent;

use Rakeem\Redis\DirtyHash;

class Player extends OldDirtyHash {
    function keyPrefix(){
        return "players:";
    }

    function dx(){
        return $this->get("x") - $this->getOld("x");
    }
}

?>
