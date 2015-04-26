<?php

namespace Rakeem\Protocol\Encapsulated;

class PlayerEquipmentPacket extends EncapsulatedPacket {
    const headerID = 0x98;

    const fieldsDefinition = [
        "eid" => [
            "length" => 4,
            "format" => "N",
        ],

        "item" => [
            "length" => 2,
            "format" => "n",
        ],

        "meta" => [
            "length" => 2,
            "format" => "n",
        ],

        "slot" => [
            "length" => 1,
            "format" => "C",
        ],

        "selectedSlot" => [
            "length" => 1,
            "format" => "C",
        ],
    ];
}

?>
