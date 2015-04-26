<?php

namespace Rakeem\Protocol\Encapsulated;

class AnimatePacket extends EncapsulatedPacket {
    const headerID = 0xa3;

    const fieldsDefinition = [
        "action" => [
            "length" => 1,
            "format" => "C",
        ],

        "eid" => [
            "length" => 4,
            "format" => "N",
        ],
    ];
}

?>
