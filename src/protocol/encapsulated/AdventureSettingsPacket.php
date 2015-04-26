<?php

namespace Rakeem\Protocol\Encapsulated;

class AdventureSettingsPacket extends EncapsulatedPacket {
    const headerID = 0xac;

    const fieldsDefinition = [
        "flags" => [
            "length" => 1,
            "format" => "C",
        ],
    ];
}

?>
