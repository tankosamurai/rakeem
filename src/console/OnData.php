<?php

namespace Rakeem\Console;

class OnData {

    function __construct($stdout){
        $this->stdout = $stdout;
        $this->redis  = \Rakeem\Redis\Client::getInstance();
    }

    function __invoke($data, $stdin){
        $explode = explode(" ", substr($data, 0, -1));
        $command = $explode[0];

        if(false){
        }else if($command === "flushall"){
            $this->redis->flushall();
            $this->writeLine("OK");
        }else if($command === "help"){
            $this->writeLine("this is help");
        }else{
            $this->writeLine("unkown command ($command)");
        }

    }

    private function write($data){
        $this->stdout->write("> " . $data);
    }

    private function writeLine($data){
        $this->write($data . PHP_EOL);
    }

}


?>
