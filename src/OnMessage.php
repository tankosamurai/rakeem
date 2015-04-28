<?php

namespace Rakeem;

class OnMessage {
    function __invoke($message, $addr, $socket){
        $redis = Redis\Client::getInstance();
        if("127.0.0.1:19111" === $addr){
            $clientAddr = $redis->get("clientAddr");
        }else{
            $redis->set("clientAddr", $addr);
        }

        $pid = ord($message{0});

        if(false){
        }else if($pid === Protocol\UnconnectedPing::headerID){
            $rakPacket  = Protocol\UnconnectedPing::unpack($message);
            $mapper = new Controller\UnconnectedPingController($socket, $addr, $rakPacket);
            // }else if($pid === Protocol\UnconnectedPingOpenConnections::headerID){
            //     $rakPacket  = Protocol\UnconnectedPingOpenConnections::unpack($message);
            //     $mapper = new Controller\RakNetController($socket, $addr, $rakPacket);
        }else if($pid === Protocol\OpenConnectionRequest1::headerID){
            $rakPacket  = Protocol\OpenConnectionRequest1::unpack($message);
            $mapper = new Controller\OpenConnectionRequest1Controller($socket, $addr, $rakPacket);
        }else if($pid === Protocol\OpenConnectionReply1::headerID){
            $rakPacket  = Protocol\OpenConnectionReply1::unpack($message);
            $mapper = new Controller\OpenConnectionReply1Controller($socket, $addr, $rakPacket);
        }else if($pid === Protocol\OpenConnectionRequest2::headerID){
            $rakPacket  = Protocol\OpenConnectionRequest2::unpack($message);
            $mapper = new Controller\OpenConnectionRequest2Controller($socket, $addr, $rakPacket);
        }else if($pid === Protocol\OpenConnectionReply2::headerID){
            $rakPacket  = Protocol\OpenConnectionReply2::unpack($message);
            $mapper = new Controller\OpenConnectionReply2Controller($socket, $addr, $rakPacket);
            // }else if($pid === Protocol\ClientConnect::headerID){
            //     $rakPacket  = Protocol\ClientConnect::unpack($message);
            //     $mapper = new Controller\RakNetController($socket, $addr, $rakPacket);
        }else if($pid === Protocol\UnconnectedPong::headerID){
            $rakPacket  = Protocol\UnconnectedPong::unpack($message);
            $mapper = new Controller\UnconnectedPongController($socket, $addr, $rakPacket);
        }else if(0x80 <= $pid and $pid <= 0x8f){
            $rakPacket  = Protocol\CustomPacket::unpack($message);
            $packets    = Protocol\AbstractDataPacket::unpackPackets($rakPacket->payload);

            foreach($packets as $datPacket){
                $pid = ord($datPacket->payload{0});

                if(false){
                }else if($pid === Protocol\Encapsulated\PingPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\PingPacket::unpack($datPacket->payload);
                    $mapper = new Controller\PingController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\PongPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\PongPacket::unpack($datPacket->payload);
                    $mapper = new Controller\PongController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\LoginPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\LoginPacket::unpack($datPacket->payload);
                    $mapper = new Controller\LoginController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\PlayStatusPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\PlayStatusPacket::unpack($datPacket->payload);
                    $mapper = new Controller\PlayStatusController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\DisconnectPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\DisconnectPacket::unpack($datPacket->payload);
                    $mapper = new Controller\DisconnectController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\MessageIncomingPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\MessageIncomingPacket::unpack($datPacket->payload);
                    $mapper = new Controller\MessageController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\SetTimePacket::headerID){
                    $appPacket  = Protocol\Encapsulated\SetTimePacket::unpack($datPacket->payload);
                    $mapper = new Controller\SetTimeController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\StartGamePacket::headerID){
                    $appPacket  = Protocol\Encapsulated\StartGamePacket::unpack($datPacket->payload);
                    $mapper = new Controller\StartGameController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\AddPlayerPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\AddPlayerPacket::unpack($datPacket->payload);
                    $mapper = new Controller\AddPlayerController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\RemovePlayerPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\RemovePlayerPacket::unpack($datPacket->payload);
                    $mapper = new Controller\RemovePlayerController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\AddEntityPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\AddEntityPacket::unpack($datPacket->payload);
                    $mapper = new Controller\AddEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\RemoveEntityPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\RemoveEntityPacket::unpack($datPacket->payload);
                    $mapper = new Controller\RemoveEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\AddItemEntityPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\AddItemEntityPacket::unpack($datPacket->payload);
                    $mapper = new Controller\AddItemEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\TakeItemEntityPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\TakeItemEntityPacket::unpack($datPacket->payload);
                    $mapper = new Controller\TakeItemEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\MoveEntityPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\MoveEntityPacket::unpack($datPacket->payload);
                    $mapper = new Controller\MoveEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\MovePlayerPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\MovePlayerPacket::unpack($datPacket->payload);
                    $mapper = new Controller\MovePlayerController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\RemoveBlockPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\RemoveBlockPacket::unpack($datPacket->payload);
                    $mapper = new Controller\RemoveBlockController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\UpdateBlockPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\UpdateBlockPacket::unpack($datPacket->payload);
                    $mapper = new Controller\UpdateBlockController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\AddPaintingPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\AddPaintingPacket::unpack($datPacket->payload);
                    $mapper = new Controller\AddPaintingController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\ExplodePacket::headerID){
                    $appPacket  = Protocol\Encapsulated\ExplodePacket::unpack($datPacket->payload);
                    $mapper = new Controller\ExplodeController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\LevelEventPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\LevelEventPacket::unpack($datPacket->payload);
                    $mapper = new Controller\LevelEventController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\TileEventPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\TileEventPacket::unpack($datPacket->payload);
                    $mapper = new Controller\TileEventController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\EntityEventPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\EntityEventPacket::unpack($datPacket->payload);
                    $mapper = new Controller\EntityEventController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\MobEffectPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\MobEffectPacket::unpack($datPacket->payload);
                    $mapper = new Controller\MobEffectController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\PlayerEquipmentPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\PlayerEquipmentPacket::unpack($datPacket->payload);
                    $mapper = new Controller\PlayerEquipmentController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\PlayerArmorEquipmentPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\PlayerArmorEquipmentPacket::unpack($datPacket->payload);
                    $mapper = new Controller\PlayerArmorEquipmentController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\InteractPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\InteractPacket::unpack($datPacket->payload);
                    $mapper = new Controller\InteractController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\UseItemPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\UseItemPacket::unpack($datPacket->payload);
                    $mapper = new Controller\UseItemController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\PlayerActionPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\PlayerActionPacket::unpack($datPacket->payload);
                    $mapper = new Controller\PlayerActionController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\HurtArmorPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\HurtArmorPacket::unpack($datPacket->payload);
                    $mapper = new Controller\HurtArmorController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\SetEntityDataPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\SetEntityDataPacket::unpack($datPacket->payload);
                    $mapper = new Controller\SetEntityDataController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\SetEntityMotionPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\SetEntityMotionPacket::unpack($datPacket->payload);
                    $mapper = new Controller\SetEntityMotionController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\SetEntityLinkPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\SetEntityLinkPacket::unpack($datPacket->payload);
                    $mapper = new Controller\SetEntityLinkController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\SetHealthPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\SetHealthPacket::unpack($datPacket->payload);
                    $mapper = new Controller\SetHealthController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\SetSpawnPositionPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\SetSpawnPositionPacket::unpack($datPacket->payload);
                    $mapper = new Controller\SetSpawnPositionController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\AnimatePacket::headerID){
                    $appPacket  = Protocol\Encapsulated\AnimatePacket::unpack($datPacket->payload);
                    $mapper = new Controller\AnimateController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\RespawnPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\RespawnPacket::unpack($datPacket->payload);
                    $mapper = new Controller\RespawnController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\DropItemPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\DropItemPacket::unpack($datPacket->payload);
                    $mapper = new Controller\DropItemController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\ContainerOpenPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\ContainerOpenPacket::unpack($datPacket->payload);
                    $mapper = new Controller\ContainerOpenController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\ContainerClosePacket::headerID){
                    $appPacket  = Protocol\Encapsulated\ContainerClosePacket::unpack($datPacket->payload);
                    $mapper = new Controller\ContainerCloseController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\ContainerSetSlotPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\ContainerSetSlotPacket::unpack($datPacket->payload);
                    $mapper = new Controller\ContainerSetSlotController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\ContainerSetDataPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\ContainerSetDataPacket::unpack($datPacket->payload);
                    $mapper = new Controller\ContainerSetDataController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\ContainerSetContentPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\ContainerSetContentPacket::unpack($datPacket->payload);
                    $mapper = new Controller\ContainerSetContentController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\AdventureSettingsPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\AdventureSettingsPacket::unpack($datPacket->payload);
                    $mapper = new Controller\AdventureSettingsController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\TileEntityDataPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\TileEntityDataPacket::unpack($datPacket->payload);
                    $mapper = new Controller\TileEntityDataController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\FullChunkDataPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\FullChunkDataPacket::unpack($datPacket->payload);
                    $mapper = new Controller\FullChunkDataController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\SetDifficultyPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\SetDifficultyPacket::unpack($datPacket->payload);
                    $mapper = new Controller\SetDifficultyController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else if($pid === Protocol\Encapsulated\BatchPacket::headerID){
                    $appPacket  = Protocol\Encapsulated\BatchPacket::unpack($datPacket->payload);
                    $mapper = new Controller\BatchController($socket, $addr, $rakPacket, $datPacket, $appPacket);
                }else{
                    $mapper = new Controller\RakNetController($socket, $addr, $rakPacket);
                }
            }
            // }else if($pid === Protocol\NotAcknowledgement::headerID){
            //     $rakPacket  = Protocol\NotAcknowledgement::unpack($message);
            //     $mapper = new Controller\RakNetController($socket, $addr, $rakPacket);
        }else if($pid === Protocol\Acknowledgement::headerID){
            $rakPacket  = Protocol\Acknowledgement::unpack($message);
            $mapper = new Controller\AcknowledgementController($socket, $addr, $rakPacket);
        }else{
            return;
        }

        $mapper->map();


    }
}

?>