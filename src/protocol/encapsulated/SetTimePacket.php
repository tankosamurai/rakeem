<?php

namespace Rakeem\Protocol\Encapsulated;

class SetTimePacket extends EncapsulatedPacket {
    const headerID = 0x86;

    const fieldsDefinition = [
        "time" => [
            "length" => 4,
            "format" => "N",
        ],

        "started" => [
            "length" => 1,
            "format" => "C",
        ],
    ];
}

?>
