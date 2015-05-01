<?php

namespace Rakeem\Protocol\Encapsulated;

class StartGamePacket extends EncapsulatedPacket {
    const headerID = 0x87;

    const fieldsDefinition = [
        "seed" => [
            "length" => 1,
            "format" => "C",
        ],

        "generator" => [
            "length" => 1,
            "format" => "C",
        ],

        "gamemode" => [
            "length" => 1,
            "format" => "C",
        ],

        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "x" => [
            "length" => 4,
            "format" => "f"
        ],

        "y" => [
            "length" => 4,
            "format" => "f"
        ],

        "z" => [
            "length" => 4,
            "format" => "f"
        ],
    ];

}
?>
