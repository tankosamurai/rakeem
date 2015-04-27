<?php

namespace Rakeem\Protocol\Encapsulated;

class FullChunkDataPacket extends EncapsulatedPacket {
    const headerID = 0xaf;

    const fieldsDefinition = [
        "x" => [
            "length" => 2,
            "format" => "n",
        ],

        "y" => [
            "length" => 2,
            "format" => "n",
        ],

        "length" => [
            "length" => 2,
            "format" => "n",
        ],

        "data" => [
        ],
    ];

}
?>
