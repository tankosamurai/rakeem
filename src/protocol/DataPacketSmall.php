<?php

namespace Rakeem\Protocol;

class DataPacketSmall extends AbstractDataPacket {
    const headerID = 0x00;

    const fieldsDefinition = [
        "lengthInBit" => [
            "length" => 2,
            "format" => "n",
        ],

        "payload" => [
        ],
    ];
}

?>
