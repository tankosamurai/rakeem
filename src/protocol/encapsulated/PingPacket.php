<?php

namespace Rakeem\Protocol\Encapsulated;

class PingPacket extends EncapsulatedPacket {
    const headerID = 0x00;

    const fieldsDefinition = [
        "identifier" => [
            "length" => 8,
            "format" => "J",
        ],
    ];
}

?>
