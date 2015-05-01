<?php

namespace Rakeem\Controller;

use Rakeem\Persistent\ClientHash;

class PongController extends AppController {

    function map(){
        $client = new ClientHash($this->addr);
        $client->hgetall();
    }

}

?>
