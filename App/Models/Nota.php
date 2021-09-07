<?php 
namespace App\Models;

use App\Connection;

class Nota extends Connection{
	
	private $conn = null;
	private $id = null;
	private $id_usuario = null;
    private $titulo = null;
    private $conteudo = null;

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
		$query = "SELECT titulo,conteudo,id_usuario FROM notas WHERE id_usuario = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(1, $this->__get('id_usuario'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function cadastra_nota(){
      
        $query = "INSERT INTO notas(id_usuario, titulo,conteudo) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->__get('id_usuario'));
	    $stmt->bindValue(2, $this->__get('titulo'));
	    $stmt->bindValue(3, $this->__get('conteudo'));
	    $stmt->execute();

        
	}

}


?>