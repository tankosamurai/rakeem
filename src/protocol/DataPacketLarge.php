<?php

namespace Rakeem\Protocol;

class DataPacketLarge extends AbstractDataPacket {
    const headerID = 0x60;

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

        "payload" => [
        ],
    ];

}

?>
