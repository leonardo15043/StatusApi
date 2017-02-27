<?php
require_once __DIR__ . '/vendor/autoload.php';

//Instance class Message and Loggermy
$api = new \Controller\Api\Message();
$logmy = new \Controller\Api\Loggermy();

//List of methods

if($_GET['request'] == "list"){

	echo $api->ShowMessage($_GET['detail']);

}else if($_GET['request'] == "add"){

	echo $api->AddMessage($_GET['detail']);

}else if($_GET['request'] == "delete"){

	echo $api->DeleteMessage($_GET['detail']);

}else if($_GET['request'] == "search"){

	echo $api->SearchMessage($_GET['detail']);

}else if($_GET['request'] == "log"){

 if($_GET['detail'] == "clear"){
	echo $logmy->clear();
 }

}


?>
