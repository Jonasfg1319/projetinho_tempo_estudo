<?php 
namespace App\Controllers;

use App\Controllers\Abstration;
use App\Models\Registro;
use App\Controllers\Tempo;
use App\Models\Nota;

class AppController extends Abstraction{

   public function entrada(){
       $registro = new Registro();
       $this->parametro = $registro->listarRegistros();
       $tam_registros = count($this->parametro);
       $this->parametro[$tam_registros-1]["horas_totais"] = $this->parametro[0]["horas_totais"].": ".$this->parametro[0]["minutos_totais"]." : ".$this->parametro[0]["segundos_totais"];
       $this->render("entrada");
   }

   public function estudar(){
        error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
      $this->ligar_sessao();
      $nt = new Nota();
      $notas = $nt->recupera_notas_user($_SESSION['id']);
      $this->notas = $notas;
      $this->render("estudar");
   }

   public function nota(){
      $this->ligar_sessao();
      $nt = new Nota();
      $notas = $nt->recupera_nt($_SESSION['id'],$_GET['reg']);
      $this->notas = $notas;
      $this->render("nota");
   }

   public function cadastra_registro(){

      session_start();
      $registro = new Registro();
     
      $registro->__set("id_usuario", $_SESSION['id']);
      $registro->__set("horas_atuais", $_POST['horas']);
      $registro->__set("anotacoes", $_POST['anotacao']);
      
      $tempo = $registro->consultaPersonalizada();

      $segundos = substr($_POST['horas'],8,2);
      $minutos = substr($_POST['horas'],4, 2);
      $horas = substr($_POST['horas'],0,2);

      $testar = new Tempo($horas,$minutos,$segundos);
      $testar->calculaTempo($tempo);
     
      $registro->atualizaTempo($testar->__get("horas"),$testar->__get("minutos"),$testar->__get("segundos"));
      $registro->novoRegistro();
    
              
      $_SESSION["total_hora"] = $testar->imprimeTempo(); 
      
      header("Location: /");
      

     
   }

   public function painel_usuario(){
       error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
       session_start();
       $reg = new Registro();
       $nt = new Nota();
       $registros = $reg->user_logado($_SESSION['id']);
       $notas = $nt->recupera_notas_user($_SESSION['id']);
       $this->registros = $registros;
       $this->notas = $notas;
       $this->render("painel_usuario");
   }
  public function ligar_sessao(){
    session_start();
  }

   public function fecha_sessao(){
       session_start();
       session_destroy();
       header("Location: /");
   }
}