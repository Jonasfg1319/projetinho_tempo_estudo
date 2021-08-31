<?php 
namespace App\Controllers;

class Senha{

   public function __construct(){
   	  
   }

   public function encryptar($pass){ 
     
      $options = [
       'cost' => 12,
      ];
     $new = password_hash($pass, PASSWORD_BCRYPT, $options);
     
     return $new;
   }

   public function verificar($pass,$pass_db){
       $c = "";
   	   if(\password_verify($pass,$pass_db) == $pass_db){
            $c = "success";
   	   }else{
            $c = "erro";
   	   }

   	   return $c;

   	   


   }
}