<?php

namespace Rakeem\Protocol\Encapsulated;

class RemoveBlockPacket extends EncapsulatedPacket {
    const headerID = 0x97;

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
            "length" => 1,
            "format" => "C",
        ],
    ];
}

?>
