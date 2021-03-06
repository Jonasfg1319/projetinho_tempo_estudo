<?php 

namespace App\Models;

use App\Connection;

class Registro extends Connection{

    private $id_usuario = null;
    private $horas_atuais = null;
    private $data = null;
    private $horas_totais = null;
    private $minutos_totais = null;
    private $segundos_totais = null;
    private $anotacoes = null;
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

    public function listarRegistros(){
      $query = "SELECT r.id_usuario,r.horas_atuais,r.data,r.horas_totais,u.nome, r.anotacoes, r.minutos_totais, r.segundos_totais FROM registros as r LEFT JOIN usuarios as u on (r.id_usuario = u.id)";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function novoRegistro(){
       $query = "INSERT INTO registros(id_usuario,horas_atuais,anotacoes) Values(?,?,?)";
       $stmt = $this->conn->prepare($query);
       $stmt->bindValue(1,$this->__get("id_usuario"));
       $stmt->bindValue(2,$this->__get("horas_atuais"));
       $stmt->bindValue(3,$this->__get("anotacoes"));
       $stmt->execute();
    }

    public function atualizaTempo($nova_hora,$novo_min,$novo_seg){
      
      $query = "UPDATE registros SET horas_totais = $nova_hora, minutos_totais = $novo_min, segundos_totais = $novo_seg  WHERE id_usuario = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(1,$this->__get("id_usuario"));
      $stmt->execute();
       
    }

    public function consultaPersonalizada(){
      $query = "SELECT horas_totais,minutos_totais,segundos_totais FROM registros WHERE id_usuario = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(1,$this->__get("id_usuario"));
      $stmt->execute();
      return $stmt->fetch(\PDO::FETCH_ASSOC);


    }
}