<?php

namespace Rakeem\Protocol\Encapsulated;

class InteractPacket extends EncapsulatedPacket {
    const headerID = 0x9a;

    const fieldsDefinition = [
        "action" => [
            "length" => 1,
            "format" => "C",
        ],

        "targetID" => [
            "length" => 8,
            "format" => "J",
        ]
    ];

}
?>
