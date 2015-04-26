<?php

namespace Rakeem\Controller;

class RakNetController extends AbstractController {

    function __construct($socket, $addr, $rakPacket){
        $this->socket    = $socket;
        $this->addr      = $addr;
        $this->rakPacket = $rakPacket;
    }

    function map(){
        $this->send($this->rakPacket->buffer, $this->getDest());
    }
}

?>
