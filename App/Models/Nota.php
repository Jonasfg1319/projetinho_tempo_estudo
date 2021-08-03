<?php 
namespace App\Models;

use App\Connection;

class Nota extends Connection{
	private $conn = null;

    public function __construct(){

      $this->conn = $this->getConnection();

    }

	public function recupera_notas_user($id){
		$query = "SELECT titulo,conteudo,id_usuario,id_registro FROM notas WHERE id_usuario = $id";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

    public function recupera_nt($id,$reg){
		$query = "SELECT conteudo,titulo FROM notas WHERE id_usuario = $id and id_registro = $reg";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

}


?>