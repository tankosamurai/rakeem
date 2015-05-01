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

        "splitLength" => [
            "length" => 4,
            "format" => "N",
        ],

        "splitID" => [
            "length" => 2,
            "format" => "n",
        ],

        "splitIndex" => [
            "length" => 4,
            "format" => "N",
        ],

        "payload" => [
        ],
    ];

}

?>
