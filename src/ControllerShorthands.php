<?php

namespace Rakeem;

trait ControllerShorthands {
    protected function log($log){
        return \Analog::log($log);
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

    function getClientAddr(){
        return $this->redis()->get("clientAddr");
    }

    function getDest(){
        if($this->isFromForward()){
            return $this->getClientAddr();
        }else{
            return $this->forwardAddr();
        }
    }

    function updateClientAddr(){
        if(!$this->isFromForward()){
            return $this->redis()->set("clientAddr", $this->addr);
        }
    }
}

?>
