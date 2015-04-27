<?php

namespace Rakeem\Protocol\Encapsulated;

class SetHealthPacket extends EncapsulatedPacket {
    const headerID = 0xa1;

    const fieldsDefinition = [
        "health" => [
            "length" => 2,
            "format" => "n",
        ]
    ];

}
?>
