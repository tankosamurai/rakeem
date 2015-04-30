<?php

namespace Rakeem\Controller;

class UnconnectedPingController extends RakNetController {

    function map(){
        $p      = $this->rakPacket;
        $pingID = $p->pingID;
        $addr   = $this->addr;
        // $this->logDebug("UnconnectedPing(0x01) pingID: $pingID, from: $addr");
        $this->send($p->pack(), $this->getDest());
    }
}

?>
