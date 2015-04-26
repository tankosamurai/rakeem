<?php

namespace Rakeem\Protocol\Encapsulated;

use Rakeem\Protocol\AbstractPacket;

class MessageIncomingPacket extends AbstractPacket {
    const headerID = 0x85;

    const fieldsDefinition = [
        "nameLength" => [
            "length" => 2,
            "format" => "n",
        ],

        "name" => [
            "lengthType" => "variable",
            "length" => "nameLength",
        ],

        "messageLength" => [
            "length" => 2,
            "format" => "n",
        ],

        "message" => [
            "lengthType" => "variable",
            "length" => "messageLength",
        ]

    ];

}

?>
