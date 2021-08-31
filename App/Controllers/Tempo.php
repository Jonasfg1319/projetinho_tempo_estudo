<?php 
namespace App\Controllers;


class Tempo {
    
  private $horas;
  private $minutos;
  private $segundos;

  public function __construct($horas,$minutos,$segundos){
      
      $this->horas = intval($horas);
      $this->minutos = intval($minutos);
      $this->segundos = intval($segundos);
  }


  public function __get($at){
    
       return $this->$at;
  }

  public function __set($at,$value){
       $this->$at = $value;
  }
 
  public function calculaTempo($tempo){
  
      $this->horas += intval($tempo['horas_totais']);
      $this->minutos += intval($tempo['minutos_totais']);
      $this->segundos += intval($tempo['segundos_totais']);
        

       if($this->segundos % 60 + $this->segundos > 60 ){
           $this->minutos += 1;
       }

       if($this->horas % 60 + $this->horas > 60 ){
           $this->horas += 1;
       }
     
       if($this->minutos > 59){
         if($this->horas == intval($tempo['horas_totais'])){
            $this->horas += 1;
        }
        $this->minutos = $this->minutos % 60;
      }

      
      if($this->segundos > 59){
        if($this->minutos == intval($tempo['minutos_totais'])){
            $this->minutos += 1;
        }
           
        $this->segundos = $this->segundos % 60;
      }


  }

  public function imprimeTempo(){
     
     $h = $this->horas;
     $m = $this->minutos;
     $s = $this->segundos;
               
      if($h < 10){
          $h = "0".$h;
        } 
      if($m < 10){
          $m = "0".$m;
        }
      if($s < 10){
            $s = "0".$s;
        }
     return $h.":".$m.":".$s;
  }

}