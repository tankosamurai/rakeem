<?php

namespace Rakeem\Controller;

class OpenConnectionRequest1Controller extends RakNetController {

    function map(){
        $p = $this->rakPacket;
        $this->send($p->pack(), $this->getDest());
    }
}

?>
