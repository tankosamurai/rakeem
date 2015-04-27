<?php

namespace Rakeem\Protocol\Encapsulated;

class UseItemPacket extends EncapsulatedPacket {
    const headerID = 0x9b;

    const fieldsDefinition = [
        "x" => [
            "length" => 2,
            "format" => "n",
        ],

        "y" => [
            "length" => 2,
            "format" => "n",
        ],

        "z" => [
            "length" => 2,
            "format" => "n",
        ],

        "face" => [
            "length" => 1,
            "format" => "C",
        ],

        "item" => [
            "length" => 4,
            "format" => "N",
        ],

        "meta" => [
            "length" => 4,
            "format" => "N",
        ],

        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "fx" => [
            "length" => 4,
            "format" => "F",
        ],

        "fy" => [
            "length" => 4,
            "format" => "F",
        ],

        "fz" => [
            "length" => 4,
            "format" => "F",
        ],

        "pozX" => [
            "length" => 4,
            "format" => "F",
        ],

        "pozY" => [
            "length" => 4,
            "format" => "F",
        ],

        "posZ" => [
            "length" => 4,
            "format" => "F",
        ],

    ];

}
?>
