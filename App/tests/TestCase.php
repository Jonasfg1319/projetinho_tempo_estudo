<?php 

namespace App\Test;
use App\Controllers\Tempo;

class TestCase{
  

    function test_calculo_tempo(){

    	$tempo = array(
            "horas_totais" => 0,
            "minutos_totais" => 2,
            "segundos_totais" => 3
         );

		$time = new Tempo("00","01","52");
		$time->calculaTempo($tempo);
         
        $esperado = "00:03:55"; 

		if($time->imprimeTempo() == $esperado){
		
			return "pass";
		
		}else{
          
          	return "failed";
		}

    }

}