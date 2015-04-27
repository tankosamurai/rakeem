<?php

namespace Rakeem\Protocol\Encapsulated;

class TileEventPacket extends EncapsulatedPacket {
    const headerID = 0x95;

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

        "case1" => [
            "length" => 2,
            "format" => "n",
        ],

        "case2" => [
            "length" => 2,
            "format" => "n",
        ],
    ];

}
?>
