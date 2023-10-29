<?php
    
    //Starting the session
    session_start();

   //Load all the components 
    require 'src/router.php';
    require 'src/routes.php';
    require 'src/functions.php';
    require 'src/translations.php';
    
    //To avoid loading index.php on the url directly we redirect to home
    if ($_SERVER['REQUEST_URI'] === '/index.php') {
        header('Location: /home');
        exit;
    }
    
    try{
        //get the url
        $controller =  getRoute($routes);
        
        
        if($controller == null){
            $controller = "home";
        }
        //require the url in controllers folder
        require 'controllers/'.$controller.'.php';
    }
    catch(Exception $e){
        $_SESSION['error'] = $e->getMessage();

        require 'controllers/error.php';
    }
   
    
    

    

?> 