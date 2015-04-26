<?php

namespace Rakeem\Protocol\Encapsulated;

class AddPlayerPacket extends EncapsulatedPacket {
    const headerID = 0x88;

    const fieldsDefinition = [
        "clientID" => [
            "length" => 8,
            "format" => "J",
        ],

        "usernameLength" => [
            "length" => 1,
            "format" => "C",
        ],

        "else" => [
        ],
    ];

}
?>