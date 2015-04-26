<?php

namespace Rakeem\Persistent;

use \Rakeem\Redis\Set;

class SessionSet extends Set {
    function key(){
        return "clients";
    }
}

?>
