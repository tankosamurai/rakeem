<?php

namespace Rakeem\Protocol\Encapsulated;

class RespawnPacket extends EncapsulatedPacket {
    const headerID = 0xa4;

    const fieldsDefinition = [
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
    ];

}
?>
