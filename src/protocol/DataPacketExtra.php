<?php

namespace Rakeem\Protocol;

class DataPacketExtra extends AbstractDatapacket {
    const headerID = 0x50;

    const fieldsDefinition = [
        "lengthInBit" => [
            "length" => 2,
            "format" => "n",
        ],

        "count" => [
            "length" => 3,
            "format" => "t",
        ],

        "unknown" => [
            "length" => 4,
            "format" => "N",
        ],

        "unknown2" => [
            "length" => 9,
        ],

        "payload" => [
        ],
    ];

}

?>
