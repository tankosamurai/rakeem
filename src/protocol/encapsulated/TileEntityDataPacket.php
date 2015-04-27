<?php

namespace Rakeem\Protocol\Encapsulated;

class TileEntityDataPacket extends EncapsulatedPacket {
    const headerID = 0xad;

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

        "namedTag" => [
        ],
    ];

}
?>
