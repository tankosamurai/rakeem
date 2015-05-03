<?php

namespace Rakeem;

use Analog;

trait ControllerShorthands {
    protected function log($log){
        return $this->logDebug($log);
    }

    protected function logError($log){
        return Analog::log($log, Analog::ERROR);
    }

    protected function logInfo($log){
        return Analog::log($log, Analog::INFO);
    }

    protected function logDebug($log){
        return Analog::log($log, Analog::DEBUG);
    }

    protected function redis(){
        return Redis\Client::getInstance();
    }

    protected function send($packet, $addr = ""){
        if(empty($addr)){
            return $this->socket->send($packet, $this->addr);
        }else{
            return $this->socket->send($packet, $addr);
        }
    }

    protected function configGet($key){
        return Config::getInstance()->get($key);
    }

    protected function serverInfoGet($key){
        if(!isset($this->serverInfo)){
            $this->serverInfo = new Persistent\ServerInfoHash();
        }

        return $this->serverInfo->get($key);
    }

    function forwardAddr(){
        return "127.0.0.1:19111";
    }

    function isFromForward(){
        return $this->addr === $this->forwardAddr();
    }

    function getProxyClientAddr(){
        if(isset($this->proxyClientAddr)){
            return $this->proxyClientAddr;
        }else{
            $proxyClientAddr = new Persistent\ProxyClientAddr($this->addr);
            return $this->proxyClientAddr = $proxyClientAddr;
        }
    }

    function getDest(){
        if($this->isFromForward()){
            return $this->getProxyClientAddr()->get();
        }else{
            return $this->forwardAddr();
        }
    }

}

?>
