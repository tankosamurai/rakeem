<?php

namespace Rakeem\Protocol\Encapsulated;

class TakeItemEntityPacket extends EncapsulatedPacket {
    const headerID = 0x8d;

    const fieldsDefinition = [
        "targetID" => [
            "length" => 8,
            "format" => "J",
        ],

        "eid" => [
            "length" => 8,
            "format" => "J",
        ],
    ];

}
?>
