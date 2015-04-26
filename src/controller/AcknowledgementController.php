<?php

namespace Rakeem\Controller;

class AcknowledgementController extends RakNetController {

    function map(){
        $p = $this->rakPacket;
        $this->send($p->pack(), $this->getDest());
    }
}

?>
