<?php

namespace Rakeem;

class Unpacker {
    static function unpack($format, $object){
        if("T" === $format){
            return self::unpackTriad($object);
        }else if("t" === $format){
            return self::unpackTriadLittleEndian($object);
        }else if("F" === $format){
            return self::unpackFloat($object);
        }else{
            return unpack($format, $object)[1];
        }
    }

    static private function unpackTriad($string){
        $upper = unpack("C", substr($string, 0, 1))[1];
        $lower = unpack("n", substr($string, 1, 2))[1];
        return $upper * 65536 + $lower;
    }

    static private function unpackTriadLittleEndian($string){
        return self::unpackTriad(strrev($string));
    }

    static private function unpackFloat($string){
        if(Endianness::isBigEndian()){
            return unpack("f", strrev($string))[1];
        }else{
            return unpack("f", $string)[1];
        }
    }
}

?>
