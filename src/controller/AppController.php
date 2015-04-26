<?php

namespace Rakeem\Controller;

class RakeemController extends AbstractController {

    function __construct($socket, $addr, $rakNetPacket, $dataPacket, $packet){
        $this->socket       = $socket;
        $this->addr         = $addr;
        $this->rakNetPacket = $rakNetPacket;
        $this->dataPacket   = $dataPacket;
        $this->packet       = $packet;
    }

    function map(){
        $this->send($this->rakPacket->buffer, $this->getDest());
    }

}

?>
