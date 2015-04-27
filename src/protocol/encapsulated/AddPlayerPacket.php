<?php

namespace Rakeem\Protocol\Encapsulated;

class AddPlayerPacket extends EncapsulatedPacket {
    const headerID = 0x88;

    const fieldsDefinition = [
        "clientID" => [
            "length" => 8,
            "format" => "J",
        ],

        "usernameLength" => [
            "length" => 1,
            "format" => "C",
        ],

        "username" => [
            "lengtyType" => "variable",
            "length" => "usernameLength",
        ],

        "x" => [
            "length" => 4,
            "format" => "F",
        ],

        "y" => [
            "length" => 4,
            "format" => "F",
        ],

        "z" => [
            "length" => 4,
            "format" => "F",
        ],

        "speedX" => [
            "length" => 4,
            "format" => "F",
        ],

        "speedY" => [
            "length" => 4,
            "format" => "F",
        ],

        "speedZ" => [
            "length" => 4,
            "format" => "F",
        ],

        "yaw" => [
            "length" => 4,
            "format" => "F",
        ],

        "bodyYaw" => [
            "length" => 4,
            "format" => "F",
        ],

        "pitch" => [
            "length" => 4,
            "format" => "F",
        ],

        "item" => [
            "length" => 4,
            "format" => "N",
        ],

        "meta" => [
            "length" => 4,
            "format" => "N",
        ],

        "slim" => [
            "length" => 1,
            "format" => "C",
        ],

        "skinLength" => [
            "length" => 1,
            "format" => "C",
        ],

        "skin" => [
            "lengthType" => "variable",
            "length" => "skinLength",
        ],

        "else" => [
        ],
    ];

}
?>