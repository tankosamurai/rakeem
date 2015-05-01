<?php

namespace Rakeem\Controller;

class Forwarder extends RakNetController {

    function map(){
        $this->send($this->rakPacket->buffer, $this->getDest());
    }

}

?>