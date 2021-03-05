<?php 
namespace App\Controllers;
use App\Controllers\AppController;
use App\Controllers\IndexController;

class Abstraction{

    

	public function render($route){
       session_start();
       $class_this = get_class($this);
       $class_this = str_replace('App\\Controllers\\', '', $class_this);
       $class_this = strtolower(str_replace('Controller', '', $class_this));
       require_once "../App/Views/layout.phtml";
       require_once "../App/Views/".$class_this."/".$route.".phtml";


	}

	

	
	
}