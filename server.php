#!/usr/bin/env php

<?php

require "vendor/autoload.php";

$conf   = Rakeem\Config::getInstance();
$loop   = React\EventLoop\Factory::create();
$server = stream_socket_server($conf->get("host"), $errno, $errstr, STREAM_SERVER_BIND);
$socket = new React\Datagram\Socket($loop, $server);

Analog::Handler(Analog\Handler\Stderr::init());

$socket->on("message", new Rakeem\OnMessage());

$loop->addPeriodicTimer(1, function()use($socket){
    // $sessions = new Rakeem\Persistent\SessionSet();

    // foreach($sessions->smembers() as $addr){
    //     $controller = new Rakeem\Controller($socket, $addr);
    //     $controller->eachSecond();
    // }
});

$loop->run();

?>
