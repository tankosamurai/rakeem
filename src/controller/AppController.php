<?php

namespace Rakeem\Controller;

use Rakeem\Persistent\PacketCounter;

class AppController extends AbstractController {

    function __construct($socket, $addr, $rakPacket, $datPacket, $packet){
        $this->socket    = $socket;
        $this->addr      = $addr;
        $this->rakPacket = $rakPacket;
        $this->datPacket = $datPacket;
        $this->packet    = $packet;
        $this->initCounter($addr, $datPacket);
    }

    function initCounter($addr, $datPacket){
        $this->counter = new PacketCounter($addr);
        $count         = $datPacket->count;

        if($this->counter->exists()){
            // do nothing.
        }else if(is_int($count)){
            $this->counter->set($count);
        }
    }

    function map(){
        $this->send($this->rakPacket->buffer, $this->getDest());
    }

}

?>
