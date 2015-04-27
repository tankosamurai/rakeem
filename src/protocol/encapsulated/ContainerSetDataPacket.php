<?php

namespace Rakeem\Protocol\Encapsulated;

class ContainerSetDataPacket extends EncapsulatedPacket {
    const headerID = 0xa9;

    const fieldsDefinition = [
        "eid" => [
            "length" => 1,
            "format" => "C",
        ],

        "property" => [
            "length" => 4,
            "format" => "N",
        ],

        "value" => [
            "length" => 4,
            "format" => "N",
        ],
    ];

}
?>
