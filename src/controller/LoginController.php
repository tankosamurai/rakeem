<?php

namespace Rakeem\Controller;

use Rakeem\Protocol\Encapsulated\LoginToServerPacket;
use Rakeem\Protocol\Encapsulated\LoginToClientPacket;

class LoginController extends AppController {

    function map(){
        if($this->isFromForward()){
            $p = LoginToClientPacket::unpack($this->datPacket->payload);
        }else{
            $p = LoginToServerPacket::unpack($this->datPacket->payload);
        }
    }

}

?>