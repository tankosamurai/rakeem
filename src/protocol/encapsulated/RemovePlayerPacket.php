<?php

namespace Rakeem\Protocol\Encapsulated;

class RemovePlayerPacket extends EncapsulatedPacket {
    const headerID = 0x89;

    const fieldsDefinition = [
        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "clientID" => [
            "length" => 8,
            "format" => "J",
        ],
    ];

}
?>
