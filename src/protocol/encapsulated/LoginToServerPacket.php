<?php

namespace Rakeem\Protocol\Encapsulated;

class LoginToServerPacket extends EncapsulatedPacket {
    const headerID = 0x82;

    const fieldsDefinition = [
        "nameLength" => [
            "length" => 2,
            "format" => "n",
        ],

        "name" => [
            "lengthType" => "variable",
            "length" => "nameLength"
        ],

        "protocol1" => [
            "length" => 4,
            "format" => "N",
        ],

        "protocol2" => [
            "length" => 4,
            "format" => "N",
        ],

        "clientID" => [
            "length" => 4,
            "format" => "N",
        ],
    ];
}

?>
