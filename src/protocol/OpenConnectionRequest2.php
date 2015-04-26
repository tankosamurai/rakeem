<?php

namespace Rakeem\Protocol;

class OpenConnectionRequest2 extends AbstractPacket {
    const headerID = 0x07;

    const fieldsDefinition = [
        "magic" => [
            "length" => 16,
        ],

        "security" => [
            "length" => 1,
            "format" => "C",
        ],

        "cookie" => [
            "length" => 4,
            "format" => "N",
        ],

        "serverPort" => [
            "length" => 2,
            "format" => "n",
        ],

        "mtuSize" => [
            "length" => 2,
            "format" => "n",
        ],

        "clientID" => [
            "length" => 8,
            "format" => "J",
        ],
    ];

}

?>
