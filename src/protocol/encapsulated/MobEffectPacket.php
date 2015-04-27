<?php

namespace Rakeem\Protocol\Encapsulated;

class MobEffectPacket extends EncapsulatedPacket {
    const headerID = 0x97;

    const fieldsDefinition = [
        "eid" => [
            "length" => 8,
            "format" => "J",
        ],

        "eventID" => [
            "length" => 1,
            "format" => "C",
        ],

        "effectID" => [
            "length" => 1,
            "format" => "C",
        ],

        "amplifier" => [
            "length" => 1,
            "format" => "C",
        ],

        "particles" => [
            "length" => 1,
            "format" => "C",
        ],

        "duration" => [
            "length" => 2,
            "format" => "n",
        ]
    ];

}
?>
