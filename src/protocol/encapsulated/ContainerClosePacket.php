<?php

namespace Rakeem\Protocol\Encapsulated;

class ContainerClosePacket extends EncapsulatedPacket {
    const headerID = 0xa7;

    const fieldsDefinition = [
        "eid" => [
            "length" => 1,
            "format" => "C",
        ],
    ];

}
?>
