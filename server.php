<?php

require "vendor/autoload.php";

$conf   = Rakeem\Config::getInstance();
$loop   = React\EventLoop\Factory::create();
$server = stream_socket_server($conf->get("host"), $errno, $errstr, STREAM_SERVER_BIND);
$socket = new React\Datagram\Socket($loop, $server);
$info   = new Rakeem\Persistent\ServerInfoHash();
$info->hmset();

Analog::Handler(Analog\Handler\Stderr::init());

$socket->on("message", function($message, $addr, $socket){
    $redis = Rakeem\Redis\Client::getInstance();
    if("127.0.0.1:19111" === $addr){
        $clientAddr = $redis->get("clientAddr");
    }else{
        $redis->set("clientAddr", $addr);
    }

    $pid = ord($message{0});

    if(false){
    }else if($pid === Rakeem\Protocol\UnconnectedPing::headerID){
        $rakPacket  = Rakeem\Protocol\UnconnectedPing::unpack($message);
        $mapper = new Rakeem\Controller\UnconnectedPingController($socket, $addr, $rakPacket);
    // }else if($pid === Rakeem\Protocol\UnconnectedPingOpenConnections::headerID){
    //     $rakPacket  = Rakeem\Protocol\UnconnectedPingOpenConnections::unpack($message);
    //     $mapper = new Rakeem\Controller\RakNetController($socket, $addr, $rakPacket);
    }else if($pid === Rakeem\Protocol\OpenConnectionRequest1::headerID){
        $rakPacket  = Rakeem\Protocol\OpenConnectionRequest1::unpack($message);
        $mapper = new Rakeem\Controller\OpenConnectionRequest1Controller($socket, $addr, $rakPacket);
    }else if($pid === Rakeem\Protocol\OpenConnectionReply1::headerID){
        $rakPacket  = Rakeem\Protocol\OpenConnectionReply1::unpack($message);
        $mapper = new Rakeem\Controller\OpenConnectionReply1Controller($socket, $addr, $rakPacket);
    }else if($pid === Rakeem\Protocol\OpenConnectionRequest2::headerID){
        $rakPacket  = Rakeem\Protocol\OpenConnectionRequest2::unpack($message);
        $mapper = new Rakeem\Controller\OpenConnectionRequest2Controller($socket, $addr, $rakPacket);
    }else if($pid === Rakeem\Protocol\OpenConnectionReply2::headerID){
        $rakPacket  = Rakeem\Protocol\OpenConnectionReply2::unpack($message);
        $mapper = new Rakeem\Controller\OpenConnectionReply2Controller($socket, $addr, $rakPacket);
    // }else if($pid === Rakeem\Protocol\ClientConnect::headerID){
    //     $rakPacket  = Rakeem\Protocol\ClientConnect::unpack($message);
    //     $mapper = new Rakeem\Controller\RakNetController($socket, $addr, $rakPacket);
    }else if($pid === Rakeem\Protocol\UnconnectedPong::headerID){
        $rakPacket  = Rakeem\Protocol\UnconnectedPong::unpack($message);
        $mapper = new Rakeem\Controller\UnconnectedPongController($socket, $addr, $rakPacket);
    }else if(0x80 <= $pid and $pid <= 0x8f){
        $rakPacket  = Rakeem\Protocol\CustomPacket::unpack($message);
        $packets    = Rakeem\Protocol\AbstractDataPacket::unpackPackets($rakPacket->payload);

        foreach($packets as $datPacket){
            $pid = ord($datPacket->payload{0});

            if(false){
            }else if($pid === Rakeem\Protocol\Encapsulated\LoginPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\LoginPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\PlayStatusPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\PlayStatusPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\DisconnectPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\DisconnectPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\MessageIncomingPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\MessageIncomingPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\MessageController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\SetTimePacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\SetTimePacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\StartGamePacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\StartGamePacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\AddPlayerPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\AddPlayerPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\RemovePlayerPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\RemovePlayerPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\AddEntityPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\AddEntityPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\RemoveEntityPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\RemoveEntityPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\AddItemEntityPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\AddItemEntityPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\TakeItemEntityPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\TakeItemEntityPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\MoveEntityPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\MoveEntityPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\MovePlayerPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\MovePlayerPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\RemoveBlockPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\RemoveBlockPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\UpdateBlockPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\UpdateBlockPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\AddPaintingPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\AddPaintingPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\ExplodePacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\ExplodePacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\LevelEventPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\LevelEventPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\TileEventPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\TileEventPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\EntityEventPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\EntityEventPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\MobEffectPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\MobEffectPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\PlayerEquipmentPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\PlayerEquipmentPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\PlayerArmorEquipmentPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\PlayerArmorEquipmentPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\InteractPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\InteractPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\UseItemPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\UseItemPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\PlayerActionPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\PlayerActionPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\HurtArmorPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\HurtArmorPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\SetEntityDataPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\SetEntityDataPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\SetEntityMotionPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\SetEntityMotionPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\SetEntityLinkPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\SetEntityLinkPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\SetHealthPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\SetHealthPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\SetSpawnPositionPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\SetSpawnPositionPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\AnimatePacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\AnimatePacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\RespawnPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\RespawnPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\DropItemPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\DropItemPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\ContainerOpenPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\ContainerOpenPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\ContainerClosePacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\ContainerClosePacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\ContainerSetSlotPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\ContainerSetSlotPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\ContainerSetDataPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\ContainerSetDataPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\ContainerSetContentPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\ContainerSetContentPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\AdventureSettingsPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\AdventureSettingsPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\TileEntityDataPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\TileEntityDataPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\FullChunkDataPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\FullChunkDataPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\SetDifficultyPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\SetDifficultyPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else if($pid === Rakeem\Protocol\Encapsulated\BatchPacket::headerID){
                $appPacket  = Rakeem\Protocol\Encapsulated\BatchPacket::unpack($datPacket->payload);
                $mapper = new Rakeem\Controller\AppController($socket, $addr, $rakPacket, $datPacket, $appPacket);
            }else{
                $mapper = new Rakeem\Controller\RakNetController($socket, $addr, $rakPacket);
            }
        }
    // }else if($pid === Rakeem\Protocol\NotAcknowledgement::headerID){
    //     $rakPacket  = Rakeem\Protocol\NotAcknowledgement::unpack($message);
    //     $mapper = new Rakeem\Controller\RakNetController($socket, $addr, $rakPacket);
    }else if($pid === Rakeem\Protocol\Acknowledgement::headerID){
        $rakPacket  = Rakeem\Protocol\Acknowledgement::unpack($message);
        $mapper = new Rakeem\Controller\AcknowledgementController($socket, $addr, $rakPacket);
    }else{
        return;
    }

    $mapper->map();

});

$loop->addPeriodicTimer(1, function()use($socket){
    // $sessions = new Rakeem\Persistent\SessionSet();

    // foreach($sessions->smembers() as $addr){
    //     $controller = new Rakeem\Controller($socket, $addr);
    //     $controller->eachSecond();
    // }
});

$loop->run();

?>
