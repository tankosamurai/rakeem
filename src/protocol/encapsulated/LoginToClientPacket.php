<?php

namespace Rakeem\Protocol\Encapsulated;

class LoginToClientPacket extends EncapsulatedPacket {
    const headerID = 0x82;

    const fieldsDefinition = [
        "payload" => [
        ],
    ];
}

?>
