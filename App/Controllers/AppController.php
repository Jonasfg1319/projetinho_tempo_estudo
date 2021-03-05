<?php 
namespace App\Controllers;

use App\Controllers\Abstration;
use App\Models\Registro;
//use App\Models\Tempo;
use App\Models\Teste;

class AppController extends Abstraction{

   public function entrada(){
       $registro = new Registro();
       $this->parametro = $registro->listarRegistros();
       $this->render("entrada");
   }

   public function estudar(){
      $this->render("estudar");
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

      $testar = new Teste($horas,$minutos,$segundos);
      $testar->calculaTempo($tempo);
     
      $registro->atualizaTempo($testar->__get("horas"),$testar->__get("minutos"),$testar->__get("segundos"));
      $registro->novoRegistro();
    
              
      $_SESSION["total_hora"] = $testar->imprimeTempo(); 
      
      header("Location: /");
      

     
   }


   public function fecha_sessao(){
       session_start();
       session_destroy();
       header("Location: /");
   }
}