<?php 

namespace App;


class Route{

	 private $routes;

	 public function __construct(){
	 	$this->initRoutes();
	 	$this->run($this->getUrl());
	 }

	 public function run($url){
        $route = $this->routes;
        foreach ($route as $key => $value) {
          if($this->getUrl() == $value["route"]){
             $controller = "App\\Controllers\\".ucfirst($value['controller']);
	           $class = new $controller;
             $r = $value['action'];
	           $class->$r();
	    }
    }
       
	   
	 }

	 public function getRoutes(){
	 	 return $this->routes;
	 }

	 public function setRoutes(array $routes){
	 	 $this->routes = $routes;
	 }
     
     public function initRoutes(){

     	$route['index'] = array(
           "route" => "/",
           "controller" => "IndexController",
           "action" => "index"
     	 );
     
        $route['estudar'] = array(
           "route" => "/estudar",
           "controller" => "AppController",
           "action" => "estudar"
     	 );

        $route['entrada'] = array(
           "route" => "/entrada",
           "controller" => "AppController",
           "action" => "entrada"
     	 );

        $route['autentica'] = array(
           "route" => "/autentica",
           "controller" => "IndexController",
           "action" => "autentica"
     	 );

        $route['registrar'] = array(
           "route" => "/registrar",
           "controller" => "IndexController",
           "action" => "registrar"
       );

        $route['registro'] = array(
           "route" => "/registro",
           "controller" => "IndexController",
           "action" => "registro"
       );

        $route['cadastra_registro'] = array(
           "route" => "/cadastra_registro",
           "controller" => "AppController",
           "action" => "cadastra_registro"
     	 );

        $route['fecha_sessao'] = array(
           "route" => "/fecha_sessao",
           "controller" => "AppController",
           "action" => "fecha_sessao"
     	 );

        $this->setRoutes($route);

     }



     public function getUrl(){

        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
     }
	
	 
}