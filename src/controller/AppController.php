<?php

namespace Rakeem\Controller;

class AppController extends AbstractController {

    function __construct($socket, $addr, $rakPacket, $datPacket, $packet){
        $this->socket    = $socket;
        $this->addr      = $addr;
        $this->rakPacket = $rakPacket;
        $this->datPacket = $datPacket;
        $this->packet    = $packet;
    }

    function map(){
        $this->send($this->rakPacket->buffer, $this->getDest());
    }

}

?>
