<?php 
namespace App\Controllers;

use App\Controllers\Abstration;
use App\Models\Registro;
use App\Controllers\Tempo;
use App\Models\Nota;

class AppController extends Abstraction{

   public function entrada(){
       $registro = new Registro();
       $pag = 1;
       if(isset($_GET['pag'])){
          $pag = $_GET['pag'];
       }
       $this->parametro = $registro->listarRegistros($pag);
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
      echo "$horas: $minutos: $segundos <br>";
      echo $tempo[count($tempo)-1]['horas_totais'] .
      ":". $tempo[count($tempo)-1]['minutos_totais'] .
      ":". $tempo[count($tempo)-1]['segundos_totais'];

      $testar = new Tempo($horas,$minutos,$segundos);
      $testar->calculaTempo($tempo[count($tempo)-1]);
     
      $registro->__set("horas_totais", $testar->__get("horas"));
      $registro->__set("minutos_totais", $testar->__get("minutos"));
      $registro->__set("segundos_totais", $testar->__get("segundos"));
      $registro->novoRegistro();
    
              
      $_SESSION["total_hora"] = $testar->imprimeTempo(); 
      
     header("Location: /");
      

     
   }


   public function cadastra_nota(){
 

         //code
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