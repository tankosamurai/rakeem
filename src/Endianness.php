<?php

namespace Rakeem;

class Endianness {

    static private $endianness;

    static function isBigEndian(){
        if(!isset(self::$endianness)){
            self::$endianness = unpack("C*", pack("f", 1.0))[1] === 0;
        }

        return self::$endianness;
    }

}

?>
