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

        "spawnX" => [
            "length" => 4,
            "format" => "f"
        ],

        "spawnY" => [
            "length" => 4,
            "format" => "f"
        ],

        "spawnZ" => [
            "length" => 4,
            "format" => "f"
        ],
    ];

}
?>
