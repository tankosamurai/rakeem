<?php

namespace Rakeem\Protocol;

class UnconnectedPong extends AbstractPacket {
    const headerID = 0x1c;

    const fieldsDefinition = [
        "pingID" => [
            "length" => 8,
            "format" => "J",
        ],

        "serverID" => [
            "length" => 8,
            "format" => "J",
        ],

        "magic" => [
            "length" => 16,
        ],

        "identifierLength" => [
            "length" => 2,
            "format" => "n",
        ],

        "identifier" => [
            "lengthType" => "variable",
            "length"  => "identifierLength",
        ],
    ];

}

?>
