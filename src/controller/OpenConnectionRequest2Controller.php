<?php

namespace Rakeem\Controller;

use Rakeem\Persistent\ClientHash;

class OpenConnectionRequest2Controller extends RakNetController {

    function map(){
        $p = $this->rakPacket;

        $client = new ClientHash($this->addr);
        $client->clientId = $p->clientID;
        $client->hmset();

        $this->send($p->pack(), $this->getDest());
    }
}

?>
