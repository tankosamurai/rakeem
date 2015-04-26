<?php

namespace Rakeem;

class PacketRouter {

    function __construct($socket, $addr, $message){
        $this->socket  = $socket;
        $this->addr    = $addr;
        $this->message = $message;
    }

    function route(){
        $id = ord($this->message{0});
        if(false){
        }else if(0x01 === $id){
            $packet1 = Protocol\UnconnectedPing::unpack($this->message);
        }else if(0x02 === $id){
            $packet1 = Protocol\UnconnectedPingOpenConnection::unpack($this->message);
        }else if(0x05 === $id){
            $packet1 = Protocol\OpenConnectionRequest1::unpack($this->message);
        }else if(0x06 === $id){
            $packet1 = Protocol\OpenConnectionReply1::unpack($this->message);
        }else if(0x07 === $id){
            $packet1 = Protocol\OpenConnectionRequest2::unpack($this->message);
        }else if(0x08 === $id){
            $packet1 = Protocol\OpenConnectionReply2::unpack($this->message);
        }else if(0x09 === $id){
            $packet1 = Protocol\ClientConnect::unpack($this->message);
        }else if(0x1c === $id){
            $packet1 = Protocol\UnconnectedPong::unpack($this->message);
        }else if(0x80 <= $id and $id <= 0x8f){
            $packet1 = Protocol\CustomPacket::unpack($this->message);
        }else if(0xa0 === $id){
            $packet1 = Protocol\NotAcknowledgement::unpack($this->message);
        }else if(0xc0 === $id){
            $packet1 = Protocol\Acknowledgement::unpack($this->message);
        }
    }
}

?>
