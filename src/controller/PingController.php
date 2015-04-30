<?php

namespace Rakeem\Controller;

use Rakeem\Persistent\ClientHash;

class PingController extends AppController {

    function map(){
        $p = $this->packet;
        $client = new ClientHash($this->addr);
        $client->hgetall();
        $client->start_at = $this->intmillitime(true) - $p->uptime;
        $client->hmset();
        $client->setTTL();
        $this->send($this->rakPacket->buffer, $this->getDest());
    }

}

?>
