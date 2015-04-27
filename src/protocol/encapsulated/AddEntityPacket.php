<?php

namespace Rakeem\Protocol\Encapsulated;

class AddEntityPacket extends EncapsulatedPacket {
    const headerID = 0x8a;

    const fieldsDefinition = [
        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "type" => [
            "length" => 1,
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

        "yaw" => [
            "length" => 4,
            "format" => "F",
        ],

        "pitch" => [
            "length" => 4,
            "format" => "F",
        ],

        "meta" => [
        ],
    ];

}
?>
