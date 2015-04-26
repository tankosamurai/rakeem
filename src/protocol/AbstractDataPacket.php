<?php

namespace Rakeem\Protocol;

abstract class AbstractDataPacket extends AbstractPacket {
    static function dataPacketLength($payload){
        $pid = unpack("C", substr($payload, 0, 1))[1];
        $bit = unpack("n", substr($payload, 1, 2))[1];
        $len = (int) ceil($bit / 8);

        if(false){
        }else if($pid === DataPacketSmall::headerID){
            return $len + 3;
        }else if($pid === DataPacketMedium::headerID){
            return $len + 6;
        }else if($pid === DataPacketLarge::headerID){
            return $len + 10;
        }else if($pid === DataPacketExtra::headerID){
            return $len + 19;
        }else{
            return;
        }
    }

    static function splitPayload($payload){
        $array = [];

        while(strlen($payload) > 3){
            $length  = static::dataPacketLength($payload);
            $substr  = substr($payload, 0, $length);
            $array[] = $substr;

            $payload = substr($payload, $length);
        }

        return $array;
    }

    static function unpackPackets($payload){
        $array = [];

        foreach(static::splitPayload($payload) as $message){
            $pid = ord($message{0});

            if(false){
            }else if($pid === DataPacketSmall::headerID){
                $array[] = DataPacketSmall::unpack($message);
            }else if($pid === DataPacketMedium::headerID){
                $array[] = DataPacketMedium::unpack($message);
            }else if($pid === DataPacketLarge::headerID){
                $array[] = DataPacketLarge::unpack($message);
            }else if($pid === DataPacketExtra::headerID){
                $array[] = DataPacketExtra::unpack($message);
            }else{
                return;
            }
        }

        return $array;
    }
}

?>
