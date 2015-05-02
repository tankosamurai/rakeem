<?php

namespace Rakeem\Controller;

class DataExtraController extends RakNetController {

    function __construct($socket, $addr, $rakPacket, $datPacket){
        $this->socket    = $socket;
        $this->addr      = $addr;
        $this->rakPacket = $rakPacket;
        $this->packet    = $datPacket;
    }

    function map(){
        $p  = $this->packet;
        $id = $this->addr . ":" . $p->splitID;

        $redis = \Rakeem\Redis\Client::getInstance();
        $redis->append($id, $p->payload);
    }

}

?>
