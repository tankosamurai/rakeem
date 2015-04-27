<?php

namespace Rakeem\Protocol\Encapsulated;

class PlayStatusPacket extends EncapsulatedPacket {
    const headerID = 0x83;

    const fieldsDefinition = [
        "status" => [
            "length" => 1,
            "format" => "C",
        ],
    ];

}
?>
