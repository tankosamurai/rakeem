<?php

namespace Rakeem\Protocol;

class OpenConnectionReply1 extends AbstractPacket {
    const headerID = 0x06;

    const fieldsDefinition = [
        "magic" => [
            "length" => 16,
        ],

        "serverID" => [
            "length" => 8,
            "format" => "J",
        ],

        "serverSecurity" => [
            "length" => 1,
            "format" => "C",
        ],

        "mtuSize" => [
            "length" => 2,
            "format" => "n",
        ],
    ];

}

?>
