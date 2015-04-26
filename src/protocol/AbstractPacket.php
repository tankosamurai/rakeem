<?php

namespace Rakeem\Protocol;

abstract class AbstractPacket {

    public $buffer;
    protected $fields;

    static private function isFieldExists($fieldName){
        return array_key_exists($fieldName, static::fieldsDefinition);
    }

    static private function isLengthTypeExists($fieldName){
        return array_key_exists("lengthType", static::fieldsDefinition[$fieldName]);
    }

    static private function isFieldLengthExists($fieldName){
        if(static::isFieldExists($fieldName)){
            return array_key_exists("length", static::fieldsDefinition[$fieldName]);
        }else{
            return false;
        }
    }

    static private function isFieldLengthUnitExists($fieldName){
        if(static::isFieldExists($fieldName)){
            return array_key_exists("lengthUnit", static::fieldsDefinition[$fieldName]);
        }else{
            return false;
        }
    }

    static private function isFieldFormatExists($fieldName){
        if(static::isFieldExists($fieldName)){
            return array_key_exists("format", static::fieldsDefinition[$fieldName]);
        }else{
            return false;
        }
    }

    static private function isLengthTypeVariable($fieldName){
        if(static::isLengthTypeExists($fieldName)){
            $type = static::fieldsDefinition[$fieldName]["lengthType"];
            return "variable" === $type;
        }
    }

    static private function getFieldLength($fieldName){
        if(static::isFieldLengthExists($fieldName)){
            return static::fieldsDefinition[$fieldName]["length"];
        }
    }

    static private function getFieldLengthUnit($fieldName){
        if(static::isFieldLengthUnitExists($fieldName)){
            return static::fieldsDefinition[$fieldName]["lengthUnit"];
        }else{
            return "byte";
        }
    }

    static private function getFieldFormat($fieldName){
        if(static::isFieldFormatExists($fieldName)){
            return static::fieldsDefinition[$fieldName]["format"];
        }else{
            return "string";
        }
    }

    static function unpack($buffer){
        $packet = new static;
        $packet->buffer = $buffer;
        $packet->unpackAllFields();
        return $packet;
    }

    function __construct(){
        $this->fields = [];
    }

    private function substrLength($fieldName){
        $length = static::getFieldLength($fieldName);

        if(is_int($length)){
            return $length;
        }else if(is_string($length)){
            if("bit" === static::getFieldLengthUnit($fieldName)){
                return $this->$length / 8;
            }else{
                return $this->$length;
            }
        }else{
            throw new \Exception("length definition is invalid. ($fieldName)");
        }
    }

    private function substrStart($fieldName){
        $tmp = 1;

        foreach(static::fieldsDefinition as $key => $value){
            if($fieldName === $key){
                break;
            }else{
                $tmp += $this->substrLength($key);
            }
        }

        return $tmp;
    }

    private function substrBuffer($fieldName){
        $start = $this->substrStart($fieldName);

        if(static::isFieldLengthExists($fieldName)){
            $length = $this->substrLength($fieldName);
            return substr($this->buffer, $start, $length);
        }else{
            return substr($this->buffer, $start);
        }
    }

    private function packField($fieldName){
        $format = static::getFieldFormat($fieldName);
        $value  = $this->fields[$fieldName];

        if("string" === $format){
            return $value;
        }else{
            return Packer::pack($format, $value);
        }
    }

    private function unpackField($fieldName){
        $format = static::getFieldFormat($fieldName);
        $substr = $this->substrBuffer($fieldName);

        if("string" == $format){
            return $substr;
        }else{
            return Unpacker::unpack($format, $substr);
        }
    }

    function __get($fieldName){
        if(static::isFieldExists($fieldName)){
            return $this->fields[$fieldName];
        }
    }

    function __set($fieldName, $value){
        if(static::isFieldExists($fieldName)){
            if(static::isLengthTypeVariable($fieldName)){
                $methodName = static::getFieldLength($fieldName);
                $strlen     = strlen($value);

                if("bit" === static::getFieldLengthUnit($fieldName)){
                    $this->$methodName = $strlen * 8;
                }else{
                    $this->$methodName = $strlen;
                }
            }

            return $this->fields[$fieldName] = $value;
        }
    }

    function pack(){
        $buffer = chr(static::headerID);

        foreach(static::fieldsDefinition as $fieldName => $value){
            $buffer .= $this->packField($fieldName);
        }

        return $buffer;
    }

    function unpackAllFields(){
        foreach(static::fieldsDefinition as $fieldName => $value){
            $this->fields[$fieldName] = $this->unpackField($fieldName);
        }
    }

    function packedMagic(){
        $magic = [
            0x00, 0xff, 0xff, 0x00,
            0xfe, 0xfe, 0xfe, 0xfe,
            0xfd, 0xfd, 0xfd, 0xfd,
            0x12, 0x34, 0x56, 0x78,
        ];

        $temp = "";

        foreach($magic as $val){
            $temp .= pack("C", $val);
        }

        return $temp;
    }

}

?>
