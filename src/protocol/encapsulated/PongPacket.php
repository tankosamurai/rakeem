<?php

namespace Rakeem\Protocol\Encapsulated;

class PongPacket extends EncapsulatedPacket {
    const headerID = 0x03;

    const fieldsDefinition = [
        "clientUptime" => [
            "length" => 8,
            "format" => "J",
        ],

        "uptime" => [
            "length" => 8,
            "format" => "J",
        ],
    ];
}

?>
