<?php

namespace Rakeem;

class CommandReader{
	private static $loop, $loopsocket, $Reader;

	public function __construct($loop, $loopsocket){
		self::$loop = $loop;
		self::$loopsocket = $loopsocket;
	}

	public function setLoopReader($loopReader){
		self::$Reader = $loopReader;
	}

	function getCommandLine(){
		$stdin = fopen("php://stdin", "r");
		$read = [$stdin];
		$write = null;
		$exept = null;
		if(stream_select($read, $write, $exept, 0) > 0){
			foreach($read as $input => $fd){
				if($stdin === $fd){
					$line = trim(fgets($fd));
					switch($line){
						case "stop":
						case "shutdown":
							echo "Shutdown a system now...\n";
							self::$loop->cancelTimer(self::$loopsocket);
							self::$loop->cancelTimer(self::$Reader);
							self::$loop->stop();
						break;
						/*case "status":
							$usememory = round((memory_get_usage() / 1024) / 1024, 2);
							echo "UseMemory: ".$usememory."\n";
						break;*/
						default:
							echo "Line: ".$line."\n";
							echo "Not Command!\n";
						break;
					}
				}
			}
		}
	}

}
