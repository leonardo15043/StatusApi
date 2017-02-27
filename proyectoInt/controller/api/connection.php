<?php
namespace Controller\Api;


class Connection
{

	public static $instancia;
	
	

	public static function getConnection()
	{
		$log = Loggermy::write();
		if(!isset(self::$instancia)){
			
			try {
			    self::$instancia  = new \PDO('mysql:host=localhost;dbname=api', 'root', 'root');
			   
			} catch (PDOException $e) {
			    
			    $log->error("No se pudo conectar a la base de datos ".$e->getMessage());

			    die();
			}


		}

		return self::$instancia;
	}
}
