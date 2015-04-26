<?php

namespace Rakeem\Protocol;

class DataPacketMedium extends AbstractDataPacket {
    const headerID = 0x40;

    const fieldsDefinition = [
        "lengthInBit" => [
            "length" => 2,
            "format" => "n",
        ],

        "count" => [
            "length" => 3,
            "format" => "t",
        ],

        "payload" => [
        ],
    ];
}

?>
