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
       $this->parametro = $this->organiza_tempo($this->parametro);
       $tam_registros = count($this->parametro);
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
      $registro->__set("horas_totais", $testar->__get("horas"));
      $registro->__set("minutos_totais", $testar->__get("minutos"));
      $registro->__set("segundos_totais", $testar->__get("segundos"));
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


  function organiza_tempo($registros){
  
    $registro = new Registro();
    foreach($registros as $key => $r){

         $registro_usuario = $registro->tempo_total_registro($r["id_usuario"]);
         
         $r["horas_totais"] = 0;
         $r["minutos_totais"] = 0;
         $r["segundos_totais"] = 0;

         foreach($registro_usuario as $r2){
             
             $r["horas_totais"] += $r2["horas_totais"];
             $r["minutos_totais"] = $r2["minutos_totais"];
             $r["segundos_totais"] = $r2["segundos_totais"];
         }

    }

    return $registros;

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