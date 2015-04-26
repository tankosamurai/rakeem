<?php

namespace Rakeem\Protocol\Encapsulated;

class PlayerActionPacket extends EncapsulatedPacket {
    const headerID = 0x9c;

    const fieldsDefinition = [
        "action" => [
            "length" => 1,
            "format" => "C",
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

        "face" => [
            "length" => 1,
            "format" => "C",
        ],

        "eid" => [
            "length" => 1,
            "format" => "C",
        ],
    ];
}

?>
