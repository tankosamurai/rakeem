<?php

namespace Rakeem\Protocol\Encapsulated;

class EntityEventPacket extends EncapsulatedPacket {
    const headerID = 0x96;

    const fieldsDefinition = [
        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "event" => [
            "length" => 1,
            "format" => "C",
        ],
    ];

}
?>
