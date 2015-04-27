<?php

namespace Rakeem\Protocol\Encapsulated;

class ContainerSetSlotPacket extends EncapsulatedPacket {
    const headerID = 0xa8;

    const fieldsDefinition = [
        "eid" => [
            "length" => 1,
            "format" => "C",
        ],

        "slot" => [
            "length" => 4,
            "format" => "N",
        ],

        "item" => [
        ]
    ];

}
?>
