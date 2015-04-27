<?php

namespace Rakeem\Protocol\Encapsulated;

class SetEntityLinkPacket extends EncapsulatedPacket {
    const headerID = 0x9e;

    const fieldsDefinition = [
        "from" => [
            "length" => 8,
            "format" => "J",
        ],

        "to" => [
            "length" => 8,
            "format" => "J",
        ],

        "type" => [
            "length" => 1,
            "format" => "C",
        ],
    ];

}
?>
