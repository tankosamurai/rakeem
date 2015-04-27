<?php

namespace Rakeem\Protocol\Encapsulated;

class ContainerOpenPacket extends EncapsulatedPacket {
    const headerID = 0xa6;

    const fieldsDefinition = [
        "eid" => [
            "length" => 1,
            "format" => "C",
        ],

        "type" => [
            "length" => 1,
            "format" => "C",
        ],

        "slots" => [
            "length" => 4,
            "format" => "N",
        ],

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
