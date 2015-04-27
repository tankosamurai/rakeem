<?php

namespace Rakeem\Protocol\Encapsulated;

class RemoveEntityPacket extends EncapsulatedPacket {
    const headerID = 0x8b;

    const fieldsDefinition = [
        "eid" => [
            "length" => 8,
            "format" => "J",
        ]
    ];

}
?>
