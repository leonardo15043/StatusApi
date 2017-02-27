<?php

namespace Controller\Api;



class Message
{
	
	
	function ShowMessage($detail){

		//Header to give it a JSON format
		header("Content-Type: application/json");
		//We call the write method to generate logs
		$log = Loggermy::write();
		//We ensure that the request is all messages
		if($detail == "all"){
				//We query the message table and sort the data in descending order
				$sql = 'SELECT * FROM message ORDER BY fecha DESC';
				$enviar = Connection::getConnection()->prepare($sql);
				//Validate if the query was successfully executed
			  	if($enviar->execute()){

			  		if($enviar->rowCount() > 0){

			  			$result = $enviar->fetchAll(\PDO::FETCH_ASSOC);
			  			
					}else{
						$result = (['message' => 'No existen datos en este momento']);
						
					}

				}else{
					$result = (['error' => 'Ocurrio un error con la base de datos ']);
							
					$log->error($result['error']);
				}
		//If you do not see all the data it is validated that the value is a number to bring the detail of a message
		}else if(is_numeric($detail)){
				//Consult by message id
				$sql = 'SELECT * FROM message WHERE id ='.$detail;
				$enviar = Connection::getConnection()->prepare($sql);
				//Validate if the query was successfully executed
				  if($enviar->execute()){
				  			
				  		
				  		if($enviar->rowCount() > 0){

				  		$result = $enviar->fetchAll(\PDO::FETCH_ASSOC);
				  			
						}else{

						$result = (['message' => 'No existe ningun mensaje relacionado con este id']);
						
						}


					}else{
						$result = (['error' => 'Ocurrio un error con la base de datos ']);
							
						$log->error($result['error']);

					}


		}else{
				$result = (['message' => 'El id del mensaje especificado no es numerico']);
				$log->info($result['message']);
			
		}
		//We return the values in JSON format
		return json_encode($result);

	}

/*Add message*/

	function AddMessage($Message){
		//Validate that the value is not empty
		if($Message != ""){
			//We add the message with the current date
			$sql = 'INSERT INTO message (message,fecha) VALUES ("'.$Message.'" , "'.date("Y-m-d").'")';
			$add = Connection::getConnection()->prepare($sql);
			//Validate if the query was successfully executed
			if($add->execute()){
				if($add->rowCount() == 1){
					$result = (['message' => "Mensaje agregado correctamente"]);
				}else{
					$result = (['error' => "No fue posible guardar el mensaje"]);
					$this->log->error($result['error']);
				}
			}else{
					$result = (['error' => 'Ocurrio un error con la base de datos ']);
					$log->error($result['error']);
			}
			
		}else{
			$result = (['message' => 'Necesita especificar un mensaje']);
		}
		//We return the values in JSON format
		return json_encode($result);
	}

/*Delete Message*/

	function DeleteMessage($id){
		//Specify the message id to delete it
		$sql = 'DELETE FROM message WHERE id = '.$id;
		$del = Connection::getConnection()->prepare($sql);
		//Validate if the query was successfully executed
		if($del->execute()){

			if($del->rowCount() == 1){
				
				$result = (['message' => "Mensaje eliminado correctamente"]);
			}else{
				$result = (['message' => "Este mensaje no existe"]);
			}

		}else{
				$result = (['error' => 'Ocurrio un error con la base de datos ']);
				$log->error($result['error']);
		}
		//We return the values in JSON format
		return json_encode($result);
	}

/*Search Message*/

	function SearchMessage($message){
		//We query with a "like" and pass as parameter the $message variable
		$sql = "SELECT * FROM message WHERE message LIKE '%".$message."%'";
		$sm = Connection::getConnection()->prepare($sql);

		//Validate if the query was successfully executed
		if($sm->execute()){

		  		if($sm->rowCount() > 0){
		  				//Show all possible results
				  		$result = $sm->fetchAll(\PDO::FETCH_ASSOC);

				  		foreach ($result as $me) {
				  			echo $me->message;
				  		}

				}else{

						$result = (['message' => 'No existe ningun mensaje relacionado con este id']);
						
				}

		}else{
				$result = (['error' => 'Ocurrio un error con la base de datos ']);
				$log->error($result['error']);
		}
		//We return the values in JSON format
		return json_encode($result);
	}

}
