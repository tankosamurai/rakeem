<?php

namespace Rakeem\Protocol;

class OpenConnectionReply2 extends AbstractPacket {
    const headerID = 0x08;

    const fieldsDefinition = [
        "magic" => [
            "length" => 16,
        ],

        "serverID" => [
            "length" => 8,
            "format" => "J",
        ],

        "clientPort" => [
            "length" => 2,
            "format" => "n",
        ],

        "mtuSize" => [
            "length" => 2,
            "format" => "n",
        ],

        "security" => [
            "length" => 1,
            "format" => "C",
        ],
    ];

}

?>
