<?php

namespace Rakeem\Protocol;

class Acknowledgement extends AbstractPacket {
    const headerID = 0xc0;

    const fieldsDefinition = [
        "unkown" => [
            "length" => 2,
            "format" => "n",
        ],

        "packet" => [
        ]
    ];

}

?>
