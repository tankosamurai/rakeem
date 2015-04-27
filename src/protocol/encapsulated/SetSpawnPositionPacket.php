<?php

namespace Rakeem\Protocol\Encapsulated;

class SetSpawnPositionPacket extends EncapsulatedPacket {
    const headerID = 0xa2;

    const fieldsDefinition = [
        "x" => [
            "length" => 2,
            "format" => "n",
        ],

        "y" => [
            "length" => 2,
            "format" => "n",
        ],

        "z" => [
            "length" => 2,
            "format" => "n",
        ],
    ];

}
?>
