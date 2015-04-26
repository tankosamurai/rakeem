<?php

namespace Rakeem\Protocol\Encapsulated;

class MovePlayerPacket extends EncapsulatedPacket {
    const headerID = 0x8f;

    const fieldsDefinition = [
        "eid" => [
            "length" => 4,
            "format" => "n",
        ],

        "x" => [
            "length" => 4,
            "format" => "F",
        ],

        "z" => [
            "length" => 4,
            "format" => "F",
        ],

        "y" => [
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

        "bodyYaw" => [
            "length" => 4,
            "format" => "F",
        ],
    ];

}

?>
