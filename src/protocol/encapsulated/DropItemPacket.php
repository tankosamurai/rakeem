<?php

namespace Rakeem\Protocol\Encapsulated;

class DropItemPacket extends EncapsulatedPacket {
    const headerID = 0xa5;

    const fieldsDefinition = [
        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "unkown" => [
            "length" => 1,
            "format" => "C",
        ],

        "item" => [
        ],
    ];

}
?>
