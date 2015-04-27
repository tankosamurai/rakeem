<?php

namespace Rakeem\Controller;

use Rakeem\Persistent\ClientHash;

class PingController extends AppController {

    function map(){
        $client = new ClientHash($this->addr);
        $client->expire();
        $this->send($this->rakPacket->buffer, $this->getDest());
    }

}

?>
