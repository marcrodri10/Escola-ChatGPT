<?php 

require 'routes.php';

//establish the route and see if it exists in the application routes
function getRoute($routes){
    
    if(isset($_SERVER['REQUEST_URI'])){
        
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = explode('/', $url);
        
        $controller = $url[0];
        if($controller == 'index.php') $controller = 'home';
        
        if(in_array($controller, $routes)){
            return $controller;
        }
        else throw new Exception("URL not found");
    }
    return null;
}