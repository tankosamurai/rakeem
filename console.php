#!/usr/bin/env php

<?php

require "vendor/autoload.php";

use Rakeem\Console\OnData;

$loop   = React\EventLoop\Factory::create();
$stdin  = new React\Stream\Stream(fopen("php://stdin",  "r+"), $loop);
$stdout = new React\Stream\Stream(fopen("php://stdout", "w+"), $loop);

$stdin->on("data", new OnData($stdout));

$loop->run();

?>
