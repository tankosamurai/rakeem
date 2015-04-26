<?php

namespace Rakeem\Protocol;

class OpenConnectionRequest1 extends AbstractPacket {
    const headerID = 0x05;

    const fieldsDefinition = [
        "magic" => [
            "length" => 16,
        ],

        "version" => [
            "length" => 1,
            "format" => "C",
        ],

        "payload" => [
        ]
    ];
}

?>
