<?php

namespace Rakeem\Controller;

class OpenConnectionRequest2Controller extends RakNetController {

    function map(){
        $p = $this->rakPacket;
        $this->send($p->pack(), $this->getDest());
    }
}

?>
