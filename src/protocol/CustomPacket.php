<?php

namespace Rakeem\Protocol;

class CustomPacket extends AbstractPacket {
    const headerID = 0x80;

    const fieldsDefinition = [
        "count" => [
            "length" => 3,
            "format" => "t",
        ],

        "payload" => [
        ],
    ];
}

?>
