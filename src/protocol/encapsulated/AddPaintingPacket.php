<?php

namespace Rakeem\Protocol\Encapsulated;

class AddPaintingPacket extends EncapsulatedPacket {
    const headerID = 0x92;

    const fieldsDefinition = [
        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "x" => [
            "length" => 1,
            "format" => "C",
        ],

        "y" => [
            "length" => 1,
            "format" => "C",
        ],

        "z" => [
            "length" => 1,
            "format" => "C",
        ],

        "direction" => [
            "length" => 1,
            "format" => "C",
        ],

        "titleLength" => [
            "length" => 1,
            "format" => "C",
        ],

        "title" => [
            "lengthType" => "variable",
            "length" => "titleLength",
        ],
    ];

}
?>
