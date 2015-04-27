<?php

namespace Rakeem\Protocol\Encapsulated;

class AddItemEntityPacket extends EncapsulatedPacket {
    const headerID = 0x8c;

    const fieldsDefinition = [
        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "itemID" => [
            "length" => 4,
            "format" => "N",
        ],

        "itemCount" => [
            "length" => 1,
            "format" => "C"
        ],

        "itemDamage" => [
            "length" => 4,
            "format" => "C",
        ],

        "x" => [
            "length" => 4,
            "format" => "F",
        ],

        "y" => [
            "length" => 4,
            "format" => "F",
        ],

        "z" => [
            "length" => 4,
            "format" => "F",
        ],

        "speedX" => [
            "length" => 4,
            "format" => "F",
        ],

        "speedY" => [
            "length" => 4,
            "format" => "F",
        ],

        "speedZ" => [
            "length" => 4,
            "format" => "F",
        ],
    ];

}
?>
