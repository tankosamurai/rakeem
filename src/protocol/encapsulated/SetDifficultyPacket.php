<?php

namespace Rakeem\Protocol\Encapsulated;

class SetDifficultyPacket extends EncapsulatedPacket {
    const headerID = 0xb0;

    const fieldsDefinition = [
        "difficulty" => [
            "length" => 2,
            "format" => "n",
        ]
    ];

}
?>
