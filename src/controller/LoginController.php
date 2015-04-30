<?php

namespace Rakeem\Controller;

use Rakeem\Protocol\Encapsulated\LoginToServerPacket;
use Rakeem\Protocol\Encapsulated\LoginToClientPacket;

class LoginController extends AppController {

    function map(){
        if($this->isFromForward()){
            // $p = LoginToClientPacket::unpack($datPacket->payload);
            $this->log(implode(",", unpack("C*", $this->datPacket->payload)));
        }else{
            // $p = LoginToServerPacket::unpack($this->datPacket->payload);
        }

        $this->send($this->rakPacket->buffer, $this->getDest());
    }

}

?>