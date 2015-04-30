<?php

namespace Rakeem\Persistent;

class PacketServerCounter extends PacketCounter {

    function getID(){
        return "serverCount:" . $this->addr;
    }

}

?>
