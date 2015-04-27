<?php

namespace Rakeem\Protocol\Encapsulated;

class BatchPacket extends EncapsulatedPacket {
    const headerID = 0xb1;

    const fieldsDefinition = [
        "contentLength" => [
            "length" => 1,
            "format" => "C",
        ],

        "content" => [
            "lengthType" => "variable",
            "length" => "contentLength",
        ]
    ];

}
?>
