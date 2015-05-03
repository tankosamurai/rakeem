<?php

namespace Rakeem;

class OnMessage {
    function __invoke($message, $addr, $socket){
        if("127.0.0.1:19111" !== $addr){
            $clientAddr = new Persistent\ProxyClientAddr($addr);
            $clientAddr->set($addr);
        }

        $pid = ord($message{0});

        if(false){
        }else if($pid ===   Protocol\UnconnectedPing::headerID){
            $rakPacket =    Protocol\UnconnectedPing::unpack($message);
            $mapper = new Controller\UnconnectedPingController($socket, $addr, $rakPacket);

        // }else if($pid ===   Protocol\UnconnectedPingOpenConnections::headerID){
        //     $rakPacket =    Protocol\UnconnectedPingOpenConnections::unpack($message);
        //     $mapper = new Controller\UnconnectedPingOpenConnectionsController($socket, $addr, $rakPacket);

        }else if($pid ===   Protocol\OpenConnectionRequest1::headerID){
            $rakPacket =    Protocol\OpenConnectionRequest1::unpack($message);
            $mapper = new Controller\OpenConnectionRequest1Controller($socket, $addr, $rakPacket);

        }else if($pid ===   Protocol\OpenConnectionReply1::headerID){
            $rakPacket =    Protocol\OpenConnectionReply1::unpack($message);
            $mapper = new Controller\OpenConnectionReply1Controller($socket, $addr, $rakPacket);

        }else if($pid ===   Protocol\OpenConnectionRequest2::headerID){
            $rakPacket =    Protocol\OpenConnectionRequest2::unpack($message);
            $mapper = new Controller\OpenConnectionRequest2Controller($socket, $addr, $rakPacket);

        }else if($pid ===   Protocol\OpenConnectionReply2::headerID){
            $rakPacket =    Protocol\OpenConnectionReply2::unpack($message);
            $mapper = new Controller\OpenConnectionReply2Controller($socket, $addr, $rakPacket);

        // }else if($pid ===   Protocol\ClientConnect::headerID){
        //     $rakPacket =    Protocol\ClientConnect::unpack($message);
        //     $mapper = new Controller\ClientConnectController($socket, $addr, $rakPacket);

        }else if($pid ===   Protocol\UnconnectedPong::headerID){
            $rakPacket =    Protocol\UnconnectedPong::unpack($message);
            $mapper = new Controller\UnconnectedPongController($socket, $addr, $rakPacket);

        }else if(0x80 <= $pid and $pid <= 0x8f){
            $rakPacket  = Protocol\CustomPacket::unpack($message);
            $packets    = Protocol\AbstractDataPacket::unpackPackets($rakPacket->payload);

            $forwarder = new Controller\Forwarder($socket, $addr, $rakPacket);
            $forwarder->map();

            foreach($packets as $datPacket){
                $dpid = ord($datPacket->buffer{0});
                $epid = ord($datPacket->payload{0});

                if(false){
                }else if($dpid ===  Protocol\DataPacketExtra::headerID){
                    $mapper = new Controller\DataExtraController($socket, $addr, $rakPacket, $datPacket);

                }else if($epid === Protocol\Encapsulated\PingPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\PingPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\PingController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\PongPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\PongPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\PongController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ClientConnectPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ClientConnectPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ClientConnectController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ServerHandshakePacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ServerHandshakePacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ServerHandshakeController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ClientHandshakePacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ClientHandshakePacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ClientHandshakeController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ClientCancelPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ClientCancelPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ClientCancelController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\LoginPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\LoginPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\LoginController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\PlayStatusPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\PlayStatusPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\PlayStatusController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\DisconnectPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\DisconnectPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\DisconnectController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\MessageToServerPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\MessageToServerPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\MessageController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\SetTimePacket::headerID){
                    $appPacket =   Protocol\Encapsulated\SetTimePacket::unpack($datPacket->payload);
                    $mapper =             new Controller\SetTimeController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\StartGamePacket::headerID){
                    $appPacket =   Protocol\Encapsulated\StartGamePacket::unpack($datPacket->payload);
                    $mapper =             new Controller\StartGameController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\AddPlayerPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\AddPlayerPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\AddPlayerController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\RemovePlayerPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\RemovePlayerPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\RemovePlayerController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\AddEntityPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\AddEntityPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\AddEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\RemoveEntityPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\RemoveEntityPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\RemoveEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\AddItemEntityPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\AddItemEntityPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\AddItemEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\TakeItemEntityPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\TakeItemEntityPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\TakeItemEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\MoveEntityPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\MoveEntityPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\MoveEntityController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\MovePlayerPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\MovePlayerPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\MovePlayerController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\RemoveBlockPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\RemoveBlockPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\RemoveBlockController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\UpdateBlockPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\UpdateBlockPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\UpdateBlockController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\AddPaintingPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\AddPaintingPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\AddPaintingController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ExplodePacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ExplodePacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ExplodeController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\LevelEventPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\LevelEventPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\LevelEventController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\TileEventPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\TileEventPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\TileEventController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\EntityEventPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\EntityEventPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\EntityEventController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\MobEffectPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\MobEffectPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\MobEffectController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\PlayerEquipmentPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\PlayerEquipmentPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\PlayerEquipmentController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\PlayerArmorEquipmentPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\PlayerArmorEquipmentPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\PlayerArmorEquipmentController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\InteractPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\InteractPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\InteractController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\UseItemPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\UseItemPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\UseItemController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\PlayerActionPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\PlayerActionPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\PlayerActionController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\HurtArmorPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\HurtArmorPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\HurtArmorController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\SetEntityDataPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\SetEntityDataPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\SetEntityDataController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\SetEntityMotionPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\SetEntityMotionPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\SetEntityMotionController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\SetEntityLinkPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\SetEntityLinkPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\SetEntityLinkController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\SetHealthPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\SetHealthPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\SetHealthController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\SetSpawnPositionPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\SetSpawnPositionPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\SetSpawnPositionController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\AnimatePacket::headerID){
                    $appPacket =   Protocol\Encapsulated\AnimatePacket::unpack($datPacket->payload);
                    $mapper =             new Controller\AnimateController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\RespawnPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\RespawnPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\RespawnController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\DropItemPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\DropItemPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\DropItemController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ContainerOpenPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ContainerOpenPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ContainerOpenController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ContainerClosePacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ContainerClosePacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ContainerCloseController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ContainerSetSlotPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ContainerSetSlotPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ContainerSetSlotController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ContainerSetDataPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ContainerSetDataPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ContainerSetDataController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\ContainerSetContentPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\ContainerSetContentPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\ContainerSetContentController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\AdventureSettingsPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\AdventureSettingsPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\AdventureSettingsController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\TileEntityDataPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\TileEntityDataPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\TileEntityDataController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\FullChunkDataPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\FullChunkDataPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\FullChunkDataController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\SetDifficultyPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\SetDifficultyPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\SetDifficultyController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else if($epid === Protocol\Encapsulated\BatchPacket::headerID){
                    $appPacket =   Protocol\Encapsulated\BatchPacket::unpack($datPacket->payload);
                    $mapper =             new Controller\BatchController($socket, $addr, $rakPacket, $datPacket, $appPacket);

                }else{
                    // $mapper = new Controller\RakNetController($socket, $addr, $rakPacket);
                    return;
                }
            }

        // }else if($pid ===   Protocol\NotAcknowledgement::headerID){
        //     $rakPacket =    Protocol\NotAcknowledgement::unpack($message);
        //     $mapper = new Controller\NotAcknowledgementController($socket, $addr, $rakPacket);

        }else if($pid ===   Protocol\Acknowledgement::headerID){
            $rakPacket =    Protocol\Acknowledgement::unpack($message);
            $mapper = new Controller\AcknowledgementController($socket, $addr, $rakPacket);

        }else{
            return;
        }

        $mapper->map();

    }
}

?>