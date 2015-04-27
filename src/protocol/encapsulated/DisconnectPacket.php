<?php

namespace Rakeem\Protocol\Encapsulated;

class DisconnectPacket extends EncapsulatedPacket {
    const headerID = 0x84;

    const fieldsDefinition = [
        "length" => [
            "length" => 1,
            "format" => "C",
        ],

        "message" => [
            "lengthType" => "variable",
            "length" => "length",
        ],
    ];

}
?>
