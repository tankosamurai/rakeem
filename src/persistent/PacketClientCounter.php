<?php

namespace Rakeem\Persistent;

class PacketClientCounter extends PacketCounter {

    function getID(){
        return "clientCount:" . $this->addr;
    }

}

?>
