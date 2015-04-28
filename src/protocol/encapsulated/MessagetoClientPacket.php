<?php

namespace Rakeem\Protocol\Encapsulated;

use Rakeem\Protocol\AbstractPacket;

class MessageToClientPacket extends AbstractPacket {
    const headerID = 0x85;

    const fieldsDefinition = [
        "messageLength" => [
            "length" => 4,
            "format" => "N",
        ],

        "message" => [
            "lengthType" => "variable",
            "length" => "messageLength",
        ]

    ];

}

?>
