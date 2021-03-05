<?php 

namespace App\Controllers;

use App\Controllers\Abstration;
use App\Models\Registro;
use App\Models\Usuario;
use App\Models\Teste;
use App\Models\Senha;

class IndexController extends Abstraction{
     
    public function pag(){
    	 $this->biscoito = "Bolacha";
         $this->render("pag");
    }

     public function index(){
    	 error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
         session_start();
         if(isset($_SESSION['id'])){
            
             header("Location: /entrada");
         }else{
            $senha = new Senha();
            $this->render("index");
         }
    }


    public function autentica(){
    	session_start();
        if($_POST['name'] != " " || $_POST['pass'] != " "){
            $user = new Usuario();
            $user->__set("nome",$_POST['name']);
            //$user->__set("senha",$senha);
            $t = $user->require_user();
            $t = $t['senha'];
            $senha = new Senha();
            
            if($senha->verificar($_POST['pass'], $t) == "success"){
              $user->__set("senha",$t);
              $this->autentica = $user->authenticate();
            }
    
            
            if(count($this->autentica) > 1){
               $_SESSION['id'] = $this->autentica['id'];
               $_SESSION['name'] = $this->autentica['nome'];
               $reg = new Registro();
               
               $reg->__set("id_usuario",$_SESSION['id']);
               $consulta = $reg->consultaPersonalizada();
               
               $tempo = new Teste($consulta['horas_totais'],$consulta['minutos_totais'],$consulta['segundos_totais']);
               $tempo = $tempo->imprimeTempo();
               
               $_SESSION['total_hora'] = $tempo;
               
               header("Location: /entrada");   
            }else{
                
                header("Location: /?error=user_not_found");
            }
            //header("Location: /app/app_index");
          
        }else{
            header("Location: /?error=void");
        }

    	
    }

    public function registro(){
      
       if($_POST['name'] != " " && $_POST['pass'] != " " && $_POST['email'] != " " ){

           $user = new Usuario();
           $senha = new Senha();
           $user->__set("nome",$_POST['name']);
           $user->__set("senha", $senha->encryptar($_POST['pass'])); 
           $user->__set("email",$_POST['email']);

           $user->insert();

           header("Location: /");

        }
    }

    public function registrar(){

         $this->render("registrar");
    }
}