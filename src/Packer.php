<?php

namespace Rakeem;

class Packer {
    static private $endianness;

    static function pack($format, $object){
        if(is_array($object)){
            return self::packArray($format, $object);
        }else if(is_numeric($object)){
            return self::packNumeric($format, $object);
        }else{
            return pack($format, $object);
        }
    }

    static private function packArray($format, $array){
        $temp = "";

        foreach($array as $value){
            $temp .= self::packNumeric($format, $array);
        }

        return $temp;
    }

    static private function packNumeric($format, $numeric){
        if("T" === $format){
            return self::packTriad($numeric);
        }else if("F" === $format){
            return self::packFloat($numeric);
        }else{
            return pack($format, $numeric);
        }
    }

    static private function packTriad($numeric){
        $temp  = "";
        $upper = $numeric / 65536;
        $lower = $numeric % 65536;

        $temp .= pack("C", $upper);
        $temp .= pack("n", $lower);

        return $temp;
    }

    static function isBigEndian(){
        if(!isset(self::$endianness)){
            self::$endianness = unpack("C*", pack("f", 1.0))[1] === 0;
        }

        return self::$endianness;
    }

    static private function packFloat($float){
        $string = pack("f", $float);

        if(self::isBigEndian()){
            return $string;
        }else{
            return strrev($string);
        }
    }
}

?>
