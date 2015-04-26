<?php

namespace Rakeem\Protocol;

class UnconnectedPing extends AbstractPacket {
    const headerID = 0x01;

    const fieldsDefinition = [
        "pingID" => [
            "length" => 8,
            "format" => "J",
        ],

        "magic" => [
        ]
    ];

}

?>
