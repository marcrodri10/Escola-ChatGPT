<?php
    
    require 'conexion.php';
    require 'src/render.php';

    //check if the user is logged
    if(isset($_SESSION['user_data'])){
        
        //get user data from session
        $lang = $_SESSION['lang'];
            

        $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
        $userId = $_SESSION['user_data']['user_id'];

        //get student data from database
        if($userRole == 1){
            
            $userDataProfile = $db->getResponse(
                $db->select('users', [
                    'id' => 'alumnos', 'nombre' => 'users', 'apellidos' => 'users',
                    'email' => 'users', 'fecha_nacimiento' => 'alumnos', 'direccion' => 'alumnos',
                ]) .
                $db->innerJoin('users', 'alumnos', 'user_id', 'user_id').
                $db->condition('user_id', 'users', '='),

                [':user_id' => $userId]
            )[0];
        }
        //get teacher data from databse
        else {
            $userDataProfile = $db->getResponse(
                $db->select('users', [
                    'id' => 'profesores', 'nombre' => 'users', 'apellidos' => 'users',
                    'email' => 'users', 'departamento' => 'profesores'
                ]) .
                $db->innerJoin('users', 'profesores', 'user_id', 'user_id').
                $db->condition('user_id', 'users', '='),

                [':user_id' => $userId]
            )[0];
        }

        //build nav bar
        $navbarOptions = [
            'left' => [
                ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
                ['text' => $navbarTranslations[$lang]['left'][1], 'url' => 'dashboard'],
                ['text' => $navbarTranslations[$lang]['left'][2], 'url' => 'matricula'],
                ['text' => $navbarTranslations[$lang]['left'][3], 'url' => 'calificaciones'],
            ],
            'right' => [
                ['text' => $navbarTranslations[$lang]['right'][0], 'url' => 'profile'],
                ['text' => $navbarTranslations[$lang]['right'][1], 'url' => 'logoutController'],
                ['text' => $navbarTranslations[$lang]['right'][2], 'url' => 'settings'],
            ],
        ];
        
        $navbarOptions = setNavbarOptions($navbarOptions);
        //render with variables
        echo render('updateProfile', [
            'title' => 'Update Profile',
            'navbarOptions' => $navbarOptions,
            'userDataProfile' => $userDataProfile,
            'userRole' => $userRole,
        ]);
    }
    else{
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');       
    }

?>