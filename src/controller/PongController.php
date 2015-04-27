<?php

namespace Rakeem\Controller;

class PongController extends AppController {

    function map(){
        $this->log($this->packet->pingID);
        $this->log(\Rakeem\Millitime::intmillitime(true));
        // $this->log(implode(",", unpack("C*", $this->packet->buffer)));
        $this->send($this->rakPacket->buffer, $this->getDest());
    }

}

?>
