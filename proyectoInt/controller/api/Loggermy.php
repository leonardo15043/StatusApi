<?php

namespace Controller\Api;
//We call the monolog namespace
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

//We created the Loggermy class
class Loggermy
{

	//We create the method and write that assigns the error messages to the file "my_app.log" and will also allow us to generate the records
	function write(){


		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler(__DIR__.'/log/my_app.log', Logger::DEBUG));
		
		$log = $logger->pushHandler(new FirePHPHandler());


		return $log;


    }
	//Method that works to clean the log file
	function clear(){
		
		$archivo=fopen(__DIR__."/log/my_app.log","w");
		if(fclose($archivo)){
			$result = (['message' => "Log limpiado correctamente"]);
		}else{
			$result = (['message' => "No fue posible limpiar el log "]);
		}
		
		return json_encode($result);
	}


}
?>
