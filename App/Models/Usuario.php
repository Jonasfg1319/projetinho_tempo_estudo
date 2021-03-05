<?php 

namespace App\Models;
use App\Connection;

class Usuario extends Connection{
    private $nome = null;
    private $email = null;
    private $senha = null;
    private $conn = null;

    public function __construct(){

        $this->conn = $this->getConnection();

    }
   
    public function __get($attr){
    	return $this->$attr;
    }

    public function __set($attr,$value){
    	$this->$attr = $value;
    }

    public function insert(){
        $query = "INSERT INTO usuarios(nome,email,senha) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$this->__get("nome"));
        $stmt->bindValue(2,$this->__get('email'));
        $stmt->bindValue(3,$this->__get("senha"));
        $stmt->execute();
        

    }

    public function require_user(){
        $query = "SELECT nome,senha From usuarios WHERE nome = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$this->__get("nome"));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    public function authenticate(){
        $query = "SELECT u.nome,u.id, r.horas_totais, r.minutos_totais,r.segundos_totais FROM usuarios as u LEFT JOIN registros as r on (u.id = r.id_usuario) Where nome = ? and senha = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$this->__get("nome"));
        $stmt->bindValue(2,$this->__get("senha"));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


}