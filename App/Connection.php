<?php 

namespace App;

abstract class Connection{

	public function getConnection(){

		try{

			$conn = new \PDO(
				"mysql:host=localhost;dbname=tempo_estudo;charset=utf8",
				"root",
				"" 
			);

			return $conn;

		}catch(\PDOException $e){
           echo "Erro: ". $e->getMessage();
		}
	}
}
