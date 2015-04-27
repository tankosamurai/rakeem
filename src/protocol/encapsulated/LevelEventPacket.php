<?php

namespace Rakeem\Protocol\Encapsulated;

class LevelEventPacket extends EncapsulatedPacket {
    const headerID = 0x94;

    const fieldsDefinition = [
        "eid" => [
            "length" => 4,
            "format" => "N",
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

        "data" => [
        ],
    ];

}
?>
