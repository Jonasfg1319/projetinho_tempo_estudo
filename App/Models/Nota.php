<?php 
namespace App\Models;

use App\Connection;

class Nota extends Connection{
	
	private $conn = null;
	private $id = null;
	private $id_usuario = null;
	private $id_registro = null;

    public function __construct(){

      $this->conn = $this->getConnection();

    }

    public function __get($variavel){

    	return $this->$variavel;

    }

    public function __set($variavel, $valor){
 
       $this->$variavel = $valor;

    }

	public function recupera_notas_user(){
		$query = "SELECT titulo,conteudo,id_usuario,id_registro FROM notas WHERE id_usuario = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(1, $this->__get('id_usuario'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

    public function recupera_nota_registro(){
		$query = "SELECT conteudo,titulo FROM notas WHERE id_usuario = ? and id_registro = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(1, $this->__get('id_usuario'));
		$stmt->bindValue(2, $this->__get('id_registro'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function cadastra_nota(){
      

	}

}


?>