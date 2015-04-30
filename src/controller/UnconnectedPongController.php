<?php

namespace Rakeem\Controller;

class UnconnectedPongController extends RakNetController {

    function map(){
        $p = $this->rakPacket;
        $p->identifier .= " (Thru Rakeem)";
        $pingID = $p->pingID;
        $id     = $p->identifier;
        // $this->logDebug("UnconnectedPong(0x1c) pingID: $pingID, identifier: $id");
        $this->send($p->pack(), $this->getDest());
    }
}

?>
