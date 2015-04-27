<?php

namespace Rakeem\Protocol\Encapsulated;

class PongPacket extends EncapsulatedPacket {
    const headerID = 0x03;

    const fieldsDefinition = [
        "identifier" => [
            "length" => 8,
            "format" => "J",
        ],

        "unkown" => [
            "length" => 8,
            "format" => "J",
        ],
    ];
}

?>